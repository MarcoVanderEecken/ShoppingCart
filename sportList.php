<?php

	require_once("requiresLogin.php");

	$title = "Records";
	include('html/baseHeader.html');
	include('mainMenu.html');
	if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
	$_SESSION['start'] = "Session started successfully";

	$maxResPage = 6; //how many results should be displayed per page.

	include( "functionMain.php" );


	if(isset($_GET['id'])){//if product ID has been selected.
		echo "HELLO THE PRODUCT ID HAS BEEN SET.";
		//redirect to productItem page
		redirectPage("recordItem?id={$_GET['id']}");
	}


	//connect to database to fetch products.
	include("dbConn.php");

	//get schools.
	$sql = "SELECT sport.type FROM sport ORDER BY sport.type;";
	$results = $conn->query($sql);

	//TODO: two lines above, second result set using schools.

	//container for all.
	echo "<div class='container'>";

	//container for the products:
	echo "<div class='jumbotron'>";

	//form sort.
	echo "
				<form class='navbar-form navbar navbar-inverse' method='get' action='#' style='width:70%; margin: auto auto 1em auto;'>
					<div class='row'>
						<div class=\"form-group col-sm-12\" align='center' style='padding-top:1em'>
						<label style='color:white'>Sport: </label>
		                <select name='sport'>
		                <option value='*' selected='selected'> Any </option>";

	$sportTypes = array();
	array_push($sportTypes, '*'); //add the any option

	while($row = mysqli_fetch_assoc($results)){
		if($row['type'] == $_GET['sport']){

			echo "<option value='" . htmlspecialchars( htmlspecialchars( $row['type'] ) ) . "' selected='selected'>" . htmlspecialchars( $row['type'] ) . "</option>";
		}else{
			echo "<option value='". htmlspecialchars(htmlspecialchars($row['type'])) ."'>" . htmlspecialchars($row['type']) . "</option>";
		}
		array_push($sportTypes, $row['type']);
	}

					//TODO: ADD THE search.
	echo "</select>
					
		                <button type='submit' class='btn-primary'>Search</button>
		                </div>
		            </div>
				</form>";


	$order = "sport.type";
	if(isset($_GET['sport'])){//search option used
		if(in_array($_GET['sport'], $sportTypes)){//make sure no injection, only allowed options.
			if($_GET['sport'] == '*'){//the any option. Mysqli does not like * options.
				$sql = "SELECT sport.type, sport.unit, record.username, record.record, student.fname, student.sname, student.school, student.birth_year, record.recordID 
						FROM record 
						LEFT JOIN sport ON record.sport_id = sport.id 
						LEFT JOIN student ON record.username = student.username
						ORDER BY {$order}";
			}else {
				$sql = "SELECT sport.type, sport.unit, record.username, record.record, student.fname, student.sname, student.school, student.birth_year, record.recordID 
					FROM record 
					LEFT JOIN sport ON record.sport_id = sport.id 
					LEFT JOIN student ON record.username = student.username
					WHERE sport.type = '{$_GET['sport']}'ORDER BY {$order}";
			}
		}
	}else{//first time
		$sql = "SELECT sport.type, sport.unit, record.username, record.record, student.fname, student.sname, student.school, student.birth_year, record.recordID 
						FROM record 
						LEFT JOIN sport ON record.sport_id = sport.id 
						LEFT JOIN student ON record.username = student.username
						ORDER BY {$order}";
	}

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
		include('html/recordListItem.html');
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

	//Need to check if variable set before so we don't clear get.
	if(isset($_GET['sport'])){
		$prefix = "?sport=" . $_GET['sport'] . "&page=";
	}else $prefix = '?page=';


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
