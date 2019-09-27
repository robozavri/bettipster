<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Average_model extends CI_Model {

  /**
   * კუშების ევერეიჯის დათვლა
   * 
   * @param
   * @return
   */
  	public function get_average_10_to_20(){

  		$sql = "
  	   SELECT r.user_id , u.username,
		count(r.user_id) as oddcount,
		sum( f.under_over_value) as tot ,
		sum( f.odd_value ) as odd_val,
		 AVG( f.under_over_value +  f.odd_value  ) as avarage
		FROM raiting_10_to_20  r
		JOIN forecasted_matches f ON  r.user_id = f.user_id
		JOIN users u ON u.id = r.user_id 
		GROUP BY u.username

  ";
  				$query = $this->db->query($sql);

  			if( $query->num_rows() == 0){
               return;
         	}
          return $query->result_array();
  	}

  /**
   * კუშების ევერეიჯის დათვლა
   *
   * @param
   * @return
   */
  	public function get_average_100 (){

  			$sql = "   
  		SELECT r.user_id , u.username,
		count(r.user_id) as oddcount,
		sum( f.under_over_value) as tot ,
		sum( f.odd_value ) as odd_val,
		 AVG( f.under_over_value +  f.odd_value  ) as avarage
		FROM raiting_100  r
		JOIN forecasted_matches f ON  r.user_id = f.user_id
		JOIN users u ON u.id = r.user_id 
		GROUP BY u.username";


  			$query = $this->db->query($sql);

  			if( $query->num_rows() == 0){
               return;
         	}
          return $query->result_array();
  	}

  	/**
   * კუშების ევერეიჯის დათვლა
   *
   * @param
   * @return
   */
  	public function get_average_over_20 (){

  			$sql = "
        SELECT r.user_id ,u.username,
		count(r.user_id) as oddcount,
		sum( f.under_over_value) as tot ,
		sum( f.odd_value ) as odd_val,
		 AVG( f.under_over_value +  f.odd_value  ) as avarage
		FROM raiting_over_20  r
		JOIN forecasted_matches f ON  r.user_id = f.user_id
		JOIN users u ON u.id = r.user_id 
		GROUP BY u.username
    ";


  // 		$sql = "
  // 		SELECT r1020.user_id ,
		// count(r1020.user_id) as alls,
		// sum( f.under_over_value) as tot ,
		// sum( f.odd_value ) as bais,
		// AVG( f.under_over_value +  f.odd_value  ) as jami
		// FROM raiting_10_to_20 r1020 
		// JOIN forecasted_matches f ON  r1020.user_id = f.user_id
  // ";
  				$query = $this->db->query($sql);

  			if( $query->num_rows() == 0){
               return;
         	}
          return $query->result_array();
  	}

}