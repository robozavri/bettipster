<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic_model extends CI_Model {


  /**
   * გამოაქ კონკრეტული მომხმარებიის პატარა სტატისტიკა დათვლილი % ები
   *
   * @param
   * @return array
   */
  public function particular_user_mini_statistic($user_id = ''){

        $this->db->where('user_id', $user_id);

        $query = $this->db->get('users_statistic');

         if ($query->num_rows() == 0){
            return false;
      }

         return $query->result_array();
  }


/**
 * გამოაქ ყველა ტიპსტერი და მათი მცირე სტატისტიკა
 * დაიანგარიშებს მომხმარებელს რამდენი წაგება მოგება და გარტყმების % მაჩვენებელი აქვს
 *
 * @param
 * @return array
 */
 public function get_users_statistics(){

      $this->db->select('user_id, username, forecoast_count, win, procent_win, lose');
      // $this->db->from('users');
      $this->db->join('users', 'users.id = users_statistic.user_id');
      $query = $this->db->get('users_statistic');

      if ($query->num_rows() == 0){
            return false;
      }

      return $query;
 }


/**
 * იძლევა ყველა ტიპსტერი და მათი მცირე სტატისტიკა
 * დაიანგარიშებს მომხმარებელს რამდენი წაგება მოგება და გარტყმების % მაჩვენებელი აქვს
 *
 * @param
 * @return array
 */
 public function get_all_users_mini_statistic(){

    /* გამოაქ მომხმარებლის username და მათი პროგნოზების და წარმატებული პროგნოზების რაოდენობა */
     // $sql = "SELECT DISTINCT forecasted_matches.user_id, users.username,
     //         count(forecasted_matches.user_id) as match_count,
     //         count(IF(forecasted_matches.is_winner = 1,1,null)) as won_count
     //         FROM forecasted_matches
     //         INNER JOIN `users` ON users.id = forecasted_matches.user_id
     //         group by `user_id`
     // "; 

     /* გამოაქ მომხმარებლის username და მათი პროგნოზების და წარმატებული პროგნოზების რაოდენობა */
     $sql = "SELECT DISTINCT forecasted_matches.user_id, users.username,
             count(forecasted_matches.user_id) as match_count,
             count(IF(forecasted_matches.is_winner = 1,1,null)) as won_count
             FROM forecasted_matches
             INNER JOIN `users` ON users.id = forecasted_matches.user_id
              WHERE forecasted_matches.status = 1
             group by `user_id`
     ";
     $query = $this->db->query($sql);

     if ($query->num_rows() == 0){
           return;
     }

     $users = $query->result_array();

          // ანგარიშდება გარტყმული თამაშების % რიცხვი და წაგების რიცხვითი მაჩვენებელი
          for ($i=0; $i < count($users); $i++) {

           // გამოვთვალოთ რამდენი პროცენტული მაჩვვენებელი გარტყმების
           $users[$i]['procent_wins'] = (int) ( ($users[$i]['won_count'] / $users[$i]['match_count']) * 100 );
           // რამდენი მატჩი აქვს წაგებული ანუ წარუმატებელი პროგნოზი
           $users[$i]['lost'] = $users[$i]['match_count'] - $users[$i]['won_count'];

          }

          return $users;
 }


/**
 * გამოაქ 10 თამაშიდან 20 თამაში ვისაც აქვს პროგნოზირებული
 * და გამოაქ მათი სტატისტიგა გამოცნობის % მაჩვენებლის მიხედვით დალაგებული
 *
 * @param
 * @return array
 */
  public function get_statistic_football_10_to_20(){

      $sql = "SELECT r.user_id,r.won_percent,r.match_quantity,u.username
              FROM raiting_10_to_20 r
              JOIN users u ON u.id = r.user_id
              ORDER BY r.won_percent DESC,r.match_quantity DESC LIMIT 10";
              $query = $this->db->query($sql);

               if ($query->num_rows() == 0){
                      return false;
                }

              $users = $query->result_array();

              return $users;
  }

  /**
   * გამოაქ 20 თამაშზე მეტი პროგნოზი ვისაც აქვს
   * და გამოაქ მათი სტატისტიგა გამოცნობის % მაჩვენებლის მიხედვით დალაგებული
   *
   * @param
   * @return array
   */
  public function get_statistic_football_over_20(){

      $sql = "SELECT r.user_id,r.won_percent,r.match_quantity,u.username
              FROM raiting_over_20 r
              JOIN users u ON u.id = r.user_id
              ORDER BY r.won_percent DESC,r.match_quantity DESC LIMIT 10";
              $query = $this->db->query($sql);
              $users = $query->result_array();

               if ($query->num_rows() == 0){
                      return false;
                }

              return $users;
  } 

  /**
   * გამოაქ 20 თამაშზე მეტი პროგნოზი ვისაც აქვს
   * და გამოაქ მათი სტატისტიგა გამოცნობის % მაჩვენებლის მიხედვით დალაგებული
   *
   * @param
   * @return array
   */
  public function get_statistic_football_raiting_100(){

      $sql = "SELECT r.user_id,r.match_quantity,u.username
              FROM raiting_100 r
              JOIN users u ON u.id = r.user_id
              ORDER BY r.match_quantity DESC LIMIT 10";
              $query = $this->db->query($sql);

               if ($query->num_rows() == 0){
                      return false;
                }

              $users = $query->result_array();

              return $users;
  }

  /**
   * გამოაქ 5 მომხმარებლის თითო პროგნოზი ყველაზე დაბალ კოეფიციენტიანი
   * იმ მომხმარებლის ვისაც 3 თამაშზე მეტი პროგნოზი აქვს და ვისაც აქვს
   * 70% ზე მეტი გარტყმები
   *
   * @param
   * @return array
   */
  public function get_top_5_typsters(){

      // $sql = "SELECT r.user_id,u.username
      //         FROM raiting_top_5 r
      //         JOIN users u ON u.id = r.user_id
      //         ORDER BY r.won_percent DESC LIMIT 5";

      $sql = "SELECT r.user_id,f.*, u.username
              FROM raiting_top_5 r
              JOIN users u ON u.id = r.user_id
              JOIN forecasted_matches f ON f.user_id = r.user_id
              WHERE  r.won_percent > 70
               AND f.odd_value = (SELECT  MIN(f.odd_value) FROM forecasted_matches f WHERE f.user_id = r.user_id)
              AND  f.status = 0
              group by r.user_id
              ORDER BY r.won_percent DESC LIMIT 5";

              $query = $this->db->query($sql);
              // print_r($query->result_array());die;
               if ($query->num_rows() == 0){
                      return false;
                }

              $users = $query->result_array();
              // print_r($users);
             return $users;
  }


/**************************************************************************/

  /* სასურველია შედგომ ადმინ პანელის მოდელებშუ გავიდანო */
  /* დამაგენერირებელი ფუნცქიები */

  /**
   * გამოაქ 10 თამაშიდან 20 თამაში ვისაც აქვს პროგნოზირებული
   * და გამოაქ მათი სტატისტიგა გამოცნობის მიხედვით დალაგებული
   * და წერს ბაზაში
   * @param
   * @return array
   */
  public function to_forecast_football_10_to_20(){

    $sql0 = "SELECT id FROM users";
    $query1 = $this->db->query($sql0);
       if( $query1->num_rows() == 0){
               return;
         }
    $users = $query1->result_array();

    //$sql66 = "DELETE FROM raiting_10_to_20";
    // $this->db->query($sql66);
    $this->db->empty_table('raiting_10_to_20');

    for ($i=0; $i < count($users); $i++) {

          //  გამოვიტანოთ თითეული იუსერზე
          // 1) პროგნოზირებული მატჩების რაოდენობა match_count
          // 2) რამდენი აქ წარტმატებული (გარტყმული) პროგნოზი won_count
          $sql10 = "SELECT user_id, count(user_id) as match_count,
                    count(IF(`is_winner`=1,1,null)) as won_count
                    FROM forecasted_matches WHERE `user_id` = '".$users[$i]['id']."'";
          $query10 = $this->db->query($sql10);
          $datas = $query10->result_array();

          // თუ პროგნოზი ჯერ არ გაუკეთებია
          if($query10->num_rows() == 0){
              continue;
          }

          if($datas[0]['match_count'] == 0){
            continue;
          }

          if($datas[0]['won_count'] == 0){
            continue;
          }


          // გამოვარჩიოთ ისინი ვისაც 10 დან 20 მდე პროგნოზი აქ
          if($datas[0]['match_count'] > 10 && $datas[0]['match_count'] < 20){

            // გამოვთვალოთ რამდენი პროცენტული მაჩვვენებელი გარტყმების
            $procent = ($datas[0]['won_count'] / $datas[0]['match_count']) * 100;
            // რამდენი მატჩი აქვს წაგებული ანუ წარუმატებელი პროგნოზი
            $lost =  $datas[0]['match_count'] - $datas[0]['won_count'];

          $sql12 = "INSERT INTO raiting_10_to_20 (user_id,sport_id,won_percent,match_quantity,won,lost)
                    VALUES('".$users[$i]['id']."',10,'".$procent."','".$datas[0]['match_count']."',
                    '".$datas[0]['won_count']."','".$lost."')";
                $this->db->query($sql12);
          }
    }
 
  }


  /**
   * გამოაქ 20 თამაშიზე მეტი ვისაც აქვს პროგნოზირებული
   * და გამოაქ მათი სტატისტიგა გამოცნობის მიხედვით დალაგებული
   *
   * @param
   * @return array
   */
  public function to_forecast_football_over_20(){

    $sql0 = "SELECT id FROM users";
    $query1 = $this->db->query($sql0);
       if( $query1->num_rows() == 0){
               return;
         }
    $users = $query1->result_array();

    // $sql66 = "DELETE FROM raiting_over_20";
    // $this->db->query($sql66);
    $this->db->empty_table('raiting_over_20');


    for ($i=0; $i < count($users); $i++) {

          //  გამოვიტანოთ თითეული იუსერზე
          // 1) პროგნოზირებული მატჩების რაოდენობა match_count
          // 2) რამდენი აქ წარტმატებული (გარტყმული) პროგნოზი won_count
          $sql10 = "SELECT user_id, count(user_id) as match_count,
                    count(IF(`is_winner`=1,1,null)) as won_count
                    FROM forecasted_matches WHERE `user_id` = '".$users[$i]['id']."'";
          $query10 = $this->db->query($sql10);
          $datas = $query10->result_array();

          // თუ პროგნოზი ჯერ არ გაუკეთებია
          if($query10->num_rows() == 0){
              continue;
          }

          if($datas[0]['match_count'] == 0){
            continue;
          }


          if($datas[0]['won_count'] == 0){
            continue;
          }


          // გამოვარჩიოთ ისინი ვისაც 20 ზე მეტი პროგნოზი აქ გაკეთებული
          if($datas[0]['match_count'] > 20){

            // გამოვთვალოთ რამდენი პროცენტული მაჩვვენებელი გარტყმების
            $procent = ($datas[0]['won_count'] / $datas[0]['match_count']) * 100;
            // რამდენი მატჩი აქვს წაგებული ანუ წარუმატებელი პროგნოზი
            $lost =  $datas[0]['match_count'] - $datas[0]['won_count'];

          $sql12 = "INSERT INTO raiting_over_20 (user_id,sport_id,won_percent,match_quantity,won,lost)
                    VALUES('".$users[$i]['id']."',10,'".$procent."','".$datas[0]['match_count']."',
                    '".$datas[0]['won_count']."','".$lost."')";
                $this->db->query($sql12);
          }
    }
  }


  /**
   * გამოაქ ვისაც აქვს 100% პროგნოზი
   * და გამოაქ მათი სტატისტიგა გამოცნობის მიხედვით დალაგებული
   *
   * @param
   * @return array
   */
  public function to_forecast_football_raiting_100(){

    $sql0 = "SELECT id FROM users";
    $query1 = $this->db->query($sql0);
       if( $query1->num_rows() == 0){
               return;
         }
    $users = $query1->result_array();

    // $sql66 = "DELETE FROM raiting_100";
    // $this->db->query($sql66);
    $this->db->empty_table('raiting_100');


    for ($i=0; $i < count($users); $i++) {

          //  გამოვიტანოთ თითეული იუსერზე
          // 1) პროგნოზირებული მატჩების რაოდენობა match_count
          // 2) რამდენი აქ წარტმატებული (გარტყმული) პროგნოზი won_count
          $sql10 = "SELECT user_id, count(user_id) as match_count,
                    count(IF(`is_winner`=1,1,null)) as won_count
                    FROM forecasted_matches WHERE `user_id` = '".$users[$i]['id']."'";
          $query10 = $this->db->query($sql10);
          $datas = $query10->result_array();

          // თუ პროგნოზი ჯერ არ გაუკეთებია
          if($query10->num_rows() == 0){
              continue;
          }
          // თუ პროგნოზი ჯერ არ გაუკეთებია
          if($datas[0]['match_count'] == 0){
            continue;
          }


          if($datas[0]['won_count'] == 0){
            continue;
          }
          
          // გამოვარჩიოთ ისინი ვისაც 100%იანი პროგნოზი აქ გაკეთებული
          if($datas[0]['match_count'] == $datas[0]['won_count']){

          $sql12 = "INSERT INTO raiting_100 (user_id,sport_id,match_quantity)
                    VALUES('".$users[$i]['id']."',10,'".$datas[0]['match_count']."')";
                $this->db->query($sql12);
          }
    }
  }

  /**
   * აგენერირებს მომხმარებლების სტატისტიკას ვისაც აქვს 70% პროგნოზი
   * და 3 თამაშზე მეტი აქვს პროგნოზირებული
   * @param
   * @return array
   */
   public function best_5_tipsters_forecast(){

     $sql0 = "SELECT id FROM users";
     $query1 = $this->db->query($sql0);
        if( $query1->num_rows() == 0){
               return;
         }
     $users = $query1->result_array();

         $sql66 = "DELETE FROM raiting_top_5";
         $this->db->query($sql66);

     for ($i=0; $i < count($users); $i++) {

           //  გამოვიტანოთ თითეული იუსერზე
           // 1) პროგნოზირებული მატჩების რაოდენობა match_count
           // 2) რამდენი აქ წარტმატებული (გარტყმული) პროგნოზი won_count
           $sql10 = "SELECT user_id, count(user_id) as match_count,
                     count(IF(`is_winner`=1,1,null)) as won_count
                     FROM forecasted_matches WHERE `user_id` = '".$users[$i]['id']."'";
           $query10 = $this->db->query($sql10);
           $datas = $query10->result_array();

           // თუ პროგნოზი ჯერ არ გაუკეთებია
           if($query10->num_rows() == 0){
               continue;
           }

           if($datas[0]['match_count'] == 0){
             continue;
           }
           // გამოვარჩიოთ ისინი ვისაც 3 ზე მეტი პროგნოზი აქ გაკეთებული
           if($datas[0]['match_count'] > 3){

             // გამოვთვალოთ რამდენი პროცენტული მაჩვვენებელი გარტყმების
             $procent = ($datas[0]['won_count'] / $datas[0]['match_count']) * 100;
             // რამდენი მატჩი აქვს წაგებული ანუ წარუმატებელი პროგნოზი
             $lost =  $datas[0]['match_count'] - $datas[0]['won_count'];

              if($procent < 70){
                   continue;
              }

              // print_r($datas);
              // echo '<hr>tipsted : '.$users[$i]['id'].' - procent : '.$procent.' - count match : '.$datas[0]['match_count'].'<br>';
              // continue;

               $sql12 = "INSERT INTO raiting_top_5 (user_id,won_percent,match_quantity,won,lost)
                         VALUES('".$users[$i]['id']."','".$procent."','".$datas[0]['match_count']."',
                         '".$datas[0]['won_count']."','".$lost."')";
               $this->db->query($sql12);
           }
     }


   }


}
?>
