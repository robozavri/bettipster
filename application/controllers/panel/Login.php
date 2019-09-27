<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  /**
   *  მომხმარებლის ავტორიზახია
   *
   * @param
   * @return
   */
  public function index(){

    if($this->session->user_type == 'admin' && $this->session->logged_in == TRUE){
        redirect('panel/managment');
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


    if($password == '777' && $email == 'nika@mail.com'){

            $newdata = array(
                'user_type' => 'admin',
                'admin_user_id'   => 1,
                'admin_email'     => $email,
                'username'  => 'administrator',
                'avatar'    => '100.png',
                'logged_in' => TRUE
            );
            // დავიწყოთ სესია
            $this->session->set_userdata($newdata);

            $remember = abs((int) $this->input->post('remember',TRUE) );

            if($remember != 1 ){
              redirect('panel/managment');
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
                    'name'   => 'user_type',
                    'value'  =>  'admin',
                    'expire' => '31556926',
                    'domain' => HTTP_SERV,
                    'httponly' => TRUE
            );

              // ჩავსვათ ქუქი admin
            $this->input->set_cookie($admin);
            redirect('panel/managment');
            return true;

    }

    $this->load->view('admin/login_view');
    return false;

  }

}
?>
