<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast extends Admin_Controller {

  function __construct() {
      parent::__construct();

      // if(empty($this->session->user_type) || $this->session->logged_in == FALSE){
      //   // save hacker in log
      //   redirect('admin/dashboard');
      //   die;
      // }
  }

  /**
   *
   *
   * @param
   * @return
   */
  public function index()
	{

        $this->load->view('admin/choose_sports_view');

        // $this->load->model('Bet_model');
        // $this->load->model('admin/Forecast_model');
        // $advice['statistic'] = $this->Forecast_model->site_advice_matches();

        $this->load->model('Site_advice_model');

  		  $data['statistic'] = $this->Site_advice_model->site_advice_matches();
        $this->lang->load('kind_sports_lang',$this->session->userdata('language'));
        $this->lang->load('advice_lang',$this->session->userdata('language'));

  			$this->load->helper('kind_sport_cinverter_helper');
        $this->load->helper('odd_type_converter');


        // $data['leagues'] = $this->Bet_model->get_all_leagues();
        // $this->lang->load('advice_lang',$this->session->userdata('language'));
        // $this->load->helper('odd_type_converter');
        // $this->load->view('admin/bet_view',$data);
        $this->load->view('admin/site_advice_view',$data);
	}

  /**
   * ლიგის მატჩების გამოტანა
   *
   * @param
   * @return
   */
   public function sport($sport_id = ''){

     if( !filter_var($sport_id, FILTER_VALIDATE_INT)){
         log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$sport_id.'  function sport() | '.__FILE__.' on line : '.__LINE__);
         show_404();
         die;
     }

     $this->load->model('Bet_model');

       switch ($sport_id) {
         case 1:
           $data['leagues'] = $this->Bet_model->get_football_leagues();
           break;
         case 2:
           $data['leagues'] = $this->Bet_model->get_baseball_leagues();
           break;
         case 3:
           $data['leagues'] = $this->Bet_model->get_basketball_leagues();
           break;
         case 4:
           $data['leagues'] = $this->Bet_model->get_tennis_leagues();
           break;
         case 5:
           $data['leagues'] = $this->Bet_model->get_rugby_leagues();
           break;
         case 6:
           $data['leagues'] = $this->Bet_model->get_hockey_leagues();
           break;
           //  case 7:
           //    $data['leagues'] = $this->Bet_model->get_handball_leagues();
            //
           //    break;
           //  case 8:
           //    $data['leagues'] = $this->Bet_model->get_valleyboll_leagues();
            //
           //    break;
         default:
               log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის (1-8 მდე) ნაცვლად : '.$sport_id.'  function sport() | '.__FILE__.' on line : '.__LINE__);
               show_404();
               die;
           break;
       }
       $data['sport_id'] = $sport_id;
       $this->lang->load('forecast_lang',$this->session->userdata('language'));
       $this->load->view('admin/choose_sports_view');
       $this->load->view('admin/leagues_list_view',$data);
   }

  /**
   * ლიგის მატჩების გამოტანა
   *
   * @param
   * @return
   */
  public function league($sport_id = '',$league_id = '')
  {

        if(!filter_var($sport_id, FILTER_VALIDATE_INT) || !filter_var($league_id, FILTER_VALIDATE_INT)){
            log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$sport_id.' და '.$league_id.'  function league() | '.__FILE__.' on line : '.__LINE__);
            show_404();
            die;
        }

        $this->load->model('Bet_model');

        $this->lang->load('match_lang',$this->session->userdata('language'));
        $this->load->view('admin/choose_sports_view');

        switch ($sport_id) {
          case 1:
            $data['matches'] = $this->Bet_model->get_football_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/football_view',$data);
            break;
          case 2:
            $data['matches'] = $this->Bet_model->get_baseball_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/baseball_view',$data);
            break;
          case 3:
            $data['matches'] = $this->Bet_model->get_basketball_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/basketball_view',$data);
            break;
          case 4:
            $data['matches'] = $this->Bet_model->get_tennis_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/tennis_view',$data);
            break;
          case 5:
            $data['matches'] = $this->Bet_model->get_rugby_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/rugby_view',$data);
            break;
          case 6:
            $data['matches'] = $this->Bet_model->get_hockey_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/hockey_view',$data);
            break;
            // case 7:
            //   $data['matches'] = $this->Bet_model->get_handball_matches($league_id);
            //   $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            //   $this->load->view('admin/matches/handball_view',$data);
            //   break;
            // case 8:
            //   $data['matches'] = $this->Bet_model->get_valleyball_matches($league_id);
            //   $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            //   $this->load->view('admin/matches/valleyboll_view',$data);
            //   break;
          default:
              log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის (1-8 მდე) ნაცვლად : '.$sport_id.' function league() | '.__FILE__.' on line : '.__LINE__);
              show_404();
              die;
            break;
        }
    }



    /**
     * "საიტი გირჩევთ" პროგნოზების წაშლა
     *
     * @param
     * @return
     */
     public function advices_delete(){

       if(!empty($_POST['check_list'])) {
         foreach($_POST['check_list'] as $id) {
              $this->db->where('xml_id', $id);
              $this->db->delete('site_advice_matches');
         }
      }

        redirect('panel/Forecast');
    }

    /**
     * საიტი გირჩევთ" ყველა პროგნოზის წაშლა
     *
     * @param
     * @return
     */
     public function delete_all_advices(){

       $this->db->empty_table('site_advice_matches');
       redirect('panel/Forecast');
    }

    /**
     * მომხმარებლის პროგნოზის წაშლა
     *
     * @param
     * @return
     */
     public function delete_forecast($id = ''){

         if( !filter_var($id, FILTER_VALIDATE_INT)){
             log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$id.'  function delete_forecast() | '.__FILE__.' on line : '.__LINE__);
             show_404();
             return;
         }

        $this->db->where('id', $id);
        $this->db->delete('forecasted_matches');

        if (!empty($_SERVER['HTTP_REFERER'])){
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }else{
            header("Location: ".base_url('panel/managment'));
        }

    }

    


}
