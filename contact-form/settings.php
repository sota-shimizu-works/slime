<?php

add_action('admin_menu', 'contact_form_settings');

function contact_form_settings()
{
    add_options_page('コンタクトフォーム設定', 'コンタクトフォーム', 8, 'contact_form_settings', 'contact_form_settings_page');
    add_action('admin_init', 'register_contact_form_settings');
}

function register_contact_form_settings()
{
    register_setting('contact-form-settings-group', 'contact_form_is_active');
    register_setting('contact-form-settings-group', 'contact_form_confilm_is_active');
    register_setting('contact-form-settings-group', 'contact_form_smtp_is_active');
    register_setting('contact-form-settings-group', 'contact_form_smtp_host');
    register_setting('contact-form-settings-group', 'contact_form_smtp_auth');
    register_setting('contact-form-settings-group', 'contact_form_smtp_port');
    register_setting('contact-form-settings-group', 'contact_form_smtp_username');
    register_setting('contact-form-settings-group', 'contact_form_smtp_password');
    register_setting('contact-form-settings-group', 'contact_form_smtp_secure');
    register_setting('contact-form-settings-group', 'contact_form_smtp_from');
    register_setting('contact-form-settings-group', 'contact_form_smtp_fromname');
}

function contact_form_settings_page()
{
?>
    <div class="wrap">
        <h2>コンタクトフォーム設定</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('contact-form-settings-group');
            do_settings_sections('contact-form-settings-group');
            ?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_is_active">有効にする</label>
                        </th>
                        <td>
                            <input type="checkbox" id="contact_form_is_active" class="regular-text" name="contact_form_is_active" <?php if (get_option('contact_form_is_active')) echo 'checked' ?>>
                            <p class="description">有効にすると<code><?= SLIMECF_INPUT_PAGE_NAME ?></code>のスラッグ名の固定ページが生成されます。</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_confilm_is_active">確認画面を有効にする</label>
                        </th>
                        <td>
                            <input type="checkbox" id="contact_form_confilm_is_active" class="regular-text" name="contact_form_confilm_is_active" <?php if (get_option('contact_form_confilm_is_active')) echo 'checked' ?>>
                            <p class="description">有効にすると<code><?= SLIMECF_CONFILM_PAGE_NAME ?></code>,<code><?= SLIMECF_THX_PAGE_NAME ?></code>のスラッグ名の固定ページが生成されます。</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_is_active">SMTP設定を有効にする</label>
                        </th>
                        <td>
                            <input type="checkbox" id="contact_form_smtp_is_active" class="regular-text" name="contact_form_smtp_is_active" <?php if (get_option('contact_form_smtp_is_active')) echo 'checked' ?>>
                            <p class="description">SMTP設定を有効にします。無効の場合WordPress設定から指定してあるメールサーバーを使用します。</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_host">SMTPホスト名</label>
                        </th>
                        <td>
                            <input type="text" id="contact_form_smtp_host" class="regular-text" name="contact_form_smtp_host" value="<?= get_option('contact_form_smtp_host') ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_auth">SMTP認証を有効にする</label>
                        </th>
                        <td>
                            <input type="checkbox" id="contact_form_smtp_auth" class="regular-text" name="contact_form_smtp_auth" <?php if (get_option('contact_form_smtp_auth')) echo 'checked' ?>>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_port">ポート番号</label>
                        </th>
                        <td>
                            <input type="number" id="contact_form_smtp_port" class="regular-text" name="contact_form_smtp_port" value="<?= get_option('contact_form_smtp_port') ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_username">ユーザー名</label>
                        </th>
                        <td>
                            <input type="number" id="contact_form_smtp_username" class="regular-text" name="contact_form_smtp_username" value="<?= get_option('contact_form_smtp_username') ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_password">パスワード</label>
                        </th>
                        <td>
                            <input type="password" id="contact_form_smtp_password" class="regular-text" name="contact_form_smtp_password" value="<?= get_option('contact_form_smtp_password') ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_secure">暗号化方式</label>
                        </th>
                        <td>
                            <select name="contact_form_smtp_secure" id="contact_form_smtp_secure">
                                <option value="none" <?php if (get_option('contact_form_smtp_secure') == 'none') echo 'selected' ?>>接続の保護なし</option>
                                <option value="starttls" <?php if (get_option('contact_form_smtp_secure') == 'starttls') echo 'selected' ?>>STARTTLS</option>
                                <option value="tls" <?php if (get_option('contact_form_smtp_secure') == 'tls') echo 'selected' ?>>TLS</option>
                                <option value="ssl" <?php if (get_option('contact_form_smtp_secure') == 'ssl') echo 'selected' ?>>SSL</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_from">送信者メールアドレス</label>
                        </th>
                        <td>
                            <input type="text" id="contact_form_smtp_from" class="regular-text" name="contact_form_smtp_from" value="<?= get_option('contact_form_smtp_from') ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_smtp_fromname">送信者名</label>
                        </th>
                        <td>
                            <input type="text" id="contact_form_smtp_fromname" class="regular-text" name="contact_form_smtp_fromname" value="<?= get_option('contact_form_smtp_fromname') ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
?>