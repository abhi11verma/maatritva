<?php
/*
===============================================================================
This code is a webservice to enter form data in the system.
Use following format to consume this webservice.
================================================================================
*/

header("Content-Type:application/json");
//include("./function.php");

$request = $_GET['data'];
//$request = '[{"MCTSID":"mcts_id_test1","GPS_latitude":"latitude","GPS_longitude":"longitude","GPS_Altitude":"altitude","ANC_visit_no":"1","edema":"YES","nausea_vomiting":"YES","bp_systolic":"140","bp_diastolic":"85","pulse_rate":"75","ANM_ID":"123","Remark":"hello world","Form_entry_time":1469445069551, "form_id":32165}]';

//echo $request;
$json = json_decode($request,true);
//print_r($json);

/*
$json = array('MCTSID' => '7777','GPS_latitude' => '20','GPS_longitude' => '20','GPS_Altitude' => '21','ANC_visit_no' => '6',
'edema' => 'YES','nausea_vomiting' => 'YES','bp_systolic' => '142','bp_diastolic' => '82','mean_arterial_pressure' => '36',
'pulse_rate' => '98','Curr_weight' => '60','ANM_ID' => '32658','form_id' => 'THISTEST_XYZ','Remark' => 'this is update test');
*/
//Check value if empty
if(!empty($json[0]['form_id']))
{
	
//===================================================================================
$MCTSID = $json[0]['MCTSID'];
$GPS_latitude = $json[0]['GPS_latitude'];
$GPS_longitude = $json[0]['GPS_longitude'];
$GPS_Altitude = $json[0]['GPS_Altitude'];
$ANC_visit_no = $json[0]['ANC_visit_no'];
$edema = $json[0]['edema']; 
$nausea_vomiting = $json[0]['nausea_vomiting'];
$bp_systolic = $json[0]['bp_systolic'];
$bp_diastolic = $json[0]['bp_diastolic'];
$mean_arterial_pressure = $json[0]['mean_arterial_pressure'];
$pulse_rate = $json[0]['pulse_rate'];
$Curr_weight = $json[0]['Curr_weight'];
$ANM_ID = $json[0]['ANM_ID'];
$form_id = $json[0]['form_id'];
$Remark = $json[0]['Remark'];
//$Form_entry_time = $json['Form_entry_time'];

//===================================================================================

	//echo "Executing query";
	
	//Submit form to database
	include'./dbconnect.php';

	$query = "INSERT INTO `pw_case_update_anm`
    (`MCTSID`, `GPS_latitude`, `GPS_longitude`, `GPS_Altitude`, `ANC_visit_no`, `edema`, `nausea_vomiting`, `bp_systolic`, 
    `bp_diastolic`, `mean_arterial_pressure`, `pulse_rate`, `Curr_weight`, `ANM_ID`, `form_id`, `Remark`) 
    VALUES ('$MCTSID', '$GPS_latitude', '$GPS_longitude', '$GPS_Altitude', '$ANC_visit_no', '$edema', '$nausea_vomiting', '$bp_systolic', 
    '$bp_diastolic', '$mean_arterial_pressure', '$pulse_rate', '$Curr_weight', '$ANM_ID', '$form_id', '$Remark')";

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