<?php

namespace RA_ELITE_USA\Controller\Classes\Quotes;

use \RA_ELITE_USA\Models\ActionsHistory;

\RA_ELITE_USA\Controller\Classes\Quotes\Modifications::init();

class Modifications
{
    public static function init()
    {
        add_action('wp_ajax_ra_elite_usa_insurance_save_quote_modification_request', '\RA_ELITE_USA\Controller\Classes\Quotes\Modifications::store');
        add_action('wp_ajax_ra_elite_usa_insurance_get_quote_modification_requests', '\RA_ELITE_USA\Controller\Classes\Quotes\Modifications::get');
        add_action('wp_ajax_ra_elite_usa_insurance_approve_form_modification_request', '\RA_ELITE_USA\Controller\Classes\Quotes\Modifications::approve');
    }

    public static function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['post_content'])) {
            wp_send_json(['message' => 'You must put the modifications.', 'status' => 'error']);
        }

        $post_arguments = [
            'post_parent' => $data['post_parent'],
            'post_title' => "Modification Requested - ${data['post_date_name']}",
            'post_type' => 'quote_form_mr',
            'post_status' => 'publish',
            'post_content' => $data['post_content'],
            'meta_input' => [
                'status' => '0',
            ],
        ];
        $result = wp_insert_post($post_arguments);
        $message = ['message' => 'Modification Request Sent', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        $action_data = [
            'action_message' => "Quote modification requested",
            'post_type' => $post_arguments['post_type'],
            'action_type' => 'request',
            'post_parent' => $result,
            'post_id' => $post_arguments['post_parent'],
            'extra_info' => json_encode($post_arguments, JSON_UNESCAPED_UNICODE),
        ];
        $action_history = new ActionsHistory();
        $action_result = $action_history->create($action_data);

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
            'post_type' => 'quote_form_mr',
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

    public static function approve()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['ID'])) {
            wp_send_json(['message' => 'You has selected an unknown modification request.', 'status' => 'error']);
        }

        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '1',
            ],
        ];
        $result = wp_update_post($post_arguments);
        $message = ['message' => 'Modification Request Approved', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        $data['meta_input'] = $post_arguments['meta_input'];
        $action_data = [
            'post_id' => $data['post_parent'],
            'post_parent' => $data['ID'],
            'action_message' => "Quote modification requested marked as approved",
            'post_type' => 'quote_data_r',
            'action_type' => 'status update',
            'extra_info' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ];
        $action_history = new ActionsHistory();
        $action_result = $action_history->create($action_data);
        wp_send_json($message);
    }

}
