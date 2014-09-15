<?php
include('connect.php');
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

include('table.php');

// Create table
include('create.table.php');

// Execute query
if (mysqli_query($con,$sql)) {
  echo "Table $table created successfully";
} else {
  echo "Error creating $table: " . mysqli_error($con);
}
?>
