<?php
/**
 * Redirect to home page in case user is not logged in.
 */

	function redirectToIndex(){
		echo "<meta http-equiv=\"refresh\" content='0; url=\"index\"'>";
	}

	//make sure session is started
	if(!isset($_SESSION)) session_start();

	if(!isset($_SESSION['loggedIn'])){//user is not logged in
		//redirect ot home page
		redirectToIndex();
		exit();
	}