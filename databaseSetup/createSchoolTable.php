<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 8/7/2017
 * Time: 3:41 PM
 */

//invoke database connection
include('../dbConn.php');

//create username and password table, password being
$sql =
	"CREATE TABLE School(
            abr VARCHAR(10) PRIMARY KEY,
            name VARCHAR(50)
            )";

if($conn->query($sql) === TRUE){
	echo "table \"School\" created successfully";
}else echo "Failed to create table \"School\"" . $conn->error;

echo "<br>Starting value insertion <br>";

//do value insertion.