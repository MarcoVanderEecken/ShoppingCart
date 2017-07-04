<?php

    //invoke database connection
    include('../dbConn.php');

    //create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
    $sql =
        "CREATE TABLE ProductImage(
                productID INT PRIMARY KEY,
                imageName VARCHAR(255) NOT NULL,
                imagePath TEXT
                )";

    if($conn->query($sql) === TRUE){
        echo "table \"ProductImage\" created successfully";
    }else echo "Failed to create table \"ProductImage\"" . $conn->error;

    echo "<br>Starting dummy value insertion <br>";
    include("dummyValuesProductImage.php");
    echo "<br>dummy value insertion complete.<br>";

    echo "<a href='../index.php'> Return to main page</a>";
    //close database connection
    $conn->close();