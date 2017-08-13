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
		redirectPage("studentItem?id={$_GET['id']}");
	}


	//connect to database to fetch schools.
	include("dbConn.php");

	//get schools.
	$sql = "SELECT abr, name FROM school ORDER BY abr;";
	$results = $conn->query($sql);

	//container for all.
	echo "<div class='container'>";

	//container for the nav:
	echo "<div class='jumbotron'>";

	//form sort.
	echo "
			<form class='navbar-form navbar navbar-inverse' method='post' action='#' style='width:70%; margin: auto auto 1em auto;'>
				<div class='row'>
					<div class=\"form-group col-sm-12\" align='center' style='padding-top:1em'>
					<label style='color:white'>School: </label>
	                <select name='school'>
						<option value='*' selected='selected'> Any</option>";

	$schoolsList = array();
	array_push($schoolsList, '*'); //add the any option

	while($row = mysqli_fetch_assoc($results)){
		if($row['abr'] == $_POST['school']){
			echo "<option value='". htmlspecialchars(htmlspecialchars($row['abr'])) ."' selected='selected'>" . htmlspecialchars($row['abr']) . " - " . htmlspecialchars($row['name']) . "</option>";
		}else {
			echo "<option value='" . htmlspecialchars( htmlspecialchars( $row['abr'] ) ) . "'>" . htmlspecialchars( $row['abr'] ) . " - " . htmlspecialchars( $row['name'] ) . "</option>";
		}
		array_push($schoolsList, $row['abr']);
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
		if(in_array($_POST['school'], $schoolsList)){//make sure value exists in selected option.
			if($_POST['school'] =='*'){
				$sql = "SELECT username, school, fname, sname, birth_year FROM student ORDER BY {$order}";
			}else{
				$sql = "SELECT username, school, fname, sname, birth_year FROM student WHERE school = '{$_POST['school']}' ORDER BY {$order}";
			}
		}
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
	echo "</div>"; //end of row
	echo "</div>"; //end of container
	echo "</div>"; //end of jumbotron
	echo "</div>"; //end of main container.

	//add footer
	include_once ("html/indexFooter.html");
