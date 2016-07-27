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
$emp_id = $_GET['emp_id'];// get data from Json call

include'./dbconnect.php';

	$query = "
 select `v_pw_case_latest_status`.`system_risk_status` AS `label`,
 count(0) AS `count` 
 from `v_pw_case_latest_status`  where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id') group by `v_pw_case_latest_status`.`system_risk_status` 

 union 
 select 'Total_pw' AS `label`,count(0) AS `count` from `v_pw_case_latest_status` where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 union
 select 'pw_due_for_visit' AS label , count(*) as count from v_pw_case_latest_status where visit_status = 'DUE' AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 union
 select 'pw_visited' AS label , count(*) as count from v_pw_case_latest_status where visit_status = 'VISITED' AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 ";   
	$result = mysqli_query($conn,$query);

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    echo json_encode($emparray);

?>