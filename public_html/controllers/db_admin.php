<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
//fputcsv($output, array('sub_experiment_name', 'field', 'result','user'));

//$select = 
//"SELECT 
//sub_experiments.name AS sub_experiment_name,
//fields.name AS field_name,
//results.result AS result,
//users.id AS user_id
//FROM experiments
//LEFT JOIN sub_experiments
//ON experiments.id = sub_experiments.experiment_id
//LEFT JOIN fields
//ON sub_experiments.id = fields.sub_experiment_id
//LEFT JOIN results
//ON fields.id = results.field_id 
//JOIN users
//ON results.user_id = users.id
//WHERE experiments.id=1 and users.id in (SELECT users.id from users)
//;
//";


// output the column headings
fputcsv($output, array('experiment','sub_experiment_name','field','result','userId','workerId','age','gender','musical_experience'));

$select = 
"SELECT 
experiments.name AS experiment_name,
sub_experiments.name AS sub_experiment_name,
fields.name AS field_name,

results.result AS result,

users.id AS user_id,
users.worker_id AS worker_id,
users.age AS age,
users.gender AS gender,
users.musical_experience AS musical_experience

FROM experiments
LEFT JOIN sub_experiments
ON experiments.id = sub_experiments.experiment_id

LEFT JOIN fields
ON sub_experiments.id = fields.sub_experiment_id

LEFT JOIN results
ON fields.id = results.field_id 

JOIN users
ON results.user_id = users.id

WHERE experiments.id=1 and sub_experiments.id=5 and users.id in (SELECT users.id from users)
;
";


$result = mysqli_query($connection,$select);
             
if(!$result || mysqli_num_rows($result) < 1) exit('no rows');

$data = array();
$cr = 0;

while ($row = mysqli_fetch_assoc($result)){
	$row['user_id'] = $row['user_id'];			    
	$row['experiment_name'] = $row['experiment_name'];
	$row['sub_experiment_name'] = $row['sub_experiment_name'];
	$row['field_name'] = $row['field_name'];
	$row['result'] = implode(',',safe_decode($row['result']));
	//$cr++;
	fputcsv($output, $row);
	
}	

exit;
?>
