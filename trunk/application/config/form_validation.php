<?php
	$config = array(
		'new_client' => array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required|xss_clean|callback_alphadash_space'
			),
			
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|xss_clean|valid_email'
			),
		),// end of registration

		'new_job' => array(
			array(
				'field' => 'lang_from',
				'label' => 'Source language',
				'rules' => 'required|xss_clean|callback_check_lang_from'
			),

			array(
				'field' => 'lang_to',
				'label' => 'Translation language',
				'rules' => 'required|xss_clean|callback_check_lang_to'
			),
			
			array(
				'field' => 'deadline',
				'label' => 'Deadline',
				'rules' => 'required|xss_clean|callback_check_deadline'
			),
			
			array(
				'field' => 'currency',
				'label' => 'Currency',
				'rules' => 'required|xss_clean|callback_check_currency'
			)
		)
	);