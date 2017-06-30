<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/20/2017
 * Time: 4:27 PM
 */

    session_start();
    $_SESSION['start'] = "Session started";
    echo "hello, main index page started load";

    include('php/test.php');

    include('mainPageMenu.html');

    echo $_SESSION['start'];