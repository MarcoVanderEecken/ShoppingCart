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