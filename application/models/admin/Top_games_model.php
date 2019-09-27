<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Top_games_model extends CI_Model {


  /**
   * ტოპ თამაშების ბაზაში შენახვა
   *
   * @param
   * @return
   */ 
  public function get_top_games(){

       $sql = "SELECT * FROM top_games ORDER BY start_date DESC";
        $query = $this->db->query($sql);
          if ($query->num_rows() == 0){
                  return false;
          }
            return $query->result_array();
  }




   	/**
	 * ტოპ თამაშების ბაზაში შენახვა
	 *
	 * @param
	 * @return
	 */
	public function save_top_games($sport_id = ''){
		
       
           $this->lang->load('match_lang',$this->session->userdata('language'));

           // $matches_post_data = '10559534=2';
           // $matches_post_data = '10559533=X|10559534=2';

           // მოწმდება მოსულია თუ არა და ცარიელი ხომ არ არის მატჩის პორგნოზები
           if(!isset($_POST['matches']) || empty($_POST['matches']) ){

               log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელის მხრიდან  $_POST[matches] ცარიელი მოვიდა function save_top_games() | '.__FILE__.' on line : '.__LINE__);
               die;
           }


           $matches_post_data = trim($this->db->escape_str(strip_tags($this->input->post('matches', TRUE))),'|');

           $matches = explode('|',$matches_post_data);
	
           $jsonMessage = array();

          for($i=0; $i< count($matches); $i++){

              // მოწმდება ცარიელი ხომ არ არის მატჩის იდენთიფიკატორი და ფსონის ტიპი
              if(empty($matches[$i])){
                  log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' მომხმარებელის მხრიდან ცარიელი მოვიდა მატჩის xml_id function save_top_games() | '.__FILE__.' on line : '.__LINE__);
                  die;
              }

              // მოწმდება მატჩის იდენთიფიკატორი რიცხვი არის თუ არა
              if( !filter_var($matches[$i], FILTER_VALIDATE_INT) ){
                  log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.'] მომხმარებელმა არავალიდური მონაცემი გადასცა, მატჩის იდენტიფიკატორი რიცხვი უნდა იყოს function save_top_games() | '.__FILE__.' on line : '.__LINE__);
                  die();
              }

              $sport_xml_id = null;
              $sport_table_name = null;

                switch ($sport_id) {
                    case 1:
			           $sport_table_name = 'football_matches';
			           $sport_xml_id = 10;
			           break;
			         case 2:
			           $sport_table_name = 'baseball_matches';
			           $sport_xml_id = 14;
			           break;
			         case 3:
			           $sport_table_name = 'basketball_matches';
			           $sport_xml_id = 15;
			           break;
			         case 4:
			           $sport_table_name = 'tennis_matches';
			           $sport_xml_id = 11;
			           break;
			         case 5:
			           $sport_table_name = 'rugby_matches';
			           $sport_xml_id = 1003;
			           break;
			         case 6:
			           $sport_table_name = 'hockey_matches';
			           $sport_xml_id = 40;
			           break;
                }

                  // მივიღოთ ამ მატჩებზე ინფორმაცია რაზეც პროგნოზი გააკეთა იუსერმა
                  $sql = "SELECT * FROM $sport_table_name
                          WHERE xml_id = '".(int) $matches[$i]."' LIMIT 1";
                  $query2 = $this->db->query($sql);
                  $result = $query2->result_array();

                  if ($query2->num_rows() == 0){
                    log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' user id = ['.$this->session->user_id.' მომხმარებლის ტიპი '.$this->session->user_type.'] ასეთი მატჩი არ არსებობს  function save_top_games() | '.__FILE__.' on line : '.__LINE__);
                        continue;
                  }

                  // $d1 = new DateTime($result[0]['start_date']);
                  // $d2 = date('Y-m-d H:i:s');
                  // print_r($d1);
                  // print_r($d2);
                  /*
                  შევადაროთ მატჩის დაწყების დრო ახლანდელ დროს და თუ დაწყებული არ არის
                  უსერს მივცეს საშვალება პროგნოზი გააკეთოს
                  თუ დაწყებულია გავაგზავნოთ შეტყობინება
                  */
                  $matchStartData = strtotime($result[0]['start_date']);
                  $now = time();
                  // თუ მატჩი უკვე დაწყებულია ან დამთავრებულია
                  if($matchStartData < $now){
                    $jsonMessage[$i]['message'] = $result[0]['match_name'].' - '.$this->lang->line('text_match_was_started');
                    // echo json_encode(array('message' => $jsonMessage));
                    continue;
                  }
              

                    $sql_is_match = "SELECT * FROM top_games
                                     WHERE xml_id = '".$result[0]['xml_id']."' ";
                    $ismatchQuery = $this->db->query($sql_is_match);


                    if ($ismatchQuery->num_rows() > 0){
                        // შეტყობინება რომ ამ მატჩზე პროგნოზი უკვე გაკეთებულია
                        $jsonMessage[$i]['message'] = $result[0]['match_name'].' - '.$this->lang->line('text_top_match_exists');
                        $jsonMessage[$i]['match'] = $result[0]['xml_id'];
                        $jsonMessage[$i]['status'] = 0;
                        continue;
                    }

                
                    // შევიტანოთ ბაზაში მომხმარებლის პროგნოზი
                      $sql2 = "INSERT INTO top_games (
                      xml_id,
                      kind_sport_id,
                      leagues_id,
                      sport_table_name,
                      match_name,
                      start_date)
                     VALUES('".$result[0]['xml_id']."',
                     '".$sport_xml_id."',
                     '".$result[0]['leagues_id']."',
                     '".$sport_table_name."',
                     '".$result[0]['match_name']."',
                     '".$result[0]['start_date']."')";
                     $this->db->query($sql2);


                     $jsonMessage[$i]['message'] = $result[0]['match_name'].' '.$this->lang->line('text_succes_saved');
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