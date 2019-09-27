<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic extends MY_Controller {

  /**
   * გამოაქ ყველა ტიპსტერი და მათი მცირე სტატისტიკა
   *
   * @param
   * @return array
   */
   public function index(){

     $this->load->library('pagination');
     $this->load->library('table');

     $config['base_url'] = base_url('statistic/index/');
     $config['total_rows'] = $this->db->get('users_statistic')->num_rows();
     $config['per_page'] = 40;
     $config['num_links'] = 20;

     $config['full_tag_open'] = '<nav aria-label=""><ul class="pagination">';
     $config['full_tag_close'] = '</ul></nav>';

     $config['prev_link'] = '&laquo; Previous';
     $config['prev_tag_open'] = ' <li>';
     $config['prev_tag_close'] = '</li>';

     $config['next_link'] = 'Next &rarr;';
     $config['next_tag_open'] = '<li class="next page">';
     $config['next_tag_close'] = '</li>';

     $config['num_tag_open'] = '<li class="page">';
     $config['num_tag_close'] = '</li>';

     $config['last_link'] = 'Last &raquo;';
     $config['last_tag_open'] = '<li class="next page">';
     $config['last_tag_close'] = '</li>';

     $config['cur_tag_open'] = '<li class="active"><a href="#">';
     $config['cur_tag_close'] = ' <span class="sr-only">(current)</span></a></li>';

     $this->pagination->initialize($config);

     $this->db->select('user_id, username, forecoast_count, win, procent_win, lose');
     $this->db->join('users', 'users.id = users_statistic.user_id');
     $this->db->where('user_group = 2');
     $data['users'] = $this->db->get('users_statistic',$config['per_page'],abs( (int) $this->uri->segment(3) ));



     $this->lang->load('statistic_lang',$this->session->userdata('language'));
     $this->load->view('users_statistics_view',$data);

      // $this->load->model('Statistic_model');
      // $data['statistic'] = $this->Statistic_model->get_users_statistics();
      // var_dump($data['users']->result_array() );
      // die;
///////////////////////////////////////////////////////////////////
      // $this->load->model('Statistic_model');
      // $data['statistic'] = $this->Statistic_model->get_all_users_mini_statistic();
      // $this->lang->load('statistic_lang',$this->session->userdata('language'));
      // $this->load->view('user_statistic_view',$data);

   }


}
?>
