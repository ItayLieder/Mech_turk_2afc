<?php 
$title = "the form"; 
$age = $workerId = $gender = $music = null;
$proceedToTheNextPage = true;

$message = array();
$message["text"] = "All the fields must be filled";
$message["style"]= "alert-success";

// Validation
if(isset($_POST["submit"]))
{ 
   // The honeypot trap needs to be empty.   
   if(isset($_POST['honeypot']) && !empty($_POST['honeypot']))
   {
       redirect("http://google.com");   
   }   
     
   // Fill all the fields.  
   if(
       !isset($_POST['workerID']) || empty($_POST['workerID']) ||
       !isset($_POST['gender']) || empty($_POST['gender']) ||
       !isset($_POST['age']) || empty($_POST['age']) ||
       !isset($_POST['music']) || empty($_POST['music'])
   )
   {
       $message["text"] = "You are a bad boy. All the fields must be filled!!!!";
       $message["style"]= "alert-danger";
   }
   

   // The worker's id should have only letters and numbers.
   $workerId = trim($_POST["workerID"]);
   if(preg_match('/[^0-9a-zA_Z]/',$workerId))
   {
       $message["text"] = "Workers id should contain only digits and letters.";
       $message["style"]= "alert-danger";
       $proceedToTheNextPage = false;
   }
   
   
   // The age should be between 18-120.
   $age = (int)trim($_POST["age"]);
   if($age < 19 || $age > 40)
   {
       $message["text"] = "You need to be between 18-40 to participate in the experiment.";
       $message["style"]= "alert-danger";
       $proceedToTheNextPage = false;
   }
   
   
   // The music needs to have only numbers letters spaces, period and comma.
   $music = trim($_POST["music"]);
   if(preg_match('/[^0-9a-zA_Z ,\.\?]/',$music))
   {
       $message["text"] = "You provided invalid value to the musical experience field.";
       $message["style"]= "alert-danger";
       $proceedToTheNextPage = false;
   }
}

// filter the data.

// Insert to the database.

// Create sessions (and cookies) to identify the user.
if(isset($_POST['workerID']) && $proceedToTheNextPage === true)
{
   $_SESSION['user'] = $_POST['workerID'];

   redirect("http://localhost/itay/thankyou");
}
?>