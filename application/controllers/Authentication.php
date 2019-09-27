<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

  /**
   * ქაპჩას აგენერირებს (აიაქსისთვის)
   *
   * @param
   * @return
   */
  public function generate_captcha()
  {
      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' POST ის ნაცვლად GET ით გამოიძახა  function generate_captcha() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        return;
      }

      $this->load->model('Captcha_model');
      $captcha_value = $this->Captcha_model->captcha_create();
      echo $captcha_value;
  }


  /**
   * ამოწმებს აიაქსით პოსტით მოსულ captcha მონაცემს
   *
   * @param
   * @return
   */
    public function captcha()
    {

      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' POST ის ნაცვლად GET ით გამოიძახა  function captcha() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        return;
      }

      $this->lang->load('registration_lang',$this->session->userdata('language'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('captcha', 'captcha',
      'required|exact_length[4]',
      array('required' => $this->lang->line('text_required')));

      if ($this->form_validation->run() == FALSE)
      {
         echo json_encode(array('status' => 0, 'message' => validation_errors()));
      }else{

          $this->load->model('Captcha_model');
          $captcha_value = $this->Captcha_model->captcha_check(strip_tags($this->input->post('captcha',TRUE)));
          // თუ ქაფჩა სწორია
          if($captcha_value){
              echo json_encode(array('status' => 1));
          }else{
             echo json_encode(array('status' => 0, 'message' => $this->lang->line('text_captcha')));
          }

      }

    }

/**
 * ამოწმებს აიაქსით პოსტით მოსულ username მონაცემს
 *
 * @param
 * @return
 */
  public function username()
  {

    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
      log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' POST ის ნაცვლად GET ით გამოიძახა  function username() | '.__FILE__.' on line : '.__LINE__);
      show_404();
      return;
    }

    $this->lang->load('registration_lang',$this->session->userdata('language'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'username',
    'required|min_length[3]|max_length[20]|is_unique[users.username]',
    array('required' => $this->lang->line('text_required'),'is_unique' => $this->lang->line('text_is_unique'),
    'min_length' => $this->lang->line('text_min_length'),'max_length'=> $this->lang->line('text_max_length')));

    if ($this->form_validation->run() == FALSE){
       echo json_encode(array('status' => 0, 'message' => validation_errors()));
    }else{
       echo json_encode(array('status' => 1));
    }

  }


    /**
     * ამოწმებს აიაქსით პოსტით მოსულ password მონაცემს
     *
     * @param
     * @return
     */
    public function password()
    {

      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' POST ის ნაცვლად GET ით გამოიძახა  function password() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        return;
      }

      $this->lang->load('registration_lang',$this->session->userdata('language'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('password', 'password',
      'required|min_length[3]|max_length[20]',
      array('required' => $this->lang->line('text_required'),'min_length' => $this->lang->line('text_min_length'),
      'max_length'=> $this->lang->line('text_max_length')));

      if ($this->form_validation->run() == FALSE){
         echo json_encode(array('status' => 0, 'message' => validation_errors()));
      }else{
         echo json_encode(array('status' => 1));
      }

    }

    /**
     * ამოწმებს აიაქსით პოსტით მოსულ retypassword მონაცემს
     *
     * @param
     * @return
     */
    public function retypassword()
    {

      if($_SERVER['REQUEST_METHOD'] != 'POST'){
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' POST ის ნაცვლად GET ით გამოიძახა  function retypassword() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        return;
      }

      $this->lang->load('registration_lang',$this->session->userdata('language'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('retypassword', 'rety password',
      'required|min_length[3]|max_length[20]',
      array('required' => $this->lang->line('text_required'),'min_length' => $this->lang->line('text_min_length'),
      'max_length'=> $this->lang->line('text_max_length')));

      if ($this->form_validation->run() == FALSE)
      {
         echo json_encode(array('status' => 0, 'message' => validation_errors()));
      }else{
         echo json_encode(array('status' => 1));
      }

    }


    /**
     * ამოწმებს აიაქსით პოსტით მოსულ retypassword მონაცემს
     *
     * @param
     * @return
     */
    public function email()
    {

      if($_SERVER['REQUEST_METHOD'] != 'POST'){
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' POST ის ნაცვლად GET ით გამოიძახა  function email() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        return;
      }

      $this->lang->load('registration_lang',$this->session->userdata('language'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('email', 'email',
      'required|min_length[5]|max_length[30]|valid_email|is_unique[users.email]',
      array('required' => $this->lang->line('text_required'),'min_length' => $this->lang->line('text_min_length'),
      'max_length'=> $this->lang->line('text_max_length'),'valid_email'=>$this->lang->line('text_email')));

      if ($this->form_validation->run() == FALSE){
         echo json_encode(array('status' => 0, 'message' => validation_errors()));
      }else{
         echo json_encode(array('status' => 1));
      }

    }


  /**
   *  მომხმარებლის რეგისტრაციის მონაცემების შემოწმება და დარეგისტრირება
   *
   * @param
   * @return
   */
  public function registration()
	{

    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function registration() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        die;
    }

       $this->load->model('Rules_model');
       $this->load->library('form_validation');
       $this->form_validation->set_rules($this->Rules_model->registration_rules);
       // თუ მონაცემები ვალიდურია მაშინ დავარეგისტრიროთ
       if($this->form_validation->run()){

           $this->load->model('User_model');
           if($this->User_model->user_registration()){
               redirect('welcome/registration','refresh'); 
           }

       }else{
        //  echo validation_errors();
        // die('form validatin error');
         log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] რეგისტრაციისას დაფიქსირებული შეცდომა  function registration() | '.__FILE__.' on line : '.__LINE__);
          //  echo validation_errors();
            if(!empty($_SERVER['HTTP_REFERER'])){
                  header("Location: {$_SERVER['HTTP_REFERER']} ");
                  exit();
            }else{
                 redirect('Welcome','refresh');
            }
            return;
       }

	}


 /**
  *  მომხმარებლის ავტორიზახია
  *
  * @param
  * @return
  */
  public function login()
  {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
          show_404();
          log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function login() | '.__FILE__.' on line : '.__LINE__);
          return;
        }

       $this->load->model('Rules_model');
       $this->load->library('form_validation');
       $this->form_validation->set_rules($this->Rules_model->login_rules);
       // თუ მონაცემები ვალიდურია მაშინ ავტორიზირდეს
       if($this->form_validation->run()){

             $this->load->model('User_model');
             $this->User_model->login();

            redirect('Welcome','refresh');
           
             return;
            // $errors['status'] = 1;
            // echo json_encode($errors);
       }else{
          // hacker save to log
          //  echo validation_errors();
          //  $errors['status'] = 0;
          //  $errors['email'] = strip_tags(form_error('email'));
          //  $errors['password'] = strip_tags(form_error('password'));
          //  echo json_encode($errors);
            if(!empty($_SERVER['HTTP_REFERER'])){
                  header("Location: {$_SERVER['HTTP_REFERER']} ");
                  exit();
            }else{
                 redirect('Welcome','refresh');
            }
            return;
       }

  }

  /**
   * მომხმარებლის გასვლა
   * სესსიის და ქუქის წაშლა
   *
   * @param
   * @return
   */
    public function logout()
    {

    

        $this->load->helper('cookie');
        delete_cookie('email',HTTP_SERV,'/');
        delete_cookie('password',HTTP_SERV,'/');
        delete_cookie('username',HTTP_SERV,'/');
        delete_cookie('avatar',HTTP_SERV,'/');
        delete_cookie('user_id',HTTP_SERV,'/');
        // session_unset();
        $this->session->sess_destroy();

        redirect('Welcome','refresh');
        return;

    }


   /**
    * მომხმარებლის ექაუნთის აქტივაცია
    *
    * @param
    * @return
    */
     public function activation($code = '')
     { 
          $code = $this->db->escape_str(strip_tags($code));
          $this->load->model('User_model');
          if($this->User_model->accaunt_activation($code))
          {
            // echo 'aq carmatebis gverdis chveneba';
              redirect('welcome','refresh');  
              return;
          }else{
              // echo 'aq carumateblobis gverdis chveneba';
              log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური აქტივაციის კოდი გადასცა  function activation() | '.__FILE__.' on line : '.__LINE__);
              return;
          }
     }


   /**
    * მომხმარებლის პაროლის აღდგენა
    *
    * @param
    * @return
    */
     public function password_reset($code = null){

        if($_SERVER['REQUEST_METHOD'] == 'GET'){

                 $code = $this->db->escape_str(strip_tags($code));
                       
                 $this->db->where('activation_code', $code);
                 $this->db->where('is_active', 1);
                 $this->db->select('pass_reset');
                 $this->db->limit(1); 
                 $query = $this->db->get('users');

               // $this->db->where('email', 'km39jrgH3v@gmail.com');
                   if ($query->num_rows() == 0){

                         redirect('welcome','refresh');  
                         return false;
                    }
     
               foreach ($query->result() as $row){
               
                    $this->db->set('password', $row->pass_reset);
                    $this->db->where('activation_code', $code);
                    $this->db->update('users');

                    // here will be success page loading
                    redirect('welcome/reseted/1','refresh');  
                    return;
              }

        }
          // if($_SERVER['REQUEST_METHOD'] != 'POST')
          // {
          //     log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function password_reset() | '.__FILE__.' on line : '.__LINE__);
          //        show_404();
          //      die;
          //  }
         $email = $this->db->escape_str(strip_tags($this->input->post('email',TRUE)));

         if (!filter_var( $email , FILTER_VALIDATE_EMAIL) === true) {
                redirect('welcome','refresh');
          } 

         $this->db->where('email', $email);
         $this->db->select('email');
         $this->db->select('activation_code');
         $this->db->limit(1); 
         $query = $this->db->get('users');


           if ($query->num_rows() == 0){
                 redirect('welcome','refresh');
                 return false;
           }

         // $this->db->where('email', 'km39jrgH3v@gmail.com');
        $user_email  = '';
        $activation_code  = '';

         foreach ($query->result() as $row){
            $user_email = $row->email;
            $activation_code = $row->activation_code;
        }
         // var_dump($query);
         // die;


 
              $this->load->helper('string');
              $newpass = random_string('alnum', 8);
              $hashed = password_hash($newpass, PASSWORD_DEFAULT);

               $this->db->set('pass_reset', $hashed);
               $this->db->where('email', $email);
               $this->db->update('users');

              // ჩავტვიღტოთ ენის ფაილი
              $this->lang->load('registration_lang',$this->session->userdata('language'));

               $title = $this->lang->line('text_reset_pas');
               
          $message = $this->lang->line('text_pass_reset_link').'<br><a href="'.base_url().'Authentication/password_reset/'.$activation_code.'">'.$this->lang->line('text_reset_pas').'</a>';
          $message .= '<p>'.$this->lang->line('text_Temporary_pass').' : <b> '.$newpass.'</b></p>';
          $message .= base_url().'Authentication/password_reset/'.$activation_code;
              

                $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
                $headers .= "From: <tipsters@tipsters.ge>\r\n"; 
                $headers .= "Reply-To: tipsters@tipsters.ge\r\n";

                $headers  .= "MIME-Version: 1.0 \r\n";
                $headers  .= "Date: ".date("r (T)")." \r\n";
                $headers  .= "X-Mailer: PHP\r\n";
                $headers  .= "X-Return-Path: tipsters@tipsters.ge \r\n";
                $headers  .= "Return-Path: tipsters@tipsters.ge \r\n";
                $headers  .= "Error-to: tipsters@tipsters.ge \r\n"; 


           mail($email, $title, $message, $headers); 

              /*
              // ჩავტვირთოთ ბიბლიოთეკა email
              $this->load->library('email');
              
              $config['mailtype'] = 'html';
            
              $this->email->initialize($config);


              $this->email->from('typersi@typersi.com', 'Administration');
              $this->email->to($email);
              $this->email->subject('typersi Password reset');
              $this->email->message($message);

              $this->email->send();
              */
              redirect('welcome/reseted','refresh');

     }

}
?>
