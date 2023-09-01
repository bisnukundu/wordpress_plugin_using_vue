<?php

/**
 * Plugin Name: WP Vue
 * Description: WP Vue
 * Author URI:  https://hasin.me
 * Plugin URI:  https://hasin.me
 * Version:     1.0.0
 * Author:      Hasin
 * Text Domain: wp-vue
 * Domain Path: /i18n
 */

include_once ABSPATH . 'wp-admin/includes/plugin.php';

class WPVue
{
    public function __construct()
    {
        // add_action('init',[$this,'initialize']);
        add_action('wp_enqueue_scripts', [$this, 'loadAssets']);
        add_filter('script_loader_tag', [$this, 'loadScriptAsModule'], 10, 3);
    }

    public function loadScriptAsModule($tag, $handle, $src)
    {
        if ('wp-vue-core' !== $handle) {
            return $tag;
        }
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        return $tag;
    }

    public function loadAssets()
    {
        $pluginUrl = plugin_dir_url(__FILE__);

        wp_enqueue_script('wp-vue-core', '//localhost:5173/src/main.js', [], time(), true);
        // wp_enqueue_script('wp-vue-core', plugin_dir_url(__FILE__) . '/dist/assets/index-4a0a00bf.js', [], time(), true);
        // wp_enqueue_style('wp-vue-core', plugin_dir_url(__FILE__) . '/dist/assets/index-fa54a91b.css', [], time());
        wp_localize_script('wp-vue-core', 'wpvue', [
            'url' => $pluginUrl,
        ]);
    }

}

new WPVue();

function my_vue_shortcode()
{

    $html = '<div id="app"></div>';

    echo $html;
}

add_shortcode('custom_form_bisnu', 'my_vue_shortcode');
