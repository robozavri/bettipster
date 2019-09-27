<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_Leagues extends CI_Controller {

  function __construct() {
      parent::__construct();

      // $user_id = $this->session->userdata('user_id');
      if(empty($this->session->user_type) || $this->session->user_type != 'admin' ){
        // save hacker in log
        die;
      }
  }


  /**
   * ლიგების გათიშვა/დაბლოკვა
   *
   * @param
   * @return
   */
    public function unblock_leagues($id = ''){


    	if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
          log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().' id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function unblock_leagues() | '.__FILE__.' on line : '.__LINE__);
          show_404();
          return;
        }

           $leaguesid = $this->db->escape_str(strip_tags($this->input->post('leaguesid', TRUE)));
			$sql = "UPDATE leagues SET  turn = 0 WHERE xml_league_id = ".abs((int)$leaguesid);
			$this->db->query($sql); 
    	
	}

}

