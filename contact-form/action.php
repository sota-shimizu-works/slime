<?php

/**
 * SMTP設定
 * 
 * WordPress管理画面から有効にされた場合のみSMTP情報を上書きします。
 * https://analyzegear.co.jp/blog/700
 */
function set_mail_smtp($phpmailer)
{
    if (get_option('contact_form_smtp_is_active')) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = get_option('contact_form_smtp_host');
        $phpmailer->SMTPAuth   = get_option('contact_form_smtp_auth');
        $phpmailer->Port       = get_option('contact_form_smtp_port');
        $phpmailer->Username   = get_option('contact_form_smtp_username');
        $phpmailer->Password   = get_option('contact_form_smtp_password');
        $phpmailer->SMTPSecure = get_option('contact_form_smtp_secure');
        $phpmailer->From       = get_option('contact_form_smtp_from');
        $phpmailer->FromName   = get_option('contact_form_smtp_fromname');
        $phpmailer->SMTPDebug  = 0;
    }
}
add_action("phpmailer_init", "set_mail_smtp");



/**
 * 入力内容確認処理
 * 
 * 入力フォームからPOSTで送信された情報をセッションに保存
 */
function confilme_page_controll()
{
    if (is_page('SLIMECF_CONFILM_PAGE_NAME')) {

        $referer = parse_url(wp_get_referer());
        if ($referer['host'] !== $_SERVER["HTTP_HOST"]) {
            // 外部からのPOST通信の場合はリダイレクトをする
            wp_redirect(esc_url(home_url('/')), '302');
        }

        if (empty($_POST)) {
            // POSTが空の場合はリダイレクトする
            wp_redirect(esc_url(home_url('/' . SLIMECF_INPUT_PAGE_NAME)), '302');
        }

        //TODO: reCAPTCHAの処理

        // セッションに保存
        session_start();
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
}
add_action('pre_get_posts', 'confilme_page_controll');



/**
 * メール送信処理
 * 
 * セッションの内容からメールを送信
 */
function thx_page_controll()
{
    if (is_page(SLIMECF_THX_PAGE_NAME)) {
        session_start();
        //TODO: メールテンプレートの作成
        $mail_to = $_SESSION['email'];
        $subject = 'お問い合わせ有難う御座います。';
        $mail_body = $_SESSION['content'];
        wp_mail($mail_to, $subject, $mail_body);
    }
}
add_action('pre_get_posts', 'thx_page_controll');
