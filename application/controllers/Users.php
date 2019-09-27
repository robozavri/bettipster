<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

 /**
	* ყველა მომხმარებლის გამოტანა
	*
	* @param
	* @return
	*/
  public function index(){

      $this->load->model('User_model');
      // $data['users'] = $this->User_model->get_all_users();
      $this->lang->load('user_lang',$this->session->userdata('language'));

      $this->load->library('pagination');
      $this->load->library('table');

      $config['base_url'] = base_url('users/index/');
      $config['total_rows'] = $this->db->get('users')->num_rows();
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

      $config['cur_tag_open'] = '<li class="active pgn-active"><a href="#">';
      $config['cur_tag_close'] = ' <span class="sr-only">(current)</span></a></li>';

      $this->pagination->initialize($config);
      $this->db->select('id,username,regist_date');
      //$this->db->where('user_group = 2');
      $data['users'] = $this->db->get('users',$config['per_page'],abs( (int) $this->uri->segment(3) ));

      $this->load->view('banners/left_banners_view');
      $this->load->view('users_view',$data);
      $this->load->view('banners/my_baners_view');

  }

 /**
    * მომხმარებლების ანბანის მიხედვით გმაოტანა
    *
    * @param integer
    * @return array
    */
    public function sort($sort_value = ''){

// die($this->uri->segment(5));
          if(!ctype_alpha($sort_value)){
              log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ლათინური ანბანის ასოების ნაცვლად გადასცა : '.$sort_value.'  function sort() | '.__FILE__.' on line : '.__LINE__);
              show_404();
              die();
          }

          // if((int) $pagin_val <= 0){
          //     log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$pagin_val.'  function sort() | '.__FILE__.' on line : '.__LINE__);
          //     show_404();
          //     die;
          // }

         $sql = "SELECT count(*) as users_count FROM users WHERE username LIKE '".$sort_value."%'  ";
         $num_rows_query = $this->db->query($sql);
        //  var_dump($num_rows_query->row('users_count'));die;
         $config['num_links'] = 20;

         $config['per_page'] = 40;
         /*
         if( (int) $this->uri->segment(5) <= 0){
          //  die('სეგმენტი არ მოსულა ან არავალიდურია');
           $sql = "SELECT * FROM users WHERE username LIKE '".$sort_value."%' ORDER BY username ASC LIMIT ".$config['per_page']." ";
         }else{
          //  die('სეგმენტი ვალიდურია');
           $sql = "SELECT * FROM users WHERE username LIKE '".$sort_value."%' ORDER BY username ASC LIMIT ".$config['per_page'].",".$this->uri->segment(5)."";
         }

         $query = $this->db->query($sql);
         */
        $query = $this->db->select('id,username,regist_date')->where("username LIKE '$sort_value%'")->get('users',$config['per_page'],abs( (int) $this->uri->segment(5) ));

         $data['users'] = $query;
         $this->load->library('pagination');
         $this->load->library('table');

         $config['base_url'] = base_url('users/sort/'.$sort_value);
         $config['total_rows'] = $num_rows_query->row('users_count');

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

         $this->lang->load('user_lang',$this->session->userdata('language'));

         $this->load->view('banners/left_banners_view');
         $this->load->view('sorted_users_view',$data);
         $this->load->view('banners/my_baners_view');
        

    }

  /*
   * მომხმარებლის ავატარის წაშლა
   *
   * @param integer
   * @return

   public function delete_avatar($user_id = ''){

       if( !filter_var($user_id, FILTER_VALIDATE_INT)){
          log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$user_id.'  function edit() | '.__FILE__.' on line : '.__LINE__);
          show_404();
          return;
       }

       $this->load->model('User_model');
       $this->User_model->delete_user_avatar($user_id);

       if (!empty($_SERVER['HTTP_REFERER'])){
           header("Location: ".$_SERVER['HTTP_REFERER']);
       }else{
           header("Location: ".base_url('admin/users'));
           // header("Location: ".'http://'.$_SERVER['SERVER_NAME']);
       }

   }
      */

}
?>
