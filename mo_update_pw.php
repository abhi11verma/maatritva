<?php
/*
===============================================================================
This code is a webservice to update data by Medical officer for PW
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


$request = $_GET['data'];

//echo $request;
$json = json_decode($request,true);
//print_r($json);

//Check value if empty
if(!empty($json[0]['form_id']))
{
	
//===================================================================================
$MCTSID = $json[0]['MCTSID'];

$risk_status = $json[0]['risk_status'];
$updated_by = $json[0]['emp_id'];
//$risk_reason = $json[0]['risk_reason'];
$next_visit_date = $json[0]['next_visit_date'];
$Remark = $json[0]['Remark'];
$form_id = $json[0]['form_id'];

//===================================================================================

if($next_visit_date == "")
{
	$case_status = 1; //'1 =VISITED', 2 ='VISITED_NEXT_DATE', 'DUE', 'CLOSE
}
else{
	$case_status = 2;
}


	//echo "Executing query";
	
	//Submit form to database
	include'./dbconnect.php';

	$query = "INSERT INTO `pw_case_status`(`MCTSID`, `case_status`, `risk_status`, `updated_by`, `next_visit_date`,`remark`)
	 VALUES ('$MCTSID','$case_status','$risk_status','$updated_by','$next_visit_date','$Remark')";

	//echo $query;
	$result = mysqli_query($conn,$query);
    
    if(mysqli_affected_rows($conn) ==1 )
    {
        deliver_response(200,"Form_Submitted",1);
    }
	else
    {
        deliver_response(200,"Some Error",2);
    }
	
	mysqli_close($conn);
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