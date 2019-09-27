<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_xml_model extends CI_Model {

  /**
   * გაპარსავს და ამოიღებს ყველა ლიგას ჩვენთვის საჭირო სპორტებისას
   * სპორტისას და შეიტანს ბაზაში
   *
   * @param
   * @return
   */
   public function parse_and_save_xml_leagues($sport_id){

     $url = "http://ad.interwetten.com/XMLFeeder/feeder.asmx/getfeed?FEEDPARAMS=ValidLeagues|LANGUAGE=EN|KINDOFSPORTIDS=$sport_id";

         $xmlstr = simplexml_load_file($url) or die("Unable to open file!");
         $childs = count( $xmlstr->children());

        if(empty($childs)){
             return;
        }

         $this->db->query("DELETE FROM `leagues` WHERE 1");
      for ($i=0; $i < count($xmlstr->KINDOFSPORT); $i++) {
          for($k=0;$k < count($xmlstr->KINDOFSPORT[$i]->children());$k++){
           $sql = "INSERT INTO leagues (xml_sport_id,xml_league_id,	league_name)
                   VALUES('".$xmlstr->KINDOFSPORT[$i]['ID']."',
                          '".$xmlstr->KINDOFSPORT[$i]->LEAGUE[$k]['ID']."',
                          '".$xmlstr->KINDOFSPORT[$i]->LEAGUE[$k]['NAME']."')";
              $this->db->query($sql);
          }
      }
   }
}
?>
