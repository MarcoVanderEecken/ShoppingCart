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