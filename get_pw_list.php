<?php
/*
===============================================================================
This code is a webservice to enter form data in the system.
Use following format to consume this webservice.
================================================================================
*/

header("Content-Type:application/json");
//include("./function.php");


//$json = json_decode($request);
//

include'./dbconnect.php';

	//$query = "SELECT * FROM v_pw_case_status ";   
    $query = "SELECT * FROM v_pw_details ";   
	$result = mysqli_query($conn,$query);

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    echo json_encode($emparray);

?>
