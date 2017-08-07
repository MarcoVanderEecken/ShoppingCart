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

$conn->close();