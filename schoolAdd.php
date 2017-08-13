<?php
/**
 * Add school
 */

//This file is for the admin to create a product

//in case session hasn't been started, e.g. user accessed page directly.
require_once ("requiresLogin.php");

include( "functionMain.php" );


//Only admin (level 2) can add school
if($_SESSION['loggedIn'] == 2){
	//navigation header
	$title = "Add School";
	include('html/baseHeader.html');
	include('mainMenu.html');
}else {
	redirectPage( "index.php" );
	exit();
}

//check if user has previously submitted a school
do if(isset($_POST['school']) && isset($_POST['abbr'])){//school variables have been set

	if(!empty($_POST['school']) && !empty($_POST['abbr'])){//school variables are not empty

		//CHECK IF VARIABLE TYPES ARE CORRECT
		$school = htmlspecialchars($_POST['school']);
		$abbr = htmlspecialchars($_POST['abbr']);

		if(is_string($school) && is_string($abbr)){

			//school check
			require ("dbConn.php");
			//first check if school with desired name already exists
			$sql = $conn->prepare("SELECT name FROM school WHERE name = ?;");
			$sql->bind_param("s", $school);
			$sql->execute();
			if($sql->fetch() != 0){//if username already taken
				jsAlert("School name has already been taken, please try again with a different school name.");
				$sql->close();
				$conn->close();
				break;
			}
			$sql->close();

			//check if school with abbreviation already exists
			$sql = $conn->prepare("SELECT abr FROM school WHERE abr = ?;");
			$sql->bind_param("s", $abbr);
			$sql->execute();
			if($sql->fetch() != 0){//if username already taken
				jsAlert("School abbreviation has already been taken, please try again with a different abbreviation.");
				$sql->close();
				$conn->close();
				break;
			}
			$sql->close();

			//create prepared statement for adding school
			$sql = $conn->prepare("INSERT INTO school(name, abr) VALUES (?,?);");
			//bind variables for school
			$sql->bind_param("ss", $school, $abbr);
			if($sql->execute() == TRUE){
				//success. Message at end
			}else {
				jsAlert( "Failed to add school: " . $sql->error );
				$sql->close();
				$conn->close();
				break;
			}

			$sql->close();
			$conn->close();
			jsAlert("School Successfully added.");
		}
	}
} while(false);//end of check if post input


//body of add a product
include("html/addSchool.html");
include("html/indexFooter.html");