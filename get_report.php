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

	$query = "select `v_latest_pw_case_status`.`risk_status` AS `label`,
 count(*) AS `count` 
 from `v_latest_pw_case_status`  where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id') group by `v_latest_pw_case_status`.`risk_status` 

 union 
 select 'Total_pw' AS `label`,count(*) AS `count` from `v_latest_pw_case_status` where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 union
 select 'pw_due_for_visit' AS label , count(*) as count from v_latest_pw_case_status where (case_status = 'DUE' OR case_status = 'VISITED_NEXT_DATE') AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 union
 select 'pw_visited' AS label , count(*) as count from v_latest_pw_case_status where case_status = 'VISITED' AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 ";   

    //casese
    $SYS_AT_RISK = 0 ;
    $SYS_NORMAL = 0 ;
    $DOC_AT_RISK = 0 ;
    $DOC_NORMAL = 0 ;
    $Total_pw = 0 ;
    $pw_due_for_visit = 0 ;
    $pw_visited = 0 ;

	$result = mysqli_query($conn,$query);
    
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {   

        if($row['label'] == 'SYS_AT_RISK')
        {
            $SYS_AT_RISK = $row['count'];
        }
        elseif($row['label'] == 'SYS_NORMAL'){
            $SYS_NORMAL = $row['count'];
        }
        elseif($row['label'] == 'DOC_AT_RISK'){
            $DOC_AT_RISK = $row['count'];
        }
        elseif($row['label'] == 'DOC_NORMAL'){
            $DOC_NORMAL = $row['count'];
        }
        elseif($row['label'] == 'Total_pw'){
            $Total_pw = $row['count'];
        }
        elseif($row['label'] == 'pw_due_for_visit'){
            $pw_due_for_visit = $row['count'];
        }
        elseif($row['label'] == 'pw_visited'){
            $pw_visited = $row['count'];
        }

        //$emparray[] = $row;
       //  echo "{".$row['label'].":".$row['count']."}";

    }

    $emparray = array("SYS_AT_RISK"=>"$SYS_AT_RISK",
                "SYS_NORMAL"=>"$SYS_NORMAL",
                "DOC_AT_RISK"=>"$DOC_AT_RISK",
                "DOC_NORMAL"=>"$DOC_NORMAL",
                "Total_pw"=>"$Total_pw",
                "pw_due_for_visit"=>"$pw_due_for_visit",
                "pw_visited"=>"$pw_visited"
    
                );

    echo json_encode($emparray);

?>