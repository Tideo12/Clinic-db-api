<?php 
	$conn =new mysqli("localhost","root","","clinic_db");

	if($conn->connect_error){
		die("Could not conect to the database!".$conn->connect_error);
	}

 ?>