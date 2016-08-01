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
//$request ='{"aadhar_id":"anm","pass":"anm"}';

$json = json_decode($request); // decode json
//print_r($json);


//Check value if empty
if(!(empty($json->aadhar_id)||empty($json->pass)))
{
	
	//Get values from URL
	$aadhar_id = $json->aadhar_id;
    $password   = $json->pass;
	
	//verify usr and password
	
	include'./dbconnect.php';
    $query = "Select * From user_profile where aadhar_id = '$aadhar_id' AND password = '$password'  ";
    //echo $query;

    $result = mysqli_query($conn,$query) or die("error in fetching");
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	//print_r($row);
	$emp_type = $row['emp_type'];
	$emp_id = $row['emp_id'];

    if(mysqli_num_rows($result)==1)
    {
        
         deliver_response(200,'Success',1,$emp_type,$emp_id);
		// deliver_response(200,'Success',1," "," ");
    }
	else
    {
         deliver_response(200,'Wrong Credentials',0," "," ");	
    }
	
	mysqli_close($conn);
	
/*
	
	 if($val = verify_user($aadhar_id,$password))
	 {
		 //user already registerd
		 deliver_response(200,'Success',1,$val);
	 }
	 else{
		 //user does not exist or error
		 deliver_response(203,'Wrong Credentials',0);	 
	 }
	 */
	
}
else
{
	// empty value, url error
	deliver_response(400,'Invalid Request',999," "," ");
}




//====================Webservice funcitons===========================

//Function to reply to webservice call
function deliver_response($status_code,$status_message,$result_code,$emp_type,$emp_id)
{
	header("HTTP/1.1 $status_code $status_message");
	
	$response['status_code']=$status_code;
	$response['status_message']=$status_message;
	$response['result_code'] = $result_code;
	$response['emp_type'] = $emp_type;
	$response['emp_id'] = $emp_id; 	
	
	$json_response = json_encode($response);
	echo $json_response;
}




?>