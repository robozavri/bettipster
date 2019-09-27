<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Chat extends CI_Controller {

  function __construct() {
      parent::__construct();

      $this->load->model('admin/Dashboard_model');
      if(!$this->Dashboard_model->user_identification()){
        redirect('panel/login','refresh');
        die;
      }
      // $user_id = $this->session->userdata('user_id');
      if(empty($this->session->user_type)){
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
       log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function send() | '.__FILE__.' on line : '.__LINE__);
       show_404();
       return;
     }

     $this->load->model('admin/Chat_model');
     $this->Chat_model->save_user_message();
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
         die;
       }

       $this->load->model('admin/Chat_model');
       $data['messages'] = $this->Chat_model->get_ajax_messages();

       $this->lang->load('chat_lang',$this->session->userdata('language'));
       $this->load->helper('time_converter_helper');

       $this->load->view('ajax_chat__messagse_view',$data);
   }

  /**
   * პატარა მინი ajax ჩათისთვის რომელიმე კონკრეტული მომხმარებლის შეტყობინებების გამოტანა
   * მომხმარებლის id ის მიხედვით
   *
   * @param int
   * @return
   */
   public function get_mini_chat_messages(){

       if($_SERVER['REQUEST_METHOD'] != 'POST')
       {
         log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function  get_messages() | '.__FILE__.' on line : '.__LINE__);
         die;
       }

       $this->load->model('admin/Chat_model');
       $data['messages'] = $this->Chat_model->get_ajax_messages();

       $this->lang->load('chat_lang',$this->session->userdata('language'));
       $this->load->helper('time_converter_helper');

       $this->load->view('ajax_mini_chat__messagse_view',$data);
   }

}
?>
