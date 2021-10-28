<?php

RA_ELITE_USA_INSURANCE_INFORMATION_REQUEST::init();

class RA_ELITE_USA_INSURANCE_INFORMATION_REQUEST
{
    public static function init()
    {
        add_action('wp_ajax_ra_elite_usa_insurance_save_quote_information_request', 'RA_ELITE_USA_INSURANCE_INFORMATION_REQUEST::store');
        add_action('wp_ajax_ra_elite_usa_insurance_get_quote_information_requests', 'RA_ELITE_USA_INSURANCE_INFORMATION_REQUEST::get');
        add_action('wp_ajax_ra_elite_usa_insurance_upload_quote_information_requested', 'RA_ELITE_USA_INSURANCE_INFORMATION_REQUEST::upload');
        add_action('wp_ajax_ra_elite_usa_insurance_delete_quote_information_request', 'RA_ELITE_USA_INSURANCE_INFORMATION_REQUEST::delete');
        add_action('wp_ajax_ra_elite_usa_insurance_approve_form_information_request', 'RA_ELITE_USA_INSURANCE_INFORMATION_REQUEST::approve');
    }

    public static function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['post_title'])) {
            wp_send_json(['message' => 'You must put the information to be requested.', 'status' => 'error']);
        }

        $post_arguments = [
            'post_parent' => $data['post_parent'],
            'post_title' => $data['post_title'],
            'post_author' => $data['post_author'],
            'post_type' => 'quote_data_r',
            'post_status' => 'publish',
            'post_content' => '',
            'meta_input' => [
                'status' => 0,
            ],
        ];
        if (!empty($data['ID'])) {
            $post_arguments['meta_input']['status'] = $data['status'];
            $post_arguments['ID'] = $data['ID'];
        }
        $result = empty($data['ID']) ? wp_insert_post($post_arguments) : wp_update_post($post_arguments);
        $message = ['message' => empty($data['ID']) ? 'Information request created' : 'Information request edited', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        if (empty($data['ID'])) {
            $action_data = [
                'post_id' => $post_arguments['post_parent'],
                'post_parent' => $result,
                'action_message' => "Information requested",
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
            'post_type' => 'quote_data_r',
            'post_parent' => $data['post_parent'],
        );
        $metadata = ['status'];
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
    public static function upload()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['post_content'])) {
            wp_send_json(['message' => 'You must send the information', 'status' => 'error']);
        }

        $post_arguments = [
            'ID' => $data['ID'],
            'post_content' => $data['post_content'],
            'meta_input' => [
                'status' => 2,
            ],
        ];
        $data['meta_input'] = $post_arguments['meta_input'];
        $action_data = [
            'post_id' => $data['post_parent'],
            'post_parent' => $data['ID'],
            'action_message' => "Information requested uploaded",
            'post_type' => 'quote_data_r',
            'action_type' => 'upload',
            'extra_info' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ];
        $result = wp_update_post($post_arguments);
        $message = ['message' => 'Information sent successfully', 'status' => 'success'];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
        $action_result = $action_history->create($action_data);

        wp_send_json($message);
    }

    public static function delete()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $message = ['message' => 'Information request deleted', 'status' => 'success'];
        $results = wp_delete_post($data['ID'], true);
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json($message);
    }

    public static function approve()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['ID'])) {
            wp_send_json(['message' => 'You has selected an unknown information request.', 'status' => 'error']);
        }

        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '1',
            ],
        ];
        $result = wp_update_post($post_arguments);
        $message = ['message' => 'Information Approved', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        $data['meta_input'] = $post_arguments['meta_input'];
        $action_data = [
            'post_id' => $data['post_parent'],
            'post_parent' => $data['ID'],
            'action_message' => "Information requested marked as approved",
            'post_type' => 'quote_data_r',
            'action_type' => 'status update',
            'extra_info' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ];
        $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
        $action_result = $action_history->create($action_data);
        wp_send_json($message);
    }

}
