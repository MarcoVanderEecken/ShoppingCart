	<?php

	require_once("requiresLogin.php");

	$title = "Students";
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

	//get schools.
	$sql = "SELECT abr, name FROM school ORDER BY abr;";
	$results = $conn->query($sql);

	//container for the products:
	echo "<div class='jumbotron'>";

	//form sort.
	echo "
			<form class='navbar-form navbar navbar-inverse' method='post' action='#' style='width:70%; margin: auto auto 1em auto;'>
				<div class='row'>
					<div class=\"form-group col-sm-12\" align='center' style='padding-top:1em'>
					<label style='color:white'>School: </label>
	                <select name='school'>";

	while($row = mysqli_fetch_assoc($results)){
		echo "<option value='". htmlspecialchars(htmlspecialchars($row['abr'])) ."'>" . htmlspecialchars($row['abr']) . " - " . htmlspecialchars($row['name']) . "</option>";
	}

	echo "</select>
					
	            
	                <button type='submit' class='btn-primary'>Search</button>
	                </div>
	            </div>
			</form>";


	//set up statement for: get product name, description, price and current stock
	//    $sql = "SELECT product.productID, productName, productDescription, productPrice, productStock, imageName, imagePath FROM product
	//          INNER JOIN productimage ON product.productID = productimage.productID ORDER BY product.productID;";

	$order = "school";
	if(isset($_POST['school'])){
		echo "SORT WAS SET AS : " . $_POST['school'];
		$sql = "SELECT username, school, fname, sname, birth_year FROM student WHERE school = '{$_POST['school']}' ORDER BY {$order}";
	}else{
		$sql = "SELECT username, school, fname, sname, birth_year FROM student ORDER BY {$order}";
	}

	//save query results
	$results = $conn->query($sql);

	//keep track of result number.
	$resultID = 0;

	//start of products
	echo "<div class='container'>
	";

	//    $imgPath = 'images/products/';

	//for each row
	while ($result = mysqli_fetch_assoc($results)){
		if ($resultID %3 === 0){
			if($resultID !== 0)echo "</div>";
			echo "<div class='row '>";
		}
		include('html/studentListItem.html');
		$resultID++; //increment item number
	}

	//end container for product items
	echo "</div>"; //end of container
	echo "</div>"; //end of jumbotron
