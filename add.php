<?php
include('connect.php');
include('table.php');

//date format and time zone
date_default_timezone_set('America/New_York');
$date = date('l jS \of F Y h:i:s A');

// escape variables for security
include('post.esc.php');
include('sql.entry.php');

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);
?>
