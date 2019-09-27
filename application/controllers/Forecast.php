<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast extends Forecoast_Controller {

  function __construct() {
      parent::__construct();


  }

/**
 *
 *
 * @param
 * @return
 */
  public function index()
	{
  // $this->lang->load('registration', $this->session->userdata('language'));
     //load_lang();
    // $oops = $this->lang->line('message_key');
    /* საიტი გირჩევთ ვიჯეტის გამოტანა */
        $this->load->model('Top_games_model');
        $data['top_games'] = $this->Top_games_model->get_top_games();

        $this->load->helper('odd_type_converter');
        $this->load->helper('kind_sport_cinverter_helper');
        
        $this->lang->load('advice_lang', $this->session->userdata('language'));
        $this->lang->load('kind_sports_lang', $this->session->userdata('language'));
        $this->lang->load('statistic_lang',$this->session->userdata('language'));

        $this->load->view('main_slider_view');
        $this->load->view('choose_sports_view');
        $this->load->view('banners/left_banners_view');
        $this->load->view('top_games_view', $data);
        $this->load->view('ticket_view');

	}

  /**
   * ლიგის მატჩების გამოტანა
   *
   * @param
   * @return
   */
   public function sport($sport_id = ''){

    if( !filter_var($sport_id, FILTER_VALIDATE_INT) ){
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
          default:
               log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის  1-8 მდეს ნაცვლად : '.$sport_id.'  function sport() | '.__FILE__.' on line : '.__LINE__);
               show_404();
               die;
           break;
       }

       $this->lang->load('forecast_lang',$this->session->userdata('language'));
       $this->lang->load('kind_sports_lang', $this->session->userdata('language'));
       $this->load->helper('kind_sport_cinverter_helper');

       $data['sport_id'] = $sport_id;
              
       $this->load->view('main_slider_view');
       $this->load->view('choose_sports_view');
       $this->load->view('banners/left_banners_view');
       $this->load->view('leagues_list_view',$data);
       $this->load->view('banners/right_banners_view');
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
          $this->load->model('User_model');
          $users_row = $this->User_model->get_user_all_info();

           // ბოლოს დადებული პროგნოზის დრო
          $date1 = new DateTime($users_row[0]['bet_limit_date']);
          // ამჟამინდელი დრო
          $date2 = new DateTime();
           $data['bet_limit'] = $users_row[0]['bet_limit'];
          // შევამოწმოთ რამდენი აქ დადებული და როდის. რათა მივცეთ უფლება რო დადოს
          // და შეტყობინება დააგენერიროს javascript-მა
          if(($users_row[0]['bet_limit'] == 2 ) && $date1->format('d') != $date2->format('d')){
              $data['bet_limit'] = 0;
          }

          $this->lang->load('kind_sports_lang', $this->session->userdata('language'));
          $this->load->helper('kind_sport_cinverter_helper');
          $data['sport_id'] = $sport_id;

          $this->lang->load('match_lang',$this->session->userdata('language'));
          $this->load->view('main_slider_view');
          $this->load->view('choose_sports_view');
          $this->load->view('banners/left_banners_view');

          switch ($sport_id) {
            case 1:
              $data['matches'] = $this->Bet_model->get_football_matches($league_id);
              $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              $this->load->view('matches/football_view',$data);
              break;
            case 2:
              $data['matches'] = $this->Bet_model->get_baseball_matches($league_id);
              $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              $this->load->view('matches/baseball_view',$data);
              break;
            case 3:
              $data['matches'] = $this->Bet_model->get_basketball_matches($league_id);
              $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              $this->load->view('matches/basketball_view',$data);
              break;
            case 4:
              $data['matches'] = $this->Bet_model->get_tennis_matches($league_id);
              $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              $this->load->view('matches/tennis_view',$data);
              break;
            case 5:
              $data['matches'] = $this->Bet_model->get_rugby_matches($league_id);
              $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              $this->load->view('matches/rugby_view',$data);
              break;
            case 6:
              $data['matches'] = $this->Bet_model->get_hockey_matches($league_id);
              $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              $this->load->view('matches/hockey_view',$data);
              break;
              // case 7:
              //   $data['matches'] = $this->Bet_model->get_handball_matches($league_id);
              //   $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              //   $this->load->view('matches/handball_view',$data);
              //   break;
              // case 8:
              //   $data['matches'] = $this->Bet_model->get_valleyball_matches($league_id);
              //   $data['league_name'] = $this->Bet_model->get_league_name($league_id);
              //   $this->load->view('matches/valleyboll_view',$data);
              //   break;

            default:
                log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის (1-8 მდე) ნაცვლად : '.$sport_id.' function league() | '.__FILE__.' on line : '.__LINE__);
                show_404();
                die;
              break;
          }

            $this->load->view('ticket_view');

      // }
    }
}
