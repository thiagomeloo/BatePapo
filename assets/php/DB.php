<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = 'bate_papo';
	$conn = new mysqli($servername, $username, $password, $db);

	if($conn ->connect_error){
		die("Connection failed : ". $conn ->connect_error) ;
	}

?>