<?php
include('connect.php');
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

include('table.php');

// Create table
$sql = "CREATE TABLE $table
(
PID INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(PID),
FirstName CHAR(15),
LastName CHAR(15),
Age INT,
date CHAR(50),
key_id CHAR(30)
)";
// Execute query
if (mysqli_query($con,$sql)) {
  echo "Table $table created successfully";
} else {
  echo "Error creating $table: " . mysqli_error($con);
}
?>
