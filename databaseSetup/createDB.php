<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 1:56 PM
 */
    //start database connection
    include('../dbConnStart.php');

    //create database
    $sql = "CREATE DATABASE shoppingCart";
    if($conn->query($sql) === TRUE){
        $msg = "Database created successfully";
    } else {
        $msg = "Error creating database: " . $conn->error;
    }

    //close database connection
    $conn->close();

    $msg = $msg . "<br>";
    $msg = $msg . "<a href='../index.php'> Return to main page</a>";

    echo $msg;