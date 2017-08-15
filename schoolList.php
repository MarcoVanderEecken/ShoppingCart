<?php

	require_once("requiresLogin.php");

	$title = "Records";
	include('html/baseHeader.html');
	include('mainMenu.html');
	if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
	$_SESSION['start'] = "Session started successfully";

	$maxResPage = 12; //how many results should be displayed per page.

	include( "functionMain.php" );


	//connect to database to fetch products.
	include("dbConn.php");

	//get schools.
	$sql = "SELECT abr, name FROM school ORDER BY name;";
	$results = $conn->query($sql);

	//container for all.
	echo "<div class='container'>";

	//container for the products:
	echo "<div class='jumbotron'>";

	$sql = "SELECT abr, name FROM school";

	//if page has been set, limit max number of records. (6 per page)

	//check that current page exists
	if(isset($_GET['page'])){
		$currentPage = $_GET['page'];
	}else $currentPage = 1;

	//check if page is actually a non-decimal number
	if(!is_numeric($currentPage) || is_float($currentPage)){
		$currentPage = 1;
	}

	//get amount fo student list products
	$numResults = mysqli_num_rows($conn->query($sql));

	//calculate offset
	$offset = floor($currentPage * $maxResPage - $maxResPage);

	//add the limit
	$sql = $sql . " LIMIT " . $maxResPage . " OFFSET " . $offset;


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
		include('html/schoolListItem.html');
		$resultID++; //increment item number
	}

	//end container for product items
	echo "</div>"; //end of row
	echo "</div>"; //end of container


	/*
	 *  START OF PAGINATION
	 */
	echo "<div class='container' style='align-content: center'>
					<div class='pagination'>
					";

	//Set pre-variable
	$prefix = '?page=';


	$numRows = floor($numResults / $maxResPage); //get number of default large - rows
	if($numResults % $maxResPage != 0) $numRows++; //in case it's an extra non-full page.
	$rowCount = 0;
	do { //run at least once so that there is always a page counter.
		$rowCount++;
		if($currentPage == $rowCount){
			echo "<a class='active' href='" . $prefix . $rowCount . "';> " . $rowCount . "</a>";
		}else {
			echo "<a href='" . $prefix . $rowCount . "'> " . $rowCount . "</a>";
		}
		$numRows--;
	}while($numRows > 0);
	echo "
				</div> <!-- end of pagination -->
				</div><!-- end of pag. container -->";

	echo "</div>"; //end of jumbotron
	echo "</div>"; //end of main container.

	//add footer
	include_once ("html/indexFooter.html");
