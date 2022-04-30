<?php

namespace RA_ELITE_USA\Controller;

class Nonces 
{
    public function __construct()
    {
        add_action('admin_head', '\RA_ELITE_USA\Controller\Nonces::init');
        add_action('wp_head', '\RA_ELITE_USA\Controller\Nonces::init');
    }

    public static function init () {
        $nonces = array(
            ''
        );
    
        $nonces_list = array();
    
        foreach ($nonces as $nonce_name) {
            $nonces_list[$nonce_name] = wp_create_nonce($nonce_name);
        }
    
        ?>
        <script>
            var ra_elite_usa_insurance_nonces = <?php echo json_encode($nonces_list); ?>;
        </script>
        <?php
    }
}