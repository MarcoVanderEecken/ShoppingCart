<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 8/7/2017
 * Time: 3:48 PM
 */

//invoke database connection
include('../dbConn.php');

//create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
$sql =
	"CREATE TABLE Item_type(
            item_type INT PRIMARY KEY AUTO_INCREMENT,
            item_extension VARCHAR(255) NOT NULL
            )";

if($conn->query($sql) === TRUE){
	echo "table \"Item_Type\" created successfully";
}else echo "Failed to create table \"Item_Type\"" . $conn->error;

echo "<br>Starting value insertion <br>";


//do value insertion.
$sql = "INSERT INTO Item_type(item_type, item_extension)
                    VALUES (1,'application/pdf')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>school dsk created";
}else echo "<br>Failed to create dsk " . $conn->error;

$conn->close();