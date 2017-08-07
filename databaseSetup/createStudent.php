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
            username VARCHAR(50) PRIMARY KEY,
            school VARCHAR(10) REFERENCES School(abr),
            fname TEXT,
            sname TEXT,
            birth_year TIMESTAMP
            )";

if($conn->query($sql) === TRUE){
	echo "table \"Student\" created successfully";
}else echo "Failed to create table \"Student\"" . $conn->error;

echo "<br>Starting value insertion <br>";

//do value insertion.
$sql = "INSERT INTO Student (username, school, fname, sname, birth_year)
                    VALUES ('firststudent', 'dsk', 'First', 'Student', NOW())"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>school dsk created";
}else echo "<br>Failed to create dsk " . $conn->error;

$conn->close();