<?php 

class login_class{
	function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "";

		try {
		  $this->db = new PDO("mysql:host=$servername;dbname=chatbox", $username, $password);
		  // set the PDO error mode to exception
		  $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  
		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		}

	}

	function register(){
		$fname 		= $_POST['fname'];
		$lname 		= $_POST['lname'];
		$contact 	= $_POST['contact'];
		$email 		= $_POST['email'];
		$password 	= $_POST['password'];
		$cpassword 	= $_POST['cpassword'];

		if (!preg_match("/^[a-zA-Z-'\s]+$/", $fname)){
			return "Please Enter a valid First Name";
		}

		if (!preg_match("/^[a-zA-Z-'\s]+$/", $lname)){
			return "Please Enter a valid Last Name";
		}

		if (!preg_match("/^[0-9]{11}+$/", $contact)){
			return "Please enter a valid contact number e.g. 0313XXXXXXX";
		}

		if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
			return "You have entered an invalid email";
		}

		if ($password !== $cpassword){
			return "Password And confirm password do not match";
		}
		$password = sha1($password);
		$fullname = $fname." ".$lname;

		$query = "INSERT INTO users(name, email, password, contact, timestamp) VALUES(?,?,?,?,?)";
		$stmt = $this->db->prepare($query);
		$stmt->execute( array( $fullname, $email, $password, $contact, time() ) );
		return "Registeration Successful";
	}

	function do_login(){
		$email 		= $_POST['email'];
		$password 	= $_POST['password'];

		if ( empty($email) || empty($password) ){
			return "Enter email and password";
		}
		$password = sha1($password);

		$query = "SELECT user_id,name FROM users WHERE email = ? AND password = ? LIMIT 1";
		$stmt = $this->db->prepare($query);
		$stmt->execute( array( $email, $password ) );

		if ($stmt->rowCount() != 1){
			return "Invalid Credentials";
		}
		$record = $stmt->fetch(PDO::FETCH_OBJ);

		//session making
		session_name("chatbox");
		session_start();
		$_SESSION['user_logged_in'] = true;
		$_SESSION['user_id'] = $record->user_id;
		$_SESSION['user_name'] = $record->name;

		return "ok";
	}

	
}//end of class



?>