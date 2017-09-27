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
	"CREATE TABLE Event(
            event_id INT PRIMARY KEY AUTO_INCREMENT,
            event_descrption VARCHAR(255),
            event_start TIMESTAMP,
            event_end TIMESTAMP,
            event_host VARCHAR(10) REFERENCES school(abr)
            )";

if($conn->query($sql) === TRUE){
	echo "table \"Event\" created successfully";
}else echo "Failed to create table \"Event\"" . $conn->error;

echo "<br>Starting value insertion <br>";

//do value insertion.
$timestamp       = date("Y-m-d H:i:s");
$futureTimestamp = date("Y-m-d H:i:s", strtotime( $timestamp + strtotime('+ 1 week')));
$sql             = "INSERT INTO Event (event_descrption, event_start, event_end, event_host)
                    VALUES ('the first event', $timestamp, $futureTimestamp, 'dsk')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>First event added";
}else echo "<br>Failed to add event" . $conn->error;


$conn->close();