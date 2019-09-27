<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

  /**
   * აკონვერტირებს ჩათის შტყობინების დროს მომხმარებლისთვის გასაგებ ენაზე
   *
   * @param string (date)
   * @return string (converted date)
   */
  public  function time_elapsed_string($datetime, $full = false) {

      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;
      $this->lang->load('time_lang',$this->session->userdata('language'));

      $string = array(
          'y' => $this->lang->line('year'),
          'm' => $this->lang->line('month'),
          'w' => $this->lang->line('week'),
          'd' => $this->lang->line('day'),
          'h' => $this->lang->line('hour'),
          'i' => $this->lang->line('minute'),
          's' => $this->lang->line('second'),
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v;
              // $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }

      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) .' '. $this->lang->line('ago') : $this->lang->line('now');
  }

  /**
   * ჩათისთვის გამოაქ მომხმარებელთა შეტყობინებები ვისთანაც დიალოგები ქონდა
   *  და ბოლოს მოწერილი ან ბოლო დიალოგი
   * @param
   * @return
   */
   public function get_chat_users_and_messages(){

      $user_id = $this->session->user_id;


      // $sql = " SELECT  C.*,u.id, u.username, u.avatar
      //          FROM chat C
      //          JOIN users u
      //          ON
      //          (  u.id = C.from_user_id OR u.id = C.to_user_id  )
      //          WHERE
      //          (  C.from_user_id = $user_id OR C.to_user_id = $user_id  )
      //          ORDER BY create_date
      //          LIMIT 10
      //          ";
      // $sql = " SELECT  C.from_user_id ,  C.to_user_id,C.content,C.create_date,C.readed, u.id, u.username, u.avatar
      //          FROM chat C
      //          JOIN users u
      //          ON
      //          (  u.id = C.from_user_id OR u.id = C.to_user_id  )
      //          WHERE
      //          (  C.from_user_id = $user_id OR C.to_user_id = $user_id  )
      //          GROUP BY C.from_user_id, C.to_user_id
      //          order by C.create_date desc
      //          LIMIT 10
      //          ";
//       date_default_timezone_set ('Asia/Tbilisi');
//
//       echo $this->time_elapsed_string('2016-11-14 19:45:11');
//
//       echo '<br>'.date('Y-m-d H:i:s');
//       echo '<br>2016-11-14 19:39:15';
// die;
  // es kargia da kargad mushaobs
      // $sql = "SELECT C.from_user_id , C.to_user_id,max(C.create_date) as send_data,C.readed,count(IF(readed = 0 AND C.from_user_id != $user_id,u.id,null)) as msg_count, u.id, u.username, u.avatar
      //          FROM chat as C
      //          JOIN users as u
      //          ON
      //          (  u.id = C.from_user_id OR u.id = C.to_user_id AND u.id != $user_id )
      //          WHERE
      //          (  C.from_user_id = $user_id OR C.to_user_id = $user_id)
      //          GROUP BY u.id
      //          ORDER BY C.create_date DESC
      //          LIMIT 10
      //          ";
$sql = "SELECT C.from_user_id ,
(select content from chat where (u.id = C.from_user_id OR u.id = C.to_user_id) AND
create_date = (select max(C.create_date) from chat where (u.id = C.from_user_id OR u.id = C.to_user_id) limit 1)
 limit 1 ) as message,
C.to_user_id,max(C.create_date) as send_data,C.readed,count(IF(readed = 0 AND C.from_user_id != $user_id,u.id,null)) as msg_count, u.id, u.username, u.avatar
         FROM chat as C
         JOIN users as u
         ON
         (  u.id = C.from_user_id OR u.id = C.to_user_id AND u.id != $user_id )
         WHERE
         (  C.from_user_id = $user_id OR C.to_user_id = $user_id)
         GROUP BY u.id
         ORDER BY C.create_date DESC
         LIMIT 20
         ";

        $query = $this->db->query($sql);
        // print_r($query->result_array());
        // die;
        if ($query->num_rows() == 0){
             return false;
        }

        $data['users'] = $query->result_array();

        $selected_iser = '';

        for ($i = 0; $i < count($data['users']); $i++) {

            if($data['users'][$i]['id'] == $user_id){
               continue;
            }
            $selected_iser = $data['users'][$i]['id'];
            break;
        }

        $sql2 = "SELECT  C.*, u.id, u.username, u.avatar
          FROM chat C
          JOIN users u
          ON
             ( C.from_user_id = $selected_iser AND C.to_user_id = $user_id )
          OR ( C.to_user_id = $selected_iser AND C.from_user_id = $user_id )
 		      WHERE u.id = C.from_user_id 
          ORDER BY C.create_date ASC LIMIT 20";

          $query2 = $this->db->query($sql2);
          if ($query->num_rows() == 0){
            $data['user_messages'] = array();
          }else{
            $data['user_messages'] = $query2->result_array();
          }
        // print_r($query2->result_array());
        // die;
        return $data;
   }

  /**
   * ჩათისთვის გამოაქ მომხმარებელთა შეტყობინებები ვისთანაც დიალოგები ქონდა
   *
   * @param
   * @return
   */
   public function get_chat_users(){

      $user_id = $this->session->user_id;

$sql = "SELECT C.from_user_id ,
(select content from chat where (u.id = C.from_user_id OR u.id = C.to_user_id) AND
create_date = (select max(C.create_date) from chat where (u.id = C.from_user_id OR u.id = C.to_user_id) limit 1)
 limit 1 ) as message,
C.to_user_id,max(C.create_date) as send_data,C.readed,count(IF(readed = 0 AND C.from_user_id != $user_id,u.id,null)) as msg_count, u.id, u.username, u.avatar
         FROM chat as C
         JOIN users as u
         ON
         (  u.id = C.from_user_id OR u.id = C.to_user_id AND u.id != $user_id )
         WHERE
         (  C.from_user_id = $user_id OR C.to_user_id = $user_id)
         GROUP BY u.id
         ORDER BY C.create_date DESC
         LIMIT 20
         ";

        $query = $this->db->query($sql);

        if ($query->num_rows() == 0){
             return false;
        }

        $data['users'] = $query->result_array();

        return $data;
   }

  /**
   * შეტყობინების ბაზაში შენახვა
   *
   * @param
   * @return
   */
   public function save_user_message(){

     $data['from_user_id'] = $this->session->user_id;
     $data['to_user_id'] = $this->db->escape_str(strip_tags($this->input->post('user_id', TRUE)));
     $data['content'] = $this->db->escape_str(strip_tags($this->input->post('message', TRUE)));

     if( !filter_var($data['to_user_id'], FILTER_VALIDATE_INT) ){
         log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$data['from_user_id'].'  function save_user_message() | '.__FILE__.' on line : '.__LINE__);
        //  show_404();
         return;
     }

     if($data['to_user_id'] == $data['from_user_id']) {
         log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა საკუთარი იდენთიფიკატორი გადასცა : session id = '.$data['from_user_id'].'  function save_user_message() | '.__FILE__.' on line : '.__LINE__);
        //  show_404();
         return;
     }

     // შემოწმდეს აქვს თუ არა უფლება რომ მიწეროს (ანუ დაბლოკილი ხომ არ ყავს იმ მომხმარებელს)
     if( $this->is_blocked_user($data['to_user_id'],$data['from_user_id']) ){
          return false;
     }

    
      $content_lengs = mb_strlen($data['content']);

     if($content_lengs > 500 || $content_lengs = 0 ){
           log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა სიმბოლოების დაუშვებელი რაოდენობა გადასცა. რაოდენობა = '.$content_lengs.' session id = '.$data['from_user_id'].'  function save_user_message() | '.__FILE__.' on line : '.__LINE__);
           return;
     }

       if(empty($data['content']) || empty($data['to_user_id'])){
           log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' ცარიელია $data[\'to_user_id\']  და $data[\'content\'] function save_user_message() | '.__FILE__.' on line : '.__LINE__);
           return;
     }

     $sql = "INSERT INTO chat (from_user_id, to_user_id, content)
             VALUES ('".$data['from_user_id']."','". $data['to_user_id']."','".$data['content']."');";
     $this->db->query($sql);

     return true;

   }


  /**
   * მომხმარებლის შეტყობინებების გამოტანა
   *
   * @param
   * @return
   */
   public function get_user_messages($user_id){

        $data['from_user_id'] = $this->session->user_id;
        $data['to_user_id'] = $user_id;
       $sql = " SELECT    C.* , u.id, u.username, u.avatar
         FROM chat C
         JOIN users u
         ON
         (  C.from_user_id = '{$data['from_user_id']}' AND C.to_user_id = '{$data['to_user_id']}'  )
         OR ( C.to_user_id = '{$data['from_user_id']}' AND C.from_user_id = '{$data['to_user_id']}')
		     WHERE u.id = C.from_user_id
         ORDER BY create_date
         ";

       $query = $this->db->query($sql);

//        print_r($query->result_array());
// die;
       if ($query->num_rows() == 0){
            return false;
       }

       return $query->result_array();

   }

  /**
   * მომხმარებლის შეტყობინებების გამოტანა ajax ისთვის
   *
   * @param
   * @return
   */
   public function get_ajax_messages(){


        $data['from_user_id'] = $this->session->user_id;
        $data['to_user_id'] = $this->db->escape_str(strip_tags($this->input->post('userid', TRUE)));

       if( !filter_var($data['to_user_id'], FILTER_VALIDATE_INT) ){
           log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$data['to_user_id'].'  function get_ajax_messages() | '.__FILE__.' on line : '.__LINE__);
          //  show_404();
           return;
       }

      //  $sql = " SELECT C.* , u.id, u.username, u.avatar
      //    FROM chat C
      //    JOIN users u
      //    ON
      //    (  C.from_user_id = '{$data['from_user_id']}' AND C.to_user_id = '{$data['to_user_id']}')
      //    OR ( C.to_user_id = '{$data['from_user_id']}' AND C.from_user_id = '{$data['to_user_id']}')
		  //    WHERE u.id = C.from_user_id
      //    ORDER BY create_date ASC
      //    limit 40
      //    ";

       $sql = "SELECT C.*, u.id, u.username, u.avatar
         FROM chat C
         JOIN users u
         ON (  C.from_user_id = '".$data['from_user_id']."' AND C.to_user_id = '".$data['to_user_id']."')
         OR ( C.to_user_id = '".$data['from_user_id']."' AND C.from_user_id = '".$data['to_user_id']."')
		     WHERE u.id = C.from_user_id
         ORDER BY create_date ASC limit 40
        ";

       $query = $this->db->query($sql);
      //  $sql2 = "UPDATE chat SET readed = 1 WHERE
      //  (  from_user_id = '{$data['from_user_id']}' AND to_user_id = '{$data['to_user_id']}')
      //     OR ( to_user_id = '{$data['from_user_id']}' AND from_user_id = '{$data['to_user_id']}')
      // ";
      $sql2 = "UPDATE chat SET readed = 1 WHERE
      ( to_user_id = '{$data['from_user_id']}' AND from_user_id = '{$data['to_user_id']}')
     ";
      //  print_r($query->result_array());
      //  die;
       if ($query->num_rows() == 0){
            return false;
       }
       $query2 = $this->db->query($sql2);

       return $query->result_array();

   }

   /**
    * მომხმარებლიი ინფორმაციის მიღება id, username, regist_date
    *
    * @param int
    * @return array
    */
    public function get_user_info($user_id = ''){

          $sql = "SELECT id,username,regist_date,avatar FROM users WHERE id = $user_id LIMIT 1";
          $query = $this->db->query($sql);

          if ($query->num_rows() == 0){
               return false;
          }

          $row = $query->row_array();

          if (isset($row)){
            return $row;
          }else{
            return false;
          }
                  //  return $query->result_row();
    }


   /**
    * ერთი მომხმარებლის მიერ მეორე მომხმარებლის დაბლოკვა
    *
    * @param 
    * @return 
    */
    public function block_user_db(){

        $data['from_user_id'] = $this->session->user_id;
        $data['to_user_id'] = $this->db->escape_str(strip_tags($this->input->post('userid', TRUE)));

       if( !filter_var($data['to_user_id'], FILTER_VALIDATE_INT) ){
           log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$data['to_user_id'].'  function block_user_db() | '.__FILE__.' on line : '.__LINE__);
          //  show_404();
           return;
       }

 $array = array('from_user_id' =>  $data['from_user_id'], 'to_user_id' => $data['to_user_id']);
     $this->db->where($array);
     $query = $this->db->get('block_users');
      
        
        if ($query->num_rows() != 0){
             return false;
        }

        // echo 'gagrdzelda';
        // die();

       $data = array(
        'from_user_id' => $data['from_user_id'],
        'to_user_id' =>  $data['to_user_id']
       );

      $this->db->insert('block_users', $data);
      
      return true;
    }


   /**
    * მომხმარებლის სმამად მონიშვნა
    * 
    * @param 
    * @return 
    */
    public function marck_user_as_spam(){
      
        $data['from_user_id'] = $this->session->user_id;
        $data['to_user_id'] = $this->db->escape_str(strip_tags($this->input->post('userid', TRUE)));

         if( !filter_var($data['to_user_id'], FILTER_VALIDATE_INT) ){
             log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელმა არავალიდური მონაცემი გადასცა, ნატურალური დადებითი რიცხვის ნაცვლად : '.$data['to_user_id'].'  function marck_user_as_spam() | '.__FILE__.' on line : '.__LINE__);
            //  show_404();
             return false;
         }

        $array = array('from_user_id' =>  $data['from_user_id'], 'to_user_id' => $data['to_user_id']);
         $this->db->where($array);
         $query = $this->db->get('spam_report');
          
            
            if ($query->num_rows() != 0){
                 return false;
            }

            // echo 'gagrdzelda';
            // die();

           $data = array(
              'from_user_id' => $data['from_user_id'],
              'to_user_id' =>  $data['to_user_id']
           );

          $this->db->insert('spam_report', $data);
          
          return true;


    }




   /**
    * მოწმბდება დაბლოკილი არის თუ არა მომხმარებელი
    * (ანუ აქვს თუ არა უფლება მიწეროს ვისაც უგზავნის შეტყობინებას)
    * @param 
    * @return 
    */
   public function is_blocked_user($blocked_user,$who_blocked){

         $array = array('from_user_id' =>  $blocked_user, 'to_user_id' => $who_blocked);
     $this->db->where($array);
     $query = $this->db->get('block_users');
      
        
        if ($query->num_rows() != 0){
             return true;
        }
   }

}
?>
