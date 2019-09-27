<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tests_model extends CI_Model {


  /**
   *  გამოიტანს უსერებს და გააკეთებინებს პროგნოზებს და იქვე
   *  გამოთვლის გაარტყა თუ არა პროგნოზი და შეიტანს ბაზაში
   *  ფეხბურტის თვის დააგენერირებს
   *
   * @param
   * @return
   */
  public function random_to_forecast_football($counter = 10){

      // $sqlD = "DELETE FROM forecasted_matches";
      // $this->db->query($sqlD);

      $sql0 = "SELECT id FROM users LIMIT $counter";
      $query1 = $this->db->query($sql0);
      if( $query1->num_rows() == 0){
               return;
         }
      $users = $query1->result_array();

      // $sql8 = "SELECT * FROM football_matches LIMIT $counter";
      // $sql8 = "SELECT * FROM football_matches WHERE RAND() LIMIT 3";
      // $query3 = $this->db->query($sql8);
      // $football_matches = $query3->result_array();
      $typeOdd = array('one','two','drow','under','over');
      //  echo $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];

      // რამდენი იუზერის არის იმდენჯერ დაემატოს პროგნოზი
       for ($j=0; $j < $counter; $j++) {

           $limit_value = rand(4,10);

           $sql8 = "SELECT * FROM football_matches WHERE RAND() LIMIT $limit_value";

           $query3 = $this->db->query($sql8);

           $football_matches = $query3->result_array();

           for ($i=0; $i < $limit_value; $i++) {

             $one =  rand(0,7);
             $two =  rand(0,7);
             $Match_rand_result = $one.'-'.$two;

             $oddType = $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];
             $is_winner = 0;

             if( ($one > $two)    && $oddType == 'one'){$is_winner = 1;}
             if( ($one < $two)    && $oddType == 'two'){$is_winner = 1;}
             if( ($one == $two)   && $oddType == 'drow'){$is_winner = 1;}
             if( ($one+$two) > 2.5  && $oddType == 'over'){$is_winner = 1;}
             if( ($one+$two) < 2.5  && $oddType == 'under'){$is_winner = 1;}
            //  switch ($oddType) {
            //    case   'one':  if($one > $two){$is_winner = 1;};
            //      break;
            //    case   'two':  if($one < $two){$is_winner = 1;};
            //      break;
            //    case  'drow':  if($one == $two){$is_winner = 1;};
            //      break;
            //    case  'over':  if( ($one+$two) > 3){$is_winner = 1;};
            //      break;
            //    case 'under':  if(($one+$two) < 3){$is_winner = 1;};
            //      break;
            //  }

            // $arrayName = array(40, 10 ,14, 15, 1003, 11, 1012 ,1002);
            // $rand_sport_id = $arrayName[array_rand($arrayName)];

             $sql2 = "INSERT INTO forecasted_matches (user_id,sport_id,xml_id,match_name,odd_type,odd_value,start_date,result,status,is_winner)
             VALUES('".$users[$j]['id']."',10,'".$football_matches[$i]['xml_id']."','".$football_matches[$i]['match_name']."',
             '".$oddType."','".$football_matches[$i][$oddType]."','".$football_matches[$i]['start_date']."','".$Match_rand_result."',1,'".$is_winner."')";
             $this->db->query($sql2);
           }
         }
      }


    /**
     *  გამოიტანს უსერებს და გააკეთებინებს პროგნოზებს და იქვე
     *  გამოთვლის გაარტყა თუ არა პროგნოზი და შეიტანს ბაზაში
     *  ჰოკეი თვის დააგენერირებს
     *
     * @param
     * @return
     */
    public function random_to_forecast_hockey($counter = 10){

        // $sqlD = "DELETE FROM forecasted_matches";
        // $this->db->query($sqlD);

        $sql0 = "SELECT id FROM users LIMIT $counter";
        $query1 = $this->db->query($sql0);
         if( $query1->num_rows() == 0){
               return;
         }
        $users = $query1->result_array();

        // $sql8 = "SELECT * FROM football_matches LIMIT $counter";
        // $sql8 = "SELECT * FROM football_matches WHERE RAND() LIMIT 3";
        // $query3 = $this->db->query($sql8);
        // $football_matches = $query3->result_array();
        $typeOdd = array('one','two','drow','under','over');
        //  echo $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];

        // რამდენი იუზერის არის იმდენჯერ დაემატოს პროგნოზი
         for ($j=0; $j < $counter; $j++) {

               $limit_value = rand(4,10);
               $sql8 = "SELECT * FROM hockey_matches WHERE RAND() LIMIT $limit_value";
               $query3 = $this->db->query($sql8);
                if($query3->num_rows() == 0 || empty($query3->result_array())){
                 continue;

             }
             $football_matches = $query3->result_array();

             if(count($football_matches) < $limit_value){
                  continue;
             }
            
             for ($i=0; $i < $limit_value; $i++) {
               $one =  rand(0,10);
               $two =  rand(0,10);
               $Match_rand_result = $one.'-'.$two;

               $oddType = $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];
               $is_winner = 0;
               if( ($one > $two)    && $oddType == 'one'){$is_winner = 1;}
               if( ($one < $two)    && $oddType == 'two'){$is_winner = 1;}
               if( ($one == $two)   && $oddType == 'drow'){$is_winner = 1;}
               if( ($one+$two) > 5.5  && $oddType == 'over'){$is_winner = 1;}
               if( ($one+$two) < 5.5  && $oddType == 'under'){$is_winner = 1;}

               $sql2 = "INSERT INTO forecasted_matches (user_id,sport_id,xml_id,match_name,odd_type,odd_value,start_date,result,status,is_winner)
               VALUES('".$users[$j]['id']."',40,'".$football_matches[$i]['xml_id']."','".$football_matches[$i]['match_name']."',
               '".$oddType."','".$football_matches[$i][$oddType]."','".$football_matches[$i]['start_date']."','".$Match_rand_result."',1,'".$is_winner."')";
               $this->db->query($sql2);
             }
           }
        }


    /**
     *  გამოიტანს უსერებს და გააკეთებინებს პროგნოზებს და იქვე
     *  გამოთვლის გაარტყა თუ არა პროგნოზი და შეიტანს ბაზაში
     *  რაგბის თვის დააგენერირებს
     *
     * @param
     * @return
     */
    public function random_to_forecast_rugby($counter = 10){

        // $sqlD = "DELETE FROM forecasted_matches";
        // $this->db->query($sqlD);

        $sql0 = "SELECT id FROM users LIMIT $counter";
        $query1 = $this->db->query($sql0);
        if( $query1->num_rows() == 0){
               return;
         }
        $users = $query1->result_array();

        // $sql8 = "SELECT * FROM football_matches LIMIT $counter";
        // $sql8 = "SELECT * FROM football_matches WHERE RAND() LIMIT 3";
        // $query3 = $this->db->query($sql8);
        // $football_matches = $query3->result_array();
        $typeOdd = array('one','two','drow');
        //  echo $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];

        // რამდენი იუზერის არის იმდენჯერ დაემატოს პროგნოზი
         for ($j=0; $j < $counter; $j++) {
             $limit_value = rand(4,10);
             $sql8 = "SELECT * FROM rugby_matches WHERE RAND() LIMIT $limit_value";
             $query3 = $this->db->query($sql8);
                if($query3->num_rows() == 0 || empty($query3->result_array())){
                 continue;

             }
             $football_matches = $query3->result_array();

             if(count($football_matches) < $limit_value){
                  continue;
             }

             for ($i=0; $i < $limit_value; $i++) {
               $one =  rand(10,60);
               $two =  rand(10,60);
               $Match_rand_result = $one.'-'.$two;

               $oddType = $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];
               $is_winner = 0;
               if( ($one > $two)    && $oddType == 'one'){$is_winner = 1;}
               if( ($one < $two)    && $oddType == 'two'){$is_winner = 1;}
               if( ($one == $two)   && $oddType == 'drow'){$is_winner = 1;}

               $sql2 = "INSERT INTO forecasted_matches (user_id,sport_id,xml_id,match_name,odd_type,odd_value,start_date,result,status,is_winner)
               VALUES('".$users[$j]['id']."',1003,'".$football_matches[$i]['xml_id']."','".$football_matches[$i]['match_name']."',
               '".$oddType."','".$football_matches[$i][$oddType]."','".$football_matches[$i]['start_date']."','".$Match_rand_result."',1,'".$is_winner."')";
               $this->db->query($sql2);
             }
           }
        }


      /**
       *  გამოიტანს უსერებს და გააკეთებინებს პროგნოზებს და იქვე
       *  გამოთვლის გაარტყა თუ არა პროგნოზი და შეიტანს ბაზაში
       *  კალატბურთისთვის თვის დააგენერირებს
       *
       * @param
       * @return
       */
      public function random_to_forecast_basketball($counter = 10){


          $sql0 = "SELECT id FROM users LIMIT $counter";
          $query1 = $this->db->query($sql0);
          if( $query1->num_rows() == 0){
               return;
         }
          $users = $query1->result_array();

          // $sql8 = "SELECT * FROM football_matches LIMIT $counter";
          // $sql8 = "SELECT * FROM football_matches WHERE RAND() LIMIT 3";
          // $query3 = $this->db->query($sql8);
          // $football_matches = $query3->result_array();
          $typeOdd = array('one','two','under','over');
          //  echo $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];

          // რამდენი იუზერის არის იმდენჯერ დაემატოს პროგნოზი
           for ($j=0; $j < $counter; $j++) {
               $limit_value = rand(4,10);
               $sql8 = "SELECT * FROM basketball_matches WHERE RAND() LIMIT $limit_value";
               $query3 = $this->db->query($sql8);
                  if($query3->num_rows() == 0 || empty($query3->result_array())){
                 continue;

             }
             $football_matches = $query3->result_array();

             if(count($football_matches) < $limit_value){
                  continue;
             }

               for ($i=0; $i < $limit_value; $i++) {
                 $one =  rand(50,130);
                 $two =  rand(50,130);
                 if($one == $two){continue;}
                 $Match_rand_result = $one.'-'.$two;

                 $oddType = $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];
                 $is_winner = 0;
                 if( ($one > $two)    && $oddType == 'one'){$is_winner = 1;}
                 if( ($one < $two)    && $oddType == 'two'){$is_winner = 1;}
                 if( ($one+$two) > $football_matches[$i]['under_over_val']  && $oddType == 'over'){$is_winner = 1;}
                 if( ($one+$two) < $football_matches[$i]['under_over_val']  && $oddType == 'under'){$is_winner = 1;}

                // $arrayName = array(40, 10 ,14, 15, 1003, 11, 1012 ,1002);
                // $rand_sport_id = $arrayName[array_rand($arrayName)];

                 $sql2 = "INSERT INTO forecasted_matches (user_id,sport_id,xml_id,match_name,odd_type,under_over_value,odd_value,start_date,result,status,is_winner)
                 VALUES('".$users[$j]['id']."',15,'".$football_matches[$i]['xml_id']."','".$this->db->escape_str($football_matches[$i]['match_name'])."',
                 '".$oddType."','".$football_matches[$i]['under_over_val']."','".$football_matches[$i][$oddType]."','".$football_matches[$i]['start_date']."','".$Match_rand_result."',1,'".$is_winner."')";
                 $this->db->query($sql2);
               }
             }
          }


  /**
   *  გამოიტანს უსერებს და გააკეთებინებს პროგნოზებს და იქვე
   *  გამოთვლის გაარტყა თუ არა პროგნოზი და შეიტანს ბაზაში
   *  ჩოგბურთისთვს თვის დააგენერირებს
   *
   * @param
   * @return
   */
  public function random_to_forecast_tennis($counter = 10){


      $sql0 = "SELECT id FROM users LIMIT $counter";
      $query1 = $this->db->query($sql0);
      if( $query1->num_rows() == 0){
               return;
         }
      $users = $query1->result_array();

      // $sql8 = "SELECT * FROM football_matches LIMIT $counter";
      // $sql8 = "SELECT * FROM football_matches WHERE RAND() LIMIT 3";
      // $query3 = $this->db->query($sql8);
      // $football_matches = $query3->result_array();
      $typeOdd = array('one','two');
      // $typeOdd = array('one','two','under','over');
      //  echo $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];

      // რამდენი იუზერის არის იმდენჯერ დაემატოს პროგნოზი
       for ($j=0; $j < $counter; $j++) {
           $limit_value = rand(4,10);
           $sql8 = "SELECT * FROM tennis_matches WHERE RAND() LIMIT $limit_value";
           $query3 = $this->db->query($sql8);
              if($query3->num_rows() == 0 || empty($query3->result_array())){
                 continue;

             }
             $football_matches = $query3->result_array();

             if(count($football_matches) < $limit_value){
                  continue;
             }

           for ($i=0; $i < $limit_value; $i++) {
             $one =  rand(0,2);
             $two =  rand(0,2);
             if($one == $two){continue;}
             $Match_rand_result = $one.'-'.$two;

             $oddType = $typeOdd[mt_rand(0, sizeof($typeOdd) - 1)];
             $is_winner = 0;
             if( ($one > $two)    && $oddType == 'one'){$is_winner = 1;}
             if( ($one < $two)    && $oddType == 'two'){$is_winner = 1;}
            //  if( ($one+$two) > $football_matches[$i]['under_over_val']  && $oddType == 'over'){$is_winner = 1;}
            //  if( ($one+$two) < $football_matches[$i]['under_over_val']  && $oddType == 'under'){$is_winner = 1;}

            // $arrayName = array(40, 10 ,14, 15, 1003, 11, 1012 ,1002);
            // $rand_sport_id = $arrayName[array_rand($arrayName)];

             $sql2 = "INSERT INTO forecasted_matches (user_id,sport_id,xml_id,match_name,odd_type,odd_value,start_date,result,status,is_winner)
             VALUES('".$users[$j]['id']."',11,'".$football_matches[$i]['xml_id']."','".$football_matches[$i]['match_name']."',
             '".$oddType."','".$football_matches[$i][$oddType]."','".$football_matches[$i]['start_date']."','".$Match_rand_result."',1,'".$is_winner."')";
             $this->db->query($sql2);
           }
         }
      }

 /**
  * შემთხვევით დაგენერირებული იუსერებით ბაზის შევსება
  *
  * @param
  * @return
  */
  public function registr_random_users($countter_users = 70)
  {
     $this->load->helper('generator');
     $this->load->helper('names_generate');
    //  $name_arr = names_generate();
    //  print_r($name_arr);
    //  echo email_generator();
    $this->db->empty_table('users');

     for ($i=0; $i < $countter_users; $i++)
     {
            $name_arr = names_generate();
            $pass = rand_string_generator();
            $data['username'] = $name_arr['name'];
            // $data['full_name'] = $name_arr['full_name'];
            $data['user_group'] = 2;
            $data['email'] = email_generator();
            $data['password'] = password_hash($pass, PASSWORD_DEFAULT);
            $data['is_active'] = 1;
            $data['activation_code'] = $pass;
            // $data['avatar'] = '100.png';
            $this->db->insert('users',$data);

     }
  }
}
?>
