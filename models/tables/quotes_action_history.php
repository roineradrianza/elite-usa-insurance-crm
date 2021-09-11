<?php

register_activation_hook(RA_ELITE_USA_INSURANCE_FILE, 'ra_elite_usa_insurance_quotes_action_history');

function ra_elite_usa_insurance_quotes_action_history()
{
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $table_name = "{$wpdb->prefix}ra_eui_quotes_action_history";

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        `action_history_id` BIGINT NOT NULL AUTO_INCREMENT,
        `action_message` TEXT NOT NULL,
        `post_type` VARCHAR(255) NOT NULL,
        `action_type` VARCHAR(60) NULL,
        `extra_info` TEXT DEFAULT '[]',
        `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
        `post_parent` BIGINT(20) UNSIGNED NOT NULL,
        `post_id` BIGINT(20) UNSIGNED NOT NULL,
        PRIMARY KEY (`action_history`),
        INDEX `fk_ra_eui_quotes_action_history_post_id_idx` (post_id),
        CONSTRAINT `fk_ra_eui_quotes_action_history_post_id`
          FOREIGN KEY (`post_id`)
          REFERENCES `insurance_policy`.`wp_posts` (`ID`)
          ON DELETE CASCADE
          ON UPDATE CASCADE) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    dbDelta($sql);

}
