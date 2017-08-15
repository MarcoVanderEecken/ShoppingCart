<?php
/*
 *  Birth certificate serving of the user.
 */

	require_once("requiresLogin.php");

	$title = "Students";

	$maxResPage = 6; //how many results should be displayed per page.

	if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
	$_SESSION['start'] = "Session started successfully";
	include('functionMain.php');

	if($_SESSION['loggedIn'] == 0){
		redirectToIndex();
	}

	//get the username.
	if(isset($_GET['username'])) {


		//File type to be served:
		header( 'Content-type: application/pdf' );

		// It will be called username.pdf
		header( 'Content-Disposition: attachment; filename="' . $_GET['username'] . '.pdf"' );

		//get the path and hash from the birth certificate table
		require ('dbConn.php');
		$sql = $conn->prepare("SELECT path, hash FROM birth_certificate WHERE username = ?");
		$sql->bind_param('s', $_GET['username']);
		$sql->execute();

		$row = $sql->fetch();
		$path = $row[0];
		$hash = $row[1];

		// The PDF source is in original.pdf
		try{
			readfile( $path . $hash );
		}catch(Exception $e){
			redirectToIndex();
		}
	}