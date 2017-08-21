<?php

//invoke database connection
include('../dbConn.php');

//create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
$sql =
	"CREATE TABLE Sport(
            id INT PRIMARY KEY AUTO_INCREMENT,
            type VARCHAR(255) NOT NULL,
            unit VARCHAR(20) NOT NULL
            )";

if($conn->query($sql) === TRUE){
	echo "table \"Sport\" created successfully";
}else echo "Failed to create table \"Sport\"" . $conn->error;

echo "<br>Starting dummy value insertion <br>";

$sql = "INSERT INTO Sport (type, unit)
                        VALUES ('80m Sprint' , 'second')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>Sport for 80m Sprint created";
}else echo "<br>Failed to create 80m Sprint sport " . $conn->error;


echo "<br>dummy value insertion complete.<br>";

echo "<a href='../index.php'> Return to main page</a>";
//close database connection
$conn->close();
