<?php

if(ENVIRONMENT == 'production'){
    include_once( 'system/core/Controller.php' );
}

class Admin_Controller extends CI_Controller
{
    function __construct() {
        parent::__construct();
        // log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' ავტორიზებული არ იყო და ცდილობდა ექაუნთში შესვლას| '.__FILE__.' on line : '.__LINE__);
        // echo $this->session->user_id.'<br>';
        // die($this->session->user_type);
        $this->load->library('Languageloader');
        $this->languageloader->set_language();


        $this->load->model('admin/Security_model');
        if(!$this->Security_model->user_identification()){
          // load login model and return
          redirect('panel/login','refresh');
          die();
        }

        /* ლოკალური დროის დაყენება */
        // date_default_timezone_set('Asia/Tbilisi');


        $this->lang->load('admin_menu_lang',$this->session->userdata('language'));

        $this->load->model('admin/Notiflication_model');
        $data['chat_notiesf'] = $this->Notiflication_model->chat_notisfication();

        $this->load->view('admin/managment_menu_view',$data);
    }

}
?>
