<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 3:56 PM
 */

    include('dbConnStart.php');
    if (isset($conn)) {
        $conn->select_db("shoppingcart");
    }
