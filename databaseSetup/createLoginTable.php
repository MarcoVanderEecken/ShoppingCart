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
        password CHAR(60),
        email VARCHAR(50),
        regdate TIMESTAMP
        )";

    if($conn->query($sql) === TRUE){
        echo "table \"Login\" created successfully";
    }else echo "Failed to create table \"Login\"" . $conn->error;

    echo "<br>Starting dummy value insertion <br>";
    include("dummyValues.php");
    echo "<br>dummy value insertion complete.<br>";

    echo "<a href='../index.php'> Return to main page</a>";
    //close database connection
    $conn->close();


