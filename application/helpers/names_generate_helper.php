<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * აგენერირებს არსებული მასივიდან შემთხვევითსახელებს
 * დაგენენრერიბულ სახელებს უმატებს უნიკალურ ციფრს რომ უნიკალური იყოს
 *
 * @param
 * @return array სახელს და გვარ მასივში
 */
if ( ! function_exists('names_generate')){
   function names_generate(){

     //PHP array containing forenames.
  $names = array(
          'Thomas',
          'Rodriguez',
          'Lopez',
          'Jackson',
          'Lewis',
          'Hill',
          'Smith',
          'Anderson',
          'Clark',
          'Wright',
          'Mitchell',
          'Johnson',
          'Perez',
          'Williams',
          'Roberts',
          'Jones'	,
          'White',
          'Lee',
          'Scott',
          'Turner',
          'Brown',
          'Harris',
          'Walker',
          'Green',
          'Phillips',
          'Davis',
          'Martin',
          'Hall',
          'Adams',
          'Campbell',
          'Miller',
          'Thompson',
          'Allen',
          'Baker',
          'Parker',
          'Wilson',
          'Garcia',
          'Young',
          'Gonzalez',
          'Evans',
          'Moore',
          'Martinez',
          'Hernandez',
          'Nelson',
          'Edwards',
          'Taylor',
          'Robinson',
          'King',
          'Carter',
          'Collins',
          'Christopher',
          'Ryan',
          'Ethan',
          'John',
          'Zoey',
          'Sarah',
          'Michelle',
          'Samantha'
         );


     //PHP array containing surnames.
     $surnames = array(
         'Walker',
         'Thompson',
         'Anderson',
         'Johnson',
         'Tremblay',
         'Peltier',
         'Cunningham',
         'Simpson',
         'Mercado',
         'Sellers',
         'Smith',
         'Johnson',
         'Williams',
         'Jones',
         'Brown',
         'Davis',
         'Miller',
         'Wilson',
         'Moore',
         'Taylor',
         'Anderson',
         'Thomas',
         'Jackson',
         'White',
         'Harris',
         'Martin',
         'Thompson',
         'Garcia',
         'Martinez',
         'Robinson',
         'Clark',
         'Rodriguez',
         'Lewis',
         'Lee',
         'Walker',
         'Hall',
         'Allen',
         'Young',
         'Hernandez',
         'King',
         'Wright',
         'Lopez',
         'Hill',
         'Scott',
         'Green',
         'Adams',
         'Baker',
         'Gonzalez',
         'Nelson',
         'Carter'
         );

         //Generate a random forename.
         $random_name = $names[mt_rand(0, sizeof($names) - 1)];

         //Generate a random surname.
         $random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];

         //Combine them together and print out the result.
        //  echo $random_name . ' ' . $random_surname;
         $data['name'] = $random_name.'_'.rand(143,3240981);
         $data['full_name'] = $random_surname.'_'.rand(1,3240983);
         return $data;
   }
}
