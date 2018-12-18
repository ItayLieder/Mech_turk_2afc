<?php
$env = 'local';
if($env == 'local'){
		$web_adress = "http://localhost/discrimination_2afc/public_html/";
	// db connection.
	define('DB_HOST','localhost');//ip:127.0.0.1 
	define('DB_USER','root'); //USERNAME
	define('DB_PASS','');
	define('DB_NAME','routing_test_db');
}else{
		$web_adress = "http://54.68.5.226/discrimination_2afc/";
	// db connection.
	define('DB_HOST','itay.crpryhylphi7.us-west-2.rds.amazonaws.com');
	define('DB_USER',******); //USERNAME
	define('DB_PASS',******);
	define('DB_NAME','main_2afc');
}


// * define is used for constant insertion on run time 
//(const DB_HOST = 'string' will be the same, but only will be executed upon compilations)
