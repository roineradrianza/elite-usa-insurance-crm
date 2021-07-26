<?php

new RA_ELITE_USA_INSURANCE_OPTIONS();

class RA_ELITE_USA_INSURANCE_OPTIONS {

	private static $instance;

  function __construct() {
  	self::option_exists();
    add_action('wp_ajax_ra_elite_usa_insurance_save_settings', array($this,'save_option'));
    add_action('wp_ajax_ra_elite_usa_insurance_get_settings', array($this,'get_options'));
  }

	public function save_option() {
		check_ajax_referer('ra_elite_usa_insurance_settings_nonce', 'nonce');
		if (!current_user_can('manage_options')) die;
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);		
    extract($data);
    $settings = array(
    	'routes' => $routes,
    );
    $saved_options = update_option('ra_elite_usa_insurance_settings', $settings);  
    if(!$saved_options) wp_send_json(array(
    	'message' => 'Has not been detected any change, any change was applied.', 'twoffactor-laboratory',
    	'status' => 'warning'
    ));
		wp_send_json(array(
    	'message' => 'The options for ELITE USA Insurance plugin has been updated successfully',
    	'status' => 'success'
    ));  
	}

	public static function get_options() {
		$options = get_option('ra_elite_usa_insurance_settings', array());
		$options = empty($options) ? ['routes' => ['dashboard' => '', 'quote_form' => '', 'quotes' => '', 'user_settings' => '', 'user_manager' => '', 'inbox' => '']] : $options;
		wp_send_json($options);
	}

	public function option_exists() {
		$options = get_option('ra_elite_usa_insurance_settings', array());
		if (!isset($options)) {
			$options = [
				'routes' => ['dashboard' => '', 'quote_form' => '', 'quotes' => '', 'user_settings' => '', 'user_manager' => '', 'inbox' => ''], 
			];
			update_option('ra_elite_usa_insurance_settings', $options);
		}
	}
	public static function get_option($option_name, $default = '') {

		$options = get_option('ra_elite_usa_insurance_settings', array());

		return (!empty($options[$option_name])) ? $options[$option_name] : $default;
	}

};