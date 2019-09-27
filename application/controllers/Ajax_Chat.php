<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Chat extends CI_Controller {

  function __construct() {
      parent::__construct();
      
      // $user_id = $this->session->userdata('user_id');
      if(empty($this->session->user_id)){
         show_404();
         die;
      }
  }


/**
 * ajax ჩათის შტყობინების მონაცემების მიღება
 *
 * @param int
 * @return
 */
 public function send(){

     if($_SERVER['REQUEST_METHOD'] != 'POST')
     {
       log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function send() | '.__FILE__.' on line : '.__LINE__);
       show_404();
       die;
     }
      $jsonMessage = array();
  
     $this->load->model('Chat_model');
     $this->lang->load('chat_lang',$this->session->userdata('language'));


     if($this->Chat_model->save_user_message()){
        $jsonMessage['is_blocked'] = 1;
        $jsonMessage['message'] = '';
      
     }else{
        $jsonMessage['is_blocked'] = 0;
        $jsonMessage['message'] = $this->lang->line('text_you_are_blocked');
     }
       echo json_encode($jsonMessage);
 }

 /**
  * ajax ჩათისთვის რომელიმე კონკრეტული მომხმარებლის შეტყობინებების გამოტანა
  * მომხმარებლის id ის მიხედვით
  *
  * @param int
  * @return
  */
  public function get_messages(){

      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function  get_messages() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        die;
      }

      $this->load->model('Chat_model');
      $data['messages'] = $this->Chat_model->get_ajax_messages();

      $this->lang->load('chat_lang',$this->session->userdata('language'));
      $this->load->helper('time_converter_helper');

      $this->load->view('ajax_chat__messagse_view',$data);
  }

 /**
  * პატარა მინი ajax ჩათისთვის რომელიმე კონკრეტული მომხმარებლის შეტყობინებების გამოტანა
  * მომხმარებლის id ის მიხედვით
  *
  * @param 
  * @return
  */
  public function get_mini_chat_messages(){

      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function  get_messages() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        die;
      }

      $this->load->model('Chat_model');
      $data['messages'] = $this->Chat_model->get_ajax_messages();

      $this->lang->load('chat_lang',$this->session->userdata('language'));
      $this->load->helper('time_converter_helper');

      $this->load->view('ajax_mini_chat__messagse_view',$data);
  }


 /**
  * მომხმარებლის დაბლოკვა რათა არ მისწეროს ის ვინც დაბლოკა
  *
  * @param 
  * @return
  */
  public function block_user(){

      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function  block_user() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        die;
      }

        $this->load->model('Chat_model');
        $this->lang->load('chat_lang',$this->session->userdata('language'));

        if($this->Chat_model->block_user_db()){
            echo $this->lang->line('text_blocked_succesfuly');
        }else{
            echo $this->lang->line('text_was_blocked');
        }


  } 


 /**
  * მომხმარებლის სმაპერად მონისვნა
  *
  * @param 
  * @return
  */
  public function mark_as_spam(){

      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function  mark_as_spam() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        die;
      }

        $this->load->model('Chat_model');
        $this->lang->load('chat_lang',$this->session->userdata('language'));

        if($this->Chat_model->marck_user_as_spam()){
            echo $this->lang->line('text_marked_spam');
        }


  }

}
?>
