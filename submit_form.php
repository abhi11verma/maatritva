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

//$request = $_POST['data'];
$request = file_get_contents('php://input');

//echo "hello";
//echo $request;
//exit();

//$request = '[{"Name":"oioi","DOB":"","Age":"09","Address":"oi","Landmark":"21","pw_ph_no":"4","MCTSID":"5445","area_id":"1","LMP":"2016-08-19","ANC_visit_no":"1","primigravida":"NO","still_birth":"NA","last_preg_gap":"1","low_birth_weight":"NA","miscarriage":"NO","blood_loss":"NA","prior_pih":"NO","pih_mother_sister":"NO","med_diagnosis":"1","diabetes_mother_sister":"YES","multi_preg":"1","headache_bluryvision":"YES","vaginal_bleeding":"YES","anaemia":"NO","bp_systolic":"2121212121","bp_diastolic":"21","mean_arterial_pressure":"707070721","pulse_rate":"2","Height_mtr":"2","Curr_weight":"12","BMI":"30000","emp_id":"anm1","form_id":"1470406443106_123455","edema":"YES","preg_count":"1","HIV":"NA","preg_mnth":"1","c_sec":"NA"}]';

//[{"Name":"","GPS_latitude":1,"GPS_longitude":2,"GPS_Altitude":3,"multi_preg":"1","headache_bluryvision":"NO","vaginal_bleeding":"NA","anaemia":"NA","bp_systolic":"212","bp_diastolic":"21","mean_arterial_pressure":"85","pulse_rate":"21","Height_mtr":"554","Curr_weight":"5","BMI":"0.16","ANM_ID":123455,"form_id":"1469973972899_123455","edema":"YES","HIV":"YES"}]

$json = json_decode($request,true);

//print_r($request);
//echo $json[0]['form_id'];
//exit();
/*
$json = array('Name' => 'Laxmi','MCTSID' => '2147483647','DOB' => '1991-01-28','Age' => '23','Socio_Eco_Status' => 'LOWER','Address' => NULL,'Landmark' => NULL,'Area' => 'Ambad','pw_ph_no' => NULL,'GPS_latitude' => '1.000000','GPS_longitude' => '2.000000','GPS_Altitude' => '34.000000','LMP' => '2016-04-04','ANC_visit_no' => '2','preg_count' => NULL,'succ_preg_count' => NULL,'preg_mnth' => NULL,'doc_visit' => NULL,'primigravida' => 'NO','nulloparous' => 'YES','last_preg_gap' => '2','pih_mother' => NULL,'have_sister' => 'YES','pih_sister' => NULL,'prior_pih' => 'YES','last_preg_status' => 'Aborted/SB/NND','med_diagnosis' => 'Hypertension','IVF_his' => 'NO','chronic_bp' => 'NO','Diabetes_his' => '','c_sec' => NULL,'edema' => NULL,'multiparous' => 'NO','nausea_vomiting' => 'YES','bp_systolic' => '120','bp_diastolic' => '80','mean_arterial_pressure' => '10000.000000','pulse_rate' => '80','Height_mtr' => '56','Curr_weight' => '55','BMI' => '35.000000','ANM_ID' => '0','form_id' => 'tetsint_php_array');
*/
//Check value if empty, i.e if form_id exist then execute if block
if(!empty($json[0]['form_id']))
{
	
//===================================================================================

$Name= $json[0]['Name'];
$MCTSID= $json[0]['MCTSID'];
$DOB= $json[0]['DOB'];
$Age= $json[0]['Age'];
$Address= $json[0]['Address'];
$Landmark= $json[0]['Landmark'];
$area_id= $json[0]['area_id'];
$pw_ph_no= $json[0]['pw_ph_no'];
$GPS_latitude= $json[0]['GPS_latitude'];
$GPS_longitude= $json[0]['GPS_longitude'];
$GPS_Altitude= $json[0]['GPS_Altitude'];
$LMP= $json[0]['LMP'];
$still_birth= $json[0]['still_birth'];
$low_birth_weight= $json[0]['low_birth_weight'];
$miscarriage= $json[0]['miscarriage'];
$blood_loss= $json[0]['blood_loss'];
$ANC_visit_no= $json[0]['ANC_visit_no'];
$preg_count= $json[0]['preg_count'];
$preg_mnth= $json[0]['preg_mnth'];
$primigravida= $json[0]['primigravida'];
$last_preg_gap= $json[0]['last_preg_gap'];
$pih_mother_sister= $json[0]['pih_mother_sister'];
$diabetes_mother_sister= $json[0]['diabetes_mother_sister'];
$prior_pih= $json[0]['prior_pih'];
$med_diagnosis= $json[0]['med_diagnosis'];
if($med_diagnosis == ",NONE OF THESE")
{
	$med_diagnosis = " ";
}

$multi_preg= $json[0]['multi_preg'];
$c_sec= $json[0]['c_sec'];
$edema= $json[0]['edema'];
$headache_bluryvision= $json[0]['headache_bluryvision'];
$vaginal_bleeding= $json[0]['vaginal_bleeding'];
$bp_systolic= $json[0]['bp_systolic'];
$bp_diastolic= $json[0]['bp_diastolic'];
$mean_arterial_pressure= $json[0]['mean_arterial_pressure'];
$pulse_rate= $json[0]['pulse_rate'];
$Height_mtr= $json[0]['Height_mtr'];
$Curr_weight= $json[0]['Curr_weight'];
$BMI= $json[0]['BMI'];
$anaemia= $json[0]['anaemia'];
$HIV= $json[0]['HIV'];
$ANM_ID= $json[0]['emp_id'];
$form_id = $json[0]['form_id'];
 //===================================================================================


	//echo "Executing query";
	
	//Submit form to database
	include'./dbconnect.php';

	$query = " INSERT INTO `pw_reg`(`Name`, `MCTSID`, `DOB`, `Age`, `Address`, `Landmark`, `area_id`, `pw_ph_no`, `GPS_latitude`, `GPS_longitude`, `GPS_Altitude`, `LMP`, `still_birth`, `low_birth_weight`, `miscarriage`, `blood_loss`, `ANC_visit_no`, `preg_count`, `preg_mnth`, `primigravida`, `last_preg_gap`, `pih_mother_sister`, `diabetes_mother_sister`, `prior_pih`, `med_diagnosis`, `multi_preg`, `c_sec`, `edema`, `headache_bluryvision`, `vaginal_bleeding`, `bp_systolic`, `bp_diastolic`, `mean_arterial_pressure`, `pulse_rate`, `Height_mtr`, `Curr_weight`, `BMI`, `anaemia`, `HIV`, `ANM_ID`, `form_id`) 
	VALUES ('$Name', '$MCTSID', '$DOB', '$Age', '$Address', '$Landmark', '$area_id', '$pw_ph_no', '$GPS_latitude', '$GPS_longitude', '$GPS_Altitude', '$LMP', '$still_birth', '$low_birth_weight', '$miscarriage', '$blood_loss', '$ANC_visit_no', '$preg_count', '$preg_mnth', '$primigravida', '$last_preg_gap', '$pih_mother_sister', '$diabetes_mother_sister', '$prior_pih', '$med_diagnosis', '$multi_preg', '$c_sec', '$edema', '$headache_bluryvision', '$vaginal_bleeding', '$bp_systolic', '$bp_diastolic', '$mean_arterial_pressure', '$pulse_rate', '$Height_mtr', '$Curr_weight', '$BMI', '$anaemia', '$HIV', '$ANM_ID', '$form_id')";

	//echo $query;
		
	$result = mysqli_query($conn,$query);
    
    if(mysqli_affected_rows($conn) ==1 )
    {
        deliver_response(200,"Form_Submitted",1);
    }
	else
    {
        deliver_response(400,"Database error",2);
    }

	$PWID = mysqli_insert_id($conn);
	mysqli_close($conn);

	include'./dbconnect.php';
	$query2 = "INSERT INTO pw_case_update(`PWID`, `GPS_latitude`, `GPS_longitude`, `GPS_Altitude`, `preg_mnth`, `ANC_visit_no`, `multi_preg`, `edema`, `headache_bluryvision`, `vaginal_bleeding`, `bp_systolic`, `bp_diastolic`, `mean_arterial_pressure`, `pulse_rate`, `Curr_weight`, `anaemia`, `HIV`, `ANM_ID`, `form_id`, `Remark`) 
	VALUES ('$PWID','$GPS_latitude', '$GPS_longitude', '$GPS_Altitude', '$preg_mnth', '$ANC_visit_no', '$multi_preg', '$edema', '$headache_bluryvision', '$vaginal_bleeding', '$bp_systolic', '$bp_diastolic', '$mean_arterial_pressure', '$pulse_rate', '$Curr_weight', '$anaemia', '$HIV', '$ANM_ID', '$form_id', 'First_record')";
	
	mysqli_query($conn,$query2);

	mysqli_close($conn);


	//====================Processing script=============================
	$risk_stat = 2; //1=SYS_AT_RISK,2=SYS_NORMAL
	$risk_reason = array();

	if($Age<18 OR $Age >30) //************************
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "AGE";
		
	}
	if($preg_count == 1 AND $Age >30)
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "elderly primi";
			
	}
		
	if($preg_count >=4)
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "grand multipara";

	}

	if($edema == "YES") //************************
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Edema";
	}
	if($headache_bluryvision == "YES")
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Headache bluryvision";
	}

	if($vaginal_bleeding=="YES")
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Vaginal bleeding";

	}

	if($preg_count >1)
	{
		if($prior_pih == "YES")
		{
			$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
			$risk_reason[] = "Prior PIH";
		}
		if($still_birth == "YES")
		{
			$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
			$risk_reason[] = "Still Birth";
		}
		if($low_birth_weight == "YES")
		{
			$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
			$risk_reason[] = "Low Birth Weight";

		}
		if($miscarriage == "YES")
		{
			$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
			$risk_reason[] = "Miscarriage";

		}
		if($c_sec == "YES")
		{
			$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
			$risk_reason[] = "C- Section";

		}
		if($blood_loss == "YES")
		{
			$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
			$risk_reason[] = "Blood Loss";

		}


	}


	
	if(!($med_diagnosis == " ")) //***********other medical history
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = $med_diagnosis;
	}

	if($pih_mother_sister == "YES")//***********Previous family history
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Family History PIH";
	}
	if($diabetes_mother_sister == "YES")//***********Previous family history
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Family History PIH";
	}

	if($bp_systolic > 140 OR $bp_diastolic > 90)
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "HIGH Blood Pressure";
	}
	if($BMI<19)
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Underweight";

	}
	elseif ($BMI>=25 AND $BMI <=30) {
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Overweight";
	}
	elseif ($BMI >= 30 AND $BMI <= 34.9) {
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Obesity";
	}

	if($Height_mtr <14.5)
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "short stature";

	}
	if($HIV == "YES")
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "HIV";
	}
	if($anaemia == "YES")
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Anaemia";
	}
	if(!($multi_preg == "NO"))
	{
		$risk_stat = 1; //1=SYS_AT_RISK,2=SYS_NORMAL
		$risk_reason[] = "Multi pregnant";
	}


	$list_of_reasons = implode(',',$risk_reason);

	//echo $list_of_reasons;
	
	if($risk_stat == 1) //if case is at risk then it should visit hospital, i.e due for visit
	{
		$case_status = 3; 
	}

	// ************************* store in the data base.*********************
	include'./dbconnect.php';
	
	$query = "INSERT INTO `pw_case_status`(PWID, `case_status`, `risk_status`, `updated_by`, `risk_reason`, `next_visit_date`)
	 VALUES ('$PWID','$case_status','$risk_stat','$ANM_ID','$list_of_reasons',curdate())";
	//echo $query;
	$result = mysqli_query($conn,$query);

	mysqli_close($conn);
	//*******************************Upata database****************************

}//Function to execute if form id is avvailable

else{//if form id is not available then execute this block and return invalid request

	deliver_response(400,'Invalid Request',999);
	exit(); 

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