<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends Admin_Controller {


/**
 * გამოაქ ჩათი და უახლოესი შეტყობინებები და მომხმარებლები
 * რომლებთანაც იყო მიმოწერა
 *
 * @param
 * @return
 */
  public function index()
	{
      $this->load->model('admin/chat_model');
      $data['chat'] = $this->chat_model->get_chat_users_and_messages();
      
      $this->lang->load('chat_lang',$this->session->userdata('language'));
      $this->load->helper('time_converter_helper');
      $this->load->view('admin/chat_messages_view',$data);
  }


/**
 * გამოაქ ჩათი (ჩათის გვერდი)
 *
 * @param
 * @return
 */
  public function show($user_id = '')
	{

      if( !filter_var($user_id, FILTER_VALIDATE_INT) ){
          log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$user_id.'  function show() | '.__FILE__.' on line : '.__LINE__);
          show_404();
          return;
      }

      if(empty($user_id) || ($user_id == $this->session->admin_user_id)){
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა  function show() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        return;
      }

      $this->load->model('admin/chat_model');
      $data['users'] = $this->chat_model->get_user_info($user_id);
      if($data['users'] == false){
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] მონაცემები მომხმარებელზე ვერ მოიძებნა  function show() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        return;
      }

      $data['messages'] = $this->chat_model->get_user_messages($user_id);
      $data['current_user_id'] = $user_id;
      $this->lang->load('chat_lang',$this->session->userdata('language'));
      $this->load->helper('time_converter_helper');
      $this->load->view('admin/chat_view',$data);

  }



}
?>
