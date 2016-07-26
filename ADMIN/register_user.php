<?php
    

    if(empty($user_name=$_GET['user_name']))
            {
                header("location:./admin.php?message=' '");
            } 
          
          else{     $user_name=$_GET['user_name'];
                    $user_emp_id=$_GET['user_emp_id'];
                    $user_type = $_GET['user_type'];
                    $user_emp_id = $_GET['user_emp_id'];
                    $registered_by = $_GET['registered_by'];
                    $remark = $_GET['remark'];

                    include("../dbconnect.php");
                    
             
                        $query  =  "INSERT INTO `u652239707_id`.`user_white_list` 
                        (`user_id`, `user_type`, `user_name`, `user_emp_id`, `registered_by`, `Remark`) 
                        VALUES (NULL, '$user_type', '$user_name', '$user_emp_id', '$registered_by','$remark')";
                        
                        echo $query;

                        $result = mysqli_query($conn,$query);
                        mysqli_close();
                        header("location:../admin.php?message=$user_name Registered as NEW USER");
                        /*** close the database connection ***/
              }
             
       
        
?>