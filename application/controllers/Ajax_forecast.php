<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_forecast extends CI_Controller {

  function __construct() {
      parent::__construct();

      // $user_id = $this->session->userdata('user_id');
      if(empty($this->session->user_id)){
        // save hacker in log
         show_404();
        die;
      }
  }


    /**
     * მატჩის პროგნოზების გაკეთება
     *
     * @param
     * @return
     */
    public function to_forecast($sport_id = '')
  	{

        if( $_SERVER['REQUEST_METHOD'] != 'POST' )
        {
            log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function to_forecast() | '.__FILE__.' on line : '.__LINE__);
            show_404();
            die;
        }


        if( !filter_var($sport_id, FILTER_VALIDATE_INT) ){
            log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა to_forecast($sport_id) (1-8 მდე გადაეცემა)| '.__FILE__.' on line : '.__LINE__);
            die('die');
        }

        switch ($sport_id) {
          case 1:
          $this->load->model('Forecasts/Forecast_football_model');
          $this->Forecast_football_model->to_forecast_football();
            break;
          case 2:
          $this->load->model('Forecasts/Forecast_baseball_model');
          $this->Forecast_baseball_model->to_baseball();
            break;
          case 3:
          $this->load->model('Forecasts/Forecast_basketball_model');
          $this->Forecast_basketball_model->to_basketball();
            break;
          case 4:
          $this->load->model('Forecasts/Forecast_tennis_model');
          $this->Forecast_tennis_model->to_forecast_tennis();
            break;
          case 5:
          $this->load->model('Forecasts/Forecast_rugby_model');
          $this->Forecast_rugby_model->to_forecast_rugby();
            break;
          case 6:
          $this->load->model('Forecasts/Forecast_hockey_model');
          $this->Forecast_hockey_model->to_forecast_hockey();
            break;
            // case 7:
            // $this->load->model('Forecasts/Forecast_handball_model');
            // $this->Forecast_handball_model->to_forecast_handball();
            //   break;
            // case 8:
            // $this->load->model('Forecasts/Forecast_Volleyball_model');
            // $this->Forecast_Volleyball_model->to_forecast_Volleyball();
            //   break;
          default:
                log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური რიცხვი გადასცა to_forecast($sport_id) (1-8 მდე გადაეცემა)| '.__FILE__.' on line : '.__LINE__);
                die;
            break;
        }


  	}



}
