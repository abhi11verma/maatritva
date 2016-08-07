<?php

/*** mysql hostname ***/
$dbhost = 'mysql.hostinger.in';

/*** mysql username ***/
$dbuser = 'u652239707_id';

/*** mysql password ***/
$dbpass = 'commonpassword';
/*** mysql database***/
$dbname = 'u652239707_id';


$conn = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbname");


$query = "SET SESSION time_zone = 'Asia/Kolkata'";
mysqli_query($conn,$query);


// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
?>