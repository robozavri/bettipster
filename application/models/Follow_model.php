<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Follow_model extends CI_Model {

  /**
   *  გამოიტანს მომხმარებლის მიერ გამოწერილ მომხმარებლებს
   *
   * @param
   * @return
   */
   public function get_my_followers(){

         $user_id = $this->session->userdata('user_id');
         if(empty($this->session->user_id)){
           return;
         }

         // მომხმარებლებზე გამოვიტანოთ ინფორმაცია
        //  $sql = "SELECT `user_id` FROM `followers` WHERE`follower_id` = $user_id";
         $sql = "SELECT users.id,users.username FROM `followers`
                 INNER JOIN `users`
                 ON users.id = followers.user_id
                 WHERE `follower_id` = $user_id";
         $my_followers = $this->db->query($sql);
        //  print_r($my_followers->result_array());
        //  die;

            // თუ გამოწერილები არ ყავს არავინ მაშინ return false
           if ($my_followers->num_rows() == 0){
                return false;
           }

           return $my_followers->result_array();
   }


  /**
   * გამოიტანს მომხმარებლის მიერ გამოწერილ მომხმარებლების სტატისტიკებს
   *
   * @param
   * @return
   */
   public function get_my_followers_and_that_statistic(){

     $user_id = $this->session->userdata('user_id');
     if(empty($this->session->user_id)){
       return;
     }

     // მომხმარებლებზე გამოვიტანოთ ინფორმაცია
    //  $sql = "SELECT `user_id` FROM `followers` WHERE`follower_id` = $user_id";
     $sql = "SELECT users.id,users.username FROM `followers`
             INNER JOIN `users`
             ON users.id = followers.user_id
             WHERE `follower_id` = $user_id";
     $my_followers = $this->db->query($sql);
    //  print_r($my_followers->result_array());
    //  die;

        // თუ გამოწერილები არ ყავს არავინ მაშინ return false
       if ($my_followers->num_rows() == 0){
            return false;
       }else{


         // გამოვიტანოთ ამ იუსერების გაკეთებული ბოლო 10 პროგნოზი limit 10
         $i = 0;
         foreach ($my_followers->result_array() as $follower) {
            $follower_id = $follower['id'];

          //  print_r($follower);
          //  die;
            // echo $follower['user_id'].'<br>';
            $sql2 = "SELECT * FROM forecasted_matches
                     WHERE user_id = '{$follower['id']}'
                     ORDER BY `add_date` desc limit 10";
            // $sql2 = "SELECT forecasted_matches.*, users.id,users.username FROM `forecasted_matches`
            //          INNER JOIN `users`
            //          ON users.id = forecasted_matches.user_id
            //          WHERE forecasted_matches.user_id = $follower_id
            //          ORDER BY forecasted_matches.add_date desc limit 10";
            $query2 = $this->db->query($sql2);
            // print_r($query2->result_array());
            $all_result[$i]['usernames'] = $follower['username'];
            $all_result[$i]['followers_statistic'] = $query2->result_array();
            $i++;
            // die;

         }
          // print_r($all_result);
          // die;
        //  die;
              return $all_result;
              // return $query2->result_array();
       }
       return false;
   }

  // ამოწმებს გამოწერილია უკვე თუ არა
  /**
   *
   *
   * @param
   * @return
   */
    public function check_is_follow($data){

        $result = $this->db->query("
            SELECT `follower_id`
            FROM `followers`
            WHERE
            (`user_id` = '{$data['for_user_id']}'
                AND `follower_id` = '{$data['follower_id']}')
        ");


        if ($result->num_rows() > 0)
        {
           return true; //თუ ყავს მეგობრებში true აბრუნებს
        }


    }//  end function check in friends

   // გამოწერის დამატება ბაზაში
   /**
    *
    *
    * @param
    * @return
    */
   public function add_follow()
   {

      if(!isset($_POST['user'])){
          // save hacker in log
          return;
      }

       $data['follower_id'] = $this->session->user_id;
       // პოსტიდან მივიღოთ მომხმარებლის id ვისი გამომწერიც უნდა გახდეს მეორე მომხმარებელი
       $data['for_user_id'] = trim($this->db->escape_str(strip_tags($this->input->post('user', TRUE))));

       if( !filter_var($data['for_user_id'], FILTER_VALIDATE_INT) ){
           log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$data['for_user_id'].'  function add_follow() | '.__FILE__.' on line : '.__LINE__);
           die;
       }

       // ადმინს რომ არ დაუფოოვდეს
       if ($data['for_user_id'] == 1 ) {

           log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა გადასცა ადმინისტრატორის იდენთიფიკატორის გადაცემა : '.$data['for_user_id'].' function add_follow() | '.__FILE__.' on line : '.__LINE__);
           die();
           return;

       }

       //  საკუთარი ექაუნთს რომ არ დაუფოლოვდეს
       if ( $data['for_user_id'] == $data['follower_id'] ) {

           log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] მომხმარებელმა გადასცა საკუთარი იდენთიფიკატორის გადაცემა : '.$data['for_user_id'].' function add_follow() | '.__FILE__.' on line : '.__LINE__);
           die();
           return;

       }

       // ჩავტვირთოთ ენის ფაილი
       $this->lang->load('profile_lang',$this->session->userdata('language'));

       if($this->check_is_follow($data)){
           $jsonMessage = $this->lang->line('text_is_follow');
           echo json_encode(array('status' => 0,'message' => $jsonMessage));
           return;
       }

        $query = $this->db->query("
              INSERT INTO `followers` (`user_id`,`follower_id`)
              VALUES('{$data['for_user_id']}','{$data['follower_id']}' )
         ");

         $jsonMessage = $this->lang->line('text_success_follow');
         echo json_encode(array('status' => 1,'message' => $jsonMessage,'btn_text'=>$this->lang->line('text_unfollow')));
         return;
   }



/**
 * მომხმარებლის მიერ მეორე მომხმარებლის გამოწერის გაუქმება unfollow
 *
 * @param
 * @return
 */
  public function unfollow(){

      if(!isset($_POST['user'])){
          // save hacker in log
          return;
      }

      $data['follower_id'] = $this->session->userdata('user_id');

      if(empty($data['follower_id'])){
          die;
      }

      // პოსტიდან მივიღოთ მომხმარებლის id ვისი გამომწერიც უნდა გახდეს მეორე მომხმარებელი
      $data['for_user_id'] = $this->db->escape_str(strip_tags($this->input->post('user', TRUE)));

      if((int) $data['for_user_id'] <= 0){
          // hacker save in log
          die;
      }

      // ჩავტვირთოთ ენის ფაილი
      $this->lang->load('profile_lang',$this->session->userdata('language'));

      if(!$this->check_is_follow($data)){
         // hacker save in log
          return;
      }

      $query = $this->db->query("
            DELETE FROM `followers`
            WHERE `user_id` = '{$data['for_user_id']}'
            AND   `follower_id` = '{$data['follower_id']}'
       ");

       $jsonMessage = $this->lang->line('text_success_unfollow');
        echo json_encode(array('status' => 1,'message' => $jsonMessage,'btn_text'=>$this->lang->line('text_follow')));
       return;

  }

}
?>
