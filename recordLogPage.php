<?php
	require_once("requiresLogin.php");
	require('recordLog.php');

	//COOKIES HAVE TO BE DEFINED BEFORE HTML OF PAGE LOAD.

	$title = "Changes to Records log";
	if(!isset($_SESSION)) session_start(); //start session in case user directly navigated to this page.
	$_SESSION['start'] = "Session started successfully";
	include('functionMain.php');


	//create record log item if it does not exist.
	if(!isset($recordLog)) {
		$recordLog = array();
	}

	//get record log from cookie
	if(isset($_COOKIE['recordLog'])){
		$recordLog = unserialize($_COOKIE['recordLog']);
	}

	if(isset($_POST['addRecord'])){
		//update record.
		include ("dbConn.php");
		//get valid options
		$approvals = getAllRecordStatusID();

		//check that the approve option is valid.
		if(in_array($_POST['approved'], $approvals)){

			$sql = $conn->prepare("UPDATE record SET approved = ?;");
			$sql->bind_param('i', $_POST['approved']);
			$sql->execute();
			$sql->close();
			$conn->close();

			//add record change to log.
			array_push($recordLog, new RecordLog($_POST['recordID'], $_POST['username'], $_POST['sport_id'],
				$_POST['sport_type'], $_POST['record'], $_POST['approved'], $_POST['recordDate'], $_SESSION['username']));
		}else {
			echo "did not get through check, approved value: " .$_POST['approved'];
		}

		unset($_POST['addRecord']);
	}

	if(setcookie('recordLog', serialize($recordLog), strtotime('+100 days')) === TRUE){
	}else echo "cookie not created";

	include('html/baseHeader.html');
	include('mainMenu.html');
	//main body container
	echo "<div class='container'>";

	include_once('html/recordLogPage.html');
	//add objects.

	foreach ($recordLog as $key => $value){
		echo "<tr>";
		echo "<td> {$value->getUsername()}</td>";
		echo "<td> {$value->getSportType()}</td>";
		echo "<td> <a href='recordItem?id={$value->getRecordID()}'> {$value->getRecord()} </a></td>";
		echo "<td> {$value->getApprovedDesc()}</td>";
		echo "<td>" . date('dS M Y', strtotime($value->getRecordDate())) . "</td>";
		echo "</tr>";
	}

	//end of page.
	echo "
		        </table>
		       </div>
		     </div>
		    </div>
		   </div>
		</body>";

	//serialize record log and save as cookie

	include_once ('html/indexFooter.html');