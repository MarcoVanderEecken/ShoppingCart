<?php

	require_once("requiresLogin.php");

	$title = "Records";
	include('html/baseHeader.html');
	include('mainMenu.html');
	if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
	$_SESSION['start'] = "Session started successfully";

	include("mainFunctions.php");


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

	//container for the products:
	echo "<div class='jumbotron'>";

	//form sort.
	echo "
			<form class='navbar-form navbar navbar-inverse' method='post' action='#' style='width:70%; margin: auto auto 1em auto;'>
				<div class='row'>
					<div class=\"form-group col-sm-12\" align='center' style='padding-top:1em'>
					<label style='color:white'>Sport: </label>
	                <select name='sport'>
	                <option value='*' selected='selected'> Any </option>";

	$sportTypes = array();
	array_push($sportTypes, '*'); //add the any option

	while($row = mysqli_fetch_assoc($results)){
		if($row['type'] == $_POST['sport']){

			echo "<option value='" . htmlspecialchars( htmlspecialchars( $row['type'] ) ) . "' selected='selected'>" . htmlspecialchars( $row['type'] ) . "</option>";
		}else{
			echo "<option value='". htmlspecialchars(htmlspecialchars($row['type'])) ."'>" . htmlspecialchars($row['type']) . "</option>";
		}
		array_push($sportTypes, $row['type']);
	}

	echo "</select>
	                <button type='submit' class='btn-primary'>Search</button>
	                </div>
	            </div>
			</form>";


	$order = "sport.type";
	if(isset($_POST['sport'])){//search option used
		if(in_array($_POST['sport'], $sportTypes)){//make sure no injection, only allowed options.
			if($_POST['sport'] == '*'){//the any option. Mysqli does not like * options.
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
				WHERE sport.type = '{$_POST['sport']}' ORDER BY {$order}";
			}
		}
	}else{//first time
		$sql = "SELECT sport.type, sport.unit, record.username, record.record, student.fname, student.sname, student.school, student.birth_year, record.recordID 
					FROM record 
					LEFT JOIN sport ON record.sport_id = sport.id 
					LEFT JOIN student ON record.username = student.username
					ORDER BY {$order}";
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
		include('html/recordListItem.html');
		$resultID++; //increment item number
	}

	//end container for product items
	echo "</div>"; //end of container
	echo "</div>"; //end of jumbotron
