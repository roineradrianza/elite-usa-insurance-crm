<?php

RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST::init();

class RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST
{
    public static function init()
    {
        add_action('wp_ajax_ra_elite_usa_insurance_save_quote_attachment_request', 'RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST::store');
        add_action('wp_ajax_ra_elite_usa_insurance_get_quote_attachment_requests', 'RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST::get');
        add_action('wp_ajax_ra_elite_usa_insurance_upload_quote_attachment_requested', 'RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST::upload');
        add_action('wp_ajax_ra_elite_usa_insurance_delete_quote_attachment_requested', 'RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST::delete');
        add_action('wp_ajax_ra_elite_usa_insurance_process_form_document_requested', 'RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST::process');
        add_action('wp_ajax_ra_elite_usa_insurance_approve_form_document_requested', 'RA_ELITE_USA_INSURANCE_DOCUMENT_REQUEST::approve_quote_document_request');
    }

    public static function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['post_title'])) {
            wp_send_json(['message' => 'You must put the document name.', 'status' => 'error']);
        }

        $post_arguments = [
            'post_parent' => $data['post_parent'],
            'post_title' => $data['post_title'],
            'post_author' => $data['post_author'],
            'post_type' => 'quote_doc_r',
            'post_status' => 'publish',
            'post_content' => '',
            'meta_input' => [
                'status' => '0',
                'attachment_id' => '',
                'attachment_url' => '',
            ],
        ];

        if (!empty($data['ID'])) {
            $post_arguments['meta_input']['status'] = $data['status'];
            $post_arguments['ID'] = $data['ID'];
        }
        $result = empty($post_arguments['ID']) ? wp_insert_post($post_arguments) : wp_update_post($post_arguments);
        $message = ['message' => empty($data['ID']) ? 'Document requested' : 'Document name edited', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        if (empty($data['ID'])) {
            $action_data = [
                'post_id' => $post_arguments['post_parent'],
                'post_parent' => $result,
                'action_message' => "Document requested",
                'post_type' => $post_arguments['post_type'],
                'action_type' => 'request',
                'extra_info' => json_encode($post_arguments, JSON_UNESCAPED_UNICODE),
            ];
            $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
            $action_result = $action_history->create($action_data);
        }
        wp_send_json($message);
    }

    public static function get()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['post_parent'])) {
            wp_send_json([]);
        }

        $args = array(
            'posts_per_page' => 100,
            'post_type' => 'quote_doc_r',
            'post_parent' => $data['post_parent'],
        );
        $metadata = ['status', 'attachment_url', 'attachment_id'];
        $query = get_posts($args);
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            foreach ($metadata as $meta) {
                if ($meta == 'attachment_url' || $meta == 'attachment_id') {
                    $meta_val = get_post_meta($post['ID'], $meta, true);
                    $post[$meta] = str_contains($meta_val, '[') ? json_decode($meta_val) : $meta_val;
                } else {
                    $post[$meta] = get_post_meta($post['ID'], $meta, true);
                }
            }
            $posts[] = $post;
        }
        wp_send_json($posts);
    }

    public static function upload()
    {
        if (!isset($_FILES['attachment'])) {
            wp_send_json(['message' => 'You must upload the document.', 'status' => 'error']);
        }
        $data = $_POST;
        $files = $_FILES['attachment'];
        $message = ['message' => 'Document/s uploaded', 'status' => 'success', 'data' => []];
        $attachs_id = [];
        for ($i = 0; $i < count($files["name"]); $i++) {
            $upload_dir = wp_upload_dir();
            $filename = explode(".", $files['name'][$i])[0];
            $filetype = wp_check_filetype(basename($files['name'][$i]), null);
            $filename_ext = sanitize_title($filename) . ".{$filetype['ext']}";
            $moveFile = move_uploaded_file($files["tmp_name"][$i], $upload_dir['path'] . "/$filename_ext");
            if ($moveFile) {
                $attachment = array(
                    'post_parent' => $data['ID'],
                    'guid' => $upload_dir['url'] . '/' . $filename_ext,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => $data['post_title'] . ' attachment',
                    'post_content' => $upload_dir['url'] . '/' . $filename_ext,
                    'post_status' => 'inherit',
                );
                $attach_result = wp_insert_attachment($attachment, $filename_ext, $data['ID']);
                $attachs_id[] = $attach_result;
                $attachs_url[] = $attachment['guid'];
                if (!$attach_result) {
                    $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
                    wp_send_json($message);
                }
            } else {
                wp_send_json(['message' => "There was an error with the uploaded file: {$files['name'][$i]}, try again.", 'status' => 'error']);
            }
        }
        $attachs_id = json_encode($attachs_id, JSON_UNESCAPED_UNICODE);
        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => 2,
                'attachment_url' => json_encode($attachs_url, JSON_UNESCAPED_UNICODE),
                'attachment_id' => $attachs_id,
            ],
        ];
        $result = wp_update_post($post_arguments);

        $post_parent = get_post($data['ID'], ARRAY_A);
        $data['meta_input'] = $post_arguments['meta_input'];
        $data['post_type'] = 'quote_doc_r';
        $action_data = [
            'post_id' => $post_parent['post_parent'],
            'post_parent' => $data['ID'],
            'action_message' => "Attachment/s requested added",
            'action_type' => 'upload',
            'post_type' => 'quote_doc_r',
            'extra_info' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ];
        $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
        $action_result = $action_history->create($action_data);
        $message_data = ['attachment_id' => $attachs_id, 'attachment_url' => $attachs_url];
        $message['data'] = $message_data;
        wp_send_json($message);
    }

    public static function delete()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $message = ['message' => 'Document request deleted', 'status' => 'success'];
        add_action('before_delete_post', 'ra_elite_usa_insurance_delete_attachment', $data['ID']);
        $results = wp_delete_post($data['ID'], true);
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        $action_data = [
            'action_message' => "Document requested deleted",
            'post_type' => $data['post_type'],
            'action_type' => 'delete',
            'post_id' => $data['post_parent'],
        ];
        $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
        $action_result = $action_history->create($action_data);
        wp_send_json($message);
    }

    public static function process()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['ID'])) {
            wp_send_json(['message' => 'You has selected an unknown document requested.', 'status' => 'error']);
        }

        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '3',
            ],
        ];
        $result = wp_update_post($post_arguments);
        $message = ['message' => 'Document marked as processing', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        $data['meta_input'] = $post_arguments['meta_input'];
        $data['meta_input']['attachment_url'] = $data['attachment_url'];
        $action_data = [
            'post_id' => $data['post_parent'],
            'post_parent' => $data['ID'],
            'action_message' => "Document requested marked as processing",
            'post_type' => 'quote_doc_r',
            'action_type' => 'status update',
            'extra_info' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ];
        $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
        $action_result = $action_history->create($action_data);
        wp_send_json($message);
    }

    public static function approve_quote_document_request()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['ID'])) {
            wp_send_json(['message' => 'You has selected an unknown document requested.', 'status' => 'error']);
        }

        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '1',
            ],
        ];
        $result = wp_update_post($post_arguments);
        $message = ['message' => 'Document Approved', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        $data['meta_input'] = $post_arguments['meta_input'];
        $data['meta_input']['attachment_url'] = $data['attachment_url'];
        $action_data = [
            'post_id' => $data['post_parent'],
            'post_parent' => $data['ID'],
            'action_message' => "Document requested marked as approved",
            'post_type' => 'quote_doc_r',
            'action_type' => 'status update',
            'extra_info' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ];
        $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
        $action_result = $action_history->create($action_data);
        wp_send_json($message);
    }

}
