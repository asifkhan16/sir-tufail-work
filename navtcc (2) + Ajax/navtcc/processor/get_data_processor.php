<?php
include("get_data_class.php");
$obj = new get_data();

if (!isset($_POST['op'])){
	echo "No Direct Access is allowed";
	exit();
}

$op = $_POST['op'];

if ($op == "add_student"){
	// echo "Working";
	$resp = $obj->add_student();
	echo $resp;
}else if ( $op == "delete_student"){
	$resp = $obj->delete_student();
	echo $resp;
}else if ( $op == "get_students"){
	$resp = $obj->get_students();
	echo json_encode($resp);
}else if ($op == "get_single_student_record"){
	$student_id = $_POST['s_id'];
	$resp = $obj->get_single_student($student_id);
	echo json_encode($resp);
}

?>