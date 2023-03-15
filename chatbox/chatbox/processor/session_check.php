<?php

session_name("chatbox");
session_start();

if ( isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ){

}else{
	header("location:login.php");
}


?>