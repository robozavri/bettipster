<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languageloader{

/**
 * ქუქში ჩაწერს გადაცემულ ენის სახელს
 *
 * @param string $language  ენის კოდი
 * @return
 */
  public function set_cookie_language($language = ''){
                $CI =& get_instance();
								$CI->load->helper('cookie');
									// set cookie
										 $cookie= array(
										  'name'   => 'language',
										  'value'  =>   $language,
										  'expire' => '86500',
									  );
								$CI->input->set_cookie($cookie);
	}

  /**
	 * შეამოწმებს ენა არის თუ არა დაყენებული სესიაში ან ქუქში და თუ არ არის მაშინ
   * სტანდარტულ ენას დააყენბს config იდან. სესიაში და ქუქშიც
   * @param
   * @return
	 */
    public function set_language(){

		  $CI =& get_instance();
		  $CI->load->library('session');
		  $CI->load->helper('cookie');

      // თუ ცარიელია სესია და ქუქში დევს მაშინ გადმოიწეროს ქუქიდან სესიაშიც
          $ses_lang = $CI->session->userdata('language');
          $cookie_leng = get_cookie('language');

		  if(empty($ses_lang) && !empty($cookie_leng)){

        	$CI->session->set_userdata('language', get_cookie('language'));

		  }elseif(!empty($ses_lang)){
            return;
		  }else{
       
         	$CI->session->set_userdata('language', $CI->config->item('language'));
         	$this->set_cookie_language($CI->config->item('language'));
          /*
          * გავთიშოთ ყველა კონტროლერისთვის ავტომატურად ჩასატვირთი ენების ფაილი
          * !! ამდროს საჭიროა ყვეალა კონტროლერს თვისი დასახელების ენების ფაილი ქონდეს შექმნილი
           if(empty($CI->uri->segment(1))){
            $CI->lang->load($CI->config->item('default_controller'), $CI->config->item('language'));
          }else{
            $CI->lang->load($CI->uri->segment(1), $CI->config->item('language'));
          }
          */
           return;
      }
	}
}
?>
