<?php

RA_ELITE_USA_INSURANCE_AGENT_ATTACHMENT::init();

class RA_ELITE_USA_INSURANCE_AGENT_ATTACHMENT
{
    public static function init()
    {
        add_action('wp_ajax_ra_elite_usa_insurance_save_quote_agent_attachment', 'RA_ELITE_USA_INSURANCE_AGENT_ATTACHMENT::store');
        add_action('wp_ajax_ra_elite_usa_insurance_mark_seen_quote_agent_attachment', 'RA_ELITE_USA_INSURANCE_AGENT_ATTACHMENT::mark_seen');
        add_action('wp_ajax_ra_elite_usa_insurance_get_quote_agent_attachments', 'RA_ELITE_USA_INSURANCE_AGENT_ATTACHMENT::get');
        add_action('wp_ajax_ra_elite_usa_insurance_delete_quote_agent_attachment', 'RA_ELITE_USA_INSURANCE_AGENT_ATTACHMENT::delete');
    }

    public static function store()
    {
        $data = $_POST;
        if (empty($data['post_title'])) {
            wp_send_json(['message' => 'You must put the document name.', 'status' => 'error']);
        } else if (empty($data['ID']) && !isset($_FILES['attachment'])) {
            wp_send_json(['message' => 'You must upload the file before create the attachment.', 'status' => 'error']);
        }

        $agent = RA_ELITE_USA_INSURANCE_USER::get_current_user();
        $post_arguments = [
            'post_parent' => $data['post_parent'],
            'post_title' => $data['post_title'],
            'post_author' => empty($data['post_author']) ? $agent['id'] : $data['post_author'],
            'post_type' => 'quote_a_doc',
            'post_status' => 'publish',
            'post_content' => '',
            'meta_input' => [
                'status' => 0,
                'attachment_id' => empty($data['attachment_id']) ? '' : $data['attachment_id'],
                'attachment_url' => empty($data['attachment_url']) ? '' : $data['attachment_url'],
            ],
        ];
        if (!empty($data['ID'])) {
            $post_arguments['ID'] = $data['ID'];
            $action_data['action_message'] = 'Attachment added has been updated';
            $action_data['action_type'] = 'update';
        }
        $post_result = wp_insert_post($post_arguments);
        $action_data = [
            'post_id' => $post_arguments['post_parent'],
            'post_parent' => $post_result,
            'action_message' => "Attachment added",
            'post_type' => $post_arguments['post_type'],
            'action_type' => 'upload',
            'raw_data_extra_info' => $post_arguments,
            'extra_info' => json_encode($post_arguments, JSON_UNESCAPED_UNICODE),
        ];
        if (!$post_result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
            wp_send_json($message);
        }
        $message = ['message' => empty($data['ID']) ? 'Document requested' : 'Document name edited', 'status' => 'success', 'data' => ['ID' => $post_result]];
        if (isset($_FILES['attachment'])) {
            $upload_dir = wp_upload_dir();
            $filename = explode(".", $_FILES['attachment']['name'])[0];
            $filetype = wp_check_filetype(basename($_FILES['attachment']['name']), null);
            $filename_ext = sanitize_title($filename) . ".{$filetype['ext']}";
            $moveFile = move_uploaded_file($_FILES["attachment"]["tmp_name"], $upload_dir['path'] . "/$filename_ext");
            if ($moveFile) {
                $ID = empty($data['ID']) ? $post_result : $data['ID'];
                $attachment = array(
                    'post_parent' => $ID,
                    'guid' => $upload_dir['url'] . '/' . $filename_ext,
                    'post_mime_type' => $filetype['type'],
                    'post_title' => $data['post_title'] . ' attachment',
                    'post_content' => $upload_dir['url'] . '/' . $filename_ext,
                    'post_status' => 'inherit',
                );
                $attach_id = '';
                if (!empty($data['attachment_id'])) {
                    $attach_id = wp_insert_attachment($attachment, $filename_ext, $ID);
                } else {
                    $attachment['ID'] = $data['attachment_id'];
                    $attach_name_update = update_attached_file($attachment['ID'], $filename_ext);
                    $attach_id = wp_update_post($attachment);
                }
                $post_arguments = [
                    'ID' => $ID,
                    'meta_input' => [
                        'attachment_url' => $attachment['guid'],
                    ],
                ];
                if (empty($data['attachment_id'])) {
                    $post_arguments['meta_input']['attachment_id'] = $attach_id;
                }

                $result = wp_update_post($post_arguments);
                $message_data = empty($data['attachment_id']) ? ['attachment_id' => $result, 'attachment_url' => $attachment['guid']] : ['attachment_url' => $attachment['guid']];
                if (empty($data['ID'])) {
                    $message_data['ID'] = $ID;
                }

                $message = ['message' => empty($data['attachment_id']) ? 'Document uploaded' : 'Document updated', 'status' => 'success', 'data' => $message_data];
                if (!$result) {
                    $message = ['message' => 'There was an error uploading the attachment, try again.', 'status' => 'error', 'error' => $result];
                }
                $action_data['raw_data_extra_info']['meta_input'] = $post_arguments['meta_input'];
                $action_data['extra_info'] = json_encode($action_data['raw_data_extra_info'], JSON_UNESCAPED_UNICODE);
                if (!empty($data['ID'])) {
                    $action_data['action_message'] = 'Attachment updated';
                }
                unset($action_data['raw_data_extra_info']);
                $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
                $action_result = $action_history->create($action_data);
                wp_send_json($message);
            } else {
                wp_send_json(['message' => "There was an error with the uploaded file, try again.", 'status' => 'error']);
            }
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
            'post_type' => 'quote_a_doc',
            'post_parent' => $data['post_parent'],
        );
        $metadata = ['attachment_url', 'attachment_id', 'status'];
        $query = get_posts($args);
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            foreach ($metadata as $meta) {
                $post[$meta] = get_post_meta($post['ID'], $meta, true);
            }
            $posts[] = $post;
        }
        wp_send_json($posts);
    }

    public static function mark_seen()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['ID'])) {
            wp_send_json(['status' => 'error', 'message' => 'Attachment ID not found']);
        }

        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => 1
            ],
        ];
        $post_result = wp_update_post($post_arguments);
        
        $message = ['status' => 'success', 'message' => 'Marked as seen'];

        if (!$post_result) {
            $message = ['status' => 'error', 'message' => 'Not seen'];
        }

        wp_send_json($message);
    }

    public static function delete()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $message = ['message' => 'Document attachment deleted', 'status' => 'success'];
        add_action('before_delete_post', 'ra_elite_usa_insurance_delete_attachment', $data['ID']);
        $results = wp_delete_post($data['ID'], true);
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json($message);
    }

}
