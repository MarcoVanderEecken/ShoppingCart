<?php
/**
 *  STILL NEED CHECK IN CASE PRODUCT ID IS INVALID.
 */
    //get product details
    include("php/mainFunctions.php");

    $results = getProduct($_GET['id']);
    $result = mysqli_fetch_assoc($results);

    $title = $result['productName'];
    include('html/baseHeader.html');
    include('mainMenu.html');

    if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.

    //body of product item
    include('html/productItem.html');