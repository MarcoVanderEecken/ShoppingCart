<?php
/**
 *  STILL NEED CHECK IN CASE PRODUCT ID IS INVALID.
 */
    //get product details
    include("mainFunctions.php");

    $results = getStudent($_GET['id']);
    $result = mysqli_fetch_assoc($results);

    $title = $result['productName'];
    include('html/baseHeader.html');
    include('mainMenu.html');

    if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.

    //path of images
    $imgPath = 'images/products/';

    //body of product item
    include('html/studentItem.html');