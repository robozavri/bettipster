<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notiflication_model extends CI_Model {


/**
 *
 *
 * @param
 * @return
 */
 public function chat_notisfication(){

     $user_id = $this->session->user_id;
     $sql = "SELECT COUNT(id) as notiflic_count
             FROM chat
             WHERE to_user_id = $user_id AND readed = 0";

     $query = $this->db->query($sql);

     if ($query->num_rows() == 0){
          return false;
     }
     // print_r($query->row('notiflic_count'));
     // die;
     return $query->row('notiflic_count');

 }

 }
 ?>
