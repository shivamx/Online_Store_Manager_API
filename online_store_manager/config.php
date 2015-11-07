<?php

$con = mysqli_connect('localhost','your_username_here','your_password_here','online_store_manager');


	if( mysqli_connect_errno() ){
		echo 'could not connect to database';
	}
	
?>