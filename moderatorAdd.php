<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 7/3/2017
 * Time: 10:30 PM
 */

//This file is for the admin to create a product

//in case session hasn't been started, e.g. user accessed page directly.
require_once ("requiresLogin.php");

include("mainFunctions.php");


//Only admin (level 2) can add moderator
if($_SESSION['loggedIn'] == 2){
	//navigation header
	$title = "Add Moderator";
	include('html/baseHeader.html');
	include('mainMenu.html');
}else {
	redirectPage( "index.php" );
	exit();
}

if(empty($schoolList)){//list of all schools
	$schoolList = getAllSchools();
}

//check if user has previously submitted a student
do if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){//product variables have been set

	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])){//student variables are not empty

		//CHECK IF VARIABLE TYPES ARE CORRECT
		$email = htmlspecialchars($_POST['email']);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			jsAlert("Please enter a valid e-mail address");
			break;
		}

		if(is_string($_POST['username']) && is_string($_POST['password'])){

			//username check
			require ("dbConn.php");
			//first check if a user with desired username already exists
			$sql = $conn->prepare("SELECT username FROM student WHERE username = ?;");
			$username = htmlspecialchars($_POST['username']);
			$sql->bind_param("s", $username);
			$sql->execute();
			if($sql->fetch() != 0){//if username already taken
				jsAlert("Username already taken, please try again with a different username.");
				break;
			}
			$sql->close();

			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


			//create prepared statement for adding teacher
			$sql = $conn->prepare("INSERT INTO login(username, password, email, regdate, level) VALUES (?,?,?,NOW(),0);");
			//bind variables for teacher
			$sql->bind_param("sss", $username, $password, $email);
			if($sql->execute() == TRUE){}
			else {
				jsAlert( "Failed to add teacher: " . $sql->error );
				break;
			}

			$sql->close();
			$conn->close();
			jsAlert("Teacher Successfully added.");
		}
	}
} while(false);//end of check if post input


//body of add a product
include("html/addTeacher.html");
include("html/indexFooter.html");