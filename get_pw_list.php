<?php
/*
===============================================================================
This code is a webservice to enter form data in the system.
Use following format to consume this webservice.
================================================================================
*/

header("Content-Type:application/json");
//include("./function.php");

$emp_id = $_GET['emp_id'];// get data from Json call
//$request ='{"emp_id":"ANM1"}';

//$json = json_decode($request);
//$json = json_decode($request);
//$emp_id = $json->emp_id;

include'./dbconnect.php';

    $query = "SELECT * FROM v_pw_details pw WHERE pw.area_id IN(select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')";
	//$query = "SELECT * FROM v_pw_case_status ";   
    //$query = "SELECT * FROM v_pw_details WHERE emp";   
	$result = mysqli_query($conn,$query);

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    echo json_encode($emparray);

?>
