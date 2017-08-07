<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 1:37 PM
 */

    //Login section to be added here. Consider making it an embed function so that it is on all pages for ease of use.
    //think forum wise, so Username: text Password: password

    //navigation header
    $title = "Login";
    include('html/baseHeader.html');
    include('mainMenu.html');

    //javascript alert
    include('mainFunctions.php');

    if(isset($_SESSION['welcomeMessage'])){ //redirect to index page once user welcomed.
        header("Location: index");
    }

    if(!isset($_SESSION)){ //in case session hasn't been started, e.g. user accessed page directly.
        session_start();
    }

    function redirectUser(){
        echo "
            <div class='container'>
                <div class='jumbotron'>
                    <meta http-equiv=\"refresh\" content='3; url=index' property=';'>
                    Welcome {$_SESSION['username']} (Level: {$_SESSION['loggedIn']}) <br>
                    You will be redirected in 3 seconds...
                </div>
            </div>";
        $_SESSION['welcomeMessage'] = true;
    }

    if(!isset($_SESSION['loggedIn'])){ //don't show the login page if logged in.
        include("html/login.html");
    }else{//Welcome user
        redirectUser();
    }

    if(isset($_POST['username']) && isset($_POST['password']) ){ //username and password given

            include("dbConn.php");
            $sql = "SELECT password, level FROM login WHERE username = '{$_POST['username']}';";
            try {
                $result = $conn->query($sql);
                $row = mysqli_fetch_row($result);
                try {
                    if (password_verify($_POST['password'], $row[0])) {//password is correct
                        $_SESSION['username'] = $_POST['username'];
                        $_SESSION['loggedIn'] = $row[1];
                        if (isset($_POST['remember'])) {
                            setcookie('username', $_POST['username'], time() + 60 * 60 * 24);
                        }else unset($_COOKIE['username']);
                        refreshPage();
                    } else { //incorrect password
                        jsAlert("Incorrect password, please try again. ");
                    }
                } catch (Exception $e) {
                    jsAlert("Username not found {$e}");
                }
            } catch (Exception $exception) {
                jsAlert("Exception occurred: " . $exception);
            }
            $conn->close();
    }

