<?php
/**
 * Created by PhpStorm.
 * User: Marco Van der Eecken
 * Date: 6/30/2017
 * Time: 12:59 PM
 */


    /**
     * Starts session if no session started, then destroys session.
     */
    function logout() {
        if(!isset($_SESSION)){
            session_start();
        }
        session_destroy();
        echo "logout page.";
        header('Location: ../index.php'); //.. redirects to parent directory.
    }

    logout();
