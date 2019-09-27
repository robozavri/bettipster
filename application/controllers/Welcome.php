<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


 /**
	*
	*
	* @param
	* @return
	*/
	public function index()
	{
						// echo $this->session->logged_in;
						// echo $this->session->user_type;
		    $this->load->model('Statistic_model');

	        $data['raiting_10_to_20'] = $this->Statistic_model->get_statistic_football_10_to_20();
	        
	        // var_dump($data['raiting_10_to_20']);die;

	        $data['raiting_over_20'] = $this->Statistic_model->get_statistic_football_over_20();
	        $data['raiting_100'] = $this->Statistic_model->get_statistic_football_raiting_100();

			$this->lang->load('welcome_lang', $this->session->userdata('language'));
	        $this->lang->load('statistic_lang',$this->session->userdata('language'));
			$this->lang->load('advice_lang', $this->session->userdata('language'));
			$this->lang->load('kind_sports_lang', $this->session->userdata('language'));

	        $this->load->view('main_slider_view');
	        $this->load->view('top_advise_title_view');

	        $this->load->view('aside_statistics_view',$data);

					
			/* საიტი გირჩევთ ვიჯეტის გამოტანა */
		    $this->load->model('Site_advice_model');
		    $this->load->model('Forecasts/Forecast_model');
			$last_forecasts['last_forecasts'] = $this->Forecast_model->get_last_forecasts();

		    $data['statistic'] = $this->Site_advice_model->site_advice_matches();
			$this->load->model('Statistic_model');
			$top_5['top_5'] = $this->Statistic_model->get_top_5_typsters();
			
			$this->load->helper('odd_type_converter');
			$this->load->helper('kind_sport_cinverter_helper');

			$this->load->view('site_advice_view', $data);
			$this->load->view('top_5_view', $top_5);
			$this->load->view('last_forecasts_view', $last_forecasts);
			$this->load->view('banners/my_baners_view');
	}



   /**
	* წარმატებული რეგისტრაციის შესახებ გვერდის ჩვენება
	*
	* @param
	* @return
	*/
	public function registration(){
 
 		$this->load->model('Statistic_model');

        $data['raiting_10_to_20'] = $this->Statistic_model->get_statistic_football_10_to_20();
        $data['raiting_over_20'] = $this->Statistic_model->get_statistic_football_over_20();
        $data['raiting_100'] = $this->Statistic_model->get_statistic_football_raiting_100();
	        
		 $this->lang->load('welcome_lang', $this->session->userdata('language'));
	 	 $this->lang->load('statistic_lang',$this->session->userdata('language'));

	     $this->load->view('main_slider_view');

	     $this->load->view('aside_statistics_view',$data);
		 $this->load->view('succes_registration_view');
		 $this->load->view('banners/my_baners_view');

	}


   /**
	* ექაუნთის წარმატებულად გააქტიურების შესახებ
	* გვერდის ჩვენება
	* @param
	* @return
	*/
	public function activation(){
 
 		$this->load->model('Statistic_model');

        $data['raiting_10_to_20'] = $this->Statistic_model->get_statistic_football_10_to_20();
        $data['raiting_over_20'] = $this->Statistic_model->get_statistic_football_over_20();
        $data['raiting_100'] = $this->Statistic_model->get_statistic_football_raiting_100();
	        
		 $this->lang->load('welcome_lang', $this->session->userdata('language'));
	 	 $this->lang->load('statistic_lang',$this->session->userdata('language'));

	     $this->load->view('main_slider_view');

	     $this->load->view('aside_statistics_view',$data);
		 $this->load->view('success_accaunt_activeation_view');
		 $this->load->view('banners/my_baners_view');

	}


   /**
	* პაროლის წარმატებით აღდგენის შესახებ
	* გვერდის ჩვენება
	* @param
	* @return
	*/
	public function reseted($status = null){
 
 		$this->load->model('Statistic_model');

        $data['raiting_10_to_20'] = $this->Statistic_model->get_statistic_football_10_to_20();
        $data['raiting_over_20'] = $this->Statistic_model->get_statistic_football_over_20();
        $data['raiting_100'] = $this->Statistic_model->get_statistic_football_raiting_100();
	        
		 $this->lang->load('welcome_lang', $this->session->userdata('language'));
	 	 $this->lang->load('statistic_lang',$this->session->userdata('language'));

	     $this->load->view('main_slider_view');

	     $this->load->view('aside_statistics_view',$data);
	     
	     if($status == 1){
	     		$this->load->view('pasword_success_was_reseted_view');
	
	     }else{
	     		 $this->load->view('pasword_success_reset_view');

	     }
		 $this->load->view('banners/my_baners_view');

	}
}
