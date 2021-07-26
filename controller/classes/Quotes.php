<?php
RA_ELITE_USA_INSURANCE_QUOTES::init();

class RA_ELITE_USA_INSURANCE_QUOTES
{
    public static function init() {
    //QUOTES
        add_action( 'wp_ajax_ra_elite_usa_insurance_save_quote_form', 'RA_ELITE_USA_INSURANCE_QUOTES::store_quote' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_generate_quote_pdf', 'RA_ELITE_USA_INSURANCE_QUOTES::generate_quote_pdf' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_my_quote_forms', 'RA_ELITE_USA_INSURANCE_QUOTES::get_my_quotes' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quote', 'RA_ELITE_USA_INSURANCE_QUOTES::get_quote' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quotes', 'RA_ELITE_USA_INSURANCE_QUOTES::get_quotes' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_delete_quote', 'RA_ELITE_USA_INSURANCE_QUOTES::delete_quote' );
    //QUOTE MODIFICATIONS REQUESTED
        add_action( 'wp_ajax_ra_elite_usa_insurance_save_quote_modification_request', 'RA_ELITE_USA_INSURANCE_QUOTES::store_quote_modification_request' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_save_quote_modification_request', 'RA_ELITE_USA_INSURANCE_QUOTES::store_quote_modification_request' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quote_modification_requests', 'RA_ELITE_USA_INSURANCE_QUOTES::get_quote_modification_request' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_approve_form_modification_request', 'RA_ELITE_USA_INSURANCE_QUOTES::approve_quote_modification_request' );
    //INFORMATION REQUESTED
        add_action( 'wp_ajax_ra_elite_usa_insurance_save_quote_information_request', 'RA_ELITE_USA_INSURANCE_QUOTES::store_quote_information_requested' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quote_information_requests', 'RA_ELITE_USA_INSURANCE_QUOTES::get_quote_information_request' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_upload_quote_information_requested', 'RA_ELITE_USA_INSURANCE_QUOTES::upload_quote_information_requested' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_delete_quote_information_request', 'RA_ELITE_USA_INSURANCE_QUOTES::delete_quote_information_requested' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_approve_form_information_request', 'RA_ELITE_USA_INSURANCE_QUOTES::approve_quote_information_request' );
    //DOCUMENTS REQUESTED
        add_action( 'wp_ajax_ra_elite_usa_insurance_save_quote_attachment_request', 'RA_ELITE_USA_INSURANCE_QUOTES::store_quote_documents_requested' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quote_attachment_requests', 'RA_ELITE_USA_INSURANCE_QUOTES::get_quote_document_attachment' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_upload_quote_attachment_requested', 'RA_ELITE_USA_INSURANCE_QUOTES::upload_quote_document_requested' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_delete_quote_attachment_requested', 'RA_ELITE_USA_INSURANCE_QUOTES::delete_document_quote_requested' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_process_form_document_requested', 'RA_ELITE_USA_INSURANCE_QUOTES::process_quote_document_request' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_approve_form_document_requested', 'RA_ELITE_USA_INSURANCE_QUOTES::approve_quote_document_request' );
    //MANAGER ATTACHMENTS
        add_action( 'wp_ajax_ra_elite_usa_insurance_save_quote_manager_attachment', 'RA_ELITE_USA_INSURANCE_QUOTES::store_quote_manager_attachment' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quote_manager_attachments', 'RA_ELITE_USA_INSURANCE_QUOTES::get_quote_manager_attachment' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_upload_quote_manager_attachment', 'RA_ELITE_USA_INSURANCE_QUOTES::upload_quote_manager_attachment' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_delete_quote_manager_attachment', 'RA_ELITE_USA_INSURANCE_QUOTES::delete_manager_attachment_quote' );
    }

    public static function store_quote()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $post_arguments = [
            'post_title' => 'Quote Form - ' . $data['personal_information']['first_name'] . ' ' .$data['personal_information']['last_name'], 
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
            ]
        ];
        if (!empty($data['ID'])) {
            $post_arguments['meta_input']['status'] = $data['status'];
            $post_arguments['post_author'] = $data['post_author'];
            $post_arguments['ID'] = $data['ID'];
        }
        $result = empty($data['ID']) ? wp_insert_post( $post_arguments ) : wp_update_post( $post_arguments );
        $message = ['message' => 'Quote form saved', 'status' => 'success'];
        /*
        if (empty($post_arguments['ID'])) {

            $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
            ob_start();
             RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/new-quote',['id' => $result, 'quote_url' => $routes['quotes']]);
            $template = ob_get_clean();
            $send_mail = $result ? RA_ELITE_USA_INSURANCE_MAIL::send_notification_to_admins('New Quote Received', $template) : null;
        }
        */
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }

    public static function generate_quote_pdf()
    {
        require_once RA_ELITE_USA_INSURANCE . "/vendor/autoload.php";
        set_time_limit(3600);
        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8', 
                'format' => 'A4',
                'fontdata' => [
                'arial' => [
                    'R' => 'ArialCE.ttf',
                    'B' => 'ArialCEBold.ttf'
                 ],
                ],
                'default_font' => 'arial'
            ]
        );
        $data = json_decode( file_get_contents("php://input"), true );
        ob_start();
         RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('documents/quote', ['data' => $data]);
        $template = ob_get_clean();
        $applicant = sanitize_title($data['applicant']);
        $mpdf->WriteHTML($template);
        $data = array(
          'status' => 'success',
          'applicant' => $applicant,
          'content' => "data:application/pdf;base64,".base64_encode($mpdf->Output('', 'S'))
        );
     wp_send_json( $data );
    }

    public static function delete_quote()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $message = ['message' => 'Quote form deleted', 'status' => 'success'];
        $results = wp_delete_post( $data['ID'], true );
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }

    public static function delete_document_quote_requested()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $message = ['message' => 'Document request deleted', 'status' => 'success'];
        add_action( 'before_delete_post', 'ra_elite_usa_insurance_delete_attachment', $data['ID'] );
        $results = wp_delete_post( $data['ID'], true );
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }

    public static function delete_quote_information_requested()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $message = ['message' => 'Information request deleted', 'status' => 'success'];
        $results = wp_delete_post( $data['ID'], true );
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }

    public static function delete_manager_attachment_quote()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $message = ['message' => 'Document attachment deleted', 'status' => 'success'];
        add_action( 'before_delete_post', 'ra_elite_usa_insurance_delete_attachment', $data['ID'] );
        $results = wp_delete_post( $data['ID'], true );
        if (!$results) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }

    public static function get_my_quotes()
    {
        $args = array(
            'author' => RA_ELITE_USA_INSURANCE_USER::get_current_user()['id'],
            'posts_per_page' => 1000,
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
            'payment_information'
        ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
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

    public static function get_quote()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $args = array(
            'include' => $data['ID'],
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
            'payment_information'
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
        wp_send_json( $posts[0] );
    }

    public static function get_quotes()
    {
        $args = array(
            'ID' => 1000,
            'posts_per_page' => 1000,
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
            'payment_information'
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

    public static function store_quote_modification_request()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_content'])) wp_send_json( ['message' => 'You must put the modifications.', 'status' => 'error'] );
        $post_arguments = [
            'post_parent' => $data['post_parent'],
            'post_title' => "Modification Requested - ${data['post_date_name']}", 
            'post_type' => 'quote_form_mr', 
            'post_status' => 'publish', 
            'post_content' => $data['post_content'], 
            'meta_input' => [
                'status' => '0',
            ]
        ];
        $result = wp_insert_post( $post_arguments );
        $message = ['message' => 'Modification Request Sent', 'status' => 'success', 'data' => $result];
        /*
        $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
        ob_start();
         RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/quote-modification-requested',['id' => $data['post_parent'], 'agent' => $data['agent'], 'modification_content' => $data['post_content'], 'quote_url' => $routes['quotes']]);
        $template = ob_get_clean();
        $send_mail = $result ? RA_ELITE_USA_INSURANCE_MAIL::send_notification_to_admins('New Quote Modification Request Received', $template) : null;
        */
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }
 
    public static function approve_quote_modification_request()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['ID'])) wp_send_json( ['message' => 'You has selected an unknown modification request.', 'status' => 'error'] );
        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '1',
            ]
        ];
        $result = wp_update_post( $post_arguments );
        $message = ['message' => 'Modification Request Approved', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        /*
        $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
        ob_start();
         RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/quote-modification-approved',['id' => $data['post_parent'], 'modification_content' => $data['post_content'], 'quote_url' => $routes['quotes']]);
        $template = ob_get_clean();
        $agent = RA_ELITE_USA_INSURANCE_USER::get_current_user($data['post_author']);
        $send_mail = $result ? RA_ELITE_USA_INSURANCE_MAIL::send_mail($agent['email'], 'Quote Modification Request Approved', $template) : null;
        */
        wp_send_json( $message );
    }
  
    public static function approve_quote_information_request()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['ID'])) wp_send_json( ['message' => 'You has selected an unknown information request.', 'status' => 'error'] );
        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '1',
            ]
        ];
        $result = wp_update_post( $post_arguments );
        $message = ['message' => 'Information Approved', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }
    
    public static function process_quote_document_request()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['ID'])) wp_send_json( ['message' => 'You has selected an unknown document requested.', 'status' => 'error'] );
        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '3',
            ]
        ];
        $result = wp_update_post( $post_arguments );
        $message = ['message' => 'Document marked as processing', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }
      
    public static function approve_quote_document_request()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['ID'])) wp_send_json( ['message' => 'You has selected an unknown document requested.', 'status' => 'error'] );
        $post_arguments = [
            'ID' => $data['ID'],
            'meta_input' => [
                'status' => '1',
            ]
        ];
        $result = wp_update_post( $post_arguments );
        $message = ['message' => 'Document Approved', 'status' => 'success', 'data' => $result];
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }
  
    public static function get_quote_modification_request()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_parent'])) wp_send_json([]);
        $args = array(
            'posts_per_page' => 100,
            'post_type' => 'quote_form_mr',
            'post_parent' => $data['post_parent'],
        );
        $metadata = [ 'status' ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            foreach ($metadata as $meta) {
                $post[$meta] = get_post_meta( $post['ID'], $meta, true );
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }

    public static function get_quote_document_attachment()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_parent'])) wp_send_json([]);
        $args = array(
            'posts_per_page' => 100,
            'post_type' => 'quote_doc_r',
            'post_parent' => $data['post_parent'],
        );
        $metadata = [ 'status', 'attachment_url', 'attachment_id' ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            foreach ($metadata as $meta) {
                $post[$meta] = get_post_meta( $post['ID'], $meta, true );
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }

    public static function get_quote_information_request()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_parent'])) wp_send_json([]);
        $args = array(
            'posts_per_page' => 100,
            'post_type' => 'quote_data_r',
            'post_parent' => $data['post_parent'],
        );
        $metadata = [ 'status' ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            foreach ($metadata as $meta) {
                $post[$meta] = get_post_meta( $post['ID'], $meta, true );
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }

    public static function get_quote_manager_attachment()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_parent'])) wp_send_json([]);
        $args = array(
            'posts_per_page' => 100,
            'post_type' => 'quote_m_doc',
            'post_parent' => $data['post_parent'],
        );
        $metadata = [ 'attachment_url', 'attachment_id' ];
        $query = get_posts( $args );
        $posts = [];
        foreach ($query as $post) {
            $post = (array) $post;
            foreach ($metadata as $meta) {
                $post[$meta] = get_post_meta( $post['ID'], $meta, true );
            }
            $posts[] = $post;
        }
        wp_send_json( $posts );
    }

    public static function store_quote_documents_requested()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_title'])) wp_send_json( ['message' => 'You must put the document name.', 'status' => 'error'] );
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
            ]
        ];
        if (!empty($data['ID'])) {
            $post_arguments['meta_input']['status'] = $data['status'];
            $post_arguments['ID'] = $data['ID'];
        }
        $result = empty($post_arguments['ID']) ? wp_insert_post( $post_arguments ) : wp_update_post( $post_arguments );
        $message = ['message' => empty($data['ID']) ? 'Document requested' : 'Document name edited', 'status' => 'success', 'data' => $result];
        /*
        $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
        ob_start();
         RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/quote-document-requested',['id' => $data['post_parent'], 'agent' => $data['agent'], 'document' => $data['post_title'], 'quote_url' => $routes['quotes']]);
        $template = ob_get_clean();
        $agent = RA_ELITE_USA_INSURANCE_USER::get_current_user($data['post_author']);
        if ($result) {
            $send_mail = empty($data['ID']) ? RA_ELITE_USA_INSURANCE_MAIL::send_mail($agent['email'], 'New Quote Document Requested', $template) : null;
        }
        */
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }

    public static function store_quote_information_requested()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_title'])) wp_send_json( ['message' => 'You must put the information to be requested.', 'status' => 'error'] );
        $post_arguments = [
            'post_parent' => $data['post_parent'],
            'post_title' => $data['post_title'], 
            'post_author' => $data['post_author'], 
            'post_type' => 'quote_data_r', 
            'post_status' => 'publish', 
            'post_content' => '', 
            'meta_input' => [
                'status' => 0,
            ]
        ];
        if (!empty($data['ID'])) {
            $post_arguments['meta_input']['status'] = $data['status'];
            $post_arguments['ID'] = $data['ID'];
        }
        $result = empty($data['ID']) ? wp_insert_post( $post_arguments ) : wp_update_post( $post_arguments );
        $message = ['message' => empty($data['ID']) ? 'Information request created' : 'Information request edited', 'status' => 'success', 'data' => $result];
        /*
        $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
        ob_start();
         RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/quote-information-requested', ['id' => $data['post_parent'], 'information' => $data['post_title'], 'quote_url' => $routes['quotes']]);
        $template = ob_get_clean();
        $agent = RA_ELITE_USA_INSURANCE_USER::get_current_user($data['post_author']);
        if ($result) {
            $send_mail = empty($data['ID']) ? RA_ELITE_USA_INSURANCE_MAIL::send_mail($agent['email'], 'New Quote Information Requested', $template) : null;
        }
        */
        if (!$result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        }
        wp_send_json( $message );
    }

    public static function store_quote_manager_attachment()
    {
        $data = $_POST;
        if (empty($data['post_title'])) wp_send_json( ['message' => 'You must put the document name.', 'status' => 'error'] );
        else if (empty($data['ID']) && !isset($_FILES['attachment'])) wp_send_json( ['message' => 'You must upload the file before create the attachment.', 'status' => 'error'] );
        $manager = RA_ELITE_USA_INSURANCE_USER::get_current_user();
        $post_arguments = [
            'post_parent' => $data['post_parent'],
            'post_title' => $data['post_title'], 
            'post_author' => empty($data['post_author']) ? $manager['id'] : $data['post_author'], 
            'post_type' => 'quote_m_doc', 
            'post_status' => 'publish', 
            'post_content' => '', 
            'meta_input' => [
                'status' => 0,
                'attachment_id' => empty($data['attachment_id']) ? '' : $data['attachment_id'],
                'attachment_url' => empty($data['attachment_url']) ? '' : $data['attachment_url'],
            ]
        ];
        if (!empty($data['ID'])) {
            $post_arguments['ID'] = $data['ID'];
        }
        $post_result = wp_insert_post( $post_arguments );
        if (!$post_result) {
            $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
            wp_send_json( $message );
        }
        $message = ['message' => empty($data['ID']) ? 'Document requested' : 'Document name edited', 'status' => 'success', 'data' => ['ID' => $post_result]];
        if (isset($_FILES['attachment'])) {
            $upload_dir = wp_upload_dir();
            $filename = explode(".", $_FILES['attachment']['name'])[0];
            $filetype = wp_check_filetype( basename( $_FILES['attachment']['name'] ), null );
            $filename_ext = sanitize_title($filename) . ".{$filetype['ext']}";
            $moveFile = move_uploaded_file($_FILES["attachment"]["tmp_name"], $upload_dir['path'] . "/$filename_ext");
            if ($moveFile) {
                $ID = empty($data['ID']) ? $post_result : $data['ID'];
                $attachment = array(
                    'post_parent'    => $ID, 
                    'guid'           => $upload_dir['url'] . '/' . $filename_ext, 
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => $data['post_title'] . ' attachment',
                    'post_content'   => $upload_dir['url'] . '/' . $filename_ext,
                    'post_status'    => 'inherit'
                );
                $attach_id = '';
                if (!empty($data['attachment_id'])) {
                    $attach_id = wp_insert_attachment( $attachment, $filename_ext, $ID ) ;
                }
                else {
                    $attachment['ID'] = $data['attachment_id'];
                    $attach_name_update = update_attached_file( $attachment['ID'], $filename_ext );
                    $attach_id = wp_update_post( $attachment );
                }
                $post_arguments = [
                    'ID' => $ID,
                    'meta_input' => [
                        'attachment_url' => $attachment['guid'],
                    ]
                ];
                if (empty($data['attachment_id'])) $post_arguments['meta_input']['attachment_id'] = $attach_id;
                $result = wp_update_post( $post_arguments );
                $message_data = empty($data['attachment_id']) ? ['attachment_id' => $result, 'attachment_url' => $attachment['guid']] : ['attachment_url' => $attachment['guid']];
                if (empty($data['ID'])) $message_data['ID'] = $ID;
                $message = ['message' => empty($data['attachment_id']) ? 'Document uploaded' : 'Document updated', 'status' => 'success', 'data' => $message_data];
                if ($result) {
                    /*
                    $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
                    ob_start();
                     RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/quote-manager-attachment-uploaded',['id' => $data['post_parent'], 'manager' => "{$manager['first_name']} {$manager['last_name']}", 'document' => $data['post_title'], 'quote_url' => $routes['quotes']]);
                    $template = ob_get_clean();
                    $agent = RA_ELITE_USA_INSURANCE_USER::get_current_user($data['agent']);
                    $send_mail = empty($data['ID']) ? RA_ELITE_USA_INSURANCE_MAIL::send_mail($agent['email'], 'New Quote Attachment Uploaded', $template) : null;
                    */
                }
                else {
                    $message = ['message' => 'There was an error uploading the attachment, try again.', 'status' => 'error', 'error' => $result];
                }
                wp_send_json( $message );
            }
            else {
                wp_send_json( ['message' => "There was an error with the uplaoded file, try again.", 'status' => 'error'] );
            }
        }
    
        wp_send_json( $message );
    }

    public static function upload_quote_document_requested()
    {
        global $wpdb;
        if (!isset($_FILES['attachment'])) wp_send_json( ['message' => 'You must upload the document.', 'status' => 'error'] );
        $data = $_POST;
        $upload_dir = wp_upload_dir();
        $filename = explode(".", $_FILES['attachment']['name'])[0];
        $filetype = wp_check_filetype( basename( $_FILES['attachment']['name'] ), null );
        $filename_ext = sanitize_title($filename) . ".{$filetype['ext']}";
        $moveFile = move_uploaded_file($_FILES["attachment"]["tmp_name"], $upload_dir['path'] . "/$filename_ext");
        if ($moveFile) {
            $attachment = array(
                'post_parent'    => $data['ID'], 
                'guid'           => $upload_dir['url'] . '/' . $filename_ext, 
                'post_mime_type' => $filetype['type'],
                'post_title'     => $data['post_title'] . ' attachment',
                'post_content'   => $upload_dir['url'] . '/' . $filename_ext,
                'post_status'    => 'inherit'
            );
            $attach_id = '';
            if (!empty($data['attachment_id'])) {
                $attach_id = wp_insert_attachment( $attachment, $filename_ext, $data['ID'] ) ;
            }
            else {
                $attachment['ID'] = $data['attachment_id'];
                $attach_name_update = update_attached_file( $attachment['ID'], $filename_ext );
                $attach_id = wp_update_post( $attachment );
            }
            $post_arguments = [
                'ID' => $data['ID'],
                'meta_input' => [
                    'status' => 2,
                    'attachment_url' => $attachment['guid'],
                ]
            ];
            if (empty($data['attachment_id'])) $post_arguments['meta_input']['attachment_id'] = $attach_id;
            $result = wp_update_post( $post_arguments );
            $message_data = empty($data['attachment_id']) ? ['attachment_id' => $result, 'attachment_url' => $attachment['guid']] : ['attachment_url' => $attachment['guid']];
            $message = ['message' => empty($data['attachment_id']) ? 'Document uploaded' : 'Document updated', 'status' => 'success', 'data' => $message_data];
            /*
            $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
            ob_start();
             RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/quote-document-uploaded',['id' => $data['post_parent'], 'agent' => $data['agent'], 'document' => $data['post_title'], 'quote_url' => $routes['quotes']]);
            $template = ob_get_clean();
            */
            if (!$result) $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
            wp_send_json( $message );
        }
        else {
            wp_send_json( ['message' => "There was an error with the uplaoded file, try again.", 'status' => 'error'] );
        }
    }

    public static function upload_quote_information_requested()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['post_content'])) wp_send_json( ['message' => 'You must send the information', 'status' => 'error'] );
        $post_arguments = [
            'ID' => $data['ID'],
            'post_content' => $data['post_content'],
            'meta_input' => [
                'status' => 2,
            ]
        ];
        $result = wp_update_post( $post_arguments );
        $message = ['message' => 'Information sent successfully', 'status' => 'success'];
        /*
        $routes = RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes');
        ob_start();
         RA_ELITE_USA_INSURANCE_TEMPLATE::show_template('emails/quote-information-uploaded',['id' => $data['post_parent'], 'agent' => $data['agent'], 'information_requested' => $data['post_title'], 'info' => $data['post_content'], 'quote_url' => $routes['quotes']]);
        $template = ob_get_clean();
        */
        if (!$result) $message = ['message' => 'There was an error, try again.', 'status' => 'error'];
        wp_send_json( $message );
    }

}