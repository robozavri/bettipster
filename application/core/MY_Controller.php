<?php
if(ENVIRONMENT == 'production'){
    include_once( 'system/core/Controller.php' );
}
class MY_Controller extends CI_Controller
{
    function __construct() {
        parent::__construct();
        // echo $this->session->user_id.'<br>';
        // die($this->session->user_type);
        /* განვსაზღვროთ საიტის ენა */
        $this->load->library('Languageloader');
    		$this->languageloader->set_language();

        /* ლოკალური დროის დაყენება */
        // date_default_timezone_set('Asia/Tbilisi');

        /* მომხმარებლის იდენთიფიკაცია */
        $this->load->model('User_model');
        $this->User_model->user_identification();

        /* მენიუს გამოტანა */

          $this->lang->load('menu_lang',$this->session->userdata('language'));
          
         if($this->session->userdata('logged_in')){

           $this->load->model('Notiflication_model');
           $this->load->model('User_model');
           $this->load->model('Admin_declaration_model');

           $data['admin_message'] = $this->Admin_declaration_model->show_message();
           $data['chat_notiesf'] = $this->Notiflication_model->chat_notisfication();

           $data['user_mini_info'] = $this->User_model->get_user_mini_info($this->session->user_id);

           $this->load->view('private_menu_view',$data);

         }else{
            $this->load->view('menu_view');
         }



        /* მარცხნივ სამი სტატისტიკის გამოტანა 10-20, 20 ზე მეტი და 100% იანი შედეგები */
        // $this->load->model('Statistic_model');

        // $data['raiting_10_to_20'] = $this->Statistic_model->get_statistic_football_10_to_20();
        // $data['raiting_over_20'] = $this->Statistic_model->get_statistic_football_over_20();
        // $data['raiting_100'] = $this->Statistic_model->get_statistic_football_raiting_100();

        // $this->lang->load('statistic_lang',$this->session->userdata('language'));
        // $this->load->view('aside_statistics_view',$data);
    }


}
?>
