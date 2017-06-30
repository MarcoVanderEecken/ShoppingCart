<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 2:04 PM
 */

    //invoke database connection
    include('../dbConn.php');

    //create username and password table, password being
    $sql =
        "CREATE TABLE Login(
        username VARCHAR(50) PRIMARY KEY,
        password VARCHAR(255),
        hash VARCHAR(255),
        email VARCHAR(50),
        regdate TIMESTAMP
        )";

    if($conn->query($sql) === TRUE){
        echo "table \"Login\" created successfully";
    }else echo "Failed to create table \"Login\"" . $conn->error;

    //close database connection
    $conn->close();


