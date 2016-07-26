<?php
/*
===============================================================================
This code is a webservice to get data for showing report on the dashborad for mobile application.
================================================================================
*/

header("Content-Type:application/json");
//include("./function.php");


//$json = json_decode($request);
//

include'./dbconnect.php';

	$query = "SELECT * FROM  `v_summary_report`  ";   
	$result = mysqli_query($conn,$query);

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    echo json_encode($emparray);

?>