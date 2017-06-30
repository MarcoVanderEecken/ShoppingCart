<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 4:54 PM
 */

    //dummy values for the database.

    //assuming call through createLogin table which has $conn set up.

    //login table values.
    $hash = password_hash('user1', PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (username, password, email, regdate)
                    VALUES ('user1', '{$hash}' , 'user1@shoppingcart.com', NOW())"; //note use of '' for literal
    if($conn->query($sql) === TRUE){
        echo "<br>user1 created";
    }else echo "<br>Failed to create user1 " . $conn->error;


    $hash = password_hash('user2', PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (username, password, email, regdate)
                        VALUES ('user2', '{$hash}' , 'user2@shoppingcart.com', NOW())"; //note use of '' for literal
    if($conn->query($sql) === TRUE){
        echo "<br>user2 created";
    }else echo "<br>Failed to create user2 " . $conn->error;

    $hash = password_hash('user3', PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (username, password, email, regdate)
                        VALUES ('user3', '{$hash}' , 'user3@shoppingcart.com', NOW())"; //note use of '' for literal
    if($conn->query($sql) === TRUE){
        echo "<br>user3 created";
    }else echo "<br>Failed to create user3 " . $conn->error;

    $hash = password_hash('user4', PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (username, password, email, regdate)
                        VALUES ('user4', '{$hash}' , 'user4@shoppingcart.com', NOW())"; //note use of '' for literal
    if($conn->query($sql) === TRUE){
        echo "<br>user4 created";
    }else echo "<br>Failed to create user4 " . $conn->error;