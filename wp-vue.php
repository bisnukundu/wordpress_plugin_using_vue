<?php

/**
 * Plugin Name: Custom Form Bisnu
 * Description: It's a custom form created by Bisnu Kundu as Carlos mate requirements.
 * Author URI:  http://github.com/bisnukundu
 * Plugin URI:  http://github.com/bisnukundu
 * Version:     1.0.0
 * Author:      Bisnu Kundu
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
        // wp_enqueue_script( 'wp-vue-core', plugin_dir_url( __FILE__ ) . '/dist/assets/index-a12960fd.js', [], time(), true );
        // wp_enqueue_style( 'wp-vue-core', plugin_dir_url( __FILE__ ) . '/dist/assets/index-bb2150d8.css', [], time() );
        wp_localize_script('wp-vue-core', 'wpvue', [
            'url' => $pluginUrl,
        ]);
    }

}

new WPVue();

function my_vue_shortcode($arr)
{

    $html = '<div id="' . $arr['id'] . '"></div>';
    echo $html;
}

add_shortcode('custom_form_bisnu', 'my_vue_shortcode');

add_action('wp_ajax_nopriv_load_more_product', 'submit_multi_step_form');
add_action('wp_ajax_load_more_product', 'submit_multi_step_form');

function submit_multi_step_form()
{
    $response = array(
        'message' => $_POST,
    );

    // return wp_send_json($response);

    $admin_email = get_option('admin_email');
    $subject = 'Hello, Admin!';
    $message = '<html>
<head></head>
<body style="font-family: Arial, sans-serif;">
    <h2 style="text-align: center;">Email Contents</h2>
    <table style="border-collapse: collapse; width: 50%; margin: 0 auto;">
        <tr>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f0f0f0;">Field</th>
            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; background-color: #f0f0f0;">Value</th>
        </tr>';

    $keys = [
        'house_rate',
        'house_location',
        'purchase_type',
        'radio_one',
        'saving_amout',
        'saving_parcentage',
        'address',
        'Ingresos_netos_one',
        'Ingresos_netos_one_two',
        'address_select_2',
        'Ingresos_netos_two',
        'Ingresos_netos_two_two',
        'name',
        'email',
        'country_code_two',
        'phone_two',
    ];

    foreach ($keys as $key) {
        $message .= '<tr>';
        $message .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $key . '</td>';
        $message .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . (isset($_POST[$key]) ? $_POST[$key] : '') . '</td>';
        $message .= '</tr>';
    }

    $message .= '</table>
</body>
</html>';

    $headers = array('Content-Type: text/html; charset=UTF-8');

    $sent = wp_mail($admin_email, $subject, $message, $headers);

    if ($sent) {

        return wp_send_json_success($response, 200);
    } else {
        return wp_send_json_success($sent, 404);
    }

};
