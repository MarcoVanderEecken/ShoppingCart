<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/20/2017
 * Time: 4:27 PM
 */

    $title = "Home Page";
    include('html/baseHeader.html');
    include('mainMenu.html');

    if(!isset($_SESSION)) session_start();
    $_SESSION['start'] = "Session started successfully";


    include('html/indexBody.html');

    include('html/indexFooter.html');

