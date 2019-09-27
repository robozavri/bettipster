<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Avatar extends CI_Controller {

  function __construct() {
      parent::__construct();
      
      // $user_id = $this->session->userdata('user_id');
      if(empty($this->session->user_id)){
         show_404();
         die();
      }
  }

 /**
   *  მომხმარებლის მიერ ავატარის შეცვლა/დაყენება
   *
   * @param
   * @return
   */
  public function change()
  {   

      if($_SERVER['REQUEST_METHOD'] == 'GET')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function change() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        die;
      }

      $avatar_id = $this->input->post('avatar_id', TRUE);


       if($avatar_id == null){
      		echo json_encode(array('status' => 0, 'message' => $this->lang->line('text_fail_change_avatar')));
        	die;
      }

       if( !filter_var($avatar_id, FILTER_VALIDATE_INT) ){
         log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური რიცხვის ნაცვლად : '.$avatar_id.'  function change() | '.__FILE__.' on line : '.__LINE__);
         show_404();
         die;
     }
     
 		$this->lang->load('ajaxes_lang',$this->session->userdata('language'));

     $result = $this->db->where('avatars_bank_id', abs($avatar_id))->get('avatars_bank');
     			
     	  if( $result->num_rows() == 0)
          {
          	echo json_encode(array('status' => 0, 'message' => $this->lang->line('text_fail_change_avatar')));
                   return false;
          }

     	foreach ($result->result() as $row){

	        $this->db->set('avatar', $row->avatar_name);
			$this->db->where('id', $this->session->user_id);
			$this->db->update('users');
     
		}

   		echo json_encode(array('status' => 1, 'message' => $this->lang->line('text_succsess_change_avatar')));

  }

}
