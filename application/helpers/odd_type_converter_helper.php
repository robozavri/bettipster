<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * გადააკონვერტირებს კოეფიციენტის ტიპს, თეიბლის დასახელებიდან
 * მომხმარებლისთვის უფრო გასაგებზე
 *
 * @param
 * @return
 */
if ( ! function_exists('odd_type_converter')){
   function odd_type_converter($oddType = ''){

         switch ($oddType)
         {
             case   'one': $oddType = '1';
               break;
             case  'drow': $oddType = 'X';
               break;
             case   'two': $oddType = '2';
               break;
             case  'over': $oddType = ' > 2.5 ';
               break;
             case 'under': $oddType = ' < 2.5 ';
               break;

         }

         return $oddType;
   }
}


/**
 * გადააკონვერტირებს კოეფიციენტის ტიპს,სპორტის სახეობიდან გამომდინარე
 * მომხმარებლისთვის გასაგებ გამოხატულებასი
 *
 * @param
 * @return
 */
if ( ! function_exists('odd_type_converter_kind_sport')){
   function odd_type_converter_kind_sport($oddType = '', $sport_id = '',$under_over_value = ''){
     // 40 10 14 15 1003 11 1012 1002
     if($under_over_value == 0){

          if($sport_id == 40){

              switch ($oddType)
              {
                  case   'one': $oddType = '1';
                    break;
                  case  'drow': $oddType = 'X';
                    break;
                  case   'two': $oddType = '2';
                    break;
                  case  'over': $oddType = ' > 5.5 ';
                    break;
                  case 'under': $oddType = ' < 5.5 ';
                    break;
              }

          }

           switch ($oddType)
           {
               case   'one': $oddType = '1';
                 break;
               case  'drow': $oddType = 'X';
                 break;
               case   'two': $oddType = '2';
                 break;
               case  'over': $oddType = ' > 2.5 ';
                 break;
               case 'under': $oddType = ' < 2.5 ';
                 break;
           }

      }else{


             switch ($oddType)
             {
                 case   'one': $oddType = '1';
                   break;
                 case  'drow': $oddType = 'X';
                   break;
                 case   'two': $oddType = '2';
                   break;
                 case  'over': $oddType = ' > '.$under_over_value;
                   break;
                 case 'under': $oddType = ' < '.$under_over_value;
                   break;

             }

      }

         return $oddType;
   }
}
