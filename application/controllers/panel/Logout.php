<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

  /**
   *  მომხმარებლის ექაუნთიდან გამოსვლა
   *  ქუქის და სესიის წაშლა
   *
   * @param
   * @return
   */
  public function index(){

      $this->load->helper('cookie');
      delete_cookie('director');
      $this->session->sess_destroy();

      redirect('panel/login','refresh');

  }


}
?>
