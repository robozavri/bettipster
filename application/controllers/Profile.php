<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {


  /**
   * გამოაქ კონკრეტული მომხმარებლის პროფილი სხვა მომხმარებლისთვის id ის მიხედვით
   *
   * @param
   * @return
   */
    public function show($user_id = ''){

      if( !filter_var($user_id, FILTER_VALIDATE_INT) ){

            log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$user_id.' function show() | '.__FILE__.' on line : '.__LINE__);
            show_404();
            return;

        }

        $users['for_user_id'] = $user_id;
        $users['follower_id'] = $this->session->userdata('user_id');

        $this->load->model('Profile_model');
        $this->load->model('Statistic_model');

        // $data['statistic'] = $this->Profile_model->get_user_statistic($user_id);
        $data['statistic']['matches'] = $this->Profile_model->get_user_matches($user_id);

        $data['statistic']['statistic_mini'] = $this->Statistic_model->particular_user_mini_statistic($user_id);

        $data['user'] = $this->Profile_model->get_user_info($user_id);

        $this->load->model('Follow_model');
        if($this->Follow_model->check_is_follow($users)){
            $data['is_follow'] = true;
        }else{
            $data['is_follow'] = false;
        }

        $data['user_id'] = $user_id;
        // ჩავტვირთოთ ენის ფაილი
        $this->lang->load('profile_lang',$this->session->userdata('language'));
        $this->lang->load('kind_sports_lang',$this->session->userdata('language'));

        $this->load->helper('odd_type_converter');
        $this->load->helper('kind_sport_cinverter_helper');

        $this->load->view('banners/left_banners_view');
        $this->load->view('profile_view',$data);
        $this->load->view('banners/right_banners_view');
        $this->load->view('mini_chat_view');

    }

}
?>
