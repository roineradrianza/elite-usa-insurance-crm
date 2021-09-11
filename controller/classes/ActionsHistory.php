<?php
RA_ELITE_USA_ACTIONS_HISTORY::init();

class RA_ELITE_USA_ACTIONS_HISTORY
{
    public static function init() {
        //INBOX
        add_action( 'wp_ajax_ra_elite_usa_insurance_get_quote_action_history', 'RA_ELITE_USA_ACTIONS_HISTORY::get' );
    }

    public static function get()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $action_history = new RA_EUI_ACTIONS_HISTORY_MODEL();
        wp_send_json(
            $action_history->get(sanitize_text_field($data['ID']))
        );
    }

}