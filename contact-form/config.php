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
                        <td><input type="checkbox" id="contact_form_is_active" class="regular-text" name="contact_form_is_active" <?php if (get_option('contact_form_is_active')) echo 'checked' ?>></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="contact_form_confilm_is_active">確認画面を有効にする</label>
                        </th>
                        <td><input type="checkbox" id="contact_form_confilm_is_active" class="regular-text" name="contact_form_confilm_is_active" <?php if (get_option('contact_form_confilm_is_active')) echo 'checked' ?>></td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
?>