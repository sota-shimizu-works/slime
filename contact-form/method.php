<?php

class ContactForm
{
    public function creatForm($options = null)
    {
        $append = '<form id="contact-form-wrapper" method="post"';
        if (get_option('contact_form_confilm_is_active')) {
            if (is_page(SLIMECF_CONFILM_PAGE_NAME)) {
                $append .=  ' action="' . home_url('/' . SLIMECF_THX_PAGE_NAME . '/') . '"';
            } else {
                $append .=  ' action="' . home_url('/' . SLIMECF_CONFILM_PAGE_NAME . '/') . '"';
            }
        } else {
            $append .=  ' action="' . home_url('/' . SLIMECF_INPUT_PAGE_NAME  . '/') . '"';
        }
        $append .= ' >';

        return $append;
    }

    public function endForm()
    {
        $append = '</form>';
        return $append;
    }

    public function send($text = null)
    {
        if ($text == null) {
            if (get_option('contact_form_confilm_is_active')) {
                if (is_page(SLIMECF_CONFILM_PAGE_NAME)) {
                    $text = '送信';
                } else {
                    $text = '確認';
                }
            } else {
                $text = '送信';
            }
        }
        $append = '<button type="submit">' . $text . '</button>';

        return $append;
    }
}
