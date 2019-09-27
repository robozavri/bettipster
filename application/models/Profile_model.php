<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {



/**
 * გამოაქ მომხმარებლის პროგნოზირებული მატჩები
 *
 * @param
 * @return array
 */
  public function get_user_matches($user_id = ''){

        $sql = "SELECT * FROM forecasted_matches WHERE user_id = $user_id ORDER BY add_date DESC";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0){
             return false;
        }

        return $query->result_array();
  }


/**
 * გამოვიტანოთ თითეული იუზერისთვის მისი სტატისტიკა მის პროფილში
 *
 * @param
 * @return
 */
  public function get_user_statistic($user_id = ''){

        $sql = "SELECT * FROM forecasted_matches WHERE user_id = $user_id ORDER BY add_date DESC";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0){
             return false;
        }

        $data['matches'] = $query->result_array();

        //  $sql2 = "SELECT count(user_id) as match_count, count(IF(`is_winner`=1,1,null)) as won_count
        //           FROM forecasted_matches WHERE user_id = $user_id ";
         $sql2 = "SELECT users.username, count(forecasted_matches.user_id) as match_count, count(IF(`is_winner`=1 AND `status` = 1,1,null)) as won_count,
            count(IF(`is_winner`=0 AND `status` = 1,1,null)) as lose_count
                  FROM forecasted_matches
                  INNER JOIN `users` ON users.id = forecasted_matches.user_id
                  WHERE user_id = $user_id  group by forecasted_matches.user_id ";
        $query2 = $this->db->query($sql2);


          foreach ($query2->result_array() as $value) {

               // გამოვთვალოთ რამდენი პროცენტული მაჩვვენებელი გარტყმების
               $procent = ($value['won_count'] / $value['match_count']) * 100;

               // რამდენი მატჩი აქვს წაგებული ანუ წარუმატებელი პროგნოზი
               // $lost =  $value['match_count'] - $value['won_count'];

          }
            $data['procent_wins'] = (int) $procent;
            $data['lost'] = $value['lose_count'] ;
            $data['won_count'] = $value['won_count'];
            $data['match_count'] = $value['match_count'];

            return $data;
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

  

}
?>
