<?php

$debug_kit_values = [];



function debug($val)
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

        array_push($debug_kit_values, $data);
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
            foreach ($values as $index => $value) {

                // head list生成
                $head_li = $dom->createElement('li', $value['line']);
                $head_li->setAttribute('data-index', $index);
                if ($index == 0) $head_li->setAttribute('class', 'active');
                $head_ul->appendChild($head_li);


                // value list生成
                $value_li = $dom->createElement('li');
                $value_li->setAttribute('data-index', $index);
                if ($index == 0) $value_li->setAttribute('class', 'active');

                $head_p = $dom->createElement('p', $value['line']);
                $head_p->setAttribute('class', 'head');
                $value_li->appendChild($head_p);

                $code = $dom->createElement('code');

                // print_rの内容をリファクタリングして文字列としてpre内に出力
                ob_start();
                print_r($value['value']);
                $result = ob_get_clean();
                $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');

                $pre = $dom->createElement('pre', $result);
                $pre->setAttribute('class', 'prettyprint');


                $code->appendChild($pre);
                $value_li->appendChild($code);

                $value_ul->appendChild($value_li);
            }
        }

        $dom->appendChild($out_wrapper);

        echo $dom->saveHTML();
    } else {
        return false;
    }
}
