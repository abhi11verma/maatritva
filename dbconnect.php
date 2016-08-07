<?php

/*** mysql hostname ***/
$dbhost = 'localhost';

/*** mysql username ***/
$dbuser = 'idspnashik_maatritva_user';

/*** mysql password ***/
$dbpass = 'maatritva_db_2016';
/*** mysql database***/
$dbname = 'idspnashik_maatritva2';


$conn = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbname");


$query = "SET SESSION time_zone = '+5:30'";
mysqli_query($conn,$query);


// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
?>