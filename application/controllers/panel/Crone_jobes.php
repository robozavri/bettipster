<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crone_jobes extends CI_Controller {

  function __construct() {
      parent::__construct();
        // date_default_timezone_set('Asia/Tbilisi');
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
                $this->Football_model->fooball_matches_all_leagues();
           break;
         case 2:
                $this->load->model('admin/Baseball_model');
                $this->Baseball_model->baseball_matches_all_leagues();
           break;
         case 3:
                $this->load->model('admin/Basketball_model');
                $this->Basketball_model->basketball_matches_all_leagues();
           break;
         case 4:
               $this->load->model('admin/Tennis_model');
               $this->Tennis_model->tenis_matches_all_leagues();
            break;
         case 5:
                $this->load->model('admin/Rugby_model');
                $this->Rugby_model->rugby_matches_all_leagues();
           break;
         case 6:
                $this->load->model('admin/Hockey_model');
                $this->Hockey_model->hockey_matches_all_leagues();
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
         break;
      
       }

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

     }


       /**
     * წაშლის ძველ  30 დღის წინ დადებულ პროგნოზებს. (ანუ 30 დღეზე ძველი პროგნოზები წაიშლება)
     *
     * @param
     * @return
     */
     public function delete_old_forecasted_matches(){

       $this->db->query("  DELETE FROM `forecasted_matches` WHERE `add_date` < DATE_SUB(NOW(), INTERVAL 30 DAY)  ");

     }


    /**
     * გამოავლენს ტოპ 5 საუკეთესო ტიპსტერს
     *
     * @param
     * @return
     */
     public function generate_top_5_typster(){
     	     $this->load->model('Statistic_model');
     		 $this->Statistic_model->best_5_tipsters_forecast();
     }

 }