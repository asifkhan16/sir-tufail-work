<?php

session_name("navtcc");
session_start();

$_SESSION['name'] = "Ali";
$_SESSION['email'] = "ali@gmail.com";

echo $_SESSION['name'];


// session_unset("");
// session_destroy();


?>