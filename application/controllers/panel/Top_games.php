<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Top_games extends Admin_Controller {

  function __construct() {
      parent::__construct();

  }

  /**
   * გამოაქ ტოპ თამაშების დამატების მოდული და უკვე არჩეული ტოპ თამაშები
   *
   * @param
   * @return
   */
   public function index(){

        //  $this->load->model('admin/Dashboard_model');
        //  $this->load->model('admin/Basketball_model');
        //  $this->Basketball_model->basketball_matches_all_leagues();
        //  if(!$this->Dashboard_model->login()){
        //    return;
        //  }
        $this->load->model('Top_games_model');

        $data['top_games'] = $this->Top_games_model->get_top_games();

        $this->lang->load('advice_lang',$this->session->userdata('language'));
        $this->lang->load('kind_sports_lang',$this->session->userdata('language'));

        $this->load->helper('kind_sport_cinverter_helper');

        $this->load->view('admin/choose_sports_top_games_view');
     		$this->load->view('admin/top_games_view',$data);
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
       $this->load->view('admin/choose_sports_top_games_view');
       $this->load->view('admin/top_games_leagues_list_view',$data);
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
        $this->load->view('admin/choose_sports_top_games_view');
        $data['sport_id'] = $sport_id;

        switch ($sport_id) {
          case 1:
            $data['matches'] = $this->Bet_model->get_football_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/top_games_matches_view',$data);
            break;
          case 2:
            $data['matches'] = $this->Bet_model->get_baseball_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/top_games_matches_view',$data);
            break;
          case 3:
            $data['matches'] = $this->Bet_model->get_basketball_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/top_games_matches_view',$data);
            break;
          case 4:
            $data['matches'] = $this->Bet_model->get_tennis_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/top_games_matches_view',$data);
            break;
          case 5:
            $data['matches'] = $this->Bet_model->get_rugby_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/top_games_matches_view',$data);
            break;
          case 6:
            $data['matches'] = $this->Bet_model->get_hockey_matches($league_id);
            $data['league_name'] = $this->Bet_model->get_league_name($league_id);
            $this->load->view('admin/matches/top_games_matches_view',$data);
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
   * წაშლის არჩეულ ტოპ თამაშებს
   *
   * @param
   * @return
   */
    public function delete_top_games(){

           if(!empty($_POST['check_list'])) {
         foreach($_POST['check_list'] as $id) {
              $this->db->where('xml_id', $id);
              $this->db->delete('top_games');
             }
          }

        redirect('panel/Top_games');
    }


   /**
   * წაშლის ყველა ტოპ თამაშს
   *
   * @param
   * @return
   */
    public function delete_all_top_games(){
        $this->db->empty_table('top_games');
        redirect('panel/Top_games');
    }



}