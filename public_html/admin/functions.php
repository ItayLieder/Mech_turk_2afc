<?php
function redirect($to)
{
    // Redirect    
    header("Location: $to");
    exit;
}

//@ todo: use $_COOKIE['user']
function isUser($connection)
{
    if(isset($_SESSION['user']))
    {
       // compare session with the database. 
       $userId = (int)mysqli_real_escape_string($connection,$_SESSION['user']);
       
       $query = "SELECT `id`,`worker_id`,`age`,`gender`,`musical_experience` FROM `users` WHERE `id` = '{$userId}' LIMIT 1";
       
       if($result = mysqli_query($connection,$query))
       {
           $count = mysqli_num_rows($result);
           
           if($count<1) return false;
           
           return mysqli_fetch_assoc($result);
       }
       
       return false;
    }
    
    return false;
}



function safe_encode($array)
{
	return base64_encode(serialize($array));	
}

function safe_decode($str)
{
	return unserialize(base64_decode($str));
}

function insert_results($array,$userId,$connection,$field_id)
{
       $tableName = 'results';
		$insert = "INSERT INTO `{$tableName}` ";
        $insert.= "(`result`,`additional_data`,`field_id`,`user_id`,`creation_time`,`modification_time`,`active`) ";
        $insert.= "VALUES ";
		$insert.= "('{$array}','','{$field_id}','{$userId}',NOW(),null,1)";
		
		$results = mysqli_query($connection,$insert);        
        if(!$results) return '0';      
        $id = mysqli_insert_id($connection);      
        if(!$id || $id < 1) return '0';   
        return $id;       
}

function update_user_complete($userId,$connection,$experiment_id)
{
	
$select = 
	"SELECT 
	users.data AS experiment_data
	FROM users
	WHERE users.id = ".(int)$userId." limit 1"
	;
	
	$result = mysqli_query($connection,$select);
	                
        if(!$result || mysqli_num_rows($result) < 1) return false;

        $data = array();
        $row = mysqli_fetch_assoc($result);
        $data = $row['experiment_data'];
		
		$experiments = array(); 
        $experiments[] = (int)$experiment_id;
		
		if(!empty($data)) {
			$column = safe_decode($data);		
			if (isset($column['experiments'])){
				$experiments_old = $column['experiments'];
				$experiments = array_merge($experiments_old,$experiments);
			}
		}
		$a = array();		
		$a['experiments'] = $experiments;
		$a['ips'] = getIp();
		$experiments = safe_encode($a);
		
		$update = "UPDATE `users` SET ";
 		$update .=" `data`='{$experiments}' ";
   		$update .="WHERE `id`='{$userId}' limit 1";
  
        
        
		$results = mysqli_query($connection,$update);        
        
        
        if(!$results) return false;
        return true;
		  
}


function check_user_history($connection,$experiment_id,$workerID_new){
    //if(preg_match('/[^a-zA-Z0-9]/', $workerID)){
    	//redirect('http://google.com');		
    //} 
  $workerID_new = mysqli_real_escape_string($connection, $workerID_new);	
  //mysqli_real_escape_string — Escapes special characters in a string for use in an SQL statement, 
  //taking into account the current charset of the connection
	$select = 
	"SELECT 
	users.data AS data
	FROM users
	WHERE users.worker_id = '".$workerID_new."' limit 1"
	;
	$result = mysqli_query($connection,$select);               
    if(!$result || mysqli_num_rows($result) < 1) return false;
        
  
     $row = mysqli_fetch_assoc($result);
	 if(!isset($row['data'])) return false;
     $data = safe_decode($row['data']);
 	 if(!isset($data['experiments'])) return false;
	 $experiments = $data['experiments'];
	 foreach($experiments as $experiment){
	 		if($experiment == $experiment_id) return true;
	 	
	 }
	 return false;
}




function getUriParams(){
	
//	if(isset($_GET['workerId']) && isset($_GET['assignmentId']) && isset($_GET['hitId']) ){
	if(isset($_GET['workerId'])){
		
		$workerId = preg_replace('/[^a-zA-Z0-9]/','',$_GET['workerId']);
		//$assignmentId = preg_replace('/[^a-zA-Z0-9]/','',$_GET['assignmentId']);
		//$hitId = preg_replace('/[^a-zA-Z0-9]/','',$_GET['hitId']);
		
		//$_SESSION['assignmentId'] = $assignmentId;
	//	$_SESSION['hitId'] = $hitId;
	
		if(empty($workerId)){
			return false;
		}
		return $workerId;
		
	}	
		
}



function getIp()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        
        
        return $ipaddress;
    }   

