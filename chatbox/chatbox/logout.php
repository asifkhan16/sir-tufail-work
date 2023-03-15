<?php 

session_name("chatbox");
session_start();

session_destroy();
header("location: login.php");

?>