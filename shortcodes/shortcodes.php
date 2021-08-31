<?php
function defer_parsing_of_js($url)
{
    if (strpos($url, 'jquery.js')) {return $url;}
    return str_replace(' src', ' defer src', $url);
}

new RA_ELITE_USA_INSURANCE_SHORTCODES();

class RA_ELITE_USA_INSURANCE_SHORTCODES
{

    public function __construct()
    {
        add_shortcode('ra_elite_usa_insurance_application_form_shortcode', array($this, 'application_form'));
        add_shortcode('ra_elite_usa_insurance_dashboard_shortcode', array($this, 'quote_dashboard'));
        add_shortcode('ra_elite_usa_insurance_user_settings_shortcode', array($this, 'user_settings'));
        add_shortcode('ra_elite_usa_insurance_user_manager_shortcode', array($this, 'user_manager'));
        add_shortcode('ra_elite_usa_insurance_inbox_shortcode', array($this, 'inbox'));
    }

    public function application_form()
    {
        add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
        if (!is_user_logged_in()) {
            echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', 'login'], 'login');
        } else {
            $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
            if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {
                echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', 'agreement-v1.0.0'], 'interface/parts/agreement');
            } else {
                echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', 'applications/main-v1.10.5'], 'forms/quote_application');
            }
        }
    }

    public function quote_dashboard()
    {
        add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
        if (!is_user_logged_in()) {
            echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', 'login'], 'login');
        } else {
            $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
            if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {
                echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', 'agreement-v1.0.0'], 'interface/parts/agreement');
            } else {
                if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager') {
                    echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', 'vue-complements/vue-json-excel.umd', 'dashboard/manager/main-v1.10.5'], 'interface/manager/dashboard');
                } else if ($current_user['roles'][0] == 'elite_usa_insurance_agent') {
                    echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', 'vue-complements/vue-json-excel.umd', 'dashboard/agent/main-v1.10.2'], 'interface/agent/dashboard');
                } else if ($current_user['roles'][0] == 'elite_usa_superuser') {
                    echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', 'vue-complements/vue-json-excel.umd', 'dashboard/superuser/main-v1.10.1'], 'interface/superuser/dashboard');
                }
            }
        }

    }

    public function user_settings()
    {
        add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
        if (!is_user_logged_in()) {
            echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', 'login'], 'login');
        } else {
            $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
            if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {
                echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', 'agreement-v1.0.0'], 'interface/parts/agreement');
            } else {
                echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', 'dashboard/settings/main-v1.0.2'], 'interface/settings/main');
            }
        }

    }

    public function user_manager()
    {
        add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('admin_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
        if (!is_user_logged_in()) {
            echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', 'login'], 'login');
        } else {
            $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
            if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_superuser') {
                $folder = $current_user['roles'][0] == 'administrator' ? 'admin' : 'superuser';
                echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', "dashboard/{$folder}/manage-users-v1.0.3"], 'interface/superuser/users');
            }
        }

    }

    public function inbox()
    {
        add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
        if (!is_user_logged_in()) {
            echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['setup-v1.0.2.min', 'login'], 'login');
        } else {
            $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
            if ($current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_superuser' || $current_user['roles'][0] == 'elite_usa_quote_manager') {
                $folder = $current_user['roles'][0] == 'administrator' || $current_user['roles'][0] == 'elite_usa_quote_manager' ? 'manager' : 'superuser';
                echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', "dashboard/{$folder}/inbox-v1.0.8"], 'interface/manager/inbox');
            } else if ($current_user['roles'][0] == 'elite_usa_insurance_agent') {
                if ($current_user['roles'][0] == 'elite_usa_insurance_agent' && empty($current_user['agreement_form'])) {
                    echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', 'agreement-v1.0.0'], 'interface/parts/agreement');
                } else {
                    echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'], ['countries.min', 'setup-v1.0.2.min', "dashboard/agent/inbox-v1.0.4"], 'interface/agent/inbox');
                }
            } else {

            }
        }

    }

    public function ra_elite_usa_insurance_enqueue_ss()
    {
        $v = (WP_DEBUG) ? time() : RA_ELITE_USA_INSURANCE_DB_VERSION;
        $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();
        $assets = RA_ELITE_USA_INSURANCE_URL . 'assets';
        wp_enqueue_style('font-roboto-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap');
        wp_enqueue_style('material-design-icons', $assets . '/css/material-design-icons.min.css', null, $v, 'all');
        wp_enqueue_style('vuetify-css', $assets . '/css/vuetify.min.css', null, $v, 'all');
        wp_enqueue_style('viewer-css', $assets . '/css/lib/viewer.min.css', null, $v, 'all');

        wp_enqueue_script('jquery');
        wp_enqueue_script('preloader', $assets . '/js/preload.js', array('jquery'));

        wp_enqueue_script('vue-js', $assets . '/js/vue.js', array('jquery'));
        if (is_user_logged_in()) {
            wp_enqueue_script('moment-js', $assets . "/js/lib/moment.min.js");
            wp_enqueue_script('moment-timezone-js', $assets . "/js/lib/moment-timezone.min.js", array('moment-js'));
            wp_localize_script('vue-js', 'udata', $current_user);
            wp_localize_script('vue-js', 'routes', RA_ELITE_USA_INSURANCE_OPTIONS::get_option('routes'));
            $file = RA_ELITE_USA_INSURANCE_TEMPLATE::folder_by_rol($current_user);
            wp_enqueue_script('elite-usa-notifications', $assets . "/js/notifications/{$file}-v1.0.1.js", array('vue-js'));
        }
        wp_enqueue_script('vuetify-js', $assets . '/js/vue-complements/vuetify.js', array('vue-js'));
        wp_enqueue_script('vue-resource-js', $assets . '/js/vue-complements/vue-resource.min.js', array('vue-js'));
        return true;
    }

    public function ra_elite_usa_insurance_wp_head()
    {
        ?>
        <script type="text/javascript">
            var ra_elite_usa_insurance_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=';
        </script>
        <?php
return true;
    }
}
