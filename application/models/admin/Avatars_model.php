<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Avatars_model extends CI_Model {

  /**
   * ავატარების ბაზაში დამატება, ავატარების ბანკში
   *
   * @param
   * @return
   */
  public function insert_avatars_in_db($avatar_data = ''){

  		$sql = "INSERT INTO avatars_bank (avatar_name) VALUE('".$avatar_data."')";

  		$this->db->query($sql);
  } 


  /**
   *ყველა არსებული ავატარების გამოტანა
   *
   * @param
   * @return
   */
  public function get_all_avatars(){

  		
  		$this->db->order_by('avatars_bank_id', 'DESC');
  		// $this->db->order_by('avatars_bank_id', 'ASC');
  		$query = $this->db->get('avatars_bank');
  		
  		 if ($query->num_rows() == 0){
             return false;
        }
        $data['avatars'] = $query->result_array();

        return $data['avatars'];
  }

}
?>