<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site_advice_model extends CI_Model {

  /**
   * საიტი გირჩევთ" პროგნოზების გამოტანა
   *
   * @param
   * @return
   */
    public function site_advice_matches(){

        $sql = "SELECT * FROM site_advice_matches ORDER BY add_date DESC";
        $query = $this->db->query($sql);
          if ($query->num_rows() == 0){
                  return false;
          }
            return $query->result_array();
    }

}
?>
