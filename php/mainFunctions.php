<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 6/30/2017
 * Time: 8:56 PM
 */

    function jsAlert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    };

    function is_decimal($num){
        return is_numeric($num) && floor($num) != $num;
    }

    function refreshPage(){
        echo "<meta http-equiv=\"refresh\" content='0'>";
    }