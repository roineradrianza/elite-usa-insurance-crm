<?php
RA_ELITE_USA_INSURANCE_INBOX::init();

class RA_ELITE_USA_INSURANCE_INBOX
{
    public static function init() {
        //INBOX
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_inbox', 'RA_ELITE_USA_INSURANCE_INBOX::get_admin_inbox' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_agent_inbox', 'RA_ELITE_USA_INSURANCE_INBOX::get_agent_inbox' );
        //NOTIFICATIONS
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_admin_notifications', 'RA_ELITE_USA_INSURANCE_INBOX::get_admin_notifications' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_agent_notifications', 'RA_ELITE_USA_INSURANCE_INBOX::get_agent_notifications' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_mark_read_notification', 'RA_ELITE_USA_INSURANCE_INBOX::mark_notification_as_read' );
    }

    public static function get_admin_inbox()
    {
        $args = array(
            'posts_per_page' => 1000,
            'post_type' => ['quote_form', 'quote_data_r', 'quote_doc_r', 'quote_form_mr'],
            'meta_query' => [
                [
                    'key'   => 'status',
                    'value' => ['1', 'Approved'],
                    'compare' => 'NOT IN'
                ]
            ]       
        );
        $metadata =
        [
            'status', 
            'affordable_care_act', 
            'personal_information', 
            'employment_information', 
            'espouse_information', 
            'espouse_employment_information', 
            'dependents', 
            'payment_information',
            'seen'
        ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            $author = RA_ELITE_USA_INSURANCE_USER::get_current_user($post['post_author']);
            $post['agent'] = $author['first_name'] . ' ' . $author['last_name'];
            foreach ($metadata as $meta) {
                if ($meta == 'status') {
                   $post[$meta] = get_post_meta( $post['ID'], $meta, true );
                }
                else {
                  $post[$meta] = json_decode(get_post_meta( $post['ID'], $meta, true ));  
                }
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }

    public static function get_agent_inbox()
    {
        $author = RA_ELITE_USA_INSURANCE_USER::get_current_user();
        $args = array(
            'posts_per_page' => 1000,
            'author' => $author['id'],
            'post_type' => ['quote_form', 'quote_data_r', 'quote_doc_r'],
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key'   => 'status',
                    'value' => ['1', 'Approved'],
                    'compare' => 'NOT IN'
                ],
                [
                    'key'   => 'seen',
                    'value' => ['1'],
                    'compare' => 'NOT IN'
                ],
            ]       
        );
        $metadata =
        [
            'status', 
            'affordable_care_act', 
            'personal_information', 
            'employment_information', 
            'espouse_information', 
            'espouse_employment_information', 
            'dependents', 
            'payment_information',
            'attachment_url',
            'seen'
        ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            $post['agent'] = $author['first_name'] . ' ' . $author['last_name'];
            foreach ($metadata as $meta) {
                if ($meta == 'status') {
                   $post[$meta] = get_post_meta( $post['ID'], $meta, true );
                }
                else {
                  $post[$meta] = json_decode(get_post_meta( $post['ID'], $meta, true ));  
                }
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }

    public static function get_admin_notifications()
    {
        $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
        $args = array(
            'posts_per_page' => 1000,
            'post_type' => ['quote_data_r', 'quote_doc_r', 'quote_form_mr'],
            'meta_query' => [
                [
                    'key'   => 'status',
                    'value' => ['1', 'Approved'],
                    'compare' => 'NOT IN'
                ]
            ]       
        );
        $metadata =
        [
            'status', 
            'affordable_care_act', 
            'personal_information', 
            'employment_information', 
            'espouse_information', 
            'espouse_employment_information', 
            'dependents', 
            "date_user_{$current_user['id']}_n_seen",
            'payment_information',
            'seen'
        ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            $author = RA_ELITE_USA_INSURANCE_USER::get_current_user($post['post_author']);
            $post['agent'] = $author['first_name'] . ' ' . $author['last_name'];
            foreach ($metadata as $meta) {
                if ($meta == 'status' || $meta == "date_user_{$current_user['id']}_n_seen") {
                   $post[$meta] = get_post_meta( $post['ID'], $meta, true );
                }
                else {
                  $post[$meta] = json_decode(get_post_meta( $post['ID'], $meta, true ));  
                }
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }
    
    public static function get_agent_notifications()
    {
        $author = RA_ELITE_USA_INSURANCE_USER::get_current_user();
        $args = array(
            'posts_per_page' => 1000,
            'author' => $author['id'],
            'post_type' => ['quote_data_r', 'quote_doc_r'],
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key'   => 'status',
                    'value' => ['1', 'Approved'],
                    'compare' => 'NOT IN'
                ],
                [
                    'key'   => 'seen',
                    'value' => ['1'],
                    'compare' => 'NOT IN'
                ],
            ] 
        );
        $metadata =
        [
            'status', 
            'affordable_care_act', 
            'personal_information', 
            'employment_information', 
            'espouse_information', 
            'espouse_employment_information', 
            'dependents', 
            'payment_information',
            'attachment_url',
            "date_user_{$author['id']}_n_seen",
            'seen',
        ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            $post['agent'] = $author['first_name'] . ' ' . $author['last_name'];
            foreach ($metadata as $meta) {
                if ($meta == 'status' || $meta == "date_user_{$author['id']}_n_seen") {
                   $post[$meta] = get_post_meta( $post['ID'], $meta, true );
                }
                else {
                  $post[$meta] = json_decode(get_post_meta( $post['ID'], $meta, true ));  
                }
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }
    
    public static function mark_notification_as_read()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
        $result = update_post_meta( $data['ID'], "date_user_{$current_user['id']}_n_seen", date('Y-m-d h:i:s a', time()) );
        $message = ['message' => 'Notification marked as read', 'status' => 'success', 'data' => $result];
        wp_send_json( $message );
    }

}