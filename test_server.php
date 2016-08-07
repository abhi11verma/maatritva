<?php


header("Content-Type:application/jsonrequest");
//include("./function.php");

$request = $_POST['data'];
$json = json_decode($request);

echo $request;
exit();
/*
include'./dbconnect.php';

	$query = " INSERT INTO `test`(`data`) 
	VALUES ('$json')";

	//echo $query;
		
 mysqli_query($conn,$query);
*/

?>