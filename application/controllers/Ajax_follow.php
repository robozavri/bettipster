<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_follow extends CI_Controller {

  function __construct() {
      parent::__construct();

      // $user_id = $this->session->userdata('user_id');
      if(empty($this->session->user_id)){
        // save hacker in log
        show_404();
        die();
      }
  }


  /**
   *  მომხმარებლის მიერ მეორე მომხმარებლის გამოწერა Follow
   *
   * @param
   * @return
   */
  public function follow()
  {

      if($_SERVER['REQUEST_METHOD'] != 'POST')
      {
        log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function follow() | '.__FILE__.' on line : '.__LINE__);
        show_404();
        die;
      }

      $this->load->model('Follow_model');
      $this->Follow_model->add_follow();

  }


    /**
     * მომხმარებლის მიერ მეორე მომხმარებლის გამოწერის გაუქმება unfollow
     *
     * @param
     * @return
     */
    public function unfollow()
    {

        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
          log_message('error', '[security] მომხმარებელი IP : '.$this->input->ip_address().'user id = ['.$this->session->user_id.'] POST ის ნაცვლად GET ით გამოიძახა  function unfollow() | '.__FILE__.' on line : '.__LINE__);
          show_404();
          die;
        }

        $this->load->model('Follow_model');
        $this->Follow_model->unfollow();

    }

}
?>
