<?php
if(ENVIRONMENT == 'production'){
    include_once( 'system/core/Controller.php' );
}
class General_Accaunt extends CI_Controller
{
    function __construct() {
        parent::__construct();

        $this->load->library('Languageloader');
        $this->languageloader->set_language();

        /* ლოკალური დროის დაყენება */
        // date_default_timezone_set('Asia/Tbilisi');
        
        $this->load->model('User_model');
        $this->User_model->user_identification();

        // თუ ავტორიზებული მომხმარებელი არ არის მაშინ გადავამისამართოთ
        if(!$this->session->logged_in){
          // show_404();
          // die();
          redirect('welcome','refresh');
        }


       if($this->session->userdata('logged_in')){

           $this->load->model('Notiflication_model');
           $this->load->model('User_model');
           $this->load->model('Admin_declaration_model');

           $data['admin_message'] = $this->Admin_declaration_model->show_message();
           $data['user_mini_info'] = $this->User_model->get_user_mini_info($this->session->user_id);
           $data['chat_notiesf'] = $this->Notiflication_model->chat_notisfication();
           
           $this->lang->load('menu_lang',$this->session->userdata('language'));
           $this->load->view('private_menu_view',$data);

         }else{
            redirect('welcome');
         }

    }


}
?>
