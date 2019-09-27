<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast_model extends CI_Model {

   /**
   * გამოაქ ყველაზე პოპულარული მატჩები რომელსაც პროგნოზირებენ
   *
   * @param
   * @return
   */
   public function popular_matches(){

         $sql = "SELECT *,COUNT(*) AS total FROM `forecasted_matches` GROUP BY `xml_id` ORDER BY total DESC LIMIT 10";
        $query = $this->db->query($sql);
          if ($query->num_rows() == 0){
                  return false;
          }
            return $query->result_array();
   }


  /**
   * "საიტი გირჩევთ" პროგნოზების გამოტანა
   *
   * @param
   * @return
   */
    public function site_advice_football_matches(){

        $sql = "SELECT * FROM site_bet_football_matches";
        $query = $this->db->query($sql);
          if ($query->num_rows() == 0){
                  return false;
          }
            return $query->result_array();
    }

     /* მატჩის პროგნოზების გაკეთება */
     /**
      *
      *
      * @param
      * @return
      */
      public function to_forecast_football(){

          /*
          აქ შევამოწმო და გამოვიტანო უსერის შესახებ მონაცემები და შევამოწმო
           უფლებები, იქნებ დაბლოკილი იუსერია ან უფლება შეუზღუდეს და დადებული მატჩების ლიმიტი,
          ანუ ბეტ ლიმიტი რამდენზეა თუ 2 ზეა მაშინ არაფერიც არ ვქნა
          */
          $user_id = $this->session->userdata('user_id');
          // if(empty($user_id)){
          //   die;
          // }

          // $matches_post_data = '10559534=2';
          // $matches_post_data = '10559533=X|10559534=2';
          // აქ გავფილტრო $_POST['matches']
          if(!isset($_POST['matches'])){
              // save hacker in log
              // $jsonMessage .= $this->lang->line('text_error');
              // echo json_encode(array('message' => $jsonMessage));
              return;
          }
          // $matches_post_data = $this->db->escape_str(strip_tags($this->input->post('matches', TRUE)));
          // $matches_post_data =  !empty($matches_post_data) ? $matches_post_data : false ;
          // $matches = json_decode($matches_post_data);

          // $matches = json_decode({"1":"10582506=1","2" => "10582198=X","2" : "10582199=X"});
          $matches = json_decode($this->input->post('matches', TRUE));
          // print_r($matches);
          // die;

          $jsonMessage = '';

          for($i=0;$i< count($matches);$i++){

              $match = explode('=',$matches[$i]);
              // echo '<br>'.$match[0].'<br>';
              // echo '<br>'.$match[1].'<br>';
                  if(empty($match[0]) || empty($match[1])){
                      // save hacker in log
                      continue;
                  }
                  // !!!! აქ შემოწმდეს ვალიდაცია
                // ფსონების ტიპის, მონაცემთა ბაზის სვეტების სახელებად გარდაქმნა
                switch ($match[1]) {
                  case '1':     $oddType = 'one';
                    break;
                  case 'X':     $oddType = 'drow';
                    break;
                  case '2':     $oddType = 'two';
                    break;
                  case 'over':  $oddType = 'over';
                    break;
                  case 'under': $oddType = 'under';
                    break;
                    default:
                    // save hacker in log
                    return;
                      break;

                }

                  // მივიღოთ ამ მატჩებზე ინფორმაცია რაზეც პროგნოზი გააკეთა იუსერმა
                  $sql = "SELECT xml_id,match_name,$oddType,start_date
                          FROM football_matches
                          WHERE xml_id = '".(int) $match[0]."' LIMIT 1";
                  $query2 = $this->db->query($sql);
                  $result = $query2->result_array();

                  if ($query2->num_rows() == 0){
                        // save hacker in log wrond match id
                        continue;
                  }

                  // ჩავტვირთოთ ენის ფაილი
                  $this->lang->load('match_lang',$this->session->userdata('language'));
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

                    $jsonMessage .= $result[0]['match_name'].' - მატჩი უკვე დაწყებულია ან მორჩენილია';
                    // echo json_encode(array('message' => $jsonMessage));
                    continue;

                  }

                    $sql_is_match = "SELECT id FROM site_bet_football_matches
                                     WHERE user_id = $user_id
                                     AND  xml_id = '".$result[0]['xml_id']."' ";
                    $ismatchQuery = $this->db->query($sql_is_match);

                    if ($ismatchQuery->num_rows() > 0){
                        // შეტყობინება რომ ამ მატჩზე პროგნოზი უკვე გაკეთებულია
                       $jsonMessage .= $result[0]['match_name'].' - '.$this->lang->line('text_match_exists');
                       continue;
                    }

                    // შევიტანოთ ბაზაში მომხმარებლის პროგნოზი
                      $sql2 = "INSERT INTO site_bet_football_matches (user_id,xml_id,match_name,odd_type,odd_value)
                     VALUES($user_id,'".$result[0]['xml_id']."','".$result[0]['match_name']."',
                     '".$oddType."','".$result[0][$oddType]."')";
                     $this->db->query($sql2);

        }// end of for
                     $jsonMessage .= $this->lang->line('text_match_forecast_success');
                     echo json_encode(array('message' => $jsonMessage));
                     return;
      }// end of function to_forecast_football


}
?>
