<?php

class Forecast_tennis_model extends CI_Model {

   /**
    * ტენისის მატჩის პროგნოზების გაკეთება
    *
    * @param
    * @return
    */
    public function to_forecast_tennis(){


      $user_id = $this->session->userdata('admin_user_id');
      if(empty($user_id)){
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' admin_user_id ცარიელია სესიაში function to_forecast_tennis() | '.__FILE__.' on line : '.__LINE__);
        die;
      }
      // ჩავტვირთოთ ენის ფაილი
      $this->lang->load('match_lang',$this->session->userdata('language'));

      // $matches_post_data = '10559534=2';
      // $matches_post_data = '10559533=X|10559534=2';
      // აქ გავფილტრო $_POST['matches']
      // მოწმდება მოსულია თუ არა და ცარიელი ხომ არ არის მატჩის პორგნოზები
      if(!isset($_POST['matches']) || empty($_POST['matches']) ){
          log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელის მხრიდან  $_POST[matches] ცარიელი მოვიდა function to_forecast_tennis() | '.__FILE__.' on line : '.__LINE__);
          die;
      }

      $matches_post_data = trim($this->db->escape_str(strip_tags($this->input->post('matches', TRUE))),'|');
      $matches_post_data =  !empty($matches_post_data) ? $matches_post_data : false ;
      $matches_post_data = $this->db->escape_str($matches_post_data);
      $matches = explode('|',$matches_post_data);

      $jsonMessage = array();

      for($i=0;$i< count($matches) ;$i++){

          $match = explode('=',$matches[$i]);

          // მოწმდება ნამდვილად ორივე მონაცემი გვაქ თუ არა (მატჩის იდენთიფიკატორი და პროგნოზის ტიპი)
          if( count($match) != 2 ){
                log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელის მხრიდან ერთზე მეტი გამყოფი = იქნა გამოგზავნილი function to_basketball_football() | '.__FILE__.' on line : '.__LINE__);
                die;
          }

          // მოწმდება ცარიელი ხომ არ არის მატჩის იდენთიფიკატორი და ფსონის ტიპი
          if(empty($match[0]) || empty($match[1])){
              log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელის მხრიდან ცარიელი მოვიდა ან მატჩის xml_id ან პროგნოზის ტიპი function to_basketball_football() | '.__FILE__.' on line : '.__LINE__);
              die;
          }

          // მოწმდება მატჩის იდენთიფიკატორი რიცხვი არის თუ არა
          if( !filter_var($match[0], FILTER_VALIDATE_INT) ){
              log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->admin_user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, მატჩის იდენტიფიკატორი რიცხვი უნდა იყოს function to_basketball_football() | '.__FILE__.' on line : '.__LINE__);
              die();
          }

            // ფსონების ტიპის, მონაცემთა ბაზის სვეტების სახელებად გარდაქმნა
            switch ($match[1]) {
              case '1':     $oddType = 'one';
                break;
              case '2':     $oddType = 'two';
                break;
              case 'over':  $oddType = 'over';
                break;
              case 'under': $oddType = 'under';
                break;
                default:
                log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->admin_user_id.'] პარამეტრი : '.$match[1].' რომელიც არ შეესაბამება აქ ჩამოთვლილებს (1 X 2 over under) function to_basketball_football() | '.__FILE__.' on line : '.__LINE__);
                die;
                  break;

            }

              // მივიღოთ ამ მატჩებზე ინფორმაცია რაზეც პროგნოზი გააკეთა იუსერმა
              $sql = "SELECT xml_id,match_name,under_over_val,$oddType,start_date
                      FROM tennis_matches
                      WHERE xml_id = '".(int) $match[0]."' LIMIT 1";
              $query2 = $this->db->query($sql);
              $result = $query2->result_array();

              if ($query2->num_rows() == 0){
                    log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->admin_user_id.'] ასეთი მატჩი არ არსებობს  function to_forecast_tennis() | '.__FILE__.' on line : '.__LINE__);
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
                $sql_is_match = "SELECT id FROM site_advice_matches
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
                  $sql2 = "INSERT INTO site_advice_matches (user_id,sport_id,xml_id,match_name,odd_type,under_over_value,odd_value,add_date)
                 VALUES($user_id,11,'".$result[0]['xml_id']."','".$result[0]['match_name']."',
                 '".$oddType."','".$result[0]['under_over_val']."','".$result[0][$oddType]."','".$result[0]['start_date']."')";

                 $this->db->query($sql2);

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
