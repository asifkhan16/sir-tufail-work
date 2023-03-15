<?php 

class get_data{
	function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "";

		try {
		  $this->db = new PDO("mysql:host=$servername;dbname=school", $username, $password);
		  // set the PDO error mode to exception
		  $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  
		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		}

	}

	function get_students(){
		// $stmt = $this->db->prepare("SELECT * FROM student ORDER BY student_id DESC");
		$query = "SELECT s.*, c.class_name FROM student s JOIN class c ON s.class_id = c.class_id ORDER BY s.student_id DESC";
		$stmt = $this->db->prepare($query);

		$stmt->execute();
		if ($stmt->rowCount() < 1){
			return [];
		}else{
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	function get_classes(){
		$stmt = $this->db->prepare("SELECT class_id, class_name FROM class");
		$stmt->execute();
		if ($stmt->rowCount() < 1){
			return [];
		}else{
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	function add_student(){
		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		$contact 	= $_POST['contact'];
		$reg_no 	= $_POST['reg_no'];
		$class_id 	= $_POST['class_id'];

		if (!preg_match("/^[a-zA-Z-'\s]+$/", $name)){
			return "Please Enter a valid Name";
		}

		if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
			return "You have entered an invalid email";
		}

		if (!preg_match("/^[0-9]{11}+$/", $contact)){
			return "Please enter a valid contact number e.g. 0313XXXXXXX";
		}

		$reg_no = trim($reg_no);
		if (empty($reg_no)){
			return "Please provide Registeration No.";
		}

		$class_id = (int) $class_id;
		if ($class_id < 1){
			return "Please select a valid class";
		}

		$check = $this->db->prepare("SELECT class_id FROM class WHERE class_id = ? LIMIT 1");
		$check->execute( array($class_id) );
		if ($check->rowCount() != 1){
			return "Please select a valid class";
		}

		$check = $this->db->prepare("SELECT student_id FROM student WHERE student_email = ? LIMIT 1");
		$check->execute( array($email) );
		if ($check->rowCount() == 1){
			return "Email already registered";
		}

		$query = "INSERT INTO student(student_name, student_email, student_contact, reg_no, class_id) VALUES(?,?,?,?,?)";
		$stmt = $this->db->prepare($query);
		$resp = $stmt->execute( array( $name, $email, $contact, $reg_no, $class_id ) );
		if ($resp){
			return "Record Inserted Successfully";
		}else{
			return "Some error occured, please try later.";
		}

	}

	function delete_student(){
		$student_id = (int) $_POST['student_id'];
		if ($student_id < 1){
			return "Invalid student selected";
		}

		$query = "DELETE FROM student WHERE student_id = ? LIMIT 1";
		$stmt = $this->db->prepare($query);
		$stmt->execute( array($student_id) );
		return "Student deleted Successfully";
	}

	function get_single_student($student_id = 0){
		if ($student_id < 1){
			return "Invalid Student ID";
		}

		$query = "SELECT * FROM student WHERE student_id = ? LIMIT 1";
		$stmt = $this->db->prepare($query);
		$stmt->execute( array($student_id) );
		if ($stmt->rowCount() != 1){
			return "Invalid Student ID";
		}

		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	function update_student(){

		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		$contact 	= $_POST['contact'];
		$reg_no 	= $_POST['reg_no'];
		$class_id 	= $_POST['class_id'];
		$student_id = (int) $_POST['student_id'];

		if ($student_id < 1){
			return "Invalid student ID";
		}

		if (!preg_match("/^[a-zA-Z-'\s]+$/", $name)){
			return "Please Enter a valid Name";
		}

		if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
			return "You have entered an invalid email";
		}

		if (!preg_match("/^[0-9]{11}+$/", $contact)){
			return "Please enter a valid contact number e.g. 0313XXXXXXX";
		}

		$reg_no = trim($reg_no);
		if (empty($reg_no)){
			return "Please provide Registeration No.";
		}

		$class_id = (int) $class_id;
		if ($class_id < 1){
			return "Please select a valid class";
		}

		$query = "UPDATE student SET student_name = ?, student_email = ?, student_contact = ?, reg_no = ?, class_id = ? WHERE student_id = ? LIMIT 1";

		$stmt = $this->db->prepare($query);
		$stmt->execute( array( $name, $email, $contact, $reg_no, $class_id, $student_id ) );
		return "ok";

	}
}



?>