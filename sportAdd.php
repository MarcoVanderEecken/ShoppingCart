<?php
/**
 * Add school
 */

//This file is for the admin to create a sport

//in case session hasn't been started, e.g. user accessed page directly.
require_once ("requiresLogin.php");

include( "functionMain.php" );


//Only admin (level 2) can add sport
if($_SESSION['loggedIn'] == 2){
	//navigation header
	$title = "Add Sport";
	include('html/baseHeader.html');
	include('mainMenu.html');
}else {
	redirectPage( "index.php" );
	exit();
}

//check if user has previously submitted a sport
do if(isset($_POST['sportType']) && isset($_POST['unit'])){//sport variables have been set

	if(!empty($_POST['sportType']) && !empty($_POST['unit'])){//sport variables are not empty

		//CHECK IF VARIABLE TYPES ARE CORRECT
		$sportType = htmlspecialchars($_POST['sportType']);
		$unit = htmlspecialchars($_POST['unit']);

		if(is_string($sportType) && is_string($unit)){

			//sport type check
			require ("dbConn.php");
			//first check if sport already exists
			$sql = $conn->prepare("SELECT type FROM sport WHERE type = ?;");
			$sql->bind_param("s", $sportType);
			$sql->execute();
			if($sql->fetch() != 0){//if username already taken
				jsAlert("Sport type has already been taken, please try again with a different sport type.");
				$sql->close();
				$conn->close();
				break;
			}
			$sql->close();

			//create prepared statement for adding sport
			$sql = $conn->prepare("INSERT INTO sport(type, unit) VALUES (?,?);");
			//bind variables for sport
			$sql->bind_param("ss", $sportType, $unit);
			if($sql->execute() == TRUE){
				//success. Message at end
			}else {
				jsAlert( "Failed to add sport: " . $sql->error );
				$sql->close();
				$conn->close();
				break;
			}

			$sql->close();
			$conn->close();
			jsAlert("Sport successfully added.");
		}
	}
} while(false);//end of check if post input


//body of add a sport
include("html/addSport.html");
include("html/indexFooter.html");