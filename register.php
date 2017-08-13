<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 1:34 PM
 */

    //navigation header
    $title = "Register";
    include('html/baseHeader.html');
    include('mainMenu.html');

    include("html/registrationForm.html");

    //javascript error message
    include( 'functionMain.php' );

    function createUser($username , $password, $hash){

    }

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){ //variables are set
        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])){ //variables aren't empty strings
            //we can now create the user account.
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            include('dbConn.php');

            $sql = "INSERT INTO login (username, password, email, regdate)
                    VALUES ('{$_POST['username']}', '{$hash}' , '{$_POST['email']}', NOW())"; //note use of '' for literal

            try{
                if($conn->query($sql) === TRUE) {
                    jsAlert("Successful registration");
                } else {
                    jsAlert("User not added" . $conn->error);
                }
            } catch (Exception $e){
                jsAlert("Exception occurred: " . $conn->error);
            }

            $conn->close();
        }
    }
