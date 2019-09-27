<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accaunt extends General_Accaunt {


/**
 * გამოაქ მომხმარებლის პირადი სტატისტიკა მის ექაუნტში
 *
 * @param
 * @return
 */
  public function statistic()
  {
      $user_id = $this->session->userdata('user_id');

      $this->load->model('Profile_model');
      $this->load->model('Statistic_model');

      // $data['statistic'] = $this->Profile_model->get_user_statistic($user_id);
      $data['statistic']['matches'] = $this->Profile_model->get_user_matches($user_id);

      $data['statistic']['statistic_mini'] = $this->Statistic_model->particular_user_mini_statistic( $this->session->user_id);

      $data['user'] = $this->Profile_model->get_user_info($this->session->user_id);
      // ჩავტვირთოთ ენის ფაილი
      $this->lang->load('profile_lang',$this->session->userdata('language'));
      $this->lang->load('kind_sports_lang',$this->session->userdata('language'));

      $this->load->helper('odd_type_converter');
      $this->load->helper('kind_sport_cinverter_helper');
      $this->load->view('banners/left_banners_view');
      $this->load->view('accaunt_view',$data);
      $this->load->view('banners/right_banners_view');

  }


  /**
   * მომხმარებლის მიერ გმოწერილი მოხმარებლების პროგნოზების გვერდი
   *
   * @param
   * @return
   */
  public function followers(){

      $this->load->model('Follow_model');
      $this->load->model('Profile_model');
      $data['user'] = $this->Profile_model->get_user_info($this->session->user_id);

      // გამოვიტანოთ მომხმარებლის მიერ გამოწერილი მომხმარებლების პროგნოზები
      $data['users'] = $this->Follow_model->get_my_followers();

      // ჩავტვირთოთ ენის ფაილი
      $this->lang->load('user_lang',$this->session->userdata('language'));
      $this->load->view('banners/left_banners_view');
      $this->load->view('my_followers_view',$data);
      $this->load->view('banners/right_banners_view');
  }

  /**
   * ექაუნთის რედაქტირება
   * GET ის შემთხვევაში გვერდი გამოვუტანოთ სარედაქტირებისთვის
   * POST ის შემთხვევაში მოსული მონახემების ვალიდაცია შევამოწმო და
   * ბაზაში შევინახოთ
   * @param
   * @return
   */
   public function edit(){

        if($_SERVER['REQUEST_METHOD'] == 'GET'){

           $this->load->model('User_model');
           $data['profile'] = $this->User_model->get_user_profile();
           $data['avatars'] = $this->User_model->get_all_avatars();

           $this->load->model('Captcha_model');
           $data['captcha'] = $this->Captcha_model->captcha_create();
           $this->load->library('form_validation');
           $this->lang->load('accaunt_lang',$this->session->userdata('language'));
           $this->load->view('banners/left_banners_view');
           $this->load->view('my_accaunt_editing_view',$data);

           return;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

             $this->load->model('Rules_model');
             $this->load->library('form_validation');
             $this->form_validation->set_rules($this->Rules_model->profile_edit_rules);
             $this->load->model('User_model');
             // თუ მონაცემები ვალიდურია მაშინ დავარეგისტრიროთ
             if($this->form_validation->run()){
                 $data['condition'] = $this->User_model->user_profile_edit();
             }else{
                $data['condition'] = false;
             }
                 $data['profile'] = $this->User_model->get_user_profile();

                 $this->load->model('Captcha_model');
                 $data['avatars'] = $this->User_model->get_all_avatars();

                 $data['captcha'] = $this->Captcha_model->captcha_create();
                 $this->load->library('form_validation');
                 $this->lang->load('accaunt_lang',$this->session->userdata('language'));
                 $this->load->view('banners/left_banners_view');
                 $this->load->view('my_accaunt_editing_view',$data);
                 return;
      }


   }

  

 /**
  * მომხმარებლის ავატარის ატვირთვა
  *
  * @param
  * @return
  */
   public function upload_avatar(){
    return;
/*
<div class="text-center">
  <?php if(!empty($profile[0]['avatar'])) : ?>
  <img width="200" height="200" src="<?php echo base_url().'uploads/avatars/'.$profile[0]['avatar'];?>"  class="avatar img-circle" alt="avatar">
  <?php else:?>
  <img width="200" height="200" src="<?php echo base_url().'uploads/icons/100.png';?>"  class="avatar img-circle" alt="avatar">
<?php endif;?>
  <h6>Upload a different photo...</h6>
  <form class="" enctype="multipart/form-data"  action="<?php echo base_url('Accaunt/upload_avatar');?>" method="post">
        <input type="file" name="userfile" class="form-control">
        <p>
          <button type="submit" name="button" class="btn btn-primary">upload avatar</button>
        </p>
  </form>
  <p>
    <a  onclick="return confirm('Are you sure you want to delete user avatar ?');" class="btn btn-danger" href="<?php echo base_url('users/delete_avatar').'/'.$profile[0]['id'];?>">Delete avatar</a>
  </p>
</div>
*/
         $config['upload_path']   = './uploads/avatars/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['encrypt_name']  = TRUE;
         $config['max_size']      = 20000; // 1mb
         $config['remove_spaces'] = TRUE;

         $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload() ){

                 $error = array('error' => $this->upload->display_errors());
                //  print_r($error);
                 // თუ დამჭირდება გამვიტან შეტყობინებას
         }else{

                 // ატვირთული ფაილის ყველა მონაცემები
                 $data = $this->upload->data();
                 $avatar_data['avatar_title'] = $data['file_name'];
                 $avatar_data['user_id'] = $this->session->userdata('user_id');
                 $this->load->model('User_model');
                 $this->User_model->insert_avatar($avatar_data);
         }

         if (!empty($_SERVER['HTTP_REFERER'])){
             header("Location: ".$_SERVER['HTTP_REFERER']);
         }else{
             header("Location: ".base_url('Accaunt/edit'));
             // header("Location: ".'http://'.$_SERVER['SERVER_NAME']);
         }

   }

  // DISABLED FUNCTION გადავიტანე Profile კონტროლერში
  // public function my_forecast()
  // {
  //
  //   // ჩავტვირთოთ ჩვენი helper-ი
  //   $this->load->helper('odd_type_converter');
  //   $this->load->model('Forecast_model');
  //   $data['football_matches'] = $this->Forecast_model->get_my_football_forecast();
  //   // ჩავტვირთოთ ენის ფაილი
  //   $this->lang->load('accaunt_lang',$this->session->userdata('language'));
  //   $this->load->view('my_forecast_view',$data);
  //
  // }


}
?>
