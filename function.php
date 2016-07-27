<?php

//include'./dbconnect.php';


//List of all functions to be called


//Web service functions



//User functions

//verify if user exist
/*
function verify_user($aadhar_id,$password)
{   include'./dbconnect.php';
    $query = "Select * From user_profile where aadhar_id = '$aadhar_id' AND password = '$password'  ";
    
    $result = mysqli_query($conn,$query) or die("error in fetching");
    if(mysqli_num_rows($result)==1)
    {
        $row = mysql_fetch_assoc($result);
        $emp_type = $row['emp_type'];
        return $emp_type;
    }
	else
    {
        return 0;
    }
	
	mysqli_close();
    
}
*/


//Check if user is already registered
function check_user($aadhar_id)
{   include'./dbconnect.php';

	$query = " Select * From user_profile where aadhar_id = '$aadhar_id' ";
		
	$result = mysqli_query($conn,$query);
    
    if(mysqli_num_rows($result) >=1 )
    {
        return 1;
    }
	else
    {
        return 0;
    }
	
	mysqli_close();
}


//-----------Check white list of user_error

function check_white_list($user_type,$name,$emp_id)
{
    include"./dbconnect.php";
    $query = "SELECT * FROM user_white_list WHERE user_type = '$user_type' AND user_name = '$name' AND user_emp_id = '$emp_id'";

   $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)  == 1)
    {
        return 1; //user exist in white list
    }
    else
    {
        return 0; //user does not exist inn the white list 
    }


}






//Register new user

function register_new_user($aadhar_id,$emp_type,$name,$mobile_no,$center_id,$area_id,$password)
{
	include'./dbconnect.php';
	
    $query = "INSERT INTO `user_profile`(`aadhar_id`, `emp_type`, `name`, `mobile_no`, `center_id`, `area_id`, `password`)
     VALUES ('$aadhar_id','$emp_type','$name','$mobile_no','$center_id','$area_id','$password')";
    
    mysqli_query($conn,$query);

    if(mysqli_affected_rows($conn)==1)
       {    
           return 1;
       //Insertion successfull to database
       }
       else{
           return 0;
           //Some error in insertion to database
       }
    mysqli_close();
}

?>