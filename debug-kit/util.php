<?php

$debug_kit_values = [];



function debug($val, $group = false)
{
    if (WP_DEBUG) {
        global $debug_kit_values;

        // 表示するvalueの格納
        $data = [];
        $data['value'] = $val;


        $backtrace = debug_backtrace();

        // debug()を使用したファイル名と行数の格納
        $bt_file = $backtrace[0]['file'];
        $bt_file = explode('\\', $bt_file);
        foreach ($bt_file as $index => $file_path) {
            if ($file_path != 'themes') {
                unset($bt_file[$index]);
            } else {
                break;
            }
        }
        $bt_file = implode('\\', $bt_file);
        $bt_file = $bt_file . ' line:' . $backtrace[0]['line'];
        $data['line'] = $bt_file;

        if ($group) {
            $debug_kit_values[$group][] = $data;
        } else {
            array_push($debug_kit_values, $data);
        }
    } else {
        return false;
    }
}



function debug_kit_dom($values)
{
    if (WP_DEBUG) {
        // php Document Object Model インスタンス生成
        $dom = new DOMDocument();

        // debug-kitのラッパー生成
        $out_wrapper = $dom->createElement('div');
        $out_wrapper->setAttribute('id', 'debug-kit');

        // 見出し用ul
        $head_ul = $dom->createElement('ul');
        $head_ul->setAttribute('class', 'head-ul');
        $out_wrapper->appendChild($head_ul);

        // value用ul
        $value_ul = $dom->createElement('ul');
        $value_ul->setAttribute('class', 'value-ul');
        $out_wrapper->appendChild($value_ul);


        if (!empty($values)) {
            $idnex_cnt = 0;
            foreach ($values as $index => $value) {
                if (is_string($index)) {
                    /**
                     * グループ設定の場合
                     */

                    // head list生成
                    $head_li = $dom->createElement('li');
                    $head_li->setAttribute('data-index', $index);
                    if ($idnex_cnt == 0) $head_li->setAttribute('class', 'active');
                    $head_li_p = $dom->createElement('p', $index);
                    $head_li->appendChild($head_li_p);
                    $head_ul->appendChild($head_li);

                    // value list生成
                    $value_li = $dom->createElement('li');
                    $value_li->setAttribute('data-index', $index);
                    if ($idnex_cnt == 0) $value_li->setAttribute('class', 'active');

                    foreach ($value as $idnex => $once_value) {
                        // 型とサイズの確認
                        $value_type = gettype($once_value['value']);
                        if ($value_type == 'string') {
                            // 文字列型の場合は文字数を追記
                            $value_type .= '(' . mb_strlen($once_value['value']) . ')';
                        }

                        $head_p = $dom->createElement('p', $once_value['line'] . ' :' . $value_type);
                        $head_p->setAttribute('class', 'head group');
                        $value_li->appendChild($head_p);

                        $code = $dom->createElement('code');

                        // print_rの内容をリファクタリングして文字列としてpre内に出力
                        ob_start();
                        print_r($once_value['value']);
                        $result = ob_get_clean();
                        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');

                        $pre = $dom->createElement('pre', $result);
                        $pre->setAttribute('class', 'prettyprint lang-php');


                        $code->appendChild($pre);
                        $value_li->appendChild($code);
                    }
                    $value_ul->appendChild($value_li);
                } else {
                    // head list生成
                    $head_li = $dom->createElement('li');
                    $head_li->setAttribute('data-index', $index);
                    if ($index == 0) $head_li->setAttribute('class', 'active');

                    $head_li_p = $dom->createElement('p', $value['line']);
                    $head_li->appendChild($head_li_p);
                    $head_ul->appendChild($head_li);


                    // value list生成
                    $value_li = $dom->createElement('li');
                    $value_li->setAttribute('data-index', $index);
                    if ($idnex_cnt == 0) $value_li->setAttribute('class', 'active');

                    // 型とサイズの確認
                    $value_type = gettype($value['value']);
                    if ($value_type == 'string') {
                        // 文字列型の場合は文字数を追記
                        $value_type .= '(' . mb_strlen($value['value']) . ')';
                    }
                    $head_p = $dom->createElement('p', $value['line'] . ' :' . $value_type);
                    $head_p->setAttribute('class', 'head');
                    $value_li->appendChild($head_p);

                    $code = $dom->createElement('code');

                    // print_rの内容をリファクタリングして文字列としてpre内に出力
                    ob_start();
                    print_r($value['value']);
                    $result = ob_get_clean();
                    $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');

                    $pre = $dom->createElement('pre', $result);
                    $pre->setAttribute('class', 'prettyprint lang-php');


                    $code->appendChild($pre);
                    $value_li->appendChild($code);

                    $value_ul->appendChild($value_li);
                }
                $idnex_cnt++;
            }
        }

        $dom->appendChild($out_wrapper);

        echo $dom->saveHTML();
    } else {
        return false;
    }
}
