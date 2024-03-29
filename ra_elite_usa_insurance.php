<?php
/**
 * Plugin Name:       EliteUSAInsurance
 * Description:       Insurance quote applications
 * Version:           1.4.7
 * Requires at least: 5.1
 * Requires PHP:      7.2
 * Author:            Roiner Adrianza
 * Developer:         Roiner Adrianza
 * License:           GPL v2 or later
 */
if (!defined('ABSPATH')) {
    exit;
}
//Exit if accessed directly
define('RA_ELITE_USA_INSURANCE_FILE', __FILE__);
define('RA_ELITE_USA_INSURANCE', dirname(RA_ELITE_USA_INSURANCE_FILE));
define('RA_ELITE_USA_INSURANCE_URL', plugin_dir_url(RA_ELITE_USA_INSURANCE_FILE));
define('RA_ELITE_USA_INSURANCE_DB_VERSION', '1.1');
define('RA_ELITE_USA_INSURANCE_VERSION', '1.4.7');

define('RA_ELITE_USA_ENV', false);

if (RA_ELITE_USA_ENV) {
    @ini_set('display_errors', 1);
}

require_once plugin_dir_path( __FILE__ ) . "/vendor/autoload.php";

use \RA_ELITE_USA\Shortcode\Init as ShortcodeInit;
use \RA_ELITE_USA\Controller\Init as ControllerInit;

new ShortcodeInit();
new ControllerInit();

