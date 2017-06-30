<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 1:37 PM
 */

    //Login section to be added here. Consider making it an embed function so that it is on all pages for ease of use.
    //think forum wise, so Username: text Password: password

    if(isset($_SESSION['welcomeMessage'])){ //redirect to index page once user welcomed.
        header("Location: ../index.php");
    }

    if(!isset($_SESSION)){ //in case session hasn't been started, e.g. user accessed page directly.
        session_start();
    }

    if(isset($_POST['username']) && isset($_POST['password']) ){ //username and password given
        if(!empty($_POST['username']) && !empty($_POST['password']) ){ //not empty

            include("dbConn.php");
            $sql = "SELECT password FROM login WHERE username = '{$_POST['username']}';";
            try{
                $result = $conn->query($sql);
                $row = mysqli_fetch_row($result);
                try{
                    if(password_verify($_POST['password'], $row[0])){//password is correct
                        $_SESSION['username'] = $_POST['username'];
                    }else{ //incorrect password
                        echo "Incorrect password, please try again. ";
                    }
                }catch (Exception $e){
                    echo "Username not found " . $e;
                }

            }catch (Exception $exception){
                echo "Exception occurred: " . $exception;
            }

        }
    }

    if(!isset($_SESSION['username'])){ //don't show the login page if logged in.
        include("..\html\login.html");
    }else{//Welcome user

        echo "Welcome " . $_SESSION['username']. ". <br>
        <meta http-equiv=\"refresh\" content='3; url=../index.php'>
        You will be redirected in 3 seconds...
        ";
        $_SESSION['welcomeMessage'] = true;
    }

