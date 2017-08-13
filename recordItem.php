<?php
/**
Student Item page, shows details of student in left pane, right hand pane is record.
 */
//get student details
require_once ("requiresLogin.php");
include( "functionMain.php" );

$results = getRecordItem($_GET['id']);
$result = mysqli_fetch_assoc($results);

if(empty($result)){//in case invalid get.
	redirectPage("recordsList.php");
}

$title = $result['username'];
include('html/baseHeader.html');
include('mainMenu.html');

if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.

//body of student item
include('html/recordItem.html');