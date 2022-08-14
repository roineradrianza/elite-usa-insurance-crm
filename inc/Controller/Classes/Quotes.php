<?php

namespace RA_ELITE_USA\Controller\Classes;

use \RA_ELITE_USA\Controller\Classes\User;
use \RA_ELITE_USA\Controller\Classes\Template;
use \RA_ELITE_USA\Controller\Classes\ActionsHistory;

\RA_ELITE_USA\Controller\Classes\Quotes::init();

class Quotes
{
    public static function init()
    {
        add_action('wp_ajax_ra_elite_usa_insurance_save_quote_form', '\RA_ELITE_USA\Controller\Classes\Quotes::store');
        add_action('wp_ajax_ra_elite_usa_insurance_generate_quote_pdf', '\RA_ELITE_USA\Controller\Classes\Quotes::generate_pdf');
        add_action('wp_ajax_ra_elite_usa_insurance_get_quote', '\RA_ELITE_USA\Controller\Classes\Quotes::get_quote');
        add_action('wp_ajax_ra_elite_usa_insurance_get_quotes', '\RA_ELITE_USA\Controller\Classes\Quotes::get_quotes');
        add_action('wp_ajax_ra_elite_usa_insurance_get_my_quote_forms', '\RA_ELITE_USA\Controller\Classes\Quotes::get_quotes');
        add_action('wp_ajax_ra_elite_usa_insurance_archive_quote', '\RA_ELITE_USA\Controller\Classes\Quotes::archive');
        add_action('wp_ajax_ra_elite_usa_insurance_unarchive_quote', '\RA_ELITE_USA\Controller\Classes\Quotes::unarchive');
    }

    public static function store()
    {
        $post_data = [];
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $val = stripslashes($value);
                $post_data[$key] = json_decode($val, true);
            }
        }
        $data = empty($_POST) ? json_decode(file_get_contents("php://input"), true) : $post_data;
        $documents = [];

        if(!empty($data['affordable_care_act']['additional_notes'])) {
            $data['affordable_care_act']['additional_notes'] = str_replace('"', "'", $data['affordable_care_act']['additional_notes']);
        }

        $post_arguments = [
            'post_parent' => !empty($data['post_parent']) ? intval($data['post_parent']) : '',
            'post_title' => 'Quote Form - ' . $data['personal_information']['first_name'] . ' ' . $data['personal_information']['last_name'],
            'post_type' => 'quote_form',
            'post_status' => 'publish',
            'meta_input' => [
                'status' => 'Processing',
                'affordable_care_act' => json_encode($data['affordable_care_act'], JSON_UNESCAPED_UNICODE),
                'personal_information' => json_encode($data['personal_information'], JSON_UNESCAPED_UNICODE),
                'employment_information' => json_encode($data['employment_information'], JSON_UNESCAPED_UNICODE),
                'espouse_information' => json_encode($data['espouse_information'], JSON_UNESCAPED_UNICODE),
                'espouse_employment_information' => json_encode($data['espouse_employment_information'], JSON_UNESCAPED_UNICODE),
                'dependents' => json_encode($data['dependents'], JSON_UNESCAPED_UNICODE),
                'payment_information' => json_encode($data['payment_information'], JSON_UNESCAPED_UNICODE),
                'documents' => empty($_POST) ? json_encode($data['documents'], JSON_UNESCAPED_UNICODE) : json_encode($documents, JSON_UNESCAPED_UNICODE),
            ],
        ];

        
        if (!empty($data['ID'])) {
            $post_arguments['meta_input']['status'] = $data['status'];
            $post_arguments['post_author'] = $data['post_author'];
            $post_arguments['ID'] = $data['ID'];
        }
        $result = empty($data['ID']) ? wp_insert_post($post_arguments) : wp_update_post($post_arguments);
        $message = ['message' => 'Quote form saved', 'status' => 'success'];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        if (empty($data['ID'])) {
            $action_data = [
                'post_id' => $result,
                'action_message' => "Quote's creation",
                'post_type' => $post_arguments['post_type'],
                'action_type' => 'create',
                'created_at' => $data['affordable_care_act']['date'],
                'extra_info' => json_encode($post_arguments, JSON_UNESCAPED_UNICODE),
            ];
            $action_history = new ActionsHistory();
            $action_result = $action_history->create($action_data);
            if (!empty($post_arguments['post_parent'])) {
                $action_data = [
                    'post_id' => $post_arguments['post_parent'],
                    'post_parent' => $result,
                    'action_message' => "Quote's renewal",
                    'post_type' => $post_arguments['post_type'],
                    'action_type' => 'renewal',
                    'created_at' => $data['affordable_care_act']['date'],
                    'extra_info' => json_encode($post_arguments, JSON_UNESCAPED_UNICODE),
                ];
                $action_result = $action_history->create($action_data);
            }
        }
        if (isset($_FILES['documents']) && $result != 0) {
            $files = $_FILES['documents'];
            for ($i = 0; $i < count($_FILES['documents']['name']); $i++) {
                $upload_dir = wp_upload_dir();
                $filename = explode(".", $files['name'][$i])[0];
                $filetype = wp_check_filetype(basename($files['name'][$i]), null);
                $filename_ext = sanitize_title($filename) . ".{$filetype['ext']}";
                $moveFile = move_uploaded_file($files["tmp_name"][$i], $upload_dir['path'] . "/$filename_ext");
                if ($moveFile) {
                    $attachment = array(
                        'post_parent' => $result,
                        'guid' => $upload_dir['url'] . '/' . $filename_ext,
                        'post_mime_type' => $filetype['type'],
                        'post_title' => $post_data['docs_info'][$i]['file']['post_title'],
                        'post_content' => $post_data['docs_info'][$i]['file']['post_content'],
                        'post_status' => 'inherit',
                    );
                    $attach_result = wp_insert_attachment($attachment, $filename_ext);
                    if (!$attach_result) {
                        $message = ['message' => 'There was an error creating the file record, try again.', 'status' => 'error'];
                        wp_send_json($message);
                    }
                    $documents[] = [
                        'ID' => $attach_result,
                        'post_title' => $attachment['post_title'],
                        'post_content' => $attachment['post_content'],
                        'url' => $attachment['guid'],
                    ];
                } else {
                    wp_send_json(['message' => "There was an error with the uploaded file: {$files['name'][$i]}, try again.", 'status' => 'error']);
                }
            }
            wp_update_post([
                'ID' => $result,
                'meta_input' => [
                    'documents' => json_encode($documents, JSON_UNESCAPED_UNICODE),
                ]]
            );
        }
        wp_send_json($message);
    }

    public static function generate_pdf()
    {
        set_time_limit(3600);
        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'format' => 'A4',
                'fontdata' => [
                    'arial' => [
                        'R' => 'ArialCE.ttf',
                        'B' => 'ArialCEBold.ttf',
                    ],
                ],
                'default_font' => 'arial',
            ]
        );
        $data = json_decode(file_get_contents("php://input"), true);
        ob_start();
        Template::show_template('documents/quote', ['data' => $data]);
        $template = ob_get_clean();
        $applicant = sanitize_title($data['applicant']);
        $mpdf->WriteHTML($template);
        $data = array(
            'status' => 'success',
            'applicant' => $applicant,
            'content' => "data:application/pdf;base64," . base64_encode($mpdf->Output('', 'S')),
        );
        wp_send_json($data);
    }

    public static function archive()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $message = ['message' => 'Quote form archived', 'status' => 'success'];
        $post_arguments = [
            'ID' => $data['ID'],
            'post_status' => 'trash',
            'meta_input' => [
                'status' => 'Archived'
            ]
        ];
        $results = wp_update_post($post_arguments);
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json($message);
    }

    public static function unarchive()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $message = ['message' => 'Quote form unarchived', 'status' => 'success'];
        $post_arguments = [
            'ID' => $data['ID'],
            'post_status' => 'publish',
            'meta_input' => [
                'status' => 'Processing'
            ]
        ];
        $results = wp_update_post($post_arguments);
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json($message);
    }

    public static function get_quote()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $args = array(
            'include' => intval($data['ID']),
            'post_type' => 'quote_form',
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
            'documents',
        ];
        $query = get_posts($args);
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            $author = User::get_current_user($post['post_author']);
            $post['agent'] = $author['first_name'] . ' ' . $author['last_name'];
            foreach ($metadata as $meta) {
                if ($meta == 'status') {
                    $post[$meta] = get_post_meta($post['ID'], $meta, true);
                } else {
                    $post[$meta] = json_decode(get_post_meta($post['ID'], $meta, true));
                }
            }
            $posts[] = $post;
        }
        if (!empty($post[0]) && !self::can_manage_current_quote('', $posts[0])) {
            wp_send_json_error(null, 403);
        }
        wp_send_json($posts[0]);
    }

    public static function get_quotes()
    {
        $current_user = \RA_ELITE_USA\Controller\Classes\User::get_current_user();

        $args = array(
            'numberposts' => -1,
            'post_type' => 'quote_form',
            'post_status' => ['publish', 'trash']
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
            'documents',
        ];

        if($current_user['roles'][0] == 'elite_usa_insurance_agent') $args['author'] = $current_user['id'];

        $query = get_posts($args);
        $posts = [];
        
        foreach ($query as $post) {
            $post = (array) $post;
            $author = User::get_current_user($post['post_author']);
            $post['agent'] = $author['first_name'] . ' ' . $author['last_name'];
            $post['renewals'] = get_posts(
                [
                    'post_parent' => $post['ID'], 
                    'post_type' => 'quote_form'
                ]
            );
            foreach ($metadata as $meta) {
                if ($meta == 'status') {
                    $post[$meta] = get_post_meta($post['ID'], $meta, true);
                } else {
                    $post[$meta] = json_decode(get_post_meta($post['ID'], $meta, true));
                }
            }
            $posts[] = $post;
        }
        wp_send_json($posts);
    }

    public static function can_manage_current_quote($current_user, $quote)
    {
        $current_user = is_a($current_user, 'User') ? $current_user : User::get_current_user();
        $role = $current_user['role'][0];
        if ($current_user['id'] == $quote['post_author']) {
            return true;
        } else if ($role == 'elite_usa_superuser' || $role == 'elite_usa_quote_manager' || $role == 'administrator') {
            return true;
        }
        return false;
    }

}
