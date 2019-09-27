<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_top_games extends CI_Controller {

    function __construct() {
        parent::__construct();

        // $user_id = $this->session->userdata('user_id');
        if(empty($this->session->user_type) || $this->session->user_type != 'admin' ){
          // save hacker in log
          die;
        }
    }


    /**
     * ტოპ თამაშების შენახვა
     *
     * @param
     * @return
     */
    public function to_forecast($sport_id = '')
  	{

        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
          log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function to_forecast() | '.__FILE__.' on line : '.__LINE__);
          show_404();
          return;
        }


        if( !filter_var($sport_id, FILTER_VALIDATE_INT) ){
            log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა to_forecast($sport_id) (1-8 მდე გადაეცემა)| '.__FILE__.' on line : '.__LINE__);
            die();
        }

        $user_type = $this->session->userdata('user_type');
        if(empty($user_type)){
          die;
        }

        // date_default_timezone_set ('Asia/Tbilisi');


          // ჩავტვირთოთ ენის ფაილი
          $this->lang->load('match_lang',$this->session->userdata('language'));

          $this->load->model('admin/Top_games_model');
          $this->Top_games_model->save_top_games($sport_id);

       

  	}



}
