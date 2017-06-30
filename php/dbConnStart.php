<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 2:17 PM
 */

    $serverName = "localhost";
    $username = "root";
    $password = "";

    //create connection
    $conn = new mysqli($serverName, $username, $password);

    //check connection
    if($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }