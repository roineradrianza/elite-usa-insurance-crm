<?php
function defer_parsing_of_js( $url ) {
    if ( strpos( $url, 'jquery.js' ) ) {return $url;}
    return str_replace( ' src', ' defer src', $url );
}

new RA_ELITE_USA_INSURANCE_SHORTCODES();

class RA_ELITE_USA_INSURANCE_SHORTCODES
{

	function __construct() {
		add_shortcode( 'ra_elite_usa_insurance_application_form_shortcode', array($this, 'application_form') );
        add_shortcode( 'ra_elite_usa_insurance_dashboard_shortcode', array($this, 'quote_dashboard') );
	}

	function application_form() {
		add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
		add_action('admin_head', $this->ra_elite_usa_insurance_wp_head());
		add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
    echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'],['countries.min', 'setup.min', 'lib/moment.min', 'applications/main-v1.0.3'],'forms/quote_application');
	}

    function quote_dashboard() {
        add_action('wp_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('admin_head', $this->ra_elite_usa_insurance_wp_head());
        add_action('wp_enqueue_scripts', $this->ra_elite_usa_insurance_enqueue_ss());
        $current_user = RA_ELITE_USA_INSURANCE_USER::get_current_user();

        if ($current_user['roles'][0] == 'administrator') {
            echo RA_ELITE_USA_INSURANCE_TEMPLATE::render_view(['main'],['setup.min', 'lib/moment.min', 'dashboard/agent/main-v1.0.0'],'interface/agent/dashboard');
        }

    }

	public function ra_elite_usa_insurance_enqueue_ss() {
    $v = (WP_DEBUG) ? time() : RA_ELITE_USA_INSURANCE_DB_VERSION;
    $assets = RA_ELITE_USA_INSURANCE_URL . 'assets';
    wp_enqueue_style('font-roboto-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;1,100;1,200;1,300;1,400;1,500&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap');
    wp_enqueue_style('material-design-icons', $assets . '/css/material-design-icons.min.css', NULL, $v, 'all');
    wp_enqueue_style('vuetify-css', $assets . '/css/vuetify.min.css', NULL, $v, 'all');
    wp_enqueue_style('viewer-css', $assets . '/css/lib/viewer.min.css', NULL, $v, 'all');

    wp_enqueue_script('jquery');

    wp_enqueue_script('vue-js', $assets . '/js/vue.js', array('jquery'));
    wp_localize_script( 'vue-js', 'udata', RA_ELITE_USA_INSURANCE_USER::get_current_user());
    wp_enqueue_script('vuetify-js', $assets . '/js/vue-complements/vuetify.js', array('vue-js'));
    wp_enqueue_script('vue-resource-js', $assets . '/js/vue-complements/vue-resource.min.js', array('vue-js'));
    return true;
	}
    
	public function ra_elite_usa_insurance_wp_head() {
    ?>
    <script type="text/javascript">
        var ra_elite_usa_insurance_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=';
    </script>
    <?php
    return true;
	}
}
