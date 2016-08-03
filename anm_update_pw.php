<?php
/*
===============================================================================
This code is a webservice to enter form data in the system.
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
//include("./function.php");

$request = $_GET['data'];
//echo $request;
//$request ='[{"MCTSID":"123","GPS_latitude":"latitude","GPS_longitude":"longitude","GPS_Altitude":"altitude","preg_mnth":"3","ANC_visit_no":"3","edema":"1","multi_preg":"1","bp_systolic":"100","bp_diastolic":"21","pulse_rate":"54","Curr_weight":"21","form_id":"1469987352490_undefined","Remark":"","headache_bluryvision":"1","vaginal_bleeding":"1","anaemia":"1"}]';

$json = json_decode($request,true);

//print_r($json);

//Check value if empty
if(!empty($json[0]['form_id']))
{
	
//===================================================================================
$MCTSID = $json[0]['MCTSID'];
$GPS_latitude = $json[0]['GPS_latitude'];
$GPS_longitude = $json[0]['GPS_longitude'];
$GPS_Altitude = $json[0]['GPS_Altitude'];
$preg_mnth= $json[0]['preg_mnth'];
$ANC_visit_no = $json[0]['ANC_visit_no'];
$multi_preg= $json[0]['multi_preg'];
$edema = $json[0]['edema']; 
$headache_bluryvision= $json[0]['headache_bluryvision'];
$vaginal_bleeding= $json[0]['vaginal_bleeding'];
$bp_systolic = $json[0]['bp_systolic'];
$bp_diastolic = $json[0]['bp_diastolic'];
$mean_arterial_pressure = $json[0]['mean_arterial_pressure'];
$pulse_rate = $json[0]['pulse_rate'];
$Curr_weight = $json[0]['Curr_weight'];
$anaemia= $json[0]['anaemia'];
$HIV= $json[0]['HIV'];
$ANM_ID = $json[0]['emp_id'];
$form_id = $json[0]['form_id'];
$Remark = $json[0]['Remark'];

//===================================================================================

	//echo "Executing query";
	
	//Submit form to database
	include'./dbconnect.php';

	$query = " INSERT INTO pw_case_update (`MCTSID`, `GPS_latitude`, `GPS_longitude`, `GPS_Altitude`, `preg_mnth`, `ANC_visit_no`, `multi_preg`, `edema`, `headache_bluryvision`, `vaginal_bleeding`, `bp_systolic`, `bp_diastolic`, `mean_arterial_pressure`, `pulse_rate`, `Curr_weight`, `anaemia`, `HIV`, `ANM_ID`, `form_id`, `Remark`) 
VALUES ('$MCTSID', '$GPS_latitude', '$GPS_longitude', '$GPS_Altitude', '$preg_mnth', '$ANC_visit_no', '$multi_preg', '$edema', '$headache_bluryvision', '$vaginal_bleeding', '$bp_systolic', '$bp_diastolic', '$mean_arterial_pressure', '$pulse_rate', '$Curr_weight', '$anaemia', '$HIV', '$ANM_ID', '$form_id', '$Remark')";

	//echo $query;
		
	$result = mysqli_query($conn,$query);
    
    if(mysqli_affected_rows($conn) ==1 )
    {
        deliver_response(200,"Form_Submitted",1);
    }
	else
    {
        deliver_response(400,"Database Error",2);
    }
	
	mysqli_close($conn);
}


//====================Processing script=============================
/*
// Process the received values and store in the data base.
include'./dbconnect.php';
$risk_stat = 1; //1=Normal, 2=At_Risk

$query = "INSERT INTO pw_case_status_system (`MCTS_ID`,`system_risk_status`) VALUES ('$MCTSID',$risk_stat)";

$result = mysqli_query($conn,$query);
mysqli_close($conn);

*/
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