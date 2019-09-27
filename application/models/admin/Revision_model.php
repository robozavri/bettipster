<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Revision_model extends CI_Model {

  /**
   * შლის დუბლირებულ ბეისბოლის მატჩებს ბაზაში
   *
   * @param
   * @return
   */
  	public function delete_dublicate_baseball_matches(){


                    $sql="DELETE e1 FROM baseball_matches e1, baseball_matches e2 WHERE e1.match_name = e2.match_name AND e1.baseball_id > e2.baseball_id ";
            
                  $this->db->query($sql);
  	}

  /**
   * შლის დუბლირებულ ფეხბურთის მატჩებს ბაზაში
   *
   * @param
   * @return
   */
  	public function delete_dublicate_football_matches(){


                    $sql="DELETE e1 FROM football_matches e1, football_matches e2 WHERE e1.match_name = e2.match_name AND e1.fm_id > e2.fm_id ";
            
                  $this->db->query($sql);
  	}


  /**
   * შლის დუბლირებულ კალატბურთის მატჩებს ბაზაში
   *
   * @param
   * @return
   */
  	public function delete_dublicate_basketball_matches(){


                    $sql="DELETE e1 FROM basketball_matches e1, basketball_matches e2 WHERE e1.match_name = e2.match_name AND e1.basketball_id > e2.basketball_id ";
            
                  $this->db->query($sql);
  	}


  /**
   * შლის დუბლირებულ ჩოგბურთის მატჩებს ბაზაში
   *
   * @param
   * @return
   */
  	public function delete_dublicate_tennis_matches(){


                    $sql="DELETE e1 FROM tennis_matches e1, tennis_matches e2 WHERE e1.match_name = e2.match_name AND e1.tennis_id > e2.tennis_id ";
            
                  $this->db->query($sql);
  	}


  /**
   * შლის დუბლირებულ ჩოგბურთის მატჩებს ბაზაში
   *
   * @param
   * @return
   */
  	public function delete_dublicate_rugby_matches(){


                    $sql="DELETE e1 FROM rugby_matches e1,  rugby_matches e2 WHERE e1.match_name = e2.match_name AND e1.rugby_id > e2.rugby_id ";
            
                  $this->db->query($sql);
  	}


  /**
   * შლის დუბლირებულ ხოკეი მატჩებს ბაზაში
   *
   * @param
   * @return
   */
  	public function delete_dublicate_hockey_matches(){


                    $sql="DELETE e1 FROM hockey_matches e1,  hockey_matches e2 WHERE e1.match_name = e2.match_name AND e1.hockey_id > e2.hockey_id ";
            
                  $this->db->query($sql);
  	}



  /**
   * შლის დუბლირებულ მატჩებს ყველა სპორტის სახეობაში
   *
   * @param
   * @return
   */
  public function delete_all_dublicate_matches(){

  	  			$this->delete_dublicate_football_matches();

                $this->delete_dublicate_baseball_matches();

                $this->delete_dublicate_basketball_matches();

                $this->delete_dublicate_tennis_matches();

                $this->delete_dublicate_rugby_matches();

                $this->delete_dublicate_hockey_matches();
  }


}