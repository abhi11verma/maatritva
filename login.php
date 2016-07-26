<?php
/*
===============================================================================
This code is a webservice to login  user in the system.
Use following format to consume this webservice.
================================================================================
*/

header("Content-Type:application/json");
//include("./dbconnect.php");
include("./function.php");

//get values from json call_user_func
$request = $_GET['data'];// get data from Json call

$json = json_decode($request); // decode json


//Check value if empty
if(!(empty($json->emp_id)||empty($json->pass)))
{
	
	//Get values from URL
	$emp_id = $json->emp_id;
    $pswd   = $json->pass;
	
	//verify usr and password
	 if(verify_user($emp_id,$pswd))//user already registered
	 {
		 //user already registerd
		 deliver_response(200,'Success',1);
	 }
	 else{
		 //user does not exist or error
		 deliver_response(203,'Wrong Credentials',0);	 
	 }
	
}
else
{
	// empty value, url error
	deliver_response(200,'Invalid Request',999);
}




//====================Webservice funcitons===========================

//Function to reply to webservice call
function deliver_response($status_code,$status_message,$result_code)
{
	header("HTTP/1.1 $status_code $status_message");
	
	$response['status_code']=$status_code;
	$response['status_message']=$status_message;
	$response['result_code'] = $result_code;
	
	$json_response = json_encode($response);
	echo $json_response;
}




?>