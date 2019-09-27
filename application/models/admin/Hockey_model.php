<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hockey_model extends CI_Model {

     public function hockey_matches_all_leagues(){

       $url = "http://ad.interwetten.com/XMLFeeder/feeder.asmx/getfeed?FEEDPARAMS=BettingOffers2|LANGUAGE=EN|KINDOFSPORTIDS=40|OFFERTYPEIDS=13,9905356|LEAGUEIDS=";

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

           $this->db->query("DELETE FROM `hockey_matches` WHERE 1");

          for($k=0;$k < count($xmlstr->KINDOFSPORT->children());$k++){

           // echo $xmlstr->KINDOFSPORT->LEAGUE[$k]['NAME'].'<br>';
             for($i=0;$i < count($xmlstr->KINDOFSPORT->LEAGUE[$k]->children());$i++){
                    //  $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME'];
//                      $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['START_TIME'];
                    //  echo $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['EVENTID'];
                     $date = new DateTime( $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['START_TIME'].' +02');
                     $date->setTimezone(new DateTimeZone('Asia/Tbilisi'));

                    for($j=0;$j < count($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->children());$j++){
                          //  echo '<br> TIP -'.$xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TIP'];
                          //  echo '<br> QUOTE - '.$xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'];
                          //  echo '<br> TYPEID - '.$xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TYPEID'].'<br>';

                            switch($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TIP']){
                                case '1':
                                $quoteType[$i]['one'] = !empty($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE']) ? $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'] :0.00;
                                break;
                                case '2':
                                $quoteType[$i]['two'] = !empty($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE']) ? $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'] :0.00;
                                break;
                                case 'X':
                                $quoteType[$i]['drow'] = !empty($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE']) ? $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'] :0.00;
                                break;
                                // default: $quoteType[$i]['one'] = '0,00'; $quoteType[$i]['two'] = '0,00' ;  $quoteType[$i]['drow'] = '0,00';
                                // break;
                             }

                             switch ($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['PLAYER2']) {
                               case '0-5':
                                  $quoteType[$i]['under'] = !empty($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE']) ? $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'] :'0,00';
                                 break;
                               case '6 or more':
                                  $quoteType[$i]['over'] = !empty($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE']) ? $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'] :'0,00';
                                 break;
                                //  default  : $quoteType[$i]['under'] = '0,00'; $quoteType[$i]['over'] = '0,00';
                                //  break;
                             }

                    }

                             /* შევამოწმოთ ზოგიერთს საერთოდ არ აქვს 1 ან 2 თავისი კოეფიციენტით ან კიდე
             * -1.00 ია. თუ არ აქვს ჩვენ ჩავუწეროთ.
             */

              if(!isset( $quoteType[$i]['under']) || $quoteType[$i]['under'] == '-1,00'){ 
                $quoteType[$i]['under'] = '1,00';
              }
              
              if(!isset( $quoteType[$i]['over']) || $quoteType[$i]['over'] == '-1,00'){ 
                 $quoteType[$i]['over'] = '1,00';
              }

              if(!isset( $quoteType[$i]['drow']) || $quoteType[$i]['drow'] == '-1,00'){ 
                $quoteType[$i]['drow'] = '1,00';
              }

              if(!isset($quoteType[$i]['one']) || $quoteType[$i]['one'] == '-1,00'){
               $quoteType[$i]['one'] = '1,00';
              }

              if(!isset($quoteType[$i]['two']) || $quoteType[$i]['two'] == '-1,00'){
                 $quoteType[$i]['two'] = '1,00';
              }

                      $sql="
                         INSERT INTO hockey_matches (xml_id,leagues_id,match_name,one,two,drow,under,over,start_date)
                         VALUES('". $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['EVENTID']."',
                         '".$xmlstr->KINDOFSPORT->LEAGUE[$k]['ID']."',".$this->db->escape($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME']).",
                         '".$quoteType[$i]['one']."','".$quoteType[$i]['two']."','".$quoteType[$i]['drow']."','".$quoteType[$i]['under']."','".$quoteType[$i]['over']."',
                         '".$date->format('Y-m-d H:i:s')."'
                         )
                         ";
                        $this->db->query($sql);
             }
          }

        } // end function

}
?>
