<?php
/*
Plugin Name: Moortak portfolio hover effect for Elementor
Plugin URI: https://aliqorbani.github.io/plugins/moortak-ephe
Description: uses for show your portfolios with a pretty hover effect.
Version: 2.0.1
Author: Ali Qorbani
Text Domain: moortak-ephe
Domain Path: /lang
Author URI: https://aliqorbani.github.io
*/
define('MOORTAK_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MOORTAK_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MOORTAK_PLUGIN_INCLUDES', MOORTAK_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'includes/');
include_once MOORTAK_PLUGIN_INCLUDES . "post-type.php";
if ( ! function_exists('moortak_load_translation') ){
    function moortak_load_translation()
    {
        load_plugin_textdomain('moortak-ephe', false, basename(dirname(__FILE__)) . '/lang/');
    }

    add_action('plugins_loaded', 'moortak_load_translation');
}
if ( ! function_exists('moortak_load_elementor_widget') ){
    /**
     * @throws \Exception
     */
    function moortak_load_elementor_widget()
    {
        if ( class_exists('\Elementor\Plugin') ){
            require(MOORTAK_PLUGIN_PATH . 'includes/widget.php');
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(
                new \Elementor\moortak_portfolio_hover_effect_widget()
            );
            add_image_size('moortak_portfolio_hover_image', '400', '900', true);
        }
    }

    add_action('init', 'moortak_load_elementor_widget');
}
if ( ! function_exists('moortak_ephe_scripts') ){
    function moortak_ephe_scripts()
    {
        wp_enqueue_style('moortak_ephe_style', MOORTAK_PLUGIN_URL . 'css/mephe.css');
    }

    add_action('wp_enqueue_scripts', 'moortak_ephe_scripts', 99);
}
