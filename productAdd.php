<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 7/3/2017
 * Time: 10:30 PM
 */

    //This file is for the admin to create a product. To be cordoned off later.

    //navigation header
    $title = "Add Product";
    include('html/baseHeader.html');
    include('mainMenu.html');

    include("php/mainFunctions.php");

    //in case session hasn't been started, e.g. user accessed page directly.
    if(!isset($_SESSION)){
        session_start();
    }

    //check if user has submitted product
    if(isset($_POST['productName']) && isset($_POST['productDescription']) && isset($_POST['productPrice'])
        && isset($_POST['productStock'])){//product variables have been set

        if(!empty($_POST['productName']) && !empty($_POST['productDescription']) && !empty($_POST['productPrice'])
            && !empty($_POST['productStock'])){//product variables are not empty


            //CHECK IF VARIABLE TYPES ARE CORRECT
            if(is_string($_POST['productName']) && is_string($_POST['productDescription']) && is_decimal($_POST['productPrice'])
                && is_int($_POST['productStock']) && $_POST['productStock'] >= 0){

                //create database connection
                include('dbConn.php');

                //create prepared statement to add product
                $sql = $conn->prepare("INSERT INTO product(productName, productDescription, productStock, productPrice) VALUES (?,?,?,?)");

                //bind statement variables
                $sql->bind_param("ssid",$_POST['productName'], $_POST['productDescription'], $_POST['productStock'], $_POST['productPrice']);
                $sql->execute();

                //close prepared statement
                $sql->close();

                //close database connection
                $conn->close();
            }else{//failed scrubbing
                jsAlert("The values entered were not of the correct type. Please use the website GUI to submit a new product.");
            }
        }
    }


    //body of add a product
    include("html/addProduct.html");