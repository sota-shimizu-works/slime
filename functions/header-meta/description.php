<?php

function meta_description()
{
    global $post;
    if (is_front_page() or is_home()) {
        //トップページの場合の処理
        return get_bloginfo('description');
    } elseif (is_post_type_archive('videos') == true) {
        return "テスト";
    } else if (is_post_type_archive('post') == true) {
        return "てすと";
    } else {
        $description_str = "";
        if (get_post_meta(get_the_ID(), 'description', true)) {
            return get_post_meta($post->ID, 'description', true);
        } else {
            if (is_page()) {
                // 固定ページの場合の処理
                $description_str = substr(strip_tags(get_the_excerpt()), 0, 140);
                $description_str =  mb_convert_encoding($description_str, "UTF-8");
                return $description_str;
            } elseif (is_single()) {
                //投稿ページの場合かつカスタムフィールドのディスクリプション設定が存在しない場合の処理
                $description_str = substr(strip_tags(get_the_excerpt()), 0, 140);
                $description_str =  mb_convert_encoding($description_str, "UTF-8");
                return $description_str;
            }
        }
    }
}
