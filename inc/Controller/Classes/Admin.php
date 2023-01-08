<?php

namespace RA_ELITE_USA\Controller\Classes;

use \RA_ELITE_USA\Controller\Classes\User;
use \RA_ELITE_USA\Controller\Classes\Template;

class Admin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
    }

    function admin_menu(): Void
    {
        if (current_user_can('manage_options')) {
            add_menu_page(
                'ELITE USA Insurance',
                'ELITE USA Insurance',
                'manage_options',
                'elite-usa-insurance',
                array($this, 'settings_menu'),
                'dashicons-rest-api',
                5
            );
        }
    }
    public function settings_menu(): Void
    {
        add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('admin_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
        $nonce = wp_create_nonce('ra_elite_usa_insurance_settings_nonce');
        wp_localize_script('vue-js', 'nonce', $nonce);
        echo Template::render_view(['admin/main'], ['setup.min', 'lib/moment.min', 'admin/settings'], 'admin/settings');
    }

    public function ra_elite_usa_insurance_enqueue_ss(): Void
    {
        $v = (WP_DEBUG) ? time() : RA_ELITE_USA_INSURANCE_VERSION;
        $assets = RA_ELITE_USA_INSURANCE_URL . 'assets';
        wp_enqueue_style('font-roboto-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap');
        wp_enqueue_style('material-design-icons', $assets . '/css/material-design-icons.min.css', NULL, $v, 'all');
        wp_enqueue_style('vuetify-css', $assets . '/css/vuetify.min.css', NULL, $v, 'all');
        wp_enqueue_style('viewer-css', $assets . '/css/lib/viewer.min.css', NULL, $v, 'all');

        wp_enqueue_script('jquery');

        wp_enqueue_script('vue-js', $assets . '/js/vue.js', array('jquery'));
        wp_localize_script('vue-js', 'udata', User::get_session());
        wp_enqueue_script('vuetify-js', $assets . '/js/vue-complements/vuetify.js', array('vue-js'));
        wp_enqueue_script('vue-resource-js', $assets . '/js/vue-complements/vue-resource.min.js', array('vue-js'));
    }

    public function ra_elite_usa_insurance_wp_head(): Void
    {
        ?>
            <script type="text/javascript">
                var ra_elite_usa_insurance_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=';
            </script>
        <?php
    }
}
