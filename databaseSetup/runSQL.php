<?php

	require ('createDB.php');
	require('../dbConn.php');
	$query = file_get_contents("shoppingcart.sql");

	var_dump($conn);
	$stmt = mysqli_prepare($conn, $query);
	var_dump($query);
	var_dump($conn);
	var_dump($stmt);
	if ($stmt->execute()){
		echo "Everything successfully set up.";
	}else {
		echo "Failed to set up.";
	}

