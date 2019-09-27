<?php

class Volleyball_result_model extends CI_Model {


  /**
   * პარსავს ფრენბურთის xml-ს და ბაზაში განაახლებს შედეგებს და
   * შეამოწმებს მომხმარებლის პროგნოზი გამართლდა თუ არა
   *
   * @param
   * @return array
   */
   public function check_volleyball_matches_result(){

     $url = "http://ad.interwetten.com/XMLFeeder/feeder.asmx/getfeed?FEEDPARAMS=EventResults|LANGUAGE=EN|KINDOFSPORTIDS=1012";
    //  $url = "vallybal_match_resultates.xml";

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


        for($k=0;$k < count($xmlstr->KINDOFSPORT->children());$k++){

         // echo $xmlstr->KINDOFSPORT->LEAGUE[$k]['NAME'].'<br>';
         for($i=0;$i < count($xmlstr->KINDOFSPORT->LEAGUE[$k]->children());$i++){

                  // echo $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['NAME'].'<br>';
                  //  echo $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['ID'].'<br>';
                  //  echo $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['RESULT'].'<br>';
                  //  echo $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['START_FROM'].'<hr>';
           $this->check_match_result( $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['ID'],
                                  $xmlstr->KINDOFSPORT->LEAGUE[$k]->EVENT[$i]['RESULT']);
                   // die;

         }
       }
   }



/* შეამოწმოს თითეული მატჩის შედეგი და ბაზაში განახლოს დაჯდა თუ არა პროგნოზი */
public function check_match_result($match_id = '',$match_result = ''){

    /*ზოგიერთი გადადებული მატჩის შედეგი ცარიელი მოდის*/
        if( $match_result == ' ' || empty($match_result)){
              return;
        }
        // მატჩის შედეგი დავშალოთ
        $matchResArr = explode(':',$match_result);
        // თუ ცარიელია შედეგები
        if(!isset($matchResArr[0]) && !isset($matchResArr[1])){
            return;
        }
        // თუ პირველმა მოიგო
        if( (int) $matchResArr[0] > (int) $matchResArr[1]){
             $odd_type = 'one';

          //  თუ მეორემ მოიგო
        }else{
             $odd_type = 'two';
        }

        $match_result_count = ( (int) $matchResArr[0] + (int) $matchResArr[1] );
        /* ბაზაში გნავაახლოთ თუ პროგნოზი გამართლდა
        თუარადა უბრალოდ ანგარიში და სტატუსი განახლდება */
      $sql = "UPDATE forecasted_matches
              SET is_winner = CASE
              WHEN (odd_type = 'over' AND under_over_value < $match_result_count)
                THEN 1
              WHEN (odd_type = 'under' AND under_over_value > $match_result_count)
                THEN 1
              WHEN odd_type = '".$odd_type."' THEN 1
                ELSE 0 END
              ,result = '".$match_result."', status = 1
              WHERE sport_id = 1012 AND xml_id = ".(int) $match_id." AND status = 0
              ";
          $query = $this->db->query($sql);
    }

}
?>
