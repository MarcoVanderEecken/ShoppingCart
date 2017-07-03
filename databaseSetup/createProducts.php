<?php

    //invoke database connection
    include('../dbConn.php');

    //create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
    $sql =
        "CREATE TABLE Product(
            productID INT PRIMARY KEY AUTO_INCREMENT,
            productName VARCHAR(255) NOT NULL,
            productDescription TEXT,
            productStock INT(11),
            productPrice DECIMAL(6,2)
            )";

    if($conn->query($sql) === TRUE){
        echo "table \"Product\" created successfully";
    }else echo "Failed to create table \"Product\"" . $conn->error;

    echo "<br>Starting dummy value insertion <br>";
    include("dummyValuesProducts.php");
    echo "<br>dummy value insertion complete.<br>";

    echo "<a href='../index.php'> Return to main page</a>";
    //close database connection
    $conn->close();
