<?php
    $title = "Shop";
    include('html/baseHeader.html');
    include('mainMenu.html');

    if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
    $_SESSION['start'] = "Session started successfully";

    //connect to database to fetch products.
    include("dbConn.php");
    $products = array();

    //set up statement for: get product name, description, price and current stock
    $sql = "SELECT productName, productDescription, productPrice, productStock FROM product;";

    //save query results
    $results = $conn->query($sql);

    //keep track of result number.
    $resultID = 0;

    //container for the products:
    echo "<div class='container'>
";

    //for each row
    while ($result = mysqli_fetch_assoc($results) ){
        if ($resultID %3 === 0){
            if($resultID !== 0)echo "</div>";
            echo "<div class='row'>";
        }
        include('html/productItem.html');
        $resultID++; //increment item number
    }

    //end container for product items
    echo "</div>";
