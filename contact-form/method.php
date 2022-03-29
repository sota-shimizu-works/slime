<?php

class ContactForm
{
    public function creatForm($options = null)
    {
        $append = '<form id="contact-form-wrapper" method="post"';
        if (get_option('contact_form_confilm_is_active')) {
            if (is_page('contact_confilm')) {
                $append .=  ' action="' . home_url('/contact_thx/') . '"';
            } else {
                $append .=  ' action="' . home_url('/contact_confilm/') . '"';
            }
        } else {
            $append .=  ' action="' . home_url('/contact/') . '"';
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
                if (is_page('contact_confilm')) {
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
