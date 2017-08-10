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


//Only moderator (level 1) and admin (level 2) can add student
if($_SESSION['loggedIn'] == 1 || $_SESSION['loggedIn'] == 2){
	//navigation header
	$title = "Add Product";
	include('html/baseHeader.html');
	include('mainMenu.html');
}else {
	redirectPage( "index.php" );
	exit();
}

//check if user has previously submitted a student
if(isset($_POST['studentFName']) && isset($_POST['studentSName']) && isset($_POST['school'])
                                        && isset($_POST['birthDate'])){//product variables have been set

	if(!empty($_POST['studentFName']) && !empty($_POST['studentSName']) && !empty($_POST['school'])){//student variables are not empty

		//CHECK IF VARIABLE TYPES ARE CORRECT
		if(is_string($_POST['studentFName']) && is_string($_POST['studentSName']) && is_string($_POST['school'])){
			if ( $_FILES['birth_cert']['error'] !== UPLOAD_ERR_OK ) { //check if pdf file failed to upload
				die( "File upload error: " . $_FILES['birth_cert']['error'] ); //fail to upload
			}
			//check if file is actually a pdf
			$finfo = finfo_open( FILEINFO_MIME_TYPE );  //$finfo = file information
			$mime  = finfo_file( $finfo, $_FILES['birth_cert']['tmp_name'] ); //tmp_name is temporary name on server


			if ( $mime == 'application/pdf' ) {
				$basePath = $_SERVER['DOCUMENT_ROOT'] . '/ShoppingCart/Birth-Cert/';
				//append something unique like e.g. day to path for keeping file in.
				$extPath = date( 'Y-m-d' );

				$fullPath = $basePath . $extPath;


				//make sure folder exists. (file to go in content /
				if ( ! is_dir( $fullPath ) ) {
					mkdir( $fullPath, 0777, true );
				}

				$birthDate = date('Y-m-d' , strtotime( $_POST['birthDate']));

				//hash and username check
				require_once ("dbConn.php");
				//first check if student with desired username exists (namely fname+sname+birth_year)
				$sql = $conn->prepare("SELECT username FROM student WHERE username = ?;");
				$username =  str_replace(' ', '', $_POST['studentFName'] . $_POST['studentSName'] . strtok($birthDate. '-'));
				$sql->bind_param("s", $username);
				$sql->execute();
				$i = 1;
				$checkedUsername = null;
				while($sql->fetch() != 0){//while username already taken
					$checkedUsername = $username . $i;
					$sql->bind_param("s", $checkedUsername); //updated check.
					$i++;
				}
				$sql->close();
				//set username to checked username if not null.
				if(isset($checkedUsername)) $username = $checkedUsername;
				$hash = password_hash($username, PASSWORD_DEFAULT);
				while(strpos($hash, '/')){//do not allow / in hash so no path issues.
					$hash = password_hash($username, PASSWORD_DEFAULT);
				}

				//get file extension
				$ext = pathinfo( $_FILES['birth_cert']['name'], PATHINFO_EXTENSION );
				$hash = $hash . "." .  $ext;

				//move the file to the folder
				move_uploaded_file( $_FILES['birth_cert']["tmp_name"], $fullPath . "/" . $hash );

				//file got added successfully. Now create the student and associate birth certificate

				//change birthdate to datetime

				$birthYear = date('Y-m-d H:i:s', strtotime($_POST['birthDate']));
				$birthDate = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $birthDate)));


				//create prepared statement for adding student
				$sql = $conn->prepare("INSERT INTO student(username, fname, sname, birth_year, school) VALUES (?,?,?,?,?);");
				//bind variables for student
				$sql->bind_param("sssss", $username, $_POST['studentFName'], $_POST['studentSName'], $birthYear,
					$_POST['school']);
				if($sql->execute() == TRUE){}
				else jsAlert("Failed to add student: " . $sql->error);

				$sql->close();

				//save pdf location:
				$sql = $conn->prepare("INSERT INTO birth_certificate(username, type, path, hash) VALUES (?,?,?,?);");

				$type = 1;
				$sql->bind_param("siss" , $username, $type, $fullPath, $hash);
				if($sql->execute() == TRUE) {}
				else jsAlert("Failed to add birth certificate" . $sql->error);

				//close prepared statement
				$sql->close();
				$conn->close();
				jsAlert("Student Succesfully added.");

			} else {
				die( jsAlert("file type not permitted. (" . $mime . ")" ));
			}
		}
	}
}//end of check if post input

//body of add a product
include("html/addStudent.html");
include("html/indexFooter.html");