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


//$request = '[{"Name":"1","DOB":"0001-11-01","Age":"1","Socio_Eco_Status":"Option1","Address":"1","Landmark":"1","pw_ph_no":"1","MCTSID":"1","Area":"0","GPS_latitude":1,"GPS_longitude":2,"GPS_Altitude":3,"LMP":"2016-07-14","ANC_visit_no":"1","primigravida":"on","nulloparaous":"on","last_preg_gap":"1","pih_mother":"on","sister":"on","pih_sister":"on","prior_pih":"on","last_preg_status":"Aborted/SB/NND","med_diag":"Hypertension","IVF_his":"on","chronic_bp":"on","Diabetes_his":"Type 1","multi_parous":"on","nausea_vomiting":"on","bp_systolic":"12","bp_diastolic":"12","map":"804","pulse_rate":"89","Height_mtr":"123","Curr_weight":"50","BMI":"33.05","ANM_ID":"1","form_id":"12:50:27 GMT+0530 (India Standard Time)1","edema":"on","preg_count":"1","succ_preg_count":"1","preg_mnth":"1","c_sec":"on"}]';

//$request = '[{"Name":"Abhisek_test2","DOB":"1993-12-31","Age":"23","Socio_Eco_Status":"UPPER","Address":"Bombay","Landmark":"Bollywood","pw_ph_no":"1232123","MCTSID":"12321231","Area":"0","GPS_latitude":1,"GPS_longitude":2,"GPS_Altitude":3,"LMP":"2016-07-02","ANC_visit_no":"1","primigravida":"YES","nulloparaous":"YES","last_preg_gap":"1","pih_mother":"YES","sister":"NO","pih_sister":"NO","prior_pih":"NO","last_preg_status":"Aborted/SB/NND","med_diag":"Hypertension","IVF_his":"YES","chronic_bp":"YES","Diabetes_his":"Type 1","multi_parous":"NO","nausea_vomiting":"YES","bp_systolic":"45","bp_diastolic":"45","map":"3015","pulse_rate":"54","Height_mtr":"156","Curr_weight":"70","BMI":"28.76","ANM_ID":"12321231","form_id":"1469096354788_12321231","edema":"YES","preg_count":"1","succ_preg_count":"1","preg_mnth":"1","c_sec":"YES","doc_visit":"Yes"}]';


$json = json_decode($request,true);

//print_r($json);
//echo $json[0]['form_id'];

/*
$json = array('Name' => 'Laxmi','MCTSID' => '2147483647','DOB' => '1991-01-28','Age' => '23','Socio_Eco_Status' => 'LOWER','Address' => NULL,'Landmark' => NULL,'Area' => 'Ambad','pw_ph_no' => NULL,'GPS_latitude' => '1.000000','GPS_longitude' => '2.000000','GPS_Altitude' => '34.000000','LMP' => '2016-04-04','ANC_visit_no' => '2','preg_count' => NULL,'succ_preg_count' => NULL,'preg_mnth' => NULL,'doc_visit' => NULL,'primigravida' => 'NO','nulloparous' => 'YES','last_preg_gap' => '2','pih_mother' => NULL,'have_sister' => 'YES','pih_sister' => NULL,'prior_pih' => 'YES','last_preg_status' => 'Aborted/SB/NND','med_diagnosis' => 'Hypertension','IVF_his' => 'NO','chronic_bp' => 'NO','Diabetes_his' => '','c_sec' => NULL,'edema' => NULL,'multiparous' => 'NO','nausea_vomiting' => 'YES','bp_systolic' => '120','bp_diastolic' => '80','mean_arterial_pressure' => '10000.000000','pulse_rate' => '80','Height_mtr' => '56','Curr_weight' => '55','BMI' => '35.000000','ANM_ID' => '0','form_id' => 'tetsint_php_array');
*/
//Check value if empty, i.e if form_id exist then execute if block
if(!empty($json[0]['form_id']))
{
	/*
	//Get values from URL
	$pw_name = $json->pw_name; //2
    $mcts_id = $json->mcts_id; //3
    $pw_dob = $json->pw_dob;		//4 "yyyy-mm-dd" format
    $pw_age = $json->pw_age;		//5
    $socio_status = $json->socio_satus;//6 enum: 3=LOWER, 2=MIDDLE, 1=UPPER
    $Address = $json->Address;		//7
    $landmark = $json->landmark; //10
    $area = $json->area;		//11
	$pw_ph_no = $json->pw_ph_no;//----------------add to db
    $gps_lat = $json->gps_lat;  //12
    $gps_long = $json->gps_long;//13
    $gps_alt = $json->gps_alt;  //14
    $lmp = $json->lmp;			//15 "yyyy-mm-dd" date format
    $anc_vist = $json->anc_visit; //16 
    $primigravida = $json->primigravida;//17 1=yes, 2=no
    $nulloparaous = $json->nullopara; //18   1=yes, 2=no
    $last_preg_gap = $json->preg_gap; //19   
	$pih_mother = $json->pih_mother; //20    1=yes, 2=no
	$sister = $json->sister; //21            1=yes, 2=no
	$pih_sister = $json->pih_sister; //22    1=yes, 2=no
	$prior_pih = $json->prior_pih; //23      1=yes, 2=no
	$last_preg_status = $json->last_preg_status; //24  1='Aborted/SB/NND', 2= 'Successful/Live'
	$med_diag = $json->med_diag; //25 1='Hypertension',2='Chronic Kidney disease','3= Diabetes Mellitus',4= 'Autoimmune Disorders''Hypertension',5='Chronic Kidney disease',6= 'Diabetes Mellitus',7 ='Autoimmune Disorders'
	$ivf_hist = $json->ivf_hist; //26    1=yes, 2=no
	$chronic_bp = $json->chronic_bp; //27  1=yes, 2=no
	$diabetes_hist = $json->diabetes_hist; //28 1= 'type1',2= 'type2'
	$multi_parous = $json->multi_parous; //29  1=yes, 2=no
	$nausea_vomiting = $json->nausea_vomiting; //30 1=yes, 2=no
	$bp_systolic = $json->bp_systolic; //31 
	$bp_diastolic = $json->bp_diastolic; //32
	$map = $json->map; //33
	$pulse_rate = $json->pulse_rate; //34
	$height = $json->height; //35
	$weight = $json->weight; //36
	$bmi = $json->bmi; //37
	$anm_id = $json->anm_id; //38
	$form_id = $json->form_id; //39  Autogenerated
	*/



//===================================================================================

 $Name   = $json[0]['Name'];
 $MCTSID   = $json[0]['MCTSID'];
 $DOB   = $json[0]['DOB'];
 $Age   = $json[0]['Age'];
 $Socio_Eco_Status   = $json[0]['Socio_Eco_Status'];
 $Address   = $json[0]['Address'];
 $Landmark   = $json[0]['Landmark'];
 $Area   = $json[0]['Area'];
 $pw_ph_no   = $json[0]['pw_ph_no'];
 $GPS_latitude  = $json[0]['GPS_latitude'];
 $GPS_longitude  = $json[0]['GPS_longitude'];
 $GPS_Altitude  = $json[0]['GPS_Altitude'];
 $LMP  = $json[0]['LMP'];
 $ANC_visit_no  = $json[0]['ANC_visit_no'];
 $preg_count  = $json[0]['preg_count'];
 $succ_preg_count  = $json[0]['succ_preg_count'];
 $preg_mnth  = $json[0]['preg_mnth'];
 $doc_visit  = $json[0]['doc_visit'];
 $primigravida  = $json[0]['primigravida'];
 $nulloparous  = $json[0]['nulloparous'];
 $last_preg_gap  = $json[0]['last_preg_gap'];
 $pih_mother  = $json[0]['pih_mother'];
 $have_sister  = $json[0]['have_sister'];
 $pih_sister  = $json[0]['pih_sister'];
 $prior_pih  = $json[0]['prior_pih'];
 $last_preg_status  = $json[0]['last_preg_status'];
 $med_diagnosis  = $json[0]['med_diagnosis'];
 $IVF_his  = $json[0]['IVF_his'];
 $chronic_bp  = $json[0]['chronic_bp'];
 $Diabetes_his  = $json[0]['Diabetes_his'];
 $c_sec  = $json[0]['c_sec'];
 $edema  = $json[0]['edema'];
 $multiparous  = $json[0]['multiparous'];
 $nausea_vomiting  = $json[0]['nausea_vomiting'];
 $bp_systolic  = $json[0]['bp_systolic'];
 $bp_diastolic  = $json[0]['bp_diastolic'];
 $mean_arterial_pressure  = $json[0]['mean_arterial_pressure'];
 $pulse_rate  = $json[0]['pulse_rate'];
 $Height_mtr  = $json[0]['Height_mtr'];
 $Curr_weight  = $json[0]['Curr_weight'];
 $BMI  = $json[0]['BMI'];
 $ANM_ID  = $json[0]['ANM_ID'];
 $form_id  = $json[0]['form_id'];
 //$Registration_time  = $json['Registration_time'];


//===================================================================================



/*
INSERT INTO `pw_reg`(`rec_id`, `Name`, `MCTSID`, `DOB`, `Age`, `Socio_Eco_Status`, `Address`, `Landmark`, `Area`, `pw_ph_no`, `GPS_latitude`, `GPS_longitude`, `GPS_Altitude`, `LMP`, `ANC_visit_no`, `preg_count`, `succ_preg_count`, `preg_mnth`, `doc_visit`, `primigravida`, `nulloparous`, `last_preg_gap`, `pih_mother`, `have_sister`, `pih_sister`, `prior_pih`, `last_preg_status`, `med_diagnosis`, `IVF_his`, `chronic_bp`, `Diabetes_his`, `c_sec`, `edema`, `multiparous`, `nausea_vomiting`, `bp_systolic`, `bp_diastolic`, `mean_arterial_pressure`, `pulse_rate`, `Height_mtr`, `Curr_weight`, `BMI`, `ANM_ID`, `form_id`, `Registration_time`) VALUES ([value-1],[value-2],'',[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26],[value-27],[value-28],[value-29],[value-30],[value-31],[value-32],[value-33],[value-34],[value-35],[value-36],[value-37],[value-38],[value-39],[value-40],[value-41],[value-42],[value-43],[value-44],[value-45])
*/

	//echo "Executing query";
	
	//Submit form to database
	include'./dbconnect.php';

	$query = " INSERT INTO `pw_reg`(`Name`, `MCTSID`, `DOB`, `Age`, `Socio_Eco_Status`, `Address`, `Landmark`, `Area`, `pw_ph_no`, 
	`GPS_latitude`, `GPS_longitude`, `GPS_Altitude`, `LMP`, `ANC_visit_no`, `preg_count`, `succ_preg_count`, `preg_mnth`, `doc_visit`, `primigravida`, 
	`nulloparous`, `last_preg_gap`, `pih_mother`, `have_sister`, `pih_sister`, `prior_pih`, `last_preg_status`, `med_diagnosis`, `IVF_his`, `chronic_bp`, 
	`Diabetes_his`, `c_sec`, `edema`, `multiparous`, `nausea_vomiting`, `bp_systolic`, `bp_diastolic`, `mean_arterial_pressure`, `pulse_rate`,
	 `Height_mtr`, `Curr_weight`, `BMI`, `ANM_ID`, `form_id`)
	 
	  VALUES ('$Name', '$MCTSID', '$DOB', '$Age', '$Socio_Eco_Status', '$Address', '$Landmark', '$Area', '$pw_ph_no', 
	'$GPS_latitude', '$GPS_longitude', '$GPS_Altitude', '$LMP', '$ANC_visit_no', '$preg_count', '$succ_preg_count', '$preg_mnth', '$doc_visit', '$primigravida', 
	'$nulloparous', '$last_preg_gap', '$pih_mother', '$have_sister', '$pih_sister', '$prior_pih', '$last_preg_status', '$med_diagnosis', '$IVF_his', '$chronic_bp', 
	'$Diabetes_his', '$c_sec', '$edema', '$multiparous', '$nausea_vomiting', '$bp_systolic', '$bp_diastolic', '$mean_arterial_pressure', '$pulse_rate',
	 '$Height_mtr', '$Curr_weight', '$BMI', '$ANM_ID', '$form_id')";

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

	//====================Processing script=============================

	if($Age<18 OR $Age >30) //************************
	{
		$risk_stat = 2; //1=Normal, 2=At_Risk
		$risk_reason[] = "AGE";
	}
	if($primigravida == "YES" AND $Age>30)//************************
	{
		$risk_stat = 2; //1=Normal, 2=At_Risk
		$risk_reason[] = "Primigravida";
	}
	elseif ($primigravida ="NO") {

		if($prior_pih == "YES"){
			$risk_stat = 2; //1=Normal, 2=At_Risk
			$risk_reason[] = "Prior PIH";
		}
		if($last_preg_status == "Aborted/SB/NND")
		{
			$risk_stat = 2; //1=Normal, 2=At_Risk
			$risk_reason[] = "Previous preg Aborted/SB/NND";
		}

	}

	if($edema == "YES") //************************
	{
		$risk_stat = 2; //1=Normal, 2=At_Risk
		$risk_reason[] = "Edema";
	}
	
	if(!empty($med_diagnosis)) //***********other medical history
	{
		$risk_stat = 2; //1=Normal, 2=At_Risk
		$risk_reason[] = $med_diagnosis;
	}

	if($pih_mother == "YES" OR $pih_sister == "YES")//***********Previous family history
	{
		$risk_stat = 2; //1=Normal, 2=At_Risk
		$risk_reason[] = "Family History";
	}
	if($bp_systolic > 130 OR $bp_diastolic > 80)
	{
		$risk_stat = 2; //1=Normal, 2=At_Risk
		$risk_reason[] = "Blood Pressure";
	}

	$list_of_reasons = implode(',',$risk_reason);

	//echo $list_of_reasons;
	
	if($risk_stat == 2)
	{
		$visit_status = 1;
	}
	
	// ************************* store in the data base.*********************
	include'./dbconnect.php';
	
	$query = "INSERT INTO pw_case_status_system ( `MCTS_ID`, `system_risk_status`, `risk_reason`, `visit_status`) 
	VALUES ('$MCTSID',$risk_stat,'$list_of_reasons', '$visit_status')";
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