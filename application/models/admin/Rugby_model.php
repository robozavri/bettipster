<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rugby_model extends CI_Model {

    public function rugby_matches_all_leagues(){


       $url = "http://ad.interwetten.com/XMLFeeder/feeder.asmx/getfeed?FEEDPARAMS=BettingOffers2|LANGUAGE=EN|KINDOFSPORTIDS=1003|OFFERTYPEIDS=13|LEAGUEIDS=";

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

           $this->db->query("DELETE FROM `rugby_matches` WHERE 1");

          for($k=0;$k < count($xmlstr->KINDOFSPORT->children());$k++){

           // echo $xmlstr->KINDOFSPORT->LEAGUE[$k]['NAME'].'<br>';
             for($i=0;$i < count($xmlstr->KINDOFSPORT->LEAGUE[$k]->children());$i++){
                     // $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME'];
//                      $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['START_TIME'];
//                      $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['EVENTID'];
                     $date = new DateTime( $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['START_TIME'].' +02');
                     $date->setTimezone(new DateTimeZone('Asia/Tbilisi'));

                    for($j=0;$j < count($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->children());$j++){
                           // $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TIP'];
//                            $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['QUOTE'];
//                            $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]->BET[$j]['TYPEID'];

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

                     if(!isset($quoteType[$i]['drow']) || $quoteType[$i]['drow'] == '-1,00'){
                       $quoteType[$i]['drow'] = '1,00';
                    }


                      $sql="
                         INSERT INTO rugby_matches (xml_id,leagues_id,match_name,one,two,drow,start_date)
                         VALUES('". $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['EVENTID']."',
                         '".$xmlstr->KINDOFSPORT->LEAGUE[$k]['ID']."',".$this->db->escape($xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME']).",
                         '".$quoteType[$i]['one']."','".$quoteType[$i]['two']."','".$quoteType[$i]['drow']."',
                         '".$date->format('Y-m-d H:i:s')."'
                         )
                         ";
                         $this->db->query($sql);
             }
          }

    }
}
?>
