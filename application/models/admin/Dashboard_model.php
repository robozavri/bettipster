<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {


  public function user_identification(){

        if(!empty($this->session->user_type)){

              return true;

        }elseif(empty($this->session->user_type) && !empty($this->input->cookie('user_type', TRUE))){

                $newdata = array(
                    'user_type' => $this->db->escape_str(strip_tags($this->input->cookie('user_type', TRUE))),
                    'user_id'   => abs( (int) $this->db->escape_str(strip_tags($this->input->cookie('user_id', TRUE)))),
                    'email'     => $this->db->escape_str(strip_tags($this->input->cookie('email', TRUE))),
                    'password'  => base64_decode($this->db->escape_str(strip_tags($this->input->cookie('password', TRUE)))),
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
