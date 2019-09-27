<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leagues extends Admin_Controller {

/**
 *  ლიგების გამოტანა
 *
 * @param
 * @return
 */
  public function index(){

    $this->load->view('admin/kind_of_sports_view');

  }

/**
 *  ლიგების გამოტანა
 *
 * @param
 * @return
 */
 public function sport($sport_id = ''){

   $this->load->model('admin/Leagues_model');


  if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $this->Leagues_model->block_leagues();

  }

  if( !filter_var($sport_id, FILTER_VALIDATE_INT) ){
       log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$sport_id.'  function sport() | '.__FILE__.' on line : '.__LINE__);
       show_404();
       die;
   }
     $data['sport_id'] = $sport_id;


     switch ($sport_id) {
       case 1:
          // football 
         $data['leagues'] = $this->Leagues_model->get_leagues_by_sport(10);
        // $data['leagues'] = $this->Leagues_model->get_football_leagues();

         break;
       case 2:
        // baseball
         $data['leagues'] = $this->Leagues_model->get_leagues_by_sport(14);

         break;
       case 3:
         // baseketball
         $data['leagues'] = $this->Leagues_model->get_leagues_by_sport(15);

         break;
       case 4:
         // tennis
         $data['leagues'] = $this->Leagues_model->get_leagues_by_sport(11);

         break;
       case 5:
          //rugby 
         $data['leagues'] = $this->Leagues_model->get_leagues_by_sport(1003);

         break;
       case 6:
            // hockey
           $data['leagues'] = $this->Leagues_model->get_leagues_by_sport(40);
         break;
       default:
             log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის  1-8 მდეს ნაცვლად : '.$sport_id.'  function sport() | '.__FILE__.' on line : '.__LINE__);
             show_404();
             die;
         break;
     }

     $data['sport_id'] = $sport_id;
     $this->load->view('admin/kind_of_sports_view');
     $this->load->view('admin/list_sport_leagues_view',$data);

  }

}
?>
