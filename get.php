<?php

include('connect.php');
include('table.php');

$result = mysqli_query($con,"SELECT * FROM $table ORDER BY PID DESC LIMIT 0, 100");

$rows = array();

while($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
}

print json_encode($rows);
mysqli_close($con);
?>
