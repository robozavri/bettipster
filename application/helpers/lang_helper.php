<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ჩატვირთავს ავტომატურად შესაბამისი კონტროლერის ენის ფაილს
 *
 * @param
 * @return
 */
if ( ! function_exists('load_lang')){
   function load_lang($lang_file_name = ''){

       //ავიღოთ CodeIgniter ის მთავარი ობიექტი
       $CI =& get_instance();

       if(!empty($lang_file_name) && !empty($CI->session->userdata('language'))){
        //  die($CI->session->userdata('language'));
          $CI->lang->load($lang_file_name,$CI->session->userdata('language'));
          return;
       }

       // ავიღოთ კონტროლერის სახელი url იდან
       if( !empty( $CI->uri->segment(1) ) ){
           $controller = $CI->uri->segment(1);
      }else{
           $controller = $CI->config->item('default_controller');
      }
       // ჩავტვირთოთ კონტროლერისთვის მისი ენის ფაილი ან
       // სტანდარტული კონტროლერის ენის ფაილი
       if(empty($CI->session->userdata('language'))){
           $CI->lang->load($controller,$CI->config->item('language'));
       }else{
           $CI->lang->load($controller,$CI->session->userdata('language'));
       }
   }
}
