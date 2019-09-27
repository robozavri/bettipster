<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Security_model extends CI_Model {


  public function user_identification(){

        if($this->session->user_type == 'admin' && $this->session->logged_in == TRUE){

              return true;

        }elseif(!empty($this->input->cookie('user_type', TRUE))){

                $newdata = array(
                    'user_type' => $this->db->escape_str(strip_tags($this->input->cookie('user_type', TRUE))),
                    'admin_user_id' => 1,
                    // 'admin_user_id'   => abs( (int) $this->db->escape_str(strip_tags($this->input->cookie('user_id', TRUE)))),
                    'admin_email'     => $this->db->escape_str(strip_tags($this->input->cookie('email', TRUE))),
                    'admin_password'  => base64_decode($this->db->escape_str(strip_tags($this->input->cookie('password', TRUE)))),
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($newdata);
                return true;
        }else{
                $newdata = array('logged_in' => FALSE);
                $this->session->set_userdata($newdata);
                return false;
        }
      }


}
?>
