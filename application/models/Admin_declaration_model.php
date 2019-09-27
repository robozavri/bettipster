<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_declaration_model extends CI_Model {

  /**
   * გამოაქ ადმინისტრატორის მიერ გაკეთებული განცხადება
   *
   * @param string (date)
   * @return string (converted date)
   */
	public function show_message(){

			$sql = " SELECT * FROM admin_declaration group by data_create order by data_create desc limit 1;";

			$query = $this->db->query($sql);
      
         return  $query->result();
  
	}
}
