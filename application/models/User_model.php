<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {



/**
 * შემოწმდება მომხმარებელი დაბლოკილია თუ არა
 *
 * @param
 * @return
 */
  public function is_user_blocked()
  {

                 $this->db->where('id', $this->session->user_id);
                 $this->db->select('is_block');
                 $this->db->select('is_ip_block');
                 $this->db->limit(1); 
                 $query = $this->db->get('users');

               foreach ($query->result() as $user){
              
                    if($user->is_block == 1){
                         $newdata = array('logged_in' => FALSE);
                        $this->session->set_userdata($newdata);
                         return false;

                    } else {
                     return true;
                    }
              }

              return false;

}


/**
 * მომხმარებლის იდენთიფიკაცია
 *
 * @param
 * @return
 */
  public function user_identification()
  {

    // $sql = "SELECT `blocked_ip` FROM ip_storage WHERE INET_NTOA(`blocked_ip`) =  ".$this->input->ip_address()."";
    // echo $sql;
    // $query = $this->db->query($sql);
    // var_dump($query->result_array());
    // echo $query->row('blocked_ip');
    // die;
                

      if($this->session->user_type == 'user' && $this->session->logged_in == TRUE){
            
                  $this->is_user_blocked();
                  return;
             
            

      }elseif(!empty($this->input->cookie('email', TRUE))){

          $this->user_validation();

      }else{
              $newdata = array('logged_in' => FALSE);
              $this->session->set_userdata($newdata);
      }
  }

  /**
   * მომხმარებლის გამოტანა ემაილის და იუსერნეიმის მიხედვით
   * მოწმდება მომხმარებელი დაბლოკილი არის თუ არა და გააქტიურებული არის თუ არა
   * მისი მროფილი
   *
   * @param
   * @return
   */
   public function user_validation(){

      $email = $this->db->escape_str(strip_tags($this->input->cookie('email', TRUE)));
      $password = base64_decode($this->db->escape_str(strip_tags($this->input->cookie('password', TRUE))));
      // $query = $this->db->get_where('users', array('email' => $email,'password' => $password), 1);
      $sql = "SELECT id,username,avatar,email,is_active,is_block,is_ip_block FROM users WHERE  email = '".$email."' AND user_group = 2 LIMIT 1";
      $query = $this->db->query($sql);

      if ($query->num_rows() == 0){

              return false;

      }else{


              if($query->row('is_active') == 0 || $query->row('is_block') == 1){

                  $newdata = array('logged_in' => FALSE);
                  $this->session->set_userdata($newdata);
                  return false;
              }

              $newdata = array(
                  'user_id'   => $query->row('id'),
                  'username'   => $query->row('username'),
                  'avatar'   => $query->row('avatar'),
                  'user_type' => 'user',
                  'email'     => $query->row('email'),
                  'logged_in' => TRUE
              );

              $this->session->set_userdata($newdata);
              return true;
      }

   }


/**
 * მომხმარებლის ავტორიზახია
 *
 * @param
 * @return
 */
  public function login()
  {

      $password = $this->db->escape_str(strip_tags($this->input->post('password',TRUE)));
      $email    = $this->db->escape_str(strip_tags($this->input->post('email',TRUE)));
      $sql = "SELECT `id`,`password`,`username`,`avatar`
              FROM users
              WHERE email = '".$email."' AND  is_active = 1 LIMIT 1";

      $query = $this->db->query($sql);

      $row = $query->row();

      if (isset($row))
      {
          // თუ პაროლი არასწორია
          if(!password_verify($password, $row->password)){
                return false;
          }

            $newdata = array(
                'user_id'   => $row->id,
                'email'     => $email,
                'avatar'   =>  $row->avatar,
                'username'  => $row->username,
                'user_type' => 'user',
                'logged_in' => TRUE
            );
            // დავიწყოთ სესია
            $this->session->set_userdata($newdata);

            $cookie_username = array(
                    'name'   => 'username',
                    'value'  =>  $row->username,
                    'expire' => '31556926',
                    'domain' => HTTP_SERV
            );
            // ჩავსვათ ქუქი username
            $this->input->set_cookie($cookie_username);

            $cookie_email = array(
                    'name'   => 'email',
                    'value'  =>  $email,
                    'expire' => '31556926',
                    'domain' => HTTP_SERV,
                    'httponly' => TRUE
            );
            // ჩავსვათ ქუქი email
            $this->input->set_cookie($cookie_email);

            $cookie_password = array(
                    'name'   => 'password',
                    'value'  =>  base64_encode($password),
                    'expire' => '31556926',
                    'domain' => HTTP_SERV,
                    'httponly' => TRUE
            );

              // ჩავსვათ ქუქი password
            $this->input->set_cookie($cookie_password);

            // $cookie_password = array(
            //         'name'   => 'user_id',
            //         'value'  =>  $row->id,
            //         'expire' => '31556926',
            //         'domain' => HTTP_SERV
            // );
            //
            //   // ჩავსვათ ქუქი userid
            // $this->input->set_cookie($cookie_password);

            return true;

      }
      return false;
  }


  /**
   * post იდან მონაცემების მიღება გაფილტვრა და ბაზაში შენახვა
   *
   * @param
   * @return
   */
    public function user_registration()
    {

         $data['username']  = $this->db->escape_str(strip_tags($this->input->post('username',TRUE)));
         $data['email']     = $this->db->escape_str(strip_tags($this->input->post('email',TRUE)));
         $password          = strip_tags($this->input->post('password',TRUE));
         $data['password']  = password_hash($password, PASSWORD_DEFAULT);
         $captcha           = strip_tags($this->input->post('captcha',TRUE));

        if(!empty($this->input->post('year',TRUE)) &&
         !empty($this->input->post('month',TRUE)) && !empty($this->input->post('day',TRUE))){
              $data['birthday'] = abs((int)$this->input->post('year',TRUE)).'-'.abs((int) $this->input->post('month',TRUE)).'-'.abs((int) $this->input->post('day',TRUE));
        }
    
          if(!empty($this->input->post('gender',TRUE))){
            $data['gender'] = $this->input->post('gender',TRUE);
          }

          if(!empty($this->input->post('name',TRUE))){
            $data['name'] = $this->db->escape_str(strip_tags($this->input->post('name',TRUE)));
          } 

          if(!empty($this->input->post('fullname',TRUE))){
            $data['full_name'] = $this->db->escape_str(strip_tags($this->input->post('fullname',TRUE)));
          }
       

         $this->load->model('Captcha_model');
         if($this->Captcha_model->captcha_check($captcha)){

              $this->load->helper('string');
              $data['activation_code'] = random_string('alnum', 30);

              $this->db->insert('users',$data);
              
              
              
              // ჩავტვირთოთ ბიბლიოთეკა email
              // $this->load->library('email');
              
              // $config['mailtype'] = 'html';
              // $config['charset'] = 'utf-8';

            
              // $this->email->initialize($config);

              // ჩავტვიღტოთ ენის ფაილი
              $this->lang->load('registration_lang',$this->session->userdata('language'));

              $message  = $this->lang->line('text_registration_confirmation');
              $message .= '<br><a href="'.base_url().'Authentication/activation/'.$data['activation_code'].'">'.$this->lang->line('text_accaunt_activation_link').'</a><br>';
              $message .= base_url().'Authentication/activation/'.$data['activation_code'];
              // მომხმარებლისთვის აქტივაციის ლინკის გაგზავნა
              // $this->email->from('tipsters@tipsters.ge', 'Administration tipsters.ge');
              // $this->email->to($data['email']);
              // $this->email->subject('typersi Activation');
              // $this->email->message($message);
                
              // if ( ! $this->email->send())
              // {
              //         // Generate error
              //    //          echo $this->email->print_debugger();
              //   // die;
              //   return false;
              // }
   
                        // ini_set( 'display_errors', 1 );
                        // error_reporting( E_ALL );
                        $from = "tipsters@tipsters.ge";
                        $to = $data['email'];
                        $subject = "tipsters.ge Activation";
                        // $message = "php is satesto text plain";
                        // $headers = "From:" . $from;
                       

                        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
                        $headers .= "From: <tipsters@tipsters.ge>\r\n"; 
                        $headers .= "Reply-To: tipsters@tipsters.ge\r\n";

                        $headers  .= "MIME-Version: 1.0 \r\n";
                        $headers  .= "Date: ".date("r (T)")." \r\n";
                        $headers  .= "X-Mailer: PHP\r\n";
                        $headers  .= "X-Return-Path: tipsters@tipsters.ge \r\n";
                        $headers  .= "Return-Path: tipsters@tipsters.ge \r\n";
                        $headers  .= "Error-to: tipsters@tipsters.ge \r\n"; 

                        mail($to,$subject,$message, $headers);
                     

              return true;
         }

         return false;

    }




  /**
   * ექაუნთის აქტივაციის კოდის შემოწმება
   *
   * @param
   * @return
   */
    public function accaunt_activation($code = '')
    {

         $result = $this->db->query("
         SELECT `activation_code`
         FROM `users`
         WHERE `activation_code` = '$code'
         LIMIT 1 ");

          if( $result->num_rows() == 0)
          {
                   return false;

          }else{
                  $this->db->query("
                  UPDATE `users`
                  SET `is_active` = 1
                  WHERE `activation_code` = '$code' ");
                  return true;
          }
    }


    /**
     * გამოაქვს მომხმარებლების ნიკები და რეგისტრაციით თარიღები
     * და აწყობს ჯერ ახალ დარეგისტრირებულ მომხმარებლებს
     * @param
     * @return array
     */
     public function get_all_users(){

        //  $sql = "SELECT id,username,regist_date FROM users ORDER BY regist_date DESC";
        //  $query = $this->db->query($sql);
        //  if ($query->num_rows() == 0){
        //        return false;
        //  }
         //
        //  return  $query->result_array();



     }

     /**
      * პირადი მონაცემების გამოტანა
      *
      * @param
      * @return
      */
      public function get_user_profile(){

            $user_id = $this->session->userdata('user_id');
            $sql = "SELECT id,username,name,full_name,email,phone,address,birthday,gender,avatar
                    FROM users WHERE id = $user_id LIMIT 1";
            $user = $this->db->query($sql);
            return $user->result_array();
      }

     /**
      * მომხმარებლის ყველა პირადი მონაცემების გამოტანა
      *
      * @param
      * @return
      */
      public function get_user_all_info(){

            $user_id = $this->session->userdata('user_id');
            $sql = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
            $user = $this->db->query($sql);
            return $user->result_array();
      }


     /**
      * პირადი მონაცემების რედაქტირება
      *
      * @param
      * @return
      */
      public function user_profile_edit()
      {

            if(isset($_POST['phone']) && !empty($_POST['phone'])){
              $data['phone'] = $this->db->escape_str(strip_tags($this->input->post('phone',TRUE)));
            }
            if(isset($_POST['address']) && !empty($_POST['address'])){
              $data['address'] = $this->db->escape_str(strip_tags($this->input->post('address',TRUE)));
            }
            if(isset($_POST['birthday']) && !empty($_POST['birthday'])){
              $data['birthday'] = $this->db->escape_str(strip_tags($this->input->post('birthday',TRUE)));
            }
          
            if(isset($_POST['email']) && !empty($_POST['email'])){
              $data['email'] = $this->db->escape_str(strip_tags($this->input->post('email',TRUE)));
            }
            if(isset($_POST['first_name']) && !empty($_POST['first_name'])){
              $data['name'] = $this->db->escape_str(strip_tags($this->input->post('first_name',TRUE)));
            }
            if(isset($_POST['last_name']) && !empty($_POST['last_name'])){
              $data['full_name']  = $this->db->escape_str(strip_tags($this->input->post('last_name',TRUE)));
            }

          if(!empty($this->input->post('year',TRUE)) &&
         !empty($this->input->post('month',TRUE)) && !empty($this->input->post('day',TRUE))){
              $data['birthday'] = abs((int)$this->input->post('year',TRUE)).'-'.abs((int) $this->input->post('month',TRUE)).'-'.abs((int) $this->input->post('day',TRUE));
           }

          if(!empty($this->input->post('gender',TRUE))){
            $data['gender'] = $this->input->post('gender',TRUE);
          }

          if(!empty($this->input->post('name',TRUE))){
            $data['name'] = $this->db->escape_str(strip_tags($this->input->post('name',TRUE)));
          } 

          if(!empty($this->input->post('fullname',TRUE))){
            $data['full_name'] = $this->db->escape_str(strip_tags($this->input->post('fullname',TRUE)));
          }


            if(isset($_POST['password']) && !empty($_POST['password'])){
              $password   = $this->db->escape_str(strip_tags($this->input->post('password',TRUE)));
              $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $captcha = strip_tags($this->input->post('captcha',TRUE));

            $this->load->model('Captcha_model');
            if($this->Captcha_model->captcha_check($captcha)){

                 $user_id = $this->session->userdata('user_id');
                 $this->db->set($data);
                 $this->db->where('id', $user_id);
                 $this->db->update('users');
                 return true;
            }
            return false;
      }

  /**
   *ყველა არსებული ავატარების გამოტანა
   *
   * @param
   * @return
   */
  public function get_all_avatars(){

      
      $this->db->order_by('avatars_bank_id', 'DESC');
      // $this->db->order_by('avatars_bank_id', 'ASC');
      $query = $this->db->get('avatars_bank');
      
       if ($query->num_rows() == 0){
             return false;
        }
        $data['avatars'] = $query->result_array();

        return $data['avatars'];
  }


    /**
     * ავატარის სახელს ბაზაში შეინახავს
     *
     * @param
     * @return
     */
     public function insert_avatar($avatar_data){

       $sql = "SELECT avatar FROM users WHERE id = '".$avatar_data['user_id']."'";
       $query = $this->db->query($sql);

       if (file_exists($query->row('avatar'))){
         unlink('uploads/avatars/'.$query->row('avatar'));
       }


        $sql2 = "UPDATE users SET avatar = '".$avatar_data['avatar_title']."'
                WHERE id = '".$avatar_data['user_id']."'";
        $this->db->query($sql2);
        //  $this->db->insert('avatars',$avatar_data);
     }

     /**
      * მომხმარებლის ავატარის წაშლა ბაზიდან და ფოლრდერიდან
      *
      * @param
      * @return
      */
      public function delete_user_avatar($user_id){

         $sql = "SELECT avatar FROM users WHERE id = $user_id";
         $query = $this->db->query($sql);

         unlink('uploads/avatars/'.$query->row('avatar'));

         $sql2 = "UPDATE users SET avatar = '100.png'
                 WHERE id = $user_id";
         $this->db->query($sql2);

      }

     /**
      * მომხმარებლზე პატარა ინფოს გამოტანა
      *
      * @param
      * @return
      */
      public function get_user_mini_info($user_id){

        $query = $this->db->select('id,username,avatar')
                ->where('id', $user_id)
                ->get('users');
                // return $query->result();
                
          if( $query->num_rows() == 0)
          {
                   return false;
          }
            foreach ($query->result() as $row){

                 return $row;
             
            }
      }




}
?>
