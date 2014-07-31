<?php
include('connect.php');
include('table.php');

$pid = mysqli_real_escape_string($con, $_POST['PID']);

mysqli_query($con,"DELETE FROM $table WHERE PID='$pid'");

echo "Entry Removed";
?>
