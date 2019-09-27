<?php

class Forecast_model extends CI_Model {

   /**
    * ბოლოს დამატებული ახალი პროგნოზების გამოტანა
    *
    * @param
    * @return
    */
    public function get_last_forecasts(){

        $sql = "SELECT f.*,u.id,u.username FROM forecasted_matches f
                JOIN users u ON u.id = f.user_id
                ORDER BY add_date DESC LIMIT 20";
        $query = $this->db->query($sql);

          if ($query->num_rows() == 0){
            return;
          }
          return $query->result_array();

    }

}
?>
