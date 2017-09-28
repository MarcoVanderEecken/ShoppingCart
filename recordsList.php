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

	//get sport.
	$sql = "SELECT sport.type FROM sport ORDER BY sport.type;";
	$results = $conn->query($sql);
	//get schools.
	$sql2 = "SELECT name, abr FROM school ORDER BY name;";
	$results2 = $conn->query($sql2);
	//get gender.
	$sql3 = "SELECT gender.ismale, gender.gender_description FROM gender ORDER BY ismale;";
	$results3 = $conn->query($sql3);
	//get gender.
	$sql4 = "SELECT event.event_id, event.event_description, event.event_start, event.event_end, event.event_host FROM event ORDER BY event.event_end DESC, event.event_start;";
	$results4 = $conn->query($sql4);

	//container for all.
	echo "<div class='container'>";

	//container for the products:
	echo "<div class='jumbotron'>";


	if($_SESSION['loggedIn'] == 2) $isUserAdmin = 'useradmin';
	else $isUserAdmin = '';

	//form sort.
	echo "
			<form class='navbar-form navbar navbar-inverse ". htmlspecialchars($isUserAdmin) ."' method='get' action='#' style='width:70%; margin: auto auto 1em auto;'>
				<div class='row'>
					<div class=\"form-group col-sm-12\" align='center' style='padding-top:1em'>
					<label style='color:white'>Gender: </label>
	                <select name='gender'>
						<option value='*' selected='selected'> Any</option>";

						$genderList = array();
						array_push($genderList, '*'); //add the any option

						while($row = mysqli_fetch_assoc($results3)){
							if($row['ismale'] == $_GET['gender']){
								echo "<option value='". htmlspecialchars(htmlspecialchars($row['ismale'])) ."' selected='selected'>" . htmlspecialchars($row['gender_description']) . "</option>";
							}else {
								echo "<option value='". htmlspecialchars(htmlspecialchars($row['ismale'])) ."'>" . htmlspecialchars($row['gender_description']) . "</option>";
							}
							array_push($genderList, $row['ismale']);
						}

						echo "</select>
					
					
					<label style='color:white'>Sport: </label>
	                <select name='sport'>
	                <option value='*' selected='selected'> Any </option>";

	$sportTypes = array();
	array_push($sportTypes, '*'); //add the any option

	while($row = mysqli_fetch_assoc($results)){
		if($row['type'] == $_GET['sport']){
			echo "<option value='" . htmlspecialchars( $row['type'] ) . "' selected='selected'>" . htmlspecialchars( $row['type'] ) . "</option>";
		}else{
			echo "<option value='". htmlspecialchars($row['type']) ."'>" . htmlspecialchars($row['type']) . "</option>";
		}
		array_push($sportTypes, $row['type']);
	}

	echo "</select>
					</div>
					<div class=\"form-group col-sm-12\" align='center'>
        <label style='color:white'>School: </label>
	                <select name='school'>
						<option value='*' selected='selected'> Any</option>";

	$schoolsList = array();
	array_push($schoolsList, '*'); //add the any option

	while($row = mysqli_fetch_assoc($results2)){
		if($row['abr'] == $_GET['school']){
			echo "<option value='". htmlspecialchars(htmlspecialchars($row['abr'])) ."' selected='selected'>" . htmlspecialchars($row['abr']) . " - " . htmlspecialchars($row['name']) . "</option>";
		}else {
			echo "<option value='" . htmlspecialchars( htmlspecialchars( $row['abr'] ) ) . "'>" . htmlspecialchars( $row['abr'] ) . " - " . htmlspecialchars( $row['name'] ) . "</option>";
		}
		array_push($schoolsList, $row['abr']);
	}

	echo "</select>
	                </div>
	                <div class=\"form-group col-sm-12\" align='center'>
        <label style='color:white'>Event: </label>
	                <select name='event'>
						<option value='*' selected='selected'> Any</option>";

	$eventList = array();
	array_push($eventList, '*'); //add the any option

	while($row = mysqli_fetch_assoc($results4)){
		if($row['event_id'] == $_GET['event']){
			echo "<option value='". htmlspecialchars(htmlspecialchars($row['event_id'])) ."' selected='selected'>" .
			     htmlspecialchars($row['event_description'] . " (" . $row['event_start'] . " - " . $row['event_end']) . ")</option>";

		}else {
			echo "<option value='". htmlspecialchars(htmlspecialchars($row['event_id'])) ."'>" .
			     htmlspecialchars($row['event_description'] . " (" . $row['event_start'] . " - " . $row['event_end']) . ")</option>";
		}
		array_push($eventList, $row['event_id']);
	}

	echo "</select>
	                </div>
	                <div class=\"row form-group col-sm-12\" align='center' style='padding-top:1em; padding-bottom: 1em'>
	                <button type='submit' class='btn-primary'>Search</button>
	                </div>
	            </div>
			</form>";

	/** SQL Query
	 *
	 * @param $select array
	 * @param $table string
	 * @param $joins array as a full string.
	 * @param $where boolean|array
	 * @param $orderby boolean|string
	 *
	 * @return string
	 */
	function doQuery($select, $table, $joins, $where = false, $orderby = false){
		$query = "SELECT " . implode(',', $select);
		$query .= " FROM " . $table;

		foreach($joins as $value){
			$query .= " LEFT JOIN " . $value;
		}

		if($where !== FALSE){
			$query .= " WHERE " . implodeWhere($where)/*implode("' AND '", $where)*/;
		}

		if($orderby !== FALSE){
			$query .= " ORDER BY " . implode(' , ', $orderby);
		}

		return $query;
	}

	/** Returns array of where of key => value as value = (key = 'value')
	 * Based on: https://stackoverflow.com/questions/11427398/how-to-implode-array-with-key-and-value-without-foreach-in-php
	 * @param $where array
	 *
	 * @return mixed array
	 */
	function implodeWhere($where){
		return implode(' AND ', array_map(
			function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
			$where,
			array_keys($where)
		));
	}


	//setting default variables for SQL Query
	$order = "type";
	$itemsToSelect = ['sport.type', 'sport.unit', 'record.username', 'record.record', 'student.fname', 'student.sname',
		'student.school', 'student.birth_year', 'record.recordID', 'school.name', 'gender.gender_description', 'event.event_description'];
	$defaultJoin = ['sport ON record.sport_id = sport.id ', 'student ON record.username = student.username',
		'school ON student.school = school.abr', 'gender ON student.gender = gender.ismale', 'event ON record.recordEvent = event.event_id'];
	$defaultTable = 'record';

	if(isset($_GET['sport'], $_GET['school'], $_GET['gender'], $_GET['event'])) {//search option used


		$schoolSearch = ["school.abr" => $_GET['school']];
		$genderSearch = ['gender.ismale' => $_GET['gender']];
		$sportSearch = ['sport.type' => $_GET['sport']];
		$eventSearch = ['event.event_id' => $_GET['event']];


        if ((in_array($_GET['sport'], $sportTypes)) === TRUE && (in_array($_GET['school'], $schoolsList)) && (in_array($_GET['event'], $eventList))) {//make sure no injection, only allowed options.
	        $where = array();


	        //only add to where clause if not default value
	        if($_GET['school'] !== '*'){
	        	$where = array_merge($where, $schoolSearch);
	        }
	        if($_GET['gender'] !== '*'){
		        $where = array_merge($where, $genderSearch);
	        }
	        if($_GET['sport'] !== '*'){
		        $where = array_merge($where, $sportSearch);
	        }
	        if($_GET['event'] !== '*'){
		        $where = array_merge($where, $eventSearch);
	        }

	        if(empty($where)) $where = false; //set to false so that it is not added to query
	        $sql = doQuery($itemsToSelect,$defaultTable,$defaultJoin, $where);
        }
    }else{//first time
		$sql =  doQuery($itemsToSelect,$defaultTable,$defaultJoin);
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
	if(isset($_GET['sport']) && isset($_GET['school'])){
		$prefix = "?sport=" . $_GET['sport'] . "&school=" . $_GET['school']. "&page=";

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
