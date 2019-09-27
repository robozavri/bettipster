<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Top_games_model extends CI_Model {



  /**
   * გამოაქ ტოპ თამაშები
   *
   * @param
   * @return
   */
   public function get_top_games(){


   		$query = $this->db->get('top_games');
 		
 		if ($query->num_rows() == 0){
 			return;
 		}

 		return $query->result_array();
		
		
		  // $sql = "SELECT t.*,
		  //   case when t.sport_table_name ='football_matches' then 'vax' end AS value
		   
		  // from top_games t
		  // left join football_matches as f ON t.xml_id = f.xml_id"; 
		  	
		 //  $sql = "
		 //  SELECT * from top_games 
		 //    left JOIN  rugby_matches  ON rugby_matches.xml_id = 
			//    ( case
			//     	when top_games.sport_table_name = 'rugby_matches'
			//     	then top_games.xml_id	
			//      END ) 
		 //   left JOIN  football_matches  ON football_matches.xml_id = 
			//    ( case
			//     	when top_games.sport_table_name = 'football_matches'
			//     	then top_games.xml_id	
			//      END )
			// left JOIN  basketball_matches  ON basketball_matches.xml_id = 
			//    ( case
			//     	when top_games.sport_table_name = 'basketball_matches'
			//     	then top_games.xml_id	
			//      END) 		
		 //  "; 
	  // $sql = "
	
   	
		 //    	 $sql = "
		 //   SELECT top_games.*, 

 		// CASE top_games.sport_table_name  
 		// 	WHEN 'rugby_matches' THEN (left JOIN  rugby_matches as rugby   ON  rugby.xml_id = top_games.xml_id)
 		// 	WHEN 'football_matches' THEN (left JOIN  football_matches  as ftbl ON  ftbl.xml_id = top_games.xml_id)
 		// 	END as 'sss'
 		// 	from top_games

		 //  "; 
 	// 	 $query = $this->db->query($sql);
 	// 	 	foreach ($query->result() as $row)
		// {
		//         // echo $row->title;
		// 	print_r($row);
		// }
   }

}
?>