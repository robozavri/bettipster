<?php

class Match_db_result_model extends CI_Model {
// gatishulia droebit
  /**
   *  სპორტის სახეობების გამოტანა რომლებშიც პროგნოზები გაკეთდა
   *  გამოაქ ყველა სპორტის სახეობის id რომლებშიც მომხმარებელმა პროგნოზი გააკეთა
   * @param
   * @return array
   */
   public function get_forecasted_sports(){
      $sql = "SELECT DISTINCT sport_id FROM forecasted_matches";
      $query = $this->db->query($sql);

        if ($query->num_rows() == 0){
          return;
        }
        return $query->result_array();
   }

  /**
   * პარსავს xml-ს და გამოაქ ყველა მატჩის შედეგი ყველა მასივად გადაცემული სპორტის
   * სახეობიდან
   *
   * @param
   * @return
   */
   public function parse_xml_matches_results($sports){
     $string = '';
    //  print_r($sports);
     foreach ($sports as $sport) {
       $string .= $sport['sport_id'].',';
     }
      trim($string, ",");
     $url = "http://ad.interwetten.com/XMLFeeder/feeder.asmx/getfeed?FEEDPARAMS=EventResults|LANGUAGE=EN|KINDOFSPORTIDS=$string";

     $xmlstr = simplexml_load_file('sportmatchesresults.xml') or die("Unable to open file!");
     // $xmlstr = simplexml_load_file($url) or die("Unable to open file!");

     $childs = count( $xmlstr->children());

      if(empty($childs)){
           return;
      }

      for($k=0;$k < count($xmlstr->children());$k++){

      //  echo '<hr><h4>'.$xmlstr->KINDOFSPORT[$k]['NAME'].'</h4><br>';
      //  echo 'League  name : <b>'.$xmlstr->KINDOFSPORT[$k]->LEAGUE[$k]['NAME'].'</b><br><br>';
       for($i=0;$i < count($xmlstr->KINDOFSPORT[$k]->children());$i++){

          // echo '<br> League  name : <b>'.$xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]['NAME'].'</b><br><br>';
          for ($j=0; $j <  count($xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->children()); $j++) {

          //  echo  ' match  name : <i>'.$xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['NAME'].'</i><br>';
          //        echo $xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['ID'].'<br>';
          //        echo $xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['RESULT'].'<br>';
          //        echo $xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['START_FROM'].'<br>';
                 $date = new DateTime( $xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['START_FROM'].' +02');
                 $date->setTimezone(new DateTimeZone('Asia/Tbilisi'));

                 $sql = "INSERT INTO forecasted_matches_results
                        (sport_name,league_name,match_name,match_xml_id,match_result,started_from)
                        VALUES('".$xmlstr->KINDOFSPORT[$k]['NAME']."',
                               '".$xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]['NAME']."',
                               '".$this->db->escape_str($xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['NAME'])."',
                               '".$xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['ID']."',
                               '".$xmlstr->KINDOFSPORT[$k]->LEAGUE[$i]->EVENT[$j]['RESULT']."',
                               '".$date->format('Y-m-d H:i:s')."')";
                 $query = $this->db->query($sql);

         }
       }
     }
   }


   /**
    * ამოწმებს ბაზაში შენახული ფეხბურთის მატჩების შედეგების მიხედვით
    * მომხმარებლელთა საფეხბურთო პროგნოზებს. ვინ გაარტყა დ ავინ არა
    *
    * @param
    * @return array
    */
    public function check_forecasted_football_matches_result(){

           $sql = "SELECT match_xml_id,match_result FROM forecasted_matches_results WHERE sport_name = 'Football' ";
             $query = $this->db->query($sql);
             if ($query->num_rows() == 0){
                     return false;
             }
              $data = $query->result_array();

          foreach ($data as $value) {

                 // მატჩის შედეგი დავშალოთ
                 $matchResArr = explode(':',$value['match_result']);
                 // თუ ცარიელია შედეგები
                 if(!isset($matchResArr[0]) && !isset($matchResArr[1])){
                     continue;
                 }
                 // თუ პირველმა მოიგო
                 if( (int) $matchResArr[0] > (int) $matchResArr[1]){
                      $odd_type = 'one';

                   // თუ ყაიმია, ნიჩია
                 }elseif((int) $matchResArr[0] == (int) $matchResArr[1]){
                      $odd_type = 'drow';

                      // თუ მეორემ მოიგო
                 }else{
                      $odd_type = 'two';
                 }

                 // მეტი დაჯდა თუ ნაკლები ბურთების რაოდენობა
                 if( ( (int) $matchResArr[0] + (int) $matchResArr[1]) > 2){
                        $odd_type = 'over';
                 }else{
                        $odd_type = 'under';
                 }

                 /* ბაზაში გნავაახლოთ თუ პროგნოზი გამართლდა
                 თუარადა უბრალოდ ანგარიში და სტატუსი განახლდება */
               $sql = "UPDATE forecasted_matches
                       SET is_winner = CASE WHEN odd_type = '".$odd_type."'
                       THEN 1 ELSE 0 END
                       ,result = '".$match_result."', status = 1
                       WHERE xml_id = ".(int) $value['match_xml_id']."
                       ";
               $query = $this->db->query($sql);

         }

    }



   /**
    * ამოწმებს ბაზაში შენახული კალათბურთის მატჩების შედეგების მიხედვით
    * მომხმარებლელთა კალათბურთის პროგნოზებს. ვინ გაარტყა დ ავინ არა
    *
    * @param
    * @return array
    */
    public function check_forecasted_basketball_matches_result(){

           $sql = "SELECT match_xml_id,match_result FROM forecasted_matches_results WHERE sport_name = 'Basketball' ";
             $query = $this->db->query($sql);
             if ($query->num_rows() == 0){
                     return false;
             }
              $data = $query->result_array();
print_r($data);die;


    }

}
?>
