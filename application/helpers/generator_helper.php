<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * დააგენერირებს შემთხვევით სტროფს გადაცემული რიცხვის მიხედვით
 *
 * @param
 * @return
 */
if ( ! function_exists('rand_string_generator')){
   function rand_string_generator($number = 10){


     		 $arr = array('a','b','c','d','e','f',

     		 'g','h','i','j','k','l',

     		 'm','n','o','p','r','s',

     		 't','u','v','x','y','z',

     		 'A','B','C','D','E','F',

     		 'G','H','I','J','K','L',

     		 'M','N','O','P','R','S',

     		 'T','U','V','X','Y','Z',

     		 '1','2','3','4','5','6',

     		 '7','8','9','0');

     		 // დავაგენერიროთ პაროლი

     		 $rndString = "";

     		 for($i = 0; $i < $number; $i++)

     		 {

     		 // მასივის შემთხვევითი ინდექსი

     		 $index = rand(0, count($arr) - 1);

     		 $rndString .= $arr[$index];

     		 }

     		 return $rndString;
   }
}

/**
 * დააგენერირებს შემთხვევით სტროფს გადაცემული რიცხვის მიხედვით
 *
 * @param
 * @return
 */
if ( ! function_exists('email_generator')){
   function email_generator(){
        $stringRand = rand_string_generator();
        return $stringRand.'@gmail.com';
   }
 }
