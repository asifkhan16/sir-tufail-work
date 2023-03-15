<?php 

date_default_timezone_set("asia/karachi");

$date = date("19-01-2038");
$text = "This is some text";
$text = explode(" ", $text);
$text = implode(",", $text);

echo $text;

echo "<br>";
// $date = strtotime($date);
// $date = strtotime("-1 day",$date);
// $date = date("d-m-Y h:i:s A", $date);
// echo $date;

$arr = array(
  array(
    'id' => 5698,
    'first_name' => 'Peter',
    'last_name' => 'Griffin',
  ),
  array(
    'id' => 4767,
    'first_name' => 'Ben',
    'last_name' => 'Smith',
  ),
  array(
    'id' => 3809,
    'first_name' => 'Joe',
    'last_name' => 'Doe',
  )
);

$ids1 = array_column($arr, "last_name");
foreach ($ids1 as $key => $value) {
	echo $value . "<br>";
}

$numbers = [1,2,3,4,5,6,7,8];

$search = 5;
if ( in_array($search, $numbers) ){
	echo "Found";
}else{
	echo "Not found";
}

?>