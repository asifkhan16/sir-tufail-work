<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, "school");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = "' OR 1='1";
$query = "SELECT * FROM student WHERE student_name = '$name'";
$result = $conn->query($query);
echo $result->num_rows;


?>