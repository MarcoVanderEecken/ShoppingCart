<?php

    //invoke database connection
    include('../dbConn.php');

    //create username and password table, password being
    $sql =
        "CREATE TABLE LoginLevel(
            level INT,
            description VARCHAR(50)
            )";

    if($conn->query($sql) === TRUE){
        echo "table \"Login Level\" created successfully";
    }else echo "Failed to create table \"Login Level\"" . $conn->error;

    echo "<br>Starting value insertion <br>";


    $sql = "INSERT INTO LoginLevel (level, description)
                        VALUES (0, 'Normal user');"; //note use of '' for literal
    if($conn->query($sql) === TRUE){
        echo "<br>level 0 created";
    }else echo "<br>Failed to create level 0 " . $conn->error;

    $sql = "INSERT INTO LoginLevel (level, description)
                            VALUES (1, 'Moderator');"; //note use of '' for literal
    if($conn->query($sql) === TRUE){
        echo "<br>level 1 created";
    }else echo "<br>Failed to create level 1 " . $conn->error;

    $sql = "INSERT INTO LoginLevel (level, description)
                            VALUES (2, 'Admin');"; //note use of '' for literal
    if($conn->query($sql) === TRUE){
        echo "<br>level 2 created";
    }else echo "<br>Failed to create level 2 " . $conn->error;


    echo "<br>Value insertion complete.<br>";

    echo "<a href='../index.php'> Return to main page</a>";
    //close database connection
    $conn->close();