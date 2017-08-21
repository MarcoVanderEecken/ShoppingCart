<?php

//invoke database connection
include('../dbConn.php');

//create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
$sql =
	"CREATE TABLE RecordStatus(
            status INT PRIMARY KEY AUTO_INCREMENT,
            description VARCHAR(255)
            )";

if($conn->query($sql) === TRUE){
	echo "table \"ProductStatus\" created successfully";
}else echo "Failed to create table \"ProductStatus\"" . $conn->error;

echo "<br>Starting dummy value insertion <br>";

$sql = "INSERT INTO RecordStatus (description)
                        VALUES ('Waiting for approval')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>recordStatus 'Waiting for approval' created";
}else echo "<br>Failed to create 'Waiting for approval' recordStatus" . $conn->error;

$sql = "INSERT INTO RecordStatus (description)
                        VALUES ('Approved')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>recordStatus 'Approved' created";
}else echo "<br>Failed to create 'Approved' recordStatus " . $conn->error;

$sql = "INSERT INTO RecordStatus (description)
                        VALUES ('Declined')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>recordStatus for 'Declined' created";
}else echo "<br>Failed to create 'Declined' record " . $conn->error;

echo "<br>dummy value insertion complete.<br>";

echo "<a href='../index.php'> Return to main page</a>";
//close database connection
$conn->close();
