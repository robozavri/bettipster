<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * აკონვერტირებს ჩათის შტყობინების დროს მომხმარებლისთვის გასაგებ ენაზე
 *
 * @param
 * @return
 */
if ( ! function_exists('time_converter_helper')){
    function time_converter_helper($datetime, $full = false) {

        $CI =& get_instance();
        // date_default_timezone_set ('Asia/Tbilisi');
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $CI->lang->load('time_lang',$CI->session->userdata('language'));

        $string = array(
            'y' => $CI->lang->line('year'),
            'm' => $CI->lang->line('month'),
            'w' => $CI->lang->line('week'),
            'd' => $CI->lang->line('day'),
            'h' => $CI->lang->line('hour'),
            'i' => $CI->lang->line('minute'),
            's' => $CI->lang->line('second'),
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
                // $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) .' '. $CI->lang->line('ago') : $CI->lang->line('now');
    }
}
