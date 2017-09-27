<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 8/7/2017
 * Time: 3:50 PM
 */

//invoke database connection
include('../dbConn.php');

//create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
$sql =
	"CREATE TABLE Student(
            ismale BOOLEAN PRIMARY KEY,
            gender_description VARCHAR(20) UNIQUE
            )";

if($conn->query($sql) === TRUE){
	echo "table \"Gender\" created successfully";
}else echo "Failed to create table \"Gender\"" . $conn->error;

echo "<br>Starting value insertion <br>";

//do value insertion.
$sql = "INSERT INTO Gender (ismale, gender_description)
                    VALUES (1, 'male')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>Male gender added";
}else echo "<br>Failed to add male gender " . $conn->error;

$sql = "INSERT INTO Gender (ismale, gender_description)
                    VALUES (0, 'female')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>Male gender added";
}else echo "<br>Failed to add male gender " . $conn->error;

$conn->close();