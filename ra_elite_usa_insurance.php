<?php
/**
 * Plugin Name:       EliteUSAInsurance
 * Description:       Insurance quote applications
 * Version:           1.2.3
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
define('RA_ELITE_USA_INSURANCE_VERSION', '1.2.3');

define('RA_ELITE_USA_ENV', false);

if (RA_ELITE_USA_ENV) {
    @ini_set('display_errors', 1);
}

require_once RA_ELITE_USA_INSURANCE . "/vendor/autoload.php";

require_once RA_ELITE_USA_INSURANCE . '/models/main.php';

require_once RA_ELITE_USA_INSURANCE . '/controller/main.php';

require_once RA_ELITE_USA_INSURANCE . '/shortcodes/shortcodes.php';
