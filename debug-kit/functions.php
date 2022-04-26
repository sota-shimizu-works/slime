<?php

function debug_kit_display()
{
    global $debug_kit_values;
    debug_kit_dom($debug_kit_values);
}

add_action('shutdown', 'debug_kit_display');


if (WP_DEBUG) {



    function add_admin_bar_menu($wp_admin_bar)
    {
        //追加系コマンド
        $wp_admin_bar->add_node(array(
            'id'    => 'debug-dtn', //成立するIDならばなんでもよい
            'title' => 'DEBUG'
        ));
    }

    add_action('admin_bar_menu', 'add_admin_bar_menu', 99);



    function debug_import_file()
    {
        // CSS
        wp_enqueue_style('code_prettify_css', 'https://github.com/googlearchive/code-prettify/blob/e006587b4a893f0281e9dc9a53001c7ed584d4e7/styles/doxy.css', array(), '1.0.0', 'all');

        // Javascript
        wp_enqueue_script('code_prettify_js', 'https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?lang=css&skin=sunburst', array());
        wp_enqueue_script('debug_jquery', 'https://code.jquery.com/jquery-3.6.0.js', array());

        wp_enqueue_script('debug_common_js', get_template_directory_uri() . '/debug-kit/js/common.js', array());

        wp_enqueue_style('debug_common_css', get_template_directory_uri() . '/debug-kit/css/common.min.css');

        wp_enqueue_style('google_icon_sharp_css', 'https://fonts.googleapis.com/icon?family=Material+Icons+Sharp');
    }
    add_action('wp_enqueue_scripts', 'debug_import_file');


    function debug_import_file_footer()
    {
        wp_enqueue_script('debug_common_js', get_template_directory_uri() . '/debug-kit/js/common.js', array());
    }
    add_action('wp_footer', 'debug_import_file_footer');
}
