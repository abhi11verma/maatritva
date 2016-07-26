<?php

/*** mysql hostname ***/
$hostname = 'mysql.hostinger.in';

/*** mysql username ***/
$username = 'u652239707_id';

/*** mysql password ***/
$password = 'commonpassword';


$conn = mysqli_connect($hostname,$username,$password);
 if (!$conn) {
     printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
echo 'Connected successfully';
?>