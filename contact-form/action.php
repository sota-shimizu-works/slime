<?php
function page_controll()
{
    /**
     * contact_confilm page processes
     */
    if (is_page('contact_confilm')) {
        $referer = parse_url(wp_get_referer());
        if ($referer['host'] !== $_SERVER["HTTP_HOST"]) {
            wp_redirect(esc_url(home_url('/')), '302');
        }

        if (empty($_POST)) {
            wp_redirect(esc_url(home_url('/contact')), '302');
        }
        debug('contact_confilm');
        debug($_POST);
        session_start();
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    if (is_page('contact_thx')) {
        session_start();
        debug('contact_thx');
        debug($_SESSION);
    }
}

add_action('pre_get_posts', 'page_controll');
