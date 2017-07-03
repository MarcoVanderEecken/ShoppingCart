<?php
    $title = "Home Page";
    include('html/baseHeader.html');
    include('mainMenu.html');

    if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
    $_SESSION['start'] = "Session started successfully";


    include("html/productBody.html");