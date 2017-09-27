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

include( "functionMain.php" );


$title = "Add Record";
include('html/baseHeader.html');
include('mainMenu.html');


if(empty($sportsCats)){
	//result list of all sports types
	$sportsCats = getAllSports();
}

if(empty($studentList)){
	//result list of all students
	$studentList = getAllStudents();
}
if(empty($eventList)){
	//result list of all students
	$eventList = getAllEvents();
}


//check if user has submitted product
do if(isset($_POST['studentUsername'], $_POST['recordDate'], $_POST['sportType'], $_POST['record'], $_POST['event'])){//product variables have been set


		//CHECK IF VARIABLE TYPES ARE CORRECT
		if(is_string($_POST['studentUsername']) && validateDate($_POST['recordDate']) && is_numeric($_POST['sportType']) && is_numeric($_POST['event'])
		   && is_numeric($_POST['record'])){

			require ("dbConn.php");

			//Check if the username is valid.
			$sql = $conn->prepare("SELECT username FROM student WHERE username = ?;");
			$username = htmlspecialchars($_POST['studentUsername']);
			$sql->bind_param("s", $username);
			$sql->execute();

			if($sql->fetch() == 0){//username doesn't exist
				jsAlert("The username does not exist");
				break;
			}

			$sql->close();

			//Check if sport type is valid.
			$sql = $conn->prepare("SELECT sport.id FROM sport WHERE sport.id = ?;");
			$sportID = htmlspecialchars($_POST['sportType']);
			$sql->bind_param("i", $sportID);
			$sql->execute();

			if($sql-> fetch() == 0){//sport does not exist
				jsAlert("The sport type does not exist");
			}

			$sql->close();

			//check if the date is valid (not in the future)
			if(strtotime($_POST['recordDate']) > time()){
				jsAlert("Please select a non-future date");
				break;
			}

			//mysql format for datetime
			$recordDate = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['recordDate'])));

			//add the record to the database.
			$sql = $conn->prepare("INSERT INTO record(username, sport_id, record, recordDate, recordEvent) VALUES (?,?,?,?,?);");
			$sql->bind_param("siisi", $username, $sportID, $_POST['record'], $recordDate, $_POST['event']);
			echo $sql->error;
			$sql->execute();

			$sql->close();
			$conn->close();

			jsAlert("Successfully added record for " . $username);

		}else{//failed scrubbing
			jsAlert("The values entered were not of the correct type. Please use the website GUI to submit a new record.");
		}

}while (false);//end of check if post input

//body of add a product
include("html/addRecord.html");
include("html/indexFooter.html");