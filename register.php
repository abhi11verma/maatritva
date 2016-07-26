<?php
/*
===============================================================================
This code is a webservice to register new user in the system.
Use following format to consume this webservice.
================================================================================
*/

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
{
  //header('Access-Control-Allow-Origin: null');
  header('Access-Control-Allow-Headers: Content-type');
  header("HTTP/1.1 200 OK");
  die();
}


header("Content-Type:application/json");
//header("Content-Type:application/x-www-form-urlencoded");
//header('Access-Control-Allow-Origin: http://www.samenoid.16mb.com');
//include("./dbconnect.php");
include("./function.php");

//get values from json call_user_func
$request = $_GET['data'];// get data from Json call

$json = json_decode($request); // decode json

/*
//opens counter.txt to read the number of hits
$datei = fopen("counter.txt","r");
$count = fgets($datei,1000);
fclose($datei);
$count=$count + 1 ;

// opens counter.txt to change new hit number
$datei = fopen("counter.txt","w");
fwrite($datei, $count);
fclose($datei);

//Check value if empty
//echo "Starting";
if($count%2 == 0){*/
if(!empty($json->emp_id))
{
	
	//Get values from URL
	$emp_id = $json->emp_id;
	$user_type = $json->emp_type;
	$name = $json->emp_name;
	$mob_no = $json->mob_no;
	$center_id = $json->center_id;
	$area_pin = $json->area_pin;
    $pswd = $json->pass;
	
	//check if user already registerd
	$x=check_user($emp_id);
	 if($x)//user already registered
	 {
		 //user already registerd
		 deliver_response(200,"Already_exist",2);
		 exit();
	 }

elseif(!check_white_list($user_type,$name,$emp_id)) // check if user is in white list of not, 1 = yes user exist go to next block
	{
		 //User not in white list contack admin
		 deliver_response(200,"You are not authorised",3);
		 exit();

	}

else{
		 //Register new user
		 if(register_new_user($user_type,$name,$mob_no,$emp_id,$area_pin,$center_id,$pswd)) //Registered succefully
		 {
			 deliver_response(200,'Registered_Successfully',1);
			 exit();
		 }
		 else{                                                                             //Error while registering
			 deliver_response(201,'Error_Registering',0);
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