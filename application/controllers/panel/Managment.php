<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managment extends Admin_Controller {

  function __construct() {
      parent::__construct();

  }

  /**
   *
   *
   * @param
   * @return
   */
   public function index(){

        //  $this->load->model('admin/Dashboard_model');
        //  $this->load->model('admin/Basketball_model');
        //  $this->Basketball_model->basketball_matches_all_leagues();
        //  if(!$this->Dashboard_model->login()){
        //    return;
        //  } 
      

      $this->load->model('admin/Chat_model');
      $this->load->model('admin/Forecast_model');
      $data['spammers'] = $this->Chat_model->get_spamers();
      $data['popular_matches'] = $this->Forecast_model->popular_matches();
      
      $this->lang->load('kind_sports_lang',$this->session->userdata('language'));
      $this->load->helper('kind_sport_cinverter_helper');

      $this->lang->load('admin_dashboard_lang', $this->session->userdata('language'));
      $this->load->view('admin/admin_dashboard_view',$data);
   }


   /**
    * საიტი გირჩევთ ის ძველი მატჩების წაშლა რომლებიც ან დაწყებლია ან დამთავრებულია
    * და არააქტუალურია  
    * @param
    * @return
    */
    public function delete_old_advised_matches(){

      $this->db->query("DELETE FROM `site_advice_matches` WHERE `add_date` < NOW()");
        $this->index();
    }





   /**
    * ამოწმებს გაკეთებული მატჩების პროვნოზების შედეგებს
    * პარსავს xml-ს და ყველა დადებული სპორტის სახეობის პროგნოზებს
    * ბაზაში ინახავს და შემდეგ სათითაოდ მოწმდება თითეული სპორტის სახეობის მატჩების
    * შედეგები
    *
    * @param
    * @return
    */
     public function check_forecasted_matches_results($sport_id = ''){

        switch ($sport_id) {
         case 1:
           $this->load->model('admin/match_result/Footbal_results_model');
           $this->Footbal_results_model->check_footbal_matches_result();
           break;
         case 2:
            $this->load->model('admin/match_result/Baseball_result_model');
            $this->Baseball_result_model->check_baseball_matches_result();
           break;
         case 3:
           $this->load->model('admin/match_result/Basketball_result_model');
           $this->Basketball_result_model->check_basketball_matches_result();
           break;
         case 4:
            $this->load->model('admin/match_result/Tennis_result_model');
            $this->Tennis_result_model->check_tennis_matches_result();
            break;
         case 5:
           $this->load->model('admin/match_result/Rugby_result_model');
           $this->Rugby_result_model->check_rugby_matches_result();
           break;
         case 6:
           $this->load->model('admin/match_result/Hockey_result_model');
           $this->Hockey_result_model->check_hockey_matches_result();
           break;
         default:

            $this->load->model('admin/match_result/Footbal_results_model');
            $this->Footbal_results_model->check_footbal_matches_result();
            $this->load->model('admin/match_result/Baseball_result_model');
            $this->Baseball_result_model->check_baseball_matches_result();
            $this->load->model('admin/match_result/Basketball_result_model');
            $this->Basketball_result_model->check_basketball_matches_result();
            $this->load->model('admin/match_result/Tennis_result_model');
            $this->Tennis_result_model->check_tennis_matches_result();
            $this->load->model('admin/match_result/Rugby_result_model');
            $this->Rugby_result_model->check_rugby_matches_result();
            $this->load->model('admin/match_result/Hockey_result_model');
            $this->Hockey_result_model->check_hockey_matches_result();
          break;
       // $sports = $this->Match_result_model->get_forecasted_sports();
       // $this->Match_result_model->parse_xml_matches_results($sports);
        }
               redirect('panel/Managment');


    }

 
   
  /**
   * გაპარსავს და ამოიღებს ყველა ლიგას ჩვენთვის საჭირო სპორტებისას
   * სპორტისას და შეიტანს ბაზაში
   *
   * @param
   * @return
   */
   public function get_all_sport_matches($sport_id = ''){

         switch ($sport_id) {
         case 1:
         
                $this->load->model('admin/Football_model');
                $this->load->model('admin/Revision_model');
                $this->Football_model->fooball_matches_all_leagues();
                $this->Revision_model->delete_dublicate_football_matches();
           break;
         case 2:
                $this->load->model('admin/Baseball_model');
                $this->load->model('admin/Revision_model');

                $this->Baseball_model->baseball_matches_all_leagues();
                $this->Revision_model->delete_dublicate_baseball_matches();
           break;
         case 3:
                $this->load->model('admin/Basketball_model');
                $this->load->model('admin/Revision_model');

                $this->Basketball_model->basketball_matches_all_leagues();
                $this->Revision_model->delete_dublicate_basketball_matches();
           break;
         case 4:
               $this->load->model('admin/Tennis_model');
                $this->load->model('admin/Revision_model');

               $this->Tennis_model->tenis_matches_all_leagues();
               $this->Revision_model->delete_dublicate_tennis_matches();
            break;
         case 5:
                $this->load->model('admin/Rugby_model');
                $this->load->model('admin/Revision_model');

                $this->Rugby_model->rugby_matches_all_leagues();
                $this->Revision_model->delete_dublicate_rugby_matches();
           break;
         case 6:
                $this->load->model('admin/Hockey_model');
                $this->load->model('admin/Revision_model');
                $this->Hockey_model->hockey_matches_all_leagues();
                $this->Revision_model->delete_dublicate_hockey_matches();
           break;
         default:


                  $this->load->model('admin/Baseball_model');
                          $this->Baseball_model->baseball_matches_all_leagues();
                  $this->load->model('admin/Basketball_model');
                          $this->Basketball_model->basketball_matches_all_leagues();
                  $this->load->model('admin/Football_model');
                          $this->Football_model->fooball_matches_all_leagues();
                  $this->load->model('admin/Hockey_model');
                          $this->Hockey_model->hockey_matches_all_leagues();
                  $this->load->model('admin/Rugby_model');
                          $this->Rugby_model->rugby_matches_all_leagues();
                  $this->load->model('admin/Tennis_model');
                          $this->Tennis_model->tenis_matches_all_leagues();

                $this->load->model('admin/Revision_model');

                $this->Revision_model->delete_all_dublicate_matches();

         break;

       }
       // $this->index();
       redirect('panel/Managment');

   }


 /**
  * გაპარსავს და ამოიღებს ყველა ლიგას ჩვენთვის საჭირო სპორტებისას
  * სპორტისას და შეიტანს ბაზაში
  *
  * @param
  * @return
  */
  public function parse_xml_leauges(){

    $this->load->model('admin/Base_xml_model');
    // $this->Base_xml_model->parse_and_save_xml_leagues('40,10,14,15,1003,11,1012,1002');
  }

  /**
   * დააგენერირებს სატესტო მონაცემებს ფეხბურთში და სხვადასხვა სპორტში
   * დააგენერირებს შემთხვევით პროგნოზებს მითითებული ლიმიტირებული
   * მომხმარებლების რაოდენობის მიხედვით მაგ 10 მომხმარებლის
   * დააგენერირებს შემთხვევით შედეგებს პროგნოზირებული მატჩების
   * დააგენერირებს სტატისტიკებს 0-10 10-20  20 მეტი თამაში ვისაც
   * გარტყმები %ულობის მიხედვით
   *
   * @param
   * @return
   */
   public function testing(){


    // გაპარსავს და ამოიღებს ყველა სპორტის ყველა ლიგას და მათ მატჩებს და შეიტანს ბაზაშ
    // // // $this->get_all_sport_matches();

     $this->load->model('admin/Tests_model');

    
     // წაშლის ყველა მომხმარებელს 
     // და შემთხვევით დაგენერირებული იუსერებით შეივსება ბაზა
     $this->Tests_model->registr_random_users();

     // მატჩების პროგნოზების გასუფთავება, ყველას წაშლა
     $this->db->empty_table('forecasted_matches');
        // $sqls = "DELETE FROM forecasted_matches";
        // $this->db->query($sqls);

       // // // $this->get_all_sport_matches();

     $this->Tests_model->random_to_forecast_football();
     $this->Tests_model->random_to_forecast_hockey();
     $this->Tests_model->random_to_forecast_rugby();
     $this->Tests_model->random_to_forecast_tennis();
     $this->Tests_model->random_to_forecast_basketball();
  
     $this->update_user_statistics();

     // $this->load->model('Statistic_model');
     
     // $this->Statistic_model->to_forecast_football_10_to_20();
     // $this->Statistic_model->to_forecast_football_over_20();
     // $this->Statistic_model->to_forecast_football_raiting_100();
     // $this->Statistic_model->best_5_tipsters_forecast();

            redirect('panel/Managment');


   }

   public function test_top_5(){

      $this->load->model('Statistic_model');
      $this->Statistic_model->best_5_tipsters_forecast();
             redirect('panel/Managment');

   }

   /**
    * გაასუფთავებს ბაზაში დაგენერირებულ მონაცემებს და სხვებსაც
    *
    * @param
    * @return
    */
   public function stop_testing(){

       $this->db->query("DELETE FROM `bet_football_matches` WHERE 1");
       $this->db->query("DELETE FROM `followers` WHERE 1");
       $this->db->query("DELETE FROM `chat` WHERE 1");
       $this->db->query("DELETE FROM `users` WHERE 1");
       $this->db->query("DELETE FROM `site_bet_football_matches` WHERE 1");
       $this->db->query("DELETE FROM `forecasted_matches_results` WHERE 1");
       $this->db->query("DELETE FROM `forecasted_matches` WHERE 1");
       $this->db->query("DELETE FROM `users_statistic` WHERE 1");

       $this->db->query("DELETE FROM `raiting_10_to_20` WHERE 1");
       $this->db->query("DELETE FROM `raiting_100` WHERE 1");
       $this->db->query("DELETE FROM `raiting_over_20` WHERE 1");

       $this->db->query("DELETE FROM `football_matches` WHERE 1");
       $this->db->query("DELETE FROM `baseball_matches` WHERE 1");
       $this->db->query("DELETE FROM `basketball_matches` WHERE 1");
       $this->db->query("DELETE FROM `handball_matches` WHERE 1");
       $this->db->query("DELETE FROM `hockey_matches` WHERE 1");
       $this->db->query("DELETE FROM `rugby_matches` WHERE 1");
       $this->db->query("DELETE FROM `tennis_matches` WHERE 1");
       $this->db->query("DELETE FROM `volleyball_matches` WHERE 1");


       $array_items = array('user_id', 'logged_in');
       $this->session->unset_userdata($array_items);
       $this->load->helper('cookie');
       delete_cookie('email');
       delete_cookie('password');

              redirect('panel/Managment');

   }

   /**
    * წაშლის ქუქსებს
    *
    * @param
    * @return
    */
   public function delete_cookie(){
    //  $array_items = array('user_id','email','password','logged_in');
    //  $this->session->unset_userdata($array_items);
     $this->load->helper('cookie');
     delete_cookie('email');
     delete_cookie('password');
     delete_cookie('username');
     delete_cookie('avatar');
     delete_cookie('user_id');
     session_unset();
             redirect('panel/Managment');


   }

   /**
    * ითვლის მომხმარებელთა პროგნოზების და მათი შედეგების სტატისტიკას და
    * წერს ბაზაში სტატისტიკის თეიბლში
    *
    * @param
    * @return
    */
    public function update_user_statistics(){

      $this->load->model('Statistic_model');
      $statistics = $this->Statistic_model->get_all_users_mini_statistic();
      
      if(empty($statistics)){
          redirect('panel/Managment');
          return;
      }

        $this->db->empty_table('users_statistic');

        foreach ($statistics as $statistic) {

            $data = array(
                    'user_id' =>         $statistic['user_id'],
                    'forecoast_count' => $statistic['match_count'],
                    'win' =>             $statistic['won_count'],
                    'procent_win' =>     $statistic['procent_wins'],
                    'lose' =>            $statistic['lost']
            );

            $this->db->insert('users_statistic', $data);
        }
              redirect('panel/Managment');


    }

    /**
     * წაშლის დაწყებულ ან დამთავრებულ თამაშებს
     *
     * @param
     * @return
     */
    public function delete_old_top_games(){
          $this->db->query("DELETE FROM `top_games` WHERE `start_date` < NOW() ");
                redirect('panel/Managment');

    }


   /**
     * წაშლის დაწყებულ ან დამთავრებულ თამაშებს
     *
     * @param
     * @return
     */
     public function delete_old_matches(){

       $this->db->query("DELETE FROM `football_matches` WHERE `start_date` < NOW() ");
       $this->db->query("DELETE FROM `baseball_matches` WHERE `start_date` < NOW()");
       $this->db->query("DELETE FROM `basketball_matches` WHERE `start_date` < NOW()");
       $this->db->query("DELETE FROM `handball_matches` WHERE `start_date` < NOW()");
       $this->db->query("DELETE FROM `hockey_matches` WHERE `start_date` < NOW()");
       $this->db->query("DELETE FROM `rugby_matches` WHERE `start_date` < NOW()");
       $this->db->query("DELETE FROM `tennis_matches` WHERE `start_date` < NOW()");
       $this->db->query("DELETE FROM `volleyball_matches` WHERE `start_date` < NOW()");
              redirect('panel/Managment');

     }


    /**
     * წაშლის ძველ  30 დღის წინ დადებულ პროგნოზებს. (ანუ 30 დღეზე ძველი პროგნოზები წაიშლება)
     *
     * @param
     * @return
     */
     public function delete_old_forecasted_matches(){

       $this->db->query("  DELETE FROM `forecasted_matches` WHERE `add_date` < DATE_SUB(NOW(), INTERVAL 30 DAY)  ");
              redirect('panel/Managment');


     }



    /**
     * ავატარების ატვირთვა 
     *
     * @param
     * @return
     */
     public function avatars_upload(){

         $this->load->model('admin/Avatars_model');
         
         ini_set('max_file_uploads', 50);

        if ($this->input->post('load_files')){

          $config['upload_path']   = './uploads/avatars/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['encrypt_name']  = TRUE;
          $config['max_size']      = 20000; // 1mb
          $config['remove_spaces'] = TRUE;
          $config['max_width'] = '128';
          $config['max_height'] = '128';

          $this->load->library('upload', $config);

          // $this->upload->initialize($config);

          $temp_files = $_FILES;
          $count = count ($_FILES['file']['name']);
    //     echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';
          for ($i=0; $i<=$count-1; $i++)
            {
                $_FILES['file'] = array (
                  'name'=>$temp_files['file']['name'][$i],
                  'type'=>$temp_files['file']['type'][$i],
                  'tmp_name'=>$temp_files['file']['tmp_name'][$i],
                  'error'=>$temp_files['file']['error'][$i],
                  'size'=>$temp_files['file']['size'][$i]
                );

                $this->upload->do_upload('file');

                $tmp_data = $this->upload->data();
    // echo '<pre>';
    // print_r($tmp_data);
    // echo '</pre>'; 
                $files_data[$i]['data'] = $tmp_data['full_path'];
                // var_dump($files_data);
    //             echo '<pre>';
    // print_r($tmp_data);
    // echo '</pre>';
              // echo $tmp_data['file_name'].'<br>';
              $this->Avatars_model->insert_avatars_in_db($tmp_data['file_name']);
          }
        }
        $data['avatars'] = $this->Avatars_model->get_all_avatars();
        $this->load->view('admin/upload_avatars_view',$data);
    }



    /**
     * ადმინის მიერ განცხადების გაკეთება
     *
     * @param
     * @return
     */
     public function admin_declaration(){

          $query = $this->db->get('admin_declaration');
          $data['messages'] = $query->result();

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
          $this->load->view('admin/admin_declaration_view',$data);
          return;
        }

         $data['message'] = $this->db->escape_str(strip_tags($this->input->post('admin_message',TRUE)));

          $this->db->set('message', $data['message']);
          $this->db->insert('admin_declaration');
          
             redirect('panel/Managment/admin_declaration');

     }

    /**
     * ადმინის განცხადებების წაშლა
     *
     * @param
     * @return
     */
     public function admin_declaration_delete($id = ''){
          $this->db->where('adm_msg_id', $id);
          $this->db->delete('admin_declaration');
          redirect('panel/Managment/admin_declaration');
          // $this->admin_declaration();
     }

    /**
     * დაითვლის 10 თამაშიდან 20 თამაშამდე ვისაც აქვს და შედეგებს შესაბამის ბაზაში ჩაწერს
     *
     * @param
     * @return
     */
      public function update_10_to_20_statistics(){


       $this->load->model('Statistic_model');
       $this->Statistic_model->to_forecast_football_10_to_20();
         redirect('panel/Managment');

    }

    /**
     * დაითვლის 20 თამაშზე მეტი ვისაც აქვს და შედეგებს შესაბამის ბაზაში ჩაწერს
     *
     * @param
     * @return
     */
      public function update_over_20_statistics(){

        
       $this->load->model('Statistic_model');
       $this->Statistic_model->to_forecast_football_over_20();
         redirect('panel/Managment');

      }

    /**
     * დაითვლის ჩატარებული თამაშებიდან ყველა წარმატებული შედეგი ვისაც აქვს
     * თამაშამდე ვისაც აქვს და შედეგებს შესაბამის ბაზაში ჩაწერს
     *
     * @param
     * @return
     */
      public function update_raiting_100_statistics(){

        
       $this->load->model('Statistic_model');
       $this->Statistic_model->to_forecast_football_raiting_100();
         redirect('panel/Managment');

      }

}
