<?php

$age = $gender = $music = null;
$proceedToTheNextPage = true;

$message = array();
$message["text"] = "All the fields must be filled";
$message["style"] = "alert-success";

// Validation

if (isset($_POST["submit"])) {
	// The honeypot trap needs to be empty.
	if (isset($_POST['honeypot']) && !empty($_POST['honeypot'])) {
		redirect("http://google.com");
	}

	// Fill all the fields.	
	if (!isset($_POST['workerID']) || empty($_POST['workerID']) || !isset($_POST['gender']) || empty($_POST['gender']) || !isset($_POST['age']) || empty($_POST['age']) || !isset($_POST['music']) || empty($_POST['music'])) {
		$message["text"] = "All the fields must be filled";
		$message["style"] = "alert-danger";
		$proceedToTheNextPage = false;
	}
	
	
	if(!$workerId){
		// If workerId was not sent externally --> get it from user
			
		// The worker's id should have only letters and numbers.
		$workerId = trim($_POST["workerID"]);
		if (preg_match('/[^0-9a-zA-Z]/', $workerId)) {
			$message["text"] = "Workers id should contain only digits and letters.";
			$message["style"] = "alert-danger";
			$proceedToTheNextPage = false;
			var_dump($workerId);
		}
		
	}
	
	
	//$message["text"] = "Worker ID not identified.";
	//$message["style"] = "alert-danger";
	//$proceedToTheNextPage = false;
	
	// The age should be between 18-120.
	$age = (int)trim($_POST["age"]);
	if ($age < 19 || $age > 50) {
		$message["text"] = "You need to be between 18-50 to participate in the experiment.";
		$message["style"] = "alert-danger";
		$proceedToTheNextPage = false;
	}
	
		$gender = trim($_POST["gender"]);
	if ($gender != 'female'  &&  $gender != 'male' ) {
		$message["text"] = "Please choose your gender";
		$message["style"] = "alert-danger";
		$proceedToTheNextPage = false;
	}
	
	// The music needs to have only numbers letters spaces, period and comma.
	$music = trim($_POST["music"]);
	if (preg_match('/[^0-9a-zA_Z ,\.\?]/', $music)) {
		$message["text"] = "You provided invalid value to the musical experience field.";
		$message["style"] = "alert-danger";
		$proceedToTheNextPage = false;
	}

	 if($proceedToTheNextPage === true)
	 {
	 // filter the data.
	 $workerId = mysqli_real_escape_string($connection, $workerId);
	 $age      = mysqli_real_escape_string($connection, $age);
	 $gender   = mysqli_real_escape_string($connection, $gender);
	 $music    = mysqli_real_escape_string($connection, $music);
	 // Insert to the database.
	 $query    = "INSERT INTO `users`(`worker_id`, `age`, `gender`, `musical_experience`, `creation_time`,
	 `modification_time`, `active`,`data`) VALUES
	 ('$workerId','$age','$gender','$music',now(),null,1,'')";
	 mysqli_query($connection,$query);
	 $lastInsertedId = mysqli_insert_id($connection);
	var_dump($connection);

	 if($lastInsertedId < 1)
	 {
	 $message["text"] = "Problem with inserting to the database. Please contact support.";
	 $message["style"]= "alert-danger";
	 $proceedToTheNextPage = false;
	 }
	 }
	 
	// Create sessions (and cookies) to identify the user.
	if ($proceedToTheNextPage === true) {
		$name = "user";
		$value = $lastInsertedId;
		$time = time() + 60 * 60 * 24 * 365;

		$_SESSION[$name] = $value;

		//setcookie($name,$value,$time);
		//redirect("http://54.68.5.226/discrimination_2afc/nextPage");
		//redirect("http://localhost/discrimination_2afc/public_html/nextPage");
		redirect($web_adress . "nextPage");
		
	}
}
?>