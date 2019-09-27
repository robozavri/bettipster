<?php

class Forecast_Volleyball_model extends CI_Model {

   /**
    * ფრენბურთის მატჩის პროგნოზების გაკეთება
    *
    * @param
    * @return
    */
    public function to_forecast_Volleyball(){

      /*
      აქ შევამოწმო და გამოვიტანო უსერის შესახებ მონაცემები და შევამოწმო
       უფლებები, იქნებ დაბლოკილი იუსერია ან უფლება შეუზღუდეს და დადებული მატჩების ლიმიტი,
      ანუ ბეტ ლიმიტი რამდენზეა თუ 2 ზეა მაშინ არაფერიც არ ვქნა
      */
      $user_id = $this->session->userdata('user_id');
      if(empty($user_id)){
        die;
      }

      $sql0 = "SELECT id,bet_limit,bet_limit_date FROM users
               WHERE id = $user_id LIMIT 1";

      $query1 = $this->db->query($sql0);

      $users_row      = $query1->result_array();
      $user_id        = $users_row[0]['id'];
      $bet_limit      = $users_row[0]['bet_limit'];
      $bet_limit_date = $users_row[0]['bet_limit_date'];

      // date_default_timezone_set ('Asia/Tbilisi');

      // ბოლოს დადებული პროგნოზის დრო
      $date1 = new DateTime($bet_limit_date);
      // ამჟამინდელი დრო
      $date2 = new DateTime();
      // სხვაობა
      $interval = $date1->diff($date2);

      // ჩავტვირთოთ ენის ფაილი
      $this->lang->load('match_lang',$this->session->userdata('language'));

      // თუ ორი მატჩი დადებული აქ მაშინ კოდი გაჩერდეს
      if($bet_limit == 2){
        // ამ რიცხვში ამოეწურა თუ არა პროგნოზების ლიმიტი
          if($date1->format('d') == $date2->format('d')){
             // $jsonMessage[0]['message'] =  $this->lang->line('text_after_some_time').
                // $interval->h.$this->lang->line('text_hours');
                // echo json_encode($jsonMessage);
                $jsonMessage[0]['message'] =  $this->lang->line('text_after_24_match');
                $jsonMessage[0]['status'] = 0;
                echo json_encode($jsonMessage);
                return;
          }else{
                   $sql3 = "UPDATE users
                            SET bet_limit = 0
                            WHERE id = $user_id";
                            $this->db->query($sql3);
              }
      }

      // $matches_post_data = '10559534=2';
      // $matches_post_data = '10559533=X=123|10559534=2';
      // აქ გავფილტრო $_POST['matches']
      if(!isset($_POST['matches'])){
          // save hacker in log
          // $jsonMessage .= $this->lang->line('text_error').'matches ar mosula';
          // echo json_encode(array('message' => $jsonMessage));
          return;
      }

      $matches_post_data = $this->db->escape_str(strip_tags($this->input->post('matches', TRUE)));
      $matches_post_data =  !empty($matches_post_data) ? $matches_post_data : false ;
      $matches_post_data = $this->db->escape_str($matches_post_data);
      $matches = explode('|',$matches_post_data);

      $counter_matches = '';
      $jsonMessage = array();

      // თუ ორ მატჩზე მეტია მაშინ log ში შევინახოთ
      if(count($matches) > 2){
          // save hacker in log
          $counter_matches = 2;
      }else{
          $counter_matches = count($matches);
      }

      for($i=0;$i< $counter_matches ;$i++){

          $match = explode('=',$matches[$i]);

          // echo '<br>'.$match[0].'<br>';
          // echo '<br>'.$match[1].'<br>';
          // echo '<br>'.$match[2].'<br>';

              if( empty($match[0]) || empty($match[1]) ){
                  // save hacker in log
                  continue;
              }

              // !!!! აქ შემოწმდეს ვალიდაცია
            // ფსონების ტიპის, მონაცემთა ბაზის სვეტების სახელებად გარდაქმნა
            switch ($match[1]) {
              case '1':     $oddType = 'one';
                break;
              case '2':     $oddType = 'two';
                break;
              case 'over':  $oddType = 'over';
                  if(empty($match[2])){
                    // save hacker in log
                    continue;
                  }
                break;
              case 'under': $oddType = 'under';
                  if(empty($match[2])){
                    // save hacker in log
                    continue;
                  }
                break;
                default:
                // save hacker in log
                return;
                  break;

            }

              // მივიღოთ ამ მატჩებზე ინფორმაცია რაზეც პროგნოზი გააკეთა იუსერმა
              $sql = "SELECT xml_id,match_name,under_over_val,$oddType,start_date
                      FROM volleyball_matches
                      WHERE xml_id = '".(int) $match[0]."' LIMIT 1";
              $query2 = $this->db->query($sql);
              $result = $query2->result_array();

              if ($query2->num_rows() == 0){
                    // save hacker in log wrond match id
                    continue;
              }

              // $d1 = new DateTime($result[0]['start_date']);
              // $d2 = date('Y-m-d H:i:s');
              // print_r($d1);
              // print_r($d2);
              // შევადაროთ მატჩის დაწყების დრო ახლანდელ დროს და თუ დაწყებული არ არის
              // უსერს მივცეს საშვალება პროგნოზი გააკეთოს
              // თუ დაწყებულია გავაგზავნოთ შეტყობინება
              $matchStartData = strtotime($result[0]['start_date']);
              $now = time();
              // თუ მატჩი უკვე დაწყებულია ან დამთავრებულია
              if($matchStartData < $now){
                $jsonMessage[$i]['message'] = $result[0]['match_name'].' - '.$this->lang->line('text_match_was_started');
                // echo json_encode(array('message' => $jsonMessage));
                continue;
              }

              // მოწმდება რომ კოეფიციენტი არ იყოს 1.4 ზე დაბალი
              	if(floatval(str_replace(",",".",$result[0]["$oddType"])) <= 1.40){
                  // save hacker in log
                  continue;
                }

                // მივიღოთ ინფორმაცია ამ მატჩის შესახებ
                // რომ შემოწმდეს გაკეთებული აქ თუ არა პგოგნოზი ამ მატჩზე
                $sql_is_match = "SELECT id FROM forecasted_matches
                                 WHERE user_id = $user_id
                                 AND  xml_id = '".$result[0]['xml_id']."' ";
                $ismatchQuery = $this->db->query($sql_is_match);

                if ($ismatchQuery->num_rows() > 0){
                    // შეტყობინება რომ ამ მატჩზე პროგნოზი უკვე გაკეთებულია

                   $jsonMessage[$i]['message'] = $result[0]['match_name'].' - '.$this->lang->line('text_match_exists');
                   $jsonMessage[$i]['match'] = $result[0]['xml_id'];
                   $jsonMessage[$i]['status'] = 0;
                   continue;
                }

                // შევიტანოთ ბაზაში მომხმარებლის პროგნოზი
                  $sql2 = "INSERT INTO forecasted_matches (user_id,sport_id,xml_id,match_name,odd_type,under_over_value,odd_value,start_date)
                 VALUES($user_id,1012,'".$result[0]['xml_id']."','".$result[0]['match_name']."',
                 '".$oddType."','".floatval(str_replace(",",".",$result[0]['under_over_val']))."','".floatval(str_replace(",",".",$result[0][$oddType]))."','".$result[0]['start_date']."')";

                 $this->db->query($sql2);
                    // თუ იუზერის პროგნოზების რაოდენობა არ არის 2 მადე
                    // მაშინ მივცეთ პროგნოზის გაკეთების საშვალება

                 // ბოლო დადება დაიმახსოვროს
                  $sql3 = "UPDATE users
                  SET bet_limit = bet_limit + 1, bet_limit_date = NOW()
                  WHERE id = $user_id";
                  $this->db->query($sql3);

                 // შემოწმდეს რომ 24 საათში ერთხელ შეეძლოს ფსონის დადება
                 /*
                 1) დაემატოს უსერს ანგარიში იმის მიხედვით რამდენი მატჩიც დადო
                 2) მატჩის ლიმიტის დრო განახლდეს ბოლო დადებულ მატჩზე
                 და თუ მატჩის ლიმიტი 1 ის ტოლია მასინ დაიდოს მეორე მატჩი
                 ხოლო თუ 2 ის ტოლია მაშინ დაფიქსირდეს ბოლო დრო
                 და ყოველი ახალი გვერდის ბეთ გვერდის მიცემისას შევამოწმოთ
                 გავიდა თუ არა ბოლო დადებიდან 24 საათი
                 */
                 $jsonMessage[$i]['message'] = $result[0]['match_name'].' - '.$this->lang->line('text_match_forecast_success');
                 $jsonMessage[$i]['match'] = $result[0]['xml_id'];
                 $jsonMessage[$i]['status'] = 1;

    }// end of for
                //  $jsonMessage .= $this->lang->line('text_match_forecast_success');
                 echo json_encode($jsonMessage);
                //  print_r($jsonMessage);
                //  echo json_encode(array('message' => $jsonMessage));
                 return;



    }

}
?>
