<?php
/**
	Student Item page, shows details of student in left pane, right hand pane is record.
 */
//get student details
require_once ("requiresLogin.php");
include( "functionMain.php" );

$results = getStudent($_GET['id']);
$result = mysqli_fetch_assoc($results);

if(empty($result)){//in case invalid get.
	redirectPage("productList.php");
}

$title = $result['fname'] . " " . $result['sname'];
include('html/baseHeader.html');
include('mainMenu.html');

if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.

//check if the student has achieved any records.
$records = getRecordStudent($_GET['id']);
$record = mysqli_fetch_assoc($records);



//body of student item
include('html/studentItem.html');