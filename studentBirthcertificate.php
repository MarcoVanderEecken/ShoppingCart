<?php
/*
 *  Birth certificate serving of the user.
 */

	require_once("requiresLogin.php");

	$title = "Students";



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


		//get the path and hash from the birth certificate table
		require( 'dbConn.php' );
		$sql = $conn->prepare( "SELECT path, hash FROM birth_certificate WHERE username = ?" );
		$sql->bind_param( 's', $_GET['username'] );
		$sql->execute();

		$rows = $sql->get_result();

		while ( $row = $rows->fetch_assoc() ) {
			$path = $row['path'];
			$hash = $row['hash'];
		}

		if($path == NULL){ //if the file does not exist
			header('Location: index');
		}

		 //It will be called username.pdf //inline embeds in page, use attachment for download
		header( 'Content-Disposition: inline; filename="' . $_GET['username'] . '.pdf"' );


		// The PDF source is in original.pdf
		try{
			readfile( $path . "/" . $hash );
		}catch(Exception $e){
			redirectToIndex();
		}
	}