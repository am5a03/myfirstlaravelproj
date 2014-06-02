<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),
	
	'Google' => array(
		'client_id'	=> '100807164080-65vp68b233fd65hpsoud1261h7pj6d51.apps.googleusercontent.com',
		'client_secret' => 'RzUCj1jzA6GspUS76UQX9Hsa',
		'scope'		=> array('email', 'profile')
	)		

	)

);
