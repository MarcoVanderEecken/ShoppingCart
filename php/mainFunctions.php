<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 8:56 PM
 */

    function jsAlert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    };

    function is_decimal($num){
        return is_numeric($num) && floor($num) != $num;
    }

    function refreshPage(){
        echo "<meta http-equiv=\"refresh\" content='0'>";
    }

    function redirectPage($newURL){
        echo "<meta http-equiv=\"refresh\" content='0; url=\"{$newURL}\"'>";
    }

    function getProduct($itemID){
        //set up statement for: get product name, description, price and current stock
        $conn = 0;
        include("dbConn.php");
        $sql = "SELECT productID, productName, productDescription, productPrice, productStock FROM product WHERE productID={$itemID};";
        //save query result
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }