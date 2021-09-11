<?php

class RA_EUI_ACTIONS_HISTORY_MODEL
{

    private $table = "ra_eui_quotes_action_history";
    private $post_id_column = "post_id";
    private $wpdb;

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

    public function get ( $post_id = 0, $output = OBJECT ) {
        $sql = "SELECT * FROM {$this->wpdb->prefix}{$this->table}";
        $sql .= !empty($post_id) ? " WHERE {$this->post_id_column} = $post_id" : '';
        return $this->wpdb->get_results( $sql, $output );
    }
}
