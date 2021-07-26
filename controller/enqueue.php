<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly

add_action('admin_head', 'ra_elite_usa_insurance_nonces');
add_action('wp_head', 'ra_elite_usa_insurance_nonces');

function ra_elite_usa_insurance_nonces()
{

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
