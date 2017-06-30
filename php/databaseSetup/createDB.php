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
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    //close database connection
    $conn->close();

    echo "<br>";
    echo "<a href='../../index.php'> Return to main page</a>";

