<?php

/**
 * the_ogp function
 * 
 * OGP用のメタタグをHTMLとして返却します。
 * 
 * @param ary $options                      OGPの情報の初期値です。空で渡した場合適当な内容が設定されます。
 * @param strng $options['site_name']       初期値(サイト名):WordPress設定サイト名
 * @param strng $options['og_type']         初期値(OGタイプ):website
 * @param strng $options['og_url']          初期値(URL):トップページURL
 * @param strng $options['og_image']        初期値(URL):false(サムネイルが無いページでは使用しないため初期値はfalse) 
 * @param strng $options['og_description']  初期値(サイト説明):WordPress設定説明文
 * @param strng $options['fb_app_id']       初期値(ID):fasle
 * @param strng $options['twitter_card']    初期値(type):summary
 * @param strng $options['twitter_site']    初期値(URL):false
 */

function the_ogp($options = null)
{
    global $post;


    if (!isset($options['site_name'])) $options['site_name'] = get_bloginfo('name');
    if (!isset($options['og_title'])) $options['og_title'] = get_bloginfo('name');
    if (!isset($options['og_type'])) $options['og_type'] = 'website';
    if (!isset($options['og_url'])) $options['og_url'] = home_url();
    if (!isset($options['og_image'])) $options['og_image'] = false;
    if (!isset($options['og_description'])) $options['og_description'] = get_bloginfo('description');
    if (!isset($options['fb_app_id'])) $options['fb_app_id'] = false;
    if (!isset($options['twitter_card'])) $options['twitter_card'] = 'summary';
    if (!isset($options['twitter_site'])) $options['twitter_site'] = false;


    if (is_singular()) {
        setup_postdata($post);
        $options['og_type'] = 'article';
        $options['og_description'] = mb_substr(get_the_excerpt(), 0, 100);
        $options['og_url'] = get_permalink();

        wp_reset_postdata();

        if (has_post_thumbnail()) {
            $options['og_image'] = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
        }
    }

    //TODO: アーカイブページ設定追加

    $response_html = '';
    if (is_front_page() || is_home() || is_singular()) {
        if ($options['site_name']) $response_html .= '<meta property="og:site_name" content="' . esc_attr($options['site_name']) . '"/>';
        if ($options['og_title']) $response_html .= '<meta property="og:title" content="' . esc_attr($options['og_title']) . '"/>';
        if ($options['og_type']) $response_html .= '<meta property="og:type" content="' . esc_attr($options['og_type']) . '"/>';
        if ($options['og_url']) $response_html .= '<meta property="og:url" content="' . esc_url($options['og_url']) . '">';
        if ($options['og_image']) $response_html .= '<meta property="og:image" content="' . esc_url($options['og_image']) . '"/>';
        if ($options['og_description']) $response_html .= '<meta property="og:description" content="' . esc_attr($options['og_description']) . '"/>';
        if ($options['fb_app_id']) $response_html .= '<meta property="fb:app_id" content="' . $options['fb_app_id'] . '"/>';
        if ($options['twitter_card']) $response_html .= '<meta name="twitter:card" content="' . $options['twitter_card'] . '"/>';
        if ($options['twitter_site']) $response_html .= '<meta name="twitter:site" content="' . $options['twitter_site'] . '"/>';
    }

    return $response_html;
}
