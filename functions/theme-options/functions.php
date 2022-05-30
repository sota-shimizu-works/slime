<?php

require get_template_directory() . '/functions/theme-options/variables.php';

add_action('admin_menu', 'my_theme_option');
add_action('admin_init', 'my_theme_option_setting');

function my_theme_option()
{
    add_options_page('お客様情報', 'お客様情報', 'edit_themes', 'theme_option', 'theme_option_file');
}

function theme_option_file()
{
    require_once(get_template_directory() . '/functions/theme-options/manege-screen.php');
}


function my_theme_option_setting()
{
    foreach (THEME_OPTIONS as $group_name => $options) {
        foreach ($options as $option) {
            register_setting($group_name, $option['key']);
        }
    }
}
