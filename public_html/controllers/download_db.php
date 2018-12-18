<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('sub_experiment_name', 'field_name', 'result', 'user_id'));

$select = 'SELECT 
sub_experiments.name AS sub_experiment_name,
fields.name AS field_name,
results.result AS result,
users.id AS user_id
FROM experiments
LEFT JOIN sub_experiments
ON experiments.id = sub_experiments.experiment_id
LEFT JOIN fields
ON sub_experiments.id = fields.sub_experiment_id
LEFT JOIN results
ON fields.id = results.field_id 
JOIN users
ON results.user_id = users.id
WHERE experiments.id=1';

if($result = mysqli_query($connection,$select)) 
{
 
  // loop over the rows, outputting them
  while ($row = mysqli_fetch_assoc($result)) fputcsv($output, $row);

} 
else 
{
  echo "SELECT failed:" . mysqli_connect_error();
}
exit;