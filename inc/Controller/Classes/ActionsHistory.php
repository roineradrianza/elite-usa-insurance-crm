<?php

namespace RA_ELITE_USA\Controller\Classes;

\RA_ELITE_USA\Controller\Classes\ActionsHistory::init();

class ActionsHistory
{

    private $table = "ra_eui_quotes_action_history";
    private $post_id_column = "post_id";
    private $wpdb;

    public static function init() {
        //INBOX
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quote_action_history', '\RA_ELITE_USA\Controller\Classes\ActionsHistory::get' );
    }

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function create ( $data ) {
        $results = $this->wpdb->insert( "{$this->wpdb->prefix}{$this->table}", $data );
        if (!$results) {
            return false;
        }
        return $this->wpdb->insert_id;
    }

    public static function get()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $action_history = new \RA_ELITE_USA\Models\ActionsHistory();
        wp_send_json(
            $action_history->get(sanitize_text_field($data['ID']))
        );
    }

}