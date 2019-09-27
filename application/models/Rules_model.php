<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_model extends CI_Model {


// რეგისტრაციის წესები
public $registration_rules = array(
		array(
			'field' => 'email',
			'label' => 'EMAIL',
			'rules' => 'required|min_length[5]|max_length[30]|trim|valid_email|is_unique[users.email]'
			),

		array(
			'field' => 'password',
			'label' => 'PASSWORD',
			'rules' => 'required|min_length[3]|max_length[20]|trim|matches[retypassword]'
		),

		array(
			'field' => 'gender',
			'label' => 'GENDER',
			'rules' => 'in_list[male,fmale]'
		),

		array(
			'field' => 'retypassword',
			'label' => 'RETY PASSWORD',
			'rules' => 'required|min_length[3]|max_length[20]|trim'
		),

		array(
			'field' => 'username',
			'label' => 'USERNAME',
			'rules' => 'required|min_length[3]|max_length[20]|trim|is_unique[users.username]'
		),

		array(
			'field' => 'year',
			'label' => 'YEAR',
			'rules' => 'greater_than[1959]|less_than[2018]'
		),

		array(
			'field' => 'month',
			'label' => 'Month',
			'rules' => 'greater_than[0]|less_than[13]'
		),


		array(
			'field' => 'day',
			'label' => 'DAY',
			'rules' => 'greater_than[0]|less_than[32]'
		),

		array(
			'field' => 'name',
			'label' => 'NAME',
			'rules' => 'min_length[3]|max_length[20]'
		),

		array(
			'field' => 'fullname',
			'label' => 'LAST NAME',
			'rules' => 'min_length[3]|max_length[30]'
		),

		array(
			'field' => 'captcha',
			'label' => 'CAPTCHA',
			'rules' => 'required|exact_length[4]|trim'
			)
		);

		// ავტორიზაცის წესები
		public $login_rules = array(
					array(
						'field' => 'email',
						'label' => 'EMAIL',
						'rules' => 'required|min_length[5]|max_length[30]|trim|valid_email'
						),

					array(
							'field' => 'password',
							'label' => 'PASSWORD',
							'rules' => 'required|min_length[3]|max_length[20]|trim'
						)
				);

		// ფოსტის შეცვლის წესები
		public $email_change_rules = array(

				array(
					'field' => 'email',
					'label' => 'EMAIL',
					'rules' => 'min_length[5]|max_length[30]|trim|valid_email|is_unique[users.email]'
					)
		);

		// პაროლის შეცვლის წესები
		public $password_change_rules = array(

				array(
					'field' => 'password',
					'label' => 'PASSWORD',
					'rules' => 'min_length[3]|max_length[20]|trim|matches[retypassword]'
				),

				array(
					'field' => 'retypassword',
					'label' => 'RETY PASSWORD',
					'rules' => 'min_length[3]|max_length[20]|trim'
				)
			);


		// ექაუნთის რედაქტირების წესები
		public $profile_edit_rules = array(
				array(
					'field' => 'first_name',
					'label' => 'FIRST NAME',
					'rules' => 'min_length[3]|max_length[50]|trim'
					),
				array(
					'field' => 'last_name',
					'label' => 'LAST NAME',
					'rules' => 'min_length[3]|max_length[50]|trim'
					),

				array(
					'field' => 'phone',
					'label' => 'PHONE',
					'rules' => 'min_length[3]|max_length[30]|trim|numeric'
					),

				array(
					'field' => 'address',
					'label' => 'ADDRESS',
					'rules' => 'min_length[3]|max_length[30]|trim'
					),

				array(
					'field' => 'year',
					'label' => 'YEAR',
					'rules' => 'greater_than[1959]|less_than[2018]'
				),

				array(
					'field' => 'month',
					'label' => 'Month',
					'rules' => 'greater_than[0]|less_than[13]'
				),


				array(
					'field' => 'day',
					'label' => 'DAY',
					'rules' => 'greater_than[0]|less_than[32]'
				),

				array(
					'field' => 'captcha',
					'label' => 'CAPTCHA',
					'rules' => 'required|exact_length[4]|trim'
					),

				array(
					'field' => 'password',
					'label' => 'PASSWORD',
					'rules' => 'min_length[3]|max_length[20]|trim|matches[retypassword]'
				),

				array(
					'field' => 'retypassword',
					'label' => 'RETY PASSWORD',
					'rules' => 'min_length[3]|max_length[20]|trim'
				)
				);

				// ექაუნთის რედაქტირების წესები ადმინის მიერ 
				public $admin_user_edit_rules = array(
						array(
							'field' => 'first_name',
							'label' => 'FIRST NAME',
							'rules' => 'min_length[3]|max_length[50]|trim'
							),
						array(
							'field' => 'last_name',
							'label' => 'LAST NAME',
							'rules' => 'min_length[3]|max_length[50]|trim'
							),

						array(
							'field' => 'phone',
							'label' => 'PHONE',
							'rules' => 'min_length[3]|max_length[30]|trim|numeric'
							),

						array(
							'field' => 'address',
							'label' => 'ADDRESS',
							'rules' => 'min_length[3]|max_length[30]|trim'
							),

						array(
							'field' => 'gender',
							'label' => 'GENDER',
							'rules' => 'in_list[male,fmale]'
						),

						array(
							'field' => 'year',
							'label' => 'YEAR',
							'rules' => 'greater_than[1959]|less_than[2017]'
						),

						array(
							'field' => 'month',
							'label' => 'Month',
							'rules' => 'greater_than[0]|less_than[12]'
						),


						array(
							'field' => 'day',
							'label' => 'DAY',
							'rules' => 'greater_than[0]|less_than[31]'
						),

						array(
							'field' => 'email',
							'label' => 'EMAIL',
							'rules' => 'min_length[5]|max_length[30]|trim|valid_email|is_unique[users.email]'
							),

						array(
							'field' => 'password',
							'label' => 'PASSWORD',
							'rules' => 'min_length[3]|max_length[20]|trim|matches[retypassword]'
						),

						array(
							'field' => 'retypassword',
							'label' => 'RETY PASSWORD',
							'rules' => 'min_length[3]|max_length[20]|trim'
						),

						array(
							'field' => 'username',
							'label' => 'USERNAME',
							'rules' => 'min_length[3]|max_length[20]|trim|is_unique[users.username]'
						)
						);
}
?>
