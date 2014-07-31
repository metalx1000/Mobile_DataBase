<?php
include('connect.php');

//date format and time zone
date_default_timezone_set('America/New_York');
$date = date('l jS \of F Y h:i:s A');

// escape variables for security
$fname = mysqli_real_escape_string($con, $_POST['FirstName']);
$lname = mysqli_real_escape_string($con, $_POST['LastName']);
$age = mysqli_real_escape_string($con, $_POST['Age']);
$key_id = mysqli_real_escape_string($con, $_POST['key_id']);

include('table.php');

$sql="INSERT INTO $table (FirstName, LastName, Age, key_id)
VALUES ('$fname', '$lname', '$age', '$key_id')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);
?>
