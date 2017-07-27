<?php
    $title = "Shop";
    include('html/baseHeader.html');
    include('mainMenu.html');
    require_once("productCart.php");
    if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
    $_SESSION['start'] = "Session started successfully";

    include("mainFunctions.php");


    if(isset($_GET['id'])){//if product ID has been selected.
        echo "HELLO THE PRODUCT ID HAS BEEN SET.";
        //redirect to productItem page
        redirectPage("productItem.php?id={$_GET['id']}");
    }

    //connect to database to fetch products.
    include("dbConn.php");

    //set up statement for: get product name, description, price and current stock
    $sql = "SELECT product.productID, productName, productDescription, productPrice, productStock, imageName, imagePath FROM product
          INNER JOIN productimage ON product.productID = productimage.productID ORDER BY product.productID;";

    //save query results
    $results = $conn->query($sql);

    //keep track of result number.
    $resultID = 0;

    //container for the products:
    echo "<div class='container'>
";

    $imgPath = 'images/products/';

    //for each row
    while ($result = mysqli_fetch_assoc($results)){
        if ($resultID %3 === 0){
            if($resultID !== 0)echo "</div>";
            echo "<div class='row '>";
        }
        include('html/productListItem.html');
        $resultID++; //increment item number
    }

    //end container for product items
    echo "</div>";
