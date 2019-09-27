<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Average extends Admin_Controller {

  function __construct() {
      parent::__construct();

  }

  /**
   * დაითვლის სამი კატეგორიის ტიპსტერების საშვალო კუშების არითმეტიკულს
   * სტატისტიკიებიდან 10-20, 20 ზე მეტის და 100% სტაისტიკებიდან
   * @param
   * @return
   */
   public function index(){

     
        $this->load->model('admin/Average_model');

        $data['average_10_to_20'] = $this->Average_model->get_average_10_to_20();
        $data['average_100'] = $this->Average_model->get_average_100();
        $data['average_over_20'] = $this->Average_model->get_average_over_20();

     		$this->load->view('admin/Averages_view',$data);
   }


 



}