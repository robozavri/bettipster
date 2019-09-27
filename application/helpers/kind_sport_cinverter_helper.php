<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * გამოაქ სპორტის დასახელება შესაბამისი 
 * რიცხობრივი კოდის მიხედვით და
 * ენის მიხედვით რომელიც მომხმარბეელმა აირჩია
 * 
 *
 * @param
 * @return
 */
if ( ! function_exists('kind_sport_cinverter_helper')){
   function kind_sport_cinverter_helper($sport_id = ''){
     // 40 10 14 15 1003 11 1012 1002
     $CI =& get_instance();

         switch ($sport_id)
         {
             case  40:  $spoert_name = $CI->lang->line('hockey');
               break;
             case  10:  $spoert_name = $CI->lang->line('football');
               break;
             case  14:  $spoert_name = $CI->lang->line('baseball');
               break;
             case  15:  $spoert_name = $CI->lang->line('basketball');
               break;
             case 1003: $spoert_name = $CI->lang->line('rugby');
               break;
             case 11:   $spoert_name = $CI->lang->line('tennis');
               break;
             case 1012: $spoert_name = $CI->lang->line('vallayball');
               break;
             case 1002: $spoert_name = $CI->lang->line('handball');
               break;

         }

         return $spoert_name;
   }
}


/**
 * გამოაქ სპორტის დასახელება შესაბამისი ენის მიხედვით 
 * რომელიც მომხმარებელმა აირცია
 * 1-6 იდენთიფიკატორის მიხედვით
 *
 * @param
 * @return
 */
if ( ! function_exists('sport_name_convrt_helper')){
   function sport_name_convrt_helper($sport_id = ''){
   

     $CI =& get_instance();

      $spoert_name = '';

         switch ($sport_id)
         {
             case  6:  $spoert_name = $CI->lang->line('hockey');
               break;
             case  1:  $spoert_name = $CI->lang->line('football');
               break;
             case  2:  $spoert_name = $CI->lang->line('baseball');
               break;
             case  3:  $spoert_name = $CI->lang->line('basketball');
               break;
             case 5: $spoert_name = $CI->lang->line('rugby');
               break;
             case 4:   $spoert_name = $CI->lang->line('tennis');
               break;
             case 7: $spoert_name = $CI->lang->line('vallayball');
               break;
             case 8: $spoert_name = $CI->lang->line('handball');
               break;

         }

         return $spoert_name;
   }
}


/**
 * გამოაქ სპორტის სახეობის კოდი რომელიც გმაოიყენება გარე ლინკებისთვის
 * სპორტის სახეობის გარე იდენთიფიკატორი
 *
 * @param
 * @return
 */
if ( ! function_exists('sport_inner_code_convert_helper')){
       function sport_inner_code_convert_helper($sport_id = ''){
          switch ($sport_id)
         {
             case  40:  return 6;
               break;
             case  10:  return 1;
               break;
             case  14:  return 2;
               break;
             case  15:  return 3;
               break;
             case 1003: return  5;
               break;
             case 11:   return  4;
               break;
             case 1012: return  7;
               break;
             case 1002: return 8;

         }

         return;
       }

}
