<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Captcha_model extends CI_Model {

  /*
   * ქაპჩის სურათის დაგენერირება და დაბრუნება
   *
   * @param () file  image  gif|jpg|png|jpeg
   * @return (string) image_path
   */
    public function captcha_create()
    {
            $this->load->helper('captcha');

             $vals = array(
//                'word'		=> 'bambamia',
                'img_path' => './uploads/captcha/',
                'img_url' => base_url().'uploads/captcha/',
              //  'font_path' => base_url().'system/fonts/comic.ttf',
                'font_path' => base_url().'system/fonts/glyphicons-halflings-regular.ttf',
                'img_width'     => 150,
                'img_height'    => 35,
                'font_size'	    => 20,
                'expiration'    => 300,
                'word_length'   => 4,
                'img_id'        => 'Imageid',
                'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

                // White background and border, black text and red grid
                'colors'  => array(
                         			'background'	=> array(255,255,255),
                                    'border'	=> array(153,102,102),
                                    'text'		=> array(104,153,153),
                                    'grid'		=> array(255,182,182)
                                     )
            );

            $cap = create_captcha($vals);
            $this->session->set_userdata('chaptcha_word', $cap['word']);
            return $cap['image'];
    }


  /*
   * ქაპჩის მნიშვნელობის შემოწმება ნამდვილობაზე
   *
   * @param () file  image  gif|jpg|png|jpeg
   * @return (string) image_path
   */
    public function captcha_check($value = '')
    {
             if(empty($value)){
                 return;
             }else{
                     // Case comparing values.
                    if (strcasecmp($_SESSION['chaptcha_word'], $value) == 0) {
                        return true;
                    }else{
                        return false;
                    }
                }
    }
}
?>
