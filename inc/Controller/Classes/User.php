<?php

namespace RA_ELITE_USA\Controller\Classes;

use \RA_ELITE_USA\Controller\Classes\Template;
use \RA_ELITE_USA\Controller\Classes\Options;
use \RA_ELITE_USA\Controller\Classes\Mail;

\RA_ELITE_USA\Controller\Classes\User::init();

class User
{

    public static function init()
    {
    //USERS ACTIONS
        add_action( 'init','\RA_ELITE_USA\Controller\Classes\User::hide_admin_bar' );
        add_action( 'wp_ajax_nopriv_ra_elite_usa_insurance_login', '\RA_ELITE_USA\Controller\Classes\User::login' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_logout', '\RA_ELITE_USA\Controller\Classes\User::logout' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_change_password', '\RA_ELITE_USA\Controller\Classes\User::change_password' );
    //USER MANAGER
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_users', '\RA_ELITE_USA\Controller\Classes\User::get' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_create_user', '\RA_ELITE_USA\Controller\Classes\User::create' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_update_user', '\RA_ELITE_USA\Controller\Classes\User::update' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_delete_user', '\RA_ELITE_USA\Controller\Classes\User::delete' );
    //CONTRACTS
        add_action( 'wp_ajax_ra_elite_usa_insurance_submit_contract', '\RA_ELITE_USA\Controller\Classes\User::submit_contract' );
        add_action( 'wp_ajax_ra_elite_usa_insurance_generate_contract_pdf', '\RA_ELITE_USA\Controller\Classes\User::generate_contract_pdf' );
    }

    public static function login()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        $credentials = ['user_login' => $data['email'], 'user_password' => $data['password'], 'remember' => $data['remember']];
        $result = wp_signon( $credentials );
        if ($result) {
            $routes = Options::get_option('routes');
            $message = ['message' => 'Login Successful, you will be redirected in a while.', 'status' => 'success', 'data' => $result, 'redirect_url' => $routes['quotes']];
        }
        else {
            $message = ['message' => 'There was an error', 'status' => 'error', 'data' => $result];
        }
        wp_send_json( $message );
    }

    public static function change_password()
    {
        $data = json_decode( file_get_contents("php://input"), true );
        if (empty($data['password'])) wp_send_json( ['status' => 'danger', 'message' => 'Password cannot be empty' ] );
        $user = self::get_current_user();
        wp_set_password($data['password'], $user['id'] );
        wp_signon(array('user_login' => $user['user_login'], 'user_password' => $data['password']));
        wp_send_json( ['status' => 'success', 'message' => 'Password changed successfully' ] );
    }

    public static function logout()
    {
        wp_logout();
        wp_send_json( ['status' => 'success', 'redirect_url' => site_url() ] );
    }

    public static function get_current_user($id = '')
    {
        $user = array(
            'id' => 0
        );

        $current_user = (!empty($id)) ? get_userdata($id) : wp_get_current_user();

        $avatar_url = '';

        if (!empty($current_user->ID) and 0 != $current_user->ID) {
            $user_meta = get_userdata($current_user->ID);
            $user = array(
                'id' => $current_user->ID,
                'user_login' => $current_user->user_login,
                'email' => $current_user->data->user_email,
                'first_name' => get_user_meta( $current_user->ID, 'first_name', true ),
                'last_name' => get_user_meta( $current_user->ID, 'last_name', true ),
                'agreement_form' => json_decode(get_user_meta( $current_user->ID, 'agreement_form', true )),
                'roles' => $user_meta->roles,
            );
        }

        return $user;
    }

    public static function create()
    {
        if (!self::has_su_access()) wp_send_json('Forbidden');
        $data = json_decode( file_get_contents("php://input"), true );
        $args = [
            'ID' => $data['id'],
            'user_login' => $data['user_login'],
            'user_email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role' => $data['roles'][0],
        ];
        if (!empty($data['user_pass'])) {
            $args['user_pass'] = $data['user_pass'];
        }
        $result = wp_insert_user( $args );
        if (intval($data['send_user_email']) AND $result) {
            Mail::send_user_credentials_mail($args, true);
        }
        $message = ['status' => 'success', 'message' => 'User created successfully', 'data' => $result ];
        if (!$result) {
           $message = ['status' => 'error', 'message' => "It couldn't be possible to create the user, try again" ];
        }
        wp_send_json( $message );
    }

    public static function submit_contract()
    {
        $data = $_POST['form'];
        $current_user = self::get_current_user();
        $user_id = $current_user['id'];
        $result = update_user_meta( $user_id, 'agreement_form', $data);
        $message = ['status' => 'error', 'message' => "It couldn't be possible to store the contract, try again" ];
        if ($result) {
           $message = ['status' => 'success', 'message' => 'Contract signed successfully', 'data' => $result ];
           /*
           $routes = Options::get_option('routes');
            ob_start();
             Template::show_template('emails/contract-received',['id' => $user_id, 'first_name' => $current_user['first_name'], 'last_name' => $current_user['last_name'], 'users_url' => $routes['user_manager']]);
            $template = ob_get_clean();
            $send_mail = $result ? Mail::send_notification_to_admins('New contract signed has been received', $template, true) : null;
            */
        }
        wp_send_json( $message );
    }

    public static function generate_contract_pdf()
    {
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
         Template::show_template('documents/contract', ['data' => $data]);
        $template = ob_get_clean();
        ob_start();
         Template::show_template('documents/contract/header');
        $header = ob_get_clean();
        $mpdf->SetHTMLHeader($header);
        $mpdf->AddPage('', // L - landscape, P - portrait 
        '', '', '', '',
        5, // margin_left
        5, // margin right
       25, // margin top
       35, // margin bottom
        0, // margin header
        5); // margin footer
        $mpdf->WriteHTML($template);
        $data = array(
          'status' => 'success',
          'content' => "data:application/pdf;base64,".base64_encode($mpdf->Output('', 'S'))
        );
        wp_send_json( $data );
    }

    public static function get()
    {
        if (!self::has_su_access()) wp_send_json('Forbidden');
        $current_user = self::get_current_user();
        $args = [
            'role__in' => [ 'elite_usa_quote_manager', 'elite_usa_superuser', 'elite_usa_insurance_agent' ]
        ];
        $users = $current_user['roles'][0] == 'administrator' ? get_users() : get_users( $args );
        $items = [];
        foreach ($users as $user) {
            $item = self::get_current_user($user->ID);
            $items[] = $item;
        }
        $users = $items;
        wp_send_json( $users );
    }

    public static function update()
    {
        if (!self::has_su_access()) wp_send_json('Forbidden');
        add_filter( 'send_password_change_email', '__return_false' );
        add_filter( 'send_email_change_email', '__return_false' );
        $data = json_decode( file_get_contents("php://input"), true );
        $args = [
            'ID' => $data['id'],
            'user_email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role' => $data['roles'][0],
        ];
        if (!empty($data['user_pass'])) {
            $args['user_pass'] = $data['user_pass'];
        }
        $result = wp_update_user( $args );
        if (intval($data['send_user_email']) AND $result) {
            Mail::send_user_credentials_mail($args);
        }
        $message = ['status' => 'success', 'message' => 'User updated successfully' ];
        if (!$result) {
           $message = ['status' => 'error', 'message' => "It couldn't be possible to update the user, try again" ];
        }
        wp_send_json( $message );
    }

    public static function delete()
    {
        if (!self::has_su_access()) wp_send_json( 'Forbidden' );
        $data = json_decode( file_get_contents("php://input"), true );
        $result = wp_delete_user( $data['id'] );
        $message = ['status' => 'success', 'message' => 'User deleted successfully' ];
        if (!$result) {
           $message = ['status' => 'error', 'message' => "It couldn't be possible to delete the user, try again" ];
        }
        wp_send_json( $message );
    }

    public static function hide_admin_bar () {
        if (is_user_logged_in()) {
            $current_user = self::get_current_user();
            if ($current_user['roles'][0] == 'elite_usa_quote_manager' || $current_user['roles'][0] == 'elite_usa_superuser' || $current_user['roles'][0] == 'elite_usa_insurance_agent') show_admin_bar( false );
        }
    }

    public static function has_su_access () {
        if (is_user_logged_in()) {
            $current_user = self::get_current_user();
            if ($current_user['roles'][0] == 'elite_usa_superuser' || $current_user['roles'][0] == 'administrator') return true;
            return false;
        }
        else {
            return false;
        }
    }
}