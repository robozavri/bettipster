<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Admin_Controller {
  function __construct() {
      parent::__construct();

  }
  public function index(){

            redirect('panel/Managment');
            return true;

  }
  /**
   *  მომხმარებლის ავტორიზახია
   *
   * @param
   * @return
   */
  public function login(){

    if($this->session->logged_in && !empty($this->session->user_type)){
        return true;
    }
    // elseif(!empty($this->input->cookie('admin', TRUE))){
    //
    //       $newdata = array(
    //           'user_type'   => 'admin',
    //           'user_id'   => 1,
    //           'email'     => 'nika@mail.com',
    //           // 'username'  => $row->username,
    //           // 'avatar'    => $row->avatar,
    //           'logged_in' => TRUE
    //       );
    //       // დავიწყოთ სესია
    //       $this->session->set_userdata($newdata);
    //
    // }

    $password = $this->db->escape_str(strip_tags($this->input->post('password',TRUE)));
    $email    = $this->db->escape_str(strip_tags($this->input->post('email',TRUE)));
    // die($password.'   aq moved  i   '.$email);
    $this->lang->load('registration_lang',$this->session->userdata('language'));

    $this->load->library('form_validation');
    $this->form_validation->set_rules('password', 'password',
    'required|min_length[3]|max_length[20]',
    array('required' => $this->lang->line('text_required'),'min_length' => $this->lang->line('text_min_length'),
    'max_length'=> $this->lang->line('text_max_length')));

    if ($this->form_validation->run() == FALSE){
      //  echo json_encode(array('status' => 0, 'message' => validation_errors()));
       $this->load->view('admin/login_view');
       return false;
    }
    if($password == '666' && $email == 'nika@mail.com'){

            $newdata = array(
                'user_type'   => 'admin',
                // 'user_id'   => 1,
                'email'     => $email,
                // 'username'  => $row->username,
                // 'avatar'    => $row->avatar,
                'logged_in' => TRUE
            );
            // დავიწყოთ სესია
            $this->session->set_userdata($newdata);

            $remember = abs((int) $this->input->post('remember',TRUE) );

            if($remember != 1 ){
              redirect('panel/Managment');
              return true;
            }

            // $cookie_email = array(
            //         'name'   => 'email',
            //         'value'  =>  $email,
            //         'expire' => '31556926',
            //         'domain' => HTTP_SERV
            // );
            // // ჩავსვათ ქუქი email
            // $this->input->set_cookie($cookie_email);

            // $cookie_password = array(
            //         'name'   => 'password',
            //         'value'  =>  base64_encode($password),
            //         'expire' => '31556926',
            //         'domain' => HTTP_SERV
            // );
            //
            //   // ჩავსვათ ქუქი password
            // $this->input->set_cookie($cookie_password);

            // $user_id = array(
            //         'name'   => 'user_id',
            //         'value'  =>  1,
            //         'expire' => '31556926',
            //         'domain' => HTTP_SERV
            // );
            //
            //   // ჩავსვათ ქუქი userid
            // $this->input->set_cookie($user_id);

            // ჩავსვათ ქუქი admin
            $admin = array(
                    'name'   => 'admin',
                    'value'  =>  166645,
                    'expire' => '31556926',
                    'domain' => HTTP_SERV
            );

              // ჩავსვათ ქუქი admin
            $this->input->set_cookie($admin);
            redirect('panel/Managment');
            return true;

    }
    $this->load->view('admin/login_view');
    return false;

  }




}
