<?php

/**
 * オプション設定用配列
 * 
 * 
 * `key` 
 * 呼び出す際の任意な名前
 * 
 * 
 * `type`
 * 管理画面での入力形式
 * text  ....input type text
 * number  .... input type number
 * text-area  .... textarea
 * radio  .... input type radio
 * select  .... select
 * editor  .... wordpress clasic editor
 * 
 * 
 * `placeholder`
 * プレスフォルダーテキスト
 * 
 * 
 * `label`
 * 管理画面で表示するラベル名
 * 
 * 
 * `description`
 * 管理画面で表示する説明文
 */
define('THEME_OPTIONS', [
    'option_group' => [
        [
            'key' => 'company_name',
            'type' => 'text',
            'placeholder' => '余白文化株式会社',
            'label' => '企業・団体名',
        ],
        [
            'key' => 'tel',
            'type' => 'number',
            'placeholder' => '000-1111-2222',
            'label' => '電話番号',
            'description' => '電話番号(ハイフンあり)で入力してください。'
        ]
    ]
]);
