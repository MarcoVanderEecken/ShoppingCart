<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 1:34 PM
 */
    echo "<h1> Registration Page: </h1>";

    include("html/registrationForm.html");

    function createUser($username , $password, $hash){

    }

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['username']) & isset($_POST['password'])){ //variables are set
        if(!empty($_POST['username']) & !empty($_POST['password'])){ //variables aren't empty strings
            //we can now create the user account.
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        }
    }
