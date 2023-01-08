<?php

namespace RA_ELITE_USA\Shortcode;

use RA_ELITE_USA\Controller\Classes\Template;
use RA_ELITE_USA\Controller\Classes\Options;
use RA_ELITE_USA\Controller\Classes\User;

new \RA_ELITE_USA\Shortcode\Dashboard();

class Dashboard
{

    protected static $view = '';
    protected static $css_assets = [
        'main'
    ];
    protected static $js_assets  = [
        'setup.min'
    ];


    public function __construct()
    {
        add_shortcode('ra_elite_usa_insurance_application_form_shortcode', array($this, 'application_form'));
        add_shortcode('ra_elite_usa_insurance_dashboard_shortcode', array($this, 'quote_dashboard'));
        add_shortcode('ra_elite_usa_insurance_user_settings_shortcode', array($this, 'user_settings'));
        add_shortcode('ra_elite_usa_insurance_user_manager_shortcode', array($this, 'user_manager'));
        add_shortcode('ra_elite_usa_insurance_inbox_shortcode', array($this, 'inbox'));
        add_shortcode('ra_elite_usa_insurance_report_renewals_and_new_quotes_shortcode', array($this, 'reports_renewals_and_new_quotes'));
    }

    public static function application_form(): void
    {
        if (!is_user_logged_in()) {

            self::$js_assets[] = 'login.min';
            self::$view = 'login';

        } else {

            $current_user = User::get_session();
            if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {

                self::$js_assets[] = 'agreement.min';
                self::$view = 'interface/parts/agreement';

            } else {

                self::$js_assets = ['countries.min', 'setup.min', 'applications/main.min'];
                self::$view = 'forms/quote_application';

            }
        }

        self::render();
    }

    public static function quote_dashboard(): void
    {
        if (!is_user_logged_in()) {

            self::$js_assets[] = 'login.min';
            self::$view = 'login';

        } else {
            $current_user = User::get_session();

            if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {

                self::$js_assets[] = 'agreement.min';
                self::$view = 'interface/parts/agreement';

            } else {

                self::$js_assets = [
                    'countries.min',
                    'setup.min',
                    'vue-complements/vue-json-excel.umd'
                ];

                if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager') {

                    self::$js_assets[] = 'dashboard/manager/main.min';
                    self::$view = 'interface/manager/dashboard';

                } elseif ($current_user['roles'][0] == 'elite_usa_insurance_agent') {

                    self::$js_assets[] = 'dashboard/agent/main.min';
                    self::$view = 'interface/agent/dashboard';

                } elseif ($current_user['roles'][0] == 'elite_usa_superuser') {

                    self::$js_assets[] = 'dashboard/superuser/main.min';
                    self::$view = 'interface/superuser/dashboard';

                }
            }
        }

        self::render();
    }

    public static function user_settings(): void
    {
        if (!is_user_logged_in()) {

            self::$js_assets[] = 'login.min';
            self::$view = 'login';

        } else {

            $current_user = User::get_session();
            if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {

                self::$js_assets[] = 'agreement.min';
                self::$view = 'interface/parts/agreement';

            } else {

                self::$js_assets = ['setup.min', 'dashboard/settings/main.min'];
                self::$view = 'interface/settings/main';

            }

        }

        self::render();
    }

    public static function user_manager(): void
    {
        if (!is_user_logged_in()) {

            self::$js_assets[] = 'login.min';
            self::$view = 'login';

        } else {

            $current_user = User::get_session();
            if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_superuser') {

                $folder = $current_user['roles'][0] == 'administrator' ? 'admin' : 'superuser';
                self::$js_assets = ['countries.min', 'setup.min', "dashboard/{$folder}/manage-users.min"];
                self::$view = 'interface/superuser/users';

            }

        }

        self::render();
    }

    public static function inbox(): void
    {
        if (!is_user_logged_in()) {

            self::$js_assets[] = 'login.min';
            self::$view = 'login';

        } else {
            
            $current_user = User::get_session();

            if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_superuser' || $current_user['roles'][0] == 'elite_usa_quote_manager') {
                
                $folder = $current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' ? 'manager' : 'superuser';
                
                self::$js_assets = ['countries.min', 'setup.min', "dashboard/{$folder}/inbox.min"];
                self::$view = 'interface/manager/inbox';

            } elseif ($current_user['roles'][0] == 'elite_usa_insurance_agent') {
                
                if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {

                    self::$js_assets[] = 'agreement.min';
                    self::$view = 'interface/parts/agreement';

                } else {

                    self::$js_assets = ['countries.min', 'setup.min', "dashboard/agent/inbox.min"];
                    self::$view = 'interface/agent/inbox';
                    
                }

            }
        }
        
        self::render();
    }

    public static function reports_renewals_and_new_quotes(): void
    {
        if (!is_user_logged_in()) {

            self::$js_assets[] = 'login.min';
            self::$view = 'login';

        } else {
            $js_assets = [
                'lib/chartJS.min',
                'vue-complements/vue-charts.min',
                'dashboard/reports/renewals_and_new_quotes.min',
            ];
            self::$js_assets = array_merge(self::$js_assets, $js_assets);
            self::$view = 'interface/reports/renewals_and_new_quotes';
        }

        self::render();
    }

    public static function ra_elite_usa_insurance_enqueue_ss(): void
    {
        $v = (WP_DEBUG) ? time() : RA_ELITE_USA_INSURANCE_DB_VERSION;
        $current_user = User::get_session();
        $assets = RA_ELITE_USA_INSURANCE_URL . 'assets';
        
        wp_enqueue_style('font-roboto-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap');
        wp_enqueue_style('material-design-icons', $assets . '/css/material-design-icons.min.css', null, $v, 'all');
        wp_enqueue_style('vuetify-css', $assets . '/css/vuetify.min.css', null, $v, 'all');
        wp_enqueue_style('viewer-css', $assets . '/css/lib/viewer.min.css', null, $v, 'all');

        wp_enqueue_script('jquery');
        wp_enqueue_script('preloader', $assets . '/js/preload.js', array('jquery'));
        RA_ELITE_USA_ENV ? wp_enqueue_script('vue-js', $assets . '/js/vue.min.js', array('jquery')) : 
        wp_enqueue_script('vue-js', $assets . '/js/vue.pmin.js', array('jquery'));

        if (is_user_logged_in()) {

            wp_enqueue_script('moment-js', $assets . "/js/lib/moment.min.js");
            wp_enqueue_script('moment-timezone-js', $assets . "/js/lib/moment-timezone.min.js", array('moment-js'));
            wp_localize_script('vue-js', 'udata', $current_user);
            wp_localize_script('vue-js', 'routes', Options::get_option('routes'));
            $file = Template::folder_by_rol($current_user);
            wp_enqueue_script('elite-usa-notifications', $assets . "/js/notifications/{$file}.min.js", array('vue-js'), RA_ELITE_USA_INSURANCE_VERSION);

        }

        wp_enqueue_script('vuetify-js', $assets . '/js/vue-complements/vuetify.js', array('vue-js'));
        wp_enqueue_script('vue-resource-js', $assets . '/js/vue-complements/vue-resource.min.js', array('vue-js'));
    }

    public static function render() {
        add_action('wp_head', self::ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', self::ra_elite_usa_insurance_enqueue_ss());

        echo Template::render_view(self::$css_assets, self::$js_assets, self::$view);
    }

    public static function ra_elite_usa_insurance_wp_head(): void
    {
        ?>
        <script type="text/javascript">
            var ra_elite_usa_insurance_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=';
        </script>
        <?php
    }
}
