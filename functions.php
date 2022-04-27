<?php

/**
 * Debug-kit
 */
if (!is_admin()) {
    require 'debug-kit/require.php';
}





/** 
 * autoload require
 */
require 'vendor/autoload.php';





/**
 * Chronos
 * Chronos::setTestNow
 * - chronosのテスト支援ツール設定
 */

use Cake\Chronos\Chronos;

// Chronos::setTestNow(new Chronos('1975-12-25 00:00:00'));





/**
 * File require
 */
require get_template_directory() . '/functions/method.php';
require get_template_directory() . '/functions/header-meta/ogp.php';
require get_template_directory() . '/functions/header-meta/description.php';
require get_template_directory() . '/functions/util/costom-query.php';
// require get_template_directory() . '/contact-form/require.php';




/**
 * theme_setup
 * テーマの標準的な設定
 */
function theme_setup()
{
    add_theme_support('post-thumbnails'); /* アイキャッチ */
    add_theme_support('automatic-feed-links'); /* RSSフィード */
    add_theme_support('title-tag'); /* タイトルタグ自動生成 */
    add_theme_support('html5', array( /* HTML5のタグで出力 */
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'theme_setup');





/**
 * set_mime_types
 * WordPress内で使用できる拡張子の追加設定
 */
function set_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}





/**
 * my_script_for_header
 * ヘッダーで読み込むファイル設定
 * WP_HEADERの位置に挿入されます。
 */
function my_script_for_header()
{
    // CSS
    wp_enqueue_style('common_css', get_template_directory_uri() . '/css/front/common.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'my_script_for_header');
