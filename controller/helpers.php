<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

function ra_elite_usa_insurance_register_style($style, $deps = array(), $inline_css = '')
{
    $default_path = RA_ELITE_USA_INSURANCE_URL . 'assets/css/';

    wp_enqueue_style('ra-project-filter-' . $style, $default_path . $style . '.css', $deps);

    if (!empty($inline_css)) wp_add_inline_style('ra-project-filter-' . $style, $inline_css);
}

function ra_elite_usa_insurance_register_script($script, $deps = array(), $footer = false, $inline_scripts = '')
{
    $handle = "ra-project-filter-{$script}";
    wp_enqueue_script($handle, RA_ELITE_USA_INSURANCE_URL . 'assets/js/' . $script . '.js', $deps, '', $footer);
    if (!empty($inline_scripts)) wp_add_inline_script($handle, $inline_scripts);
}

function ra_insurance_policy_rand_color($opacity = 1)
{
    return "rgba(" . rand(0, 255) . ", " . rand(50, 255) . ", " . rand(10, 255) . ", " . $opacity . ")";
}

function ra_elite_usa_insurance_delete_attachment($post_id)
{
    if (empty($post_id)) return false;
    wp_delete_attachment($post_id, true);
    return true;
}

function ra_insurance_policy_get_image_url($id, $size = 'full')
{
    $url = '';
    if (!empty($id)) {
        $image = wp_get_attachment_image_src($id, $size, false);
        if (!empty($image[0])) {
            $url = $image[0];
        }
    }

    return $url;
}