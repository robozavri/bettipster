<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Leagues_model extends CI_Model {


  /**
   * 
   *
   * @param
   * @return
   */
  public function block_leagues(){


         foreach($_POST['league'] as $value) {

         	$data = explode('|', $value);
          
           if($data[1] == 0){
           	$sql = "UPDATE leagues SET  turn = 1 WHERE xml_league_id = ".abs((int)$data[0]);
           	$this->db->query($sql); 
           }     

			

    	}

  }

  /**
   * გამოაქ კონკრეტული სპორტის ლიგები
   *
   * @param
   * @return
   */
  	public function get_leagues_by_sport($sport_id = ''){

  	    $sql = "SELECT * FROM leagues WHERE xml_sport_id = '".$sport_id."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0){
             return false;
        }
        return $query->result_array();

  	}



  /**
   * გამოაქ  კონკრეტული ლიგა
   *
   * @param
   * @return
   */
   public function get_league_name($league_id){

        $sql = "SELECT * FROM leagues WHERE xml_league_id = '".$league_id."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0){
             return false;
        }
        return $query->result_array();

   }

  /**
   * გამოაქ ფეხბურთის ყველა ლიგა
   *
   * @param
   * @return
   */
  public function get_football_leagues()
  {

    // გამოაქ ლიგები და მათში არსებული ყველა მატჩის რაოდენობა
    /*
   $sql = "SELECT  DISTINCT f.leagues_id, count(f.leagues_id) as count_matchs, l.league_name
           FROM football_matches f
           JOIN leagues l
           ON l.xml_league_id = f.leagues_id
           GROUP BY l.league_name ASC
          ";
    */
  // გამოაქ ყველა ლიგა და მათში არსებული დღევანდელი მატჩების რაოდენობა
   $sql = "SELECT  f.leagues_id, l.xml_league_id,l.league_name,l.turn,f.start_date
           FROM football_matches f
           JOIN leagues l
           ON l.xml_league_id = f.leagues_id
           GROUP BY l.league_name ASC
          ";

    // $sql = "SELECT DISTINCT f.leagues_id, l.league_name
    //         FROM football_matches f
    //         JOIN leagues l
    //         ON l.xml_league_id = f.leagues_id
    //         ";

        $query = $this->db->query($sql);
        // print_r($query->result_array());
        // die;
        return $query->result_array();
  }

 /**
  *  გამოაქ ტენისის  ყველა ლიგა
  *
  * @param
  * @return
  */
  public function get_tennis_leagues(){

    $sql = "SELECT  DISTINCT f.leagues_id, count(case WHEN date(f.start_date) = CURDATE() then  f.leagues_id end ) as count_matchs, l.xml_league_id,l.league_name,l.turn
            FROM tennis_matches f
            JOIN leagues l
            ON l.xml_league_id = f.leagues_id
            GROUP BY l.league_name ASC
           ";

        $query = $this->db->query($sql);
        return $query->result_array();


  }

 /**
  *  გამოაქ კალათბურთის  ყველა ლიგა
  *
  * @param
  * @return
  */
  public function get_basketball_leagues(){

      $sql = "SELECT  DISTINCT f.leagues_id, count(case WHEN date(f.start_date) = CURDATE() then  f.leagues_id end ) as count_matchs, l.xml_league_id,l.league_name,l.turn
              FROM basketball_matches f
              JOIN leagues l
              ON l.xml_league_id = f.leagues_id
              GROUP BY l.league_name ASC
             ";

        $query = $this->db->query($sql);
        return $query->result_array();

  }

 /**
  *  გამოაქ ფრენბურთის  ყველა ლიგა
  *
  * @param
  * @return
  */
  public function get_valleyboll_leagues(){

    $sql = "SELECT  DISTINCT f.leagues_id, count(case WHEN date(f.start_date) = CURDATE() then  f.leagues_id end ) as count_matchs, l.xml_league_id,l.league_name,l.turn
            FROM volleyball_matches f
            JOIN leagues l
            ON l.xml_league_id = f.leagues_id
            GROUP BY l.league_name ASC
           ";

        $query = $this->db->query($sql);
        return $query->result_array();


  }

 /**
  *  გამოაქ ხელბურთს ყველა ლიგა
  *
  * @param
  * @return
  */
  public function get_handball_leagues(){

    $sql = "SELECT  DISTINCT f.leagues_id, count(case WHEN date(f.start_date) = CURDATE() then  f.leagues_id end ) as count_matchs, l.xml_league_id,l.league_name,l.turn
            FROM handball_matches f
            JOIN leagues l
            ON l.xml_league_id = f.leagues_id
            GROUP BY l.league_name ASC
           ";

        $query = $this->db->query($sql);
        return $query->result_array();


  }

 /**
  *  გამოაქ რაგბის ყველა ლიგა
  *
  * @param
  * @return
  */
  public function get_rugby_leagues(){

    $sql = "SELECT  DISTINCT f.leagues_id, count(case WHEN date(f.start_date) = CURDATE() then  f.leagues_id end ) as count_matchs, l.xml_league_id,l.league_name,l.turn
            FROM rugby_matches f
            JOIN leagues l
            ON l.xml_league_id = f.leagues_id
            GROUP BY l.league_name ASC
           ";

        $query = $this->db->query($sql);
        return $query->result_array();

  }

 /**
  *  გამოაქ ბეისბოლი ყველა ლიგა
  *
  * @param
  * @return
  */
  public function get_baseball_leagues(){

    $sql = "SELECT  DISTINCT f.leagues_id, count(case WHEN date(f.start_date) = CURDATE() then  f.leagues_id end ) as count_matchs, l.xml_league_id,l.league_name,l.turn
            FROM baseball_matches f
            JOIN leagues l
            ON l.xml_league_id = f.leagues_id
            GROUP BY l.league_name ASC
           ";

        $query = $this->db->query($sql);
        return $query->result_array();

  }

 /**
  *  გამოაქ ხოკეის ყველა ლიგა
  *
  * @param
  * @return
  */
  public function get_hockey_leagues(){

    $sql = "SELECT  DISTINCT f.leagues_id, count(case WHEN date(f.start_date) = CURDATE() then  f.leagues_id end ) as count_matchs, l.xml_league_id,l.league_name,l.turn
            FROM hockey_matches f
            JOIN leagues l
            ON l.xml_league_id = f.leagues_id
            GROUP BY l.league_name ASC
           ";

        $query = $this->db->query($sql);
        return $query->result_array();

  }

/********************   მატჩების გამოტანა ლიგის მიხედვით   *************************/

 /**
  *  გამოაქ ფეხბურთის  ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_football_matches($league_id)
 {
      $sql = "
      SELECT * FROM football_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }

 /**
  *  გამოაქ კალატბურთის  ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_basketball_matches($league_id)
 {
      $sql = "
      SELECT * FROM basketball_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }

 /**
  *  გამოაქ ბეისბოლის ლიგის ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_baseball_matches($league_id)
 {
      $sql = "
      SELECT * FROM baseball_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }

 /**
  *  გამოაქ ხელბურთის ლიგის ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_handball_matches($league_id)
 {
      $sql = "
      SELECT * FROM handball_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }

 /**
  *  გამოაქ ფრენბურთის ლიგის ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_valleyball_matches($league_id)
 {
      $sql = "
      SELECT * FROM volleyball_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }

 /**
  *  გამოაქ ტენისი,ჩოგბურთის ლიგის ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_tennis_matches($league_id)
 {
      $sql = "
      SELECT * FROM tennis_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }

 /**
  *  გამოაქ რაგბის ლიგის ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_rugby_matches($league_id)
 {
      $sql = "
      SELECT * FROM rugby_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }

 /**
  *  გამოაქ ხოკეის ლიგის ყველა თამაშის გამოტანა
  *
  * @param integer
  * @return array
  */
 public function get_hockey_matches($league_id)
 {
      $sql = "
      SELECT * FROM hockey_matches
      WHERE leagues_id = ".(int) $league_id." AND date(start_date) = CURDATE()";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0){
        return false;
      }
      return $query->result_array();

 }


}
