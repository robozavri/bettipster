<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tennis_model extends CI_Model {



  public function tenis_matches_all_leagues(){

    $url = "http://ad.interwetten.com/XMLFeeder/feeder.asmx/getfeed?FEEDPARAMS=BettingOffers2|LANGUAGE=EN|KINDOFSPORTIDS=11|OFFERTYPEIDS=13,9905388|LEAGUEIDS=";
        $over_under_array = array();

        try {
           $xmlstr = @simplexml_load_file($url);
           if(!$xmlstr || empty($xmlstr)){
              throw new Exception("ფაილი $url არ არსებობს ან არ ჩაიტვირთა | ".__FILE__.' on line : '.__LINE__);
           }
         }
         catch (Exception $e) {

             log_message('error', $e->getMessage());
             return;
         }

       $childs = count( $xmlstr->children());

       if(empty($childs)){
            return;
       }

       $this->db->query("DELETE FROM `tennis_matches` WHERE 1");

       for($k=0;$k < count($xmlstr->KINDOFSPORT->children());$k++){

        // echo $xmlstr->KINDOFSPORT->LEAGUE[$k]['NAME'].'<br>';
          for($i=0;$i < count($xmlstr->KINDOFSPORT->LEAGUE[$k]->children());$i++){
                  // $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME'];
//                      $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['START_TIME'];
//                      $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['EVENTID'];
                  $date = new DateTime( $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['START_TIME'].' +02');
                  $date->setTimezone(new DateTimeZone('Asia/Tbilisi'));
                  $n = 0;
                  $l = 0;

                 for($j=0;$j < count($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->children());$j++){
                       //  $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TIP'];
//                            $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'];
//                            $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TYPEID'];

                     switch($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TIP']){
                         case '1':
                         $quoteType[$i]['one'] = !empty($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE']) ? $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'] :0.00;
                         break;
                         case '2':
                         $quoteType[$i]['two'] = !empty($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE']) ? $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'] :0.00;
                         break;
                      }

                      // მეტი და ნაკლების კოეფიციენტები და მაჩვენებლის გადარჩევა
                      if($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TYPEID'] == '9905388'){

                             if(stristr($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['PLAYER2'], 'Over')){

                                  $add_str_arr = explode(' ',$xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['PLAYER2']);
                                  $over_under_array['over']['average'][$n] = $add_str_arr[1];
                                  $over_under_array['over']['oddval'][$n] = (string) $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'];
                                  $n++;
                              }elseif(stristr($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['PLAYER2'], 'Under')){

                                  $add_str_arr = explode(' ',$xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['PLAYER2']);
                                  $over_under_array['Under']['average'][$l] = $add_str_arr[1];
                                  $over_under_array['Under']['oddval'][$l] = (string) $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'];
                                  $l++;
                              }
                      }
                 }

            /* შევამოწმოთ ზოგიერთს საერთოდ არ აქვს 1 ან 2 თავისი კოეფიციენტით ან კიდე
             * -1.00 ია. თუ არ აქვს ჩვენ ჩავუწეროთ.
             */

              if(!isset($quoteType[$i]['one']) || $quoteType[$i]['one'] == '-1,00'){
               $quoteType[$i]['one'] = '1,00';
              }

              if(!isset($quoteType[$i]['two']) || $quoteType[$i]['two'] == '-1,00'){
                 $quoteType[$i]['two'] = '1,00';
              }

                 if(empty($over_under_array)){
                   $sql="
                      INSERT INTO tennis_matches (xml_id,leagues_id,match_name,one,two,start_date)
                      VALUES('". $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['EVENTID']."',
                      '".$xmlstr->KINDOFSPORT->LEAGUE[$k]['ID']."',".$this->db->escape($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME']).",
                      '".$quoteType[$i]['one']."','".$quoteType[$i]['two']."','".$date->format('Y-m-d H:i:s')."'
                      )
                      ";
                          $this->db->query($sql);
                          continue;
                 }

                   $over = [];

                   for ($b=0; $b < count($over_under_array['over']['average']); $b++) {

                       if($over_under_array['over']['oddval'][$b] != '-1,00'){

                         $over['average'] = $over_under_array['over']['average'][$b];
                         $over['oddval']  = $over_under_array['over']['oddval'][$b];

                       }
                   }

                   $under = [];

                   for ($t=0; $t < count($over_under_array['Under']['average']); $t++) {

                       if($over_under_array['Under']['oddval'][$t] !== '-1,00'){

                           $under['average'] = $over_under_array['Under']['average'][$t];
                           $under['oddval']  = $over_under_array['Under']['oddval'][$t];
                       }
                   }

      /* შევამოწმოთ ზოგიერთს საერთოდ არ აქვს 1 ან 2 თავისი კოეფიციენტით ან კიდე
             * -1.00 ია. თუ არ აქვს ჩვენ ჩავუწეროთ.
             */
                 if(!isset( $over['average']) ||  $over['average'] == '-1,00' ||  $over['average'] == ''){
                    $over['average'] = '1,00';
                 }        
                 if(!isset($over['oddval']) || $over['oddval'] == '-1,00' || $over['oddval'] == ''){
                   $over['oddval'] = '1,00';
                 }         
                if(!isset($under['oddval']) || $under['oddval'] == '-1,00' || $under['oddval'] == ''){
                   $under['oddval'] = '1,00';
                 }

                     $sql="
                        INSERT INTO tennis_matches (xml_id,leagues_id,match_name,one,two,under_over_val,over,under,start_date)
                        VALUES('". $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['EVENTID']."',
                        '".$xmlstr->KINDOFSPORT->LEAGUE[$k]['ID']."',".$this->db->escape($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME']).",
                        '".$quoteType[$i]['one']."','".$quoteType[$i]['two']."','".($over['average'] )."','".$over['oddval']."','".$under['oddval']."',
                        '".$date->format('Y-m-d H:i:s')."'
                        )
                        ";
                        $this->db->query($sql);
          }
       }

     } // end function


}
?>
