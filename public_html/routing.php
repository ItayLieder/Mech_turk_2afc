<?php
// Must be at the top.
session_start(); // Data stored in the $_SESSION array will only be available after the session is started
// Functions.
require 'admin/functions.php';
require 'admin/config.php';

$experiment_id = '1';

// Open connection
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Validate connection.
if(mysqli_connect_errno($connection))
   exit("Fail to connect to db:" . mysqli_connect_error());

// utf8 support
mysqli_set_charset($connection,"utf-8");

if(isset($_SERVER['REQUEST_URI'])) 

//$_SERVER['REQUEST_URI'] returns the URI which 
//was given in order to access this page; for instance, '/index.html'.

{
    // Extract the path from REQUEST_URI.
    $requestPath = preg_replace('#[^a-zA-Z0-9_/\-\=\&.]#i', '', $_SERVER['REQUEST_URI']);
  
    // Unescape and strip from base path.
    $basePathLen = strlen(rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/'));	
    $path = trim(substr(urldecode($requestPath), $basePathLen + 1),'/');
	
//'SCRIPT_NAME' - Contains the current script's path. 
//dirname example - Localhost Path: http://s3lab.com/Shaz3e-ResponsiveFramework/S3-CMS/_source/
//dirname($_SERVER['PHP_SELF']); //output:  /Shaz3e-ResponsiveFramework/S3-CMS/_source
//rtrim — Strip whitespace (or other characters) from the end of a string

//urldecode - Decodes any %## encoding in the given string. Plus symbols ('+') are decoded to a space character.
// substr -Returns the portion of string specified by the start and length parameters.
//trim — Strip whitespace (or other characters) from the beginning and end of a string

	$userId = 0;
	$workerId = '';
	$age = 0;
	$gender = null;
	$music ='';
	$workerId = getUriParams();
	$userArray = array();
	
	$participated_before = check_user_history($connection,$experiment_id,$workerId);
	if($participated_before){
    	redirect('http://google.com');				
	} 
	
	$userArray = isUser($connection);
	if($userArray)  
	{
	    $userId   = $userArray['id'];
	    $workerID = $userArray['worker_id'];
	    $age      = $userArray['age'];
	    $gender   = $userArray['gender'];
	    $music    = $userArray['musical_experience'];
	}
  // The routing itself   
    //var_dump($path);
  
  if ($path == '' || (isset($_GET['workerId']) && !empty($_GET['workerId'])))
    {    		    
    	$title   = "The form";     
        $content = 'form.php';
    }
    elseif($path == "nextPage")
    {
        $title   = "main";    
        $content = 'main_2afc.php';
    }
	    elseif($path == "data_collector")
    {
        $title   = "data_collector";    
        $content = 'insert_data.php';
    }
	    elseif($path ==******)
    {
        $title   = "data";    
        $content = 'db_admin.php';
    }
    elseif($path == 'download-db')
    {
        $title   = "Download DB";    
        $content = 'download_db.php';
    }
    elseif($path == 'test')
    {
		//var_dump(safe_decode('YToyOntzOjExOiJleHBlcmltZW50cyI7YToxOntpOjA7aToxO31zOjM6ImlwcyI7czozOiI6OjEiO30='));
    	//$userId = 65;
    	//var_dump($userId);
		//update_user_complete($userId,$connection,$experiment_id);
		//exit();
    }
    else 
    {
        http_response_code(404);                
        $title   = "404 error";
        $content = 'errors/404.php';
    }
}

require 'index.php';