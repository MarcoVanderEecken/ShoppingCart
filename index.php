<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/20/2017
 * Time: 4:27 PM
 */

    $title = htmlspecialchars("Home Page");
    include('html/baseHeader.html');
    include('mainMenu.html');
    include( 'functionMain.php' );

    if(!isset($_SESSION)) session_start();
    $_SESSION['start'] = "Session started successfully";

    //if user is logged in:
	if(!isset($_SESSION['loggedIn'])){//user is not logged in
		//redirect ot home page
		redirectPage("login");
		exit();
	}
    include('html/indexBody.html');
    include('html/indexFooter.html');

