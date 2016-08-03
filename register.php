<?php
/*
===============================================================================
This code is a webservice to register new user in the system.
Use following format to consume this webservice.
================================================================================
*/

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
{
  header('Access-Control-Allow-Headers: Content-type');
  header("HTTP/1.1 200 OK");
  die();
}


header("Content-Type:application/json");
include("./function.php");

//get values from json call_user_func
$request = $_GET['data'];// get data from Json call

$json = json_decode($request); // decode json

$emp_ar= array(" ","ANM","MO","Gynac");

if(!empty($json->aadhar_id))
{
	
	//Get values from URL
	$aadhar_id = $json->aadhar_id;
	$emp_type = $json->emp_type;
	$name = $json->name;
	$mobile_no = $json->mobile_no;
	$center_id = $json->center_id;
	$area_id = $json->area_id;
    $password = $json->pass;

	//check if user already registerd
	$x=check_user($aadhar_id);
	 if($x)//user already registered
	 {
		 //user already registerd
		 deliver_response(200,"Already_exist",2);
		 exit();
	 }
/* ===============disabling white list check untill everything gets final=============
elseif(!check_white_list($user_type,$name,$emp_id)) // check if user is in white list of not, 1 = yes user exist go to next block
	{
		 //User not in white list contack admin
		 deliver_response(200,"You are not authorised",3);
		 exit();

	}
*/
else{
		 //Register new user
		 if(($id = register_new_user($aadhar_id,$emp_type,$name,$mobile_no,$center_id,$area_id,$password))) //Registered succefully
		 {		
			 //$emp_id = $emp_type.$id;
			 //define type of anm and generate id
			 $emp_id = $emp_ar[$emp_type].$id;

			 //update employee id in tables too--------
			 include'./dbconnect.php';
	
    		$query2 = "update user_profile SET emp_id = '$emp_id' WHERE rec_id = $id ";
        	mysqli_query($conn,$query2);
			mysqli_close($conn);

			 deliver_response(200,'Registered_Successfully',1,$emp_id);
			 exit();
		 }
		 else{                                                                             //Error while registering
			 deliver_response(201,'Error_Registering',0," ");
			 exit();
		 }
		 
		 
	 }
	
	
}


else //if no value is passed execute this block
{
	// empty value, url error
	deliver_response(400,'Invalid Request',999);
	exit();
}


/*


}
else{
	echo "hello";
}*/

//====================Webservice funcitons===========================

//Function to reply to webservice call
function deliver_response($status_code,$status_message,$result_code,$emp_id)
{
	header("HTTP/1.1 $status_code $status_message");
	
	$response['status_code']=$status_code;
	$response['status_message']=$status_message;
	$response['result_code'] = $result_code;
	$response['emp_id'] = $emp_id;
	
	$json_response = json_encode($response);
	echo $json_response;
	
}


?>