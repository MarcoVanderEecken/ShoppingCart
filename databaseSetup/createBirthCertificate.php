<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 8/7/2017
 * Time: 3:44 PM
 */

//invoke database connection
include('../dbConn.php');

//create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
$sql =
	"CREATE TABLE Birth_Certificate(
            username VARCHAR(50) PRIMARY KEY REFERENCES Student(username),
            type INT REFERENCES Item_type(item_type),
            path TEXT,
            hash CHAR(60)
            )";

if($conn->query($sql) === TRUE){
	echo "table \"Birth Certificate\" created successfully";
}else echo "Failed to create table \"Birth Certificate\"" . $conn->error;

echo "<br>Starting value insertion <br>";


//do value insertion.
$sql = "INSERT INTO Birth_Certificate (username, type, path, hash)
                    VALUES ('firststudent', 1, 'pdf-doc','123')"; //Note the hash will be generated according to username as key.
if($conn->query($sql) === TRUE){
	echo "<br>school dsk created";
}else echo "<br>Failed to create dsk " . $conn->error;

$conn->close();