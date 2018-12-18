<?php
if(isset($_POST['postTone1']) &&  isset($_POST['postTone2']) &&  isset($_POST['postResponse']) &&  isset($_POST['postDuration']) &&  isset($_POST['postOnset']) &&  isset($_POST['postISI']) ) {
			
	$tone1=$_POST['postTone1'];
	$tone2=$_POST['postTone2'];
	$response=$_POST['postResponse'];
	$duration=$_POST['postDuration'];
	$onset=$_POST['postOnset'];
	$ISI=$_POST['postISI'];
	
	$tone1 = safe_encode($tone1);
	$tone2 = safe_encode($tone2);
	$response = safe_encode($response);
	$duration = safe_encode($duration);
	$onset = safe_encode($onset);
	$ISI = safe_encode($ISI);
	
	insert_results($tone1,$userId,$connection,27);
	insert_results($tone2,$userId,$connection,28);
	insert_results($response,$userId,$connection,29);
	insert_results($duration,$userId,$connection,30);
	insert_results($onset,$userId,$connection,31);
	insert_results($ISI,$userId,$connection,32);
	
	update_user_complete($userId,$connection,$experiment_id);
	
			
	exit;
}

?>