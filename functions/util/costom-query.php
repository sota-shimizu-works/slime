<?php

/**
 * set_add_query
 * 
 * アーカイブページで特定のGETパラメータがあればQueryに追加します。
 * @param csv $_GET['categorise']   カテゴリー名をカンマ区切りで設定してください。
 * @param strng $_GET['year']       絞り込む年を設定してください。
 * @param strng $_GET['month']       絞り込む月を設定してください。
 */
function set_add_query($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (isset($_GET['categorise'])) {
        $query->set('category_name', $_GET['categorise']);
    }
    if (isset($_GET['year'])) {
        $query->set('year', $_GET['year']);
    }
    if (isset($_GET['month'])) {
        $query->set('mouthnum', $_GET['month']);
    }
}
add_action('pre_get_posts', 'set_add_query');
