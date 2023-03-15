<?php 

include("processor/session_check.php");

?>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h1>Welcome <?php echo $_SESSION['user_name']; ?></h1>
	<a href="logout.php">Logout</a>
</body>
</html>