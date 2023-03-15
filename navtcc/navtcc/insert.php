<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=school", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

//$query = "INSERT INTO student(class_id, student_name, student_email, student_contact, reg_no) VALUES(?,?,?,?,?)";

$query = "SELECT * FROM class";
$stmt = $conn->prepare($query);
// $stmt->execute( array(3, 'ABC', "abc@gmail.com", '03130000000', 'AGR-U-30729') );
$stmt->execute();
   
 if ($stmt->rowCount() > 0){
    $stmt = $stmt->fetchAll(PDO::FETCH_OBJ);
    var_dump($stmt);
 }else{
    echo "No record found";
 }



?>