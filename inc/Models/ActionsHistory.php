<?php

namespace RA_ELITE_USA\Models;

class ActionsHistory
{

    private $table = "ra_eui_quotes_action_history";
    private $post_id_column = "post_id";
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        register_activation_hook(RA_ELITE_USA_INSURANCE_FILE, '\RA_ELITE_USA\Models\ActionsHistory::check_table');
        $this->wpdb = $wpdb;
    }

    public static function check_table()
    {
        require_once(\ABSPATH . 'wp-admin/includes/upgrade.php');

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $table_name = "{$wpdb->prefix}ra_eui_quotes_action_history";
        $sql = "CREATE TABLE `$table_name` (
            `action_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
            `action_message` text NOT NULL,
            `post_type` varchar(255) NOT NULL,
            `action_type` varchar(60) DEFAULT NULL,
            `extra_info` text DEFAULT '',
            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
            `post_parent` bigint(20) unsigned DEFAULT NULL,
            `post_id` bigint(20) unsigned NOT NULL,
            PRIMARY KEY (`action_history_id`),
            KEY `fk_ra_eui_quotes_action_history_post_id_idx` (`post_id`),
            CONSTRAINT `fk_ra_eui_quotes_action_history_post_id` FOREIGN KEY (`post_id`) REFERENCES `{$wpdb->prefix}posts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
        )";
        
        return maybe_create_table($table_name, $sql);

    }

    public function create ( $data ) {
        $results = $this->wpdb->insert( "{$this->wpdb->prefix}{$this->table}", $data );
        if (!$results) {
            return false;
        }
        return $this->wpdb->insert_id;
    }

    public function get ( $post_id = 0, $output = \OBJECT ) {
        $sql = "SELECT * FROM {$this->wpdb->prefix}{$this->table}";
        $sql .= !empty($post_id) ? " WHERE {$this->post_id_column} = $post_id" : '';
        return $this->wpdb->get_results( $sql, $output );
    }
}
