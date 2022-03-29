<?php
function create_pages_and_setting()
{
    //$pages_array[] = array('title'=>'ページタイトル', 'name'=>'スラッグ', 'parent'=>'親スラッグ');	
    //例としてお問い合わせページを入力(親ページなし)
    $pages_array[] = array('title' => 'お問い合わせ', 'name' => 'contact', 'parent' => '');
    if (get_option('contact_form_confilm_is_active')) {
        $pages_array[] = array('title' => 'お問い合わせ内容確認', 'name' => 'contact_confilm', 'parent' => '');
        $pages_array[] = array('title' => 'お問い合わせ送信完了', 'name' => 'contact_thx', 'parent' => '');
    }

    if (get_option('contact_form_is_active')) {
        foreach ($pages_array as $value) {
            setting_pages($value);
        }
    }
}
function setting_pages($val)
{
    //親ページ判別
    if (!empty($val['parent'])) {
        $parent_id = get_page_by_path($val['parent']);
        $parent_id = $parent_id->ID;
        $page_slug = $val['parent'] . "/" . $val['name'];
    } else {
        $parent_id = "";
        $page_slug = $val['name'];
    }
    if (empty(get_page_by_path($page_slug))) {
        //固定ページがなければ作成
        $insert_id = wp_insert_post(
            array(
                'post_title'   => $val['title'],
                'post_name'    => $val['name'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_parent'  => $parent_id,
                'post_content' => '',
            )
        );
    } else {
        //固定ページがすでにあれば更新
        // $page_obj = get_page_by_path($page_slug);
        // $page_id = $page_obj->ID;
        // $base_post = array(
        //     'ID'           => $page_id,
        //     'post_title'   => $val['title'],
        //     'post_name'    => $val['name'],
        // );
        // wp_update_post($base_post);
    }
}
add_action('after_setup_theme', 'create_pages_and_setting');
