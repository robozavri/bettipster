<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {


  /**
   * გამოვიტანოთ თითეული იუზერისთვის მისი სტატისტიკა მის პროფილში
   *
   * @param
   * @return
   */
    public function get_user_statistic($user_id = ''){

          $sql = "SELECT * FROM forecasted_matches  WHERE user_id = $user_id ORDER BY add_date DESC";

          $query = $this->db->query($sql);

          if ($query->num_rows() == 0){
               return false;
          }

          $statistic['matches'] = $query->result_array();

              return $statistic;
    }


    /**
     * გამოაქვს მომხმარებლების ნიკები და რეგისტრაციით თარიღები
     * და აწყობს ჯერ ახალ დარეგისტრირებულ მომხმარებლებს
     * @param
     * @return arraz
     */
     public function get_all_users(){

         $sql = "SELECT * FROM users ORDER BY regist_date DESC";
         $query = $this->db->query($sql);
         if ($query->num_rows() == 0){
               return false;
         }

         return  $query->result_array();
     }

     /**
      * პირადი მონაცემების გამოტანა
      *
      * @param
      * @return
      */
      public function get_user_profile($user_id){

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
      public function user_profile_edit($user_id)
      {

            if(isset($_POST['is_ip_block'])){
              $data['is_ip_block'] = 1;
            }else{
                $data['is_ip_block'] = 0;
            }
            if(isset($_POST['is_block'])){
              $data['is_block'] = 1;
            }else{
                $data['is_block'] = 0;
            }

            if(isset($_POST['phone']) && !empty($_POST['phone'])){
              $data['phone'] = $this->db->escape_str(strip_tags($this->input->post('phone',TRUE)));
            }
            if(isset($_POST['address']) && !empty($_POST['address'])){
              $data['address'] = $this->db->escape_str(strip_tags($this->input->post('address',TRUE)));
            }
            if(isset($_POST['birthday']) && !empty($_POST['birthday'])){
              $data['birthday'] = $this->db->escape_str(strip_tags($this->input->post('birthday',TRUE)));
            }
            if(isset($_POST['username']) && !empty($_POST['username'])){
              $data['username'] = $this->db->escape_str(strip_tags($this->input->post('username',TRUE)));
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
            if(isset($_POST['password']) && !empty($_POST['password'])){
              $password   = $this->db->escape_str(strip_tags($this->input->post('password',TRUE)));
              $data['password']   = password_hash($password, PASSWORD_DEFAULT);
            }

            if(!empty($this->input->post('year',TRUE)) &&
             !empty($this->input->post('month',TRUE)) && !empty($this->input->post('day',TRUE))){
                  $data['birthday'] = abs((int)$this->input->post('year',TRUE)).'-'.abs((int) $this->input->post('month',TRUE)).'-'.abs((int) $this->input->post('day',TRUE));
            }

            if(!empty($this->input->post('gender',TRUE))){
              $data['gender'] = $this->input->post('gender',TRUE);
            }

                 $this->db->set($data);
                 $this->db->where('id', $user_id);
                 $this->db->update('users');
                 return true;

      }

    /**
     * ავატარის სახელს ბაზაში შეინახავს
     *
     * @param
     * @return
     */
     public function insert_avatar($avatar_data){

        $sql = "UPDATE users SET avatar = '".$avatar_data['avatar_title']."'
                WHERE id = '".$avatar_data['user_id']."'";
        $this->db->query($sql);
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

}
?>
