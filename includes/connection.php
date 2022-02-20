<?php
 $dbhost = 'localhost';
 $dbuser = 'baroxghp_cart';
 $dbpass = 'deepak@123';
 $dbname = 'baroxghp_cart';
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

 if(! $conn ) {
	die('Could not connect: ' . mysqli_error());
 }
?>