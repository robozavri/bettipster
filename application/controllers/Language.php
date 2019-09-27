<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

/**
 *  ენის შეცვლა
 *
 * @param
 * @return
 */
	public function change($lang = 'english')
	{

		switch ($lang) {
			case 'georgian': $lang = 'georgian';
				break;
			case  'english': $lang = 'english';
				break;
			default:	$lang = 'english';
				break;
		}

    $this->session->set_userdata('language',$lang );
    $this->load->helper('cookie');
      // set cookie
         $cookie= array(
          'name'   => 'language',
          'value'  =>   $lang,
          'expire' => '86500',
        );
     $this->input->set_cookie($cookie);

              if (!empty($_SERVER['HTTP_REFERER'])){
                  header("Location: ".$_SERVER['HTTP_REFERER']);
              }else{
                  header("Location: ".base_url());
                  // header("Location: ".'http://'.$_SERVER['SERVER_NAME']);
              }

	}
}
