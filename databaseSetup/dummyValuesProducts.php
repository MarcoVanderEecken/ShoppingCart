<?php

        $sql = "INSERT INTO product (productName, productDescription, productStock, productPrice)
                            VALUES ('Product1' , 'This is the first product ever.', 1, 5.00);"; //note use of '' for literal
        if($conn->query($sql) === TRUE){
            echo "<br>Product1 created";
        }else echo "<br>Failed to create Product1 " . $conn->error;

        $sql = "INSERT INTO product (productName, productDescription, productStock, productPrice)
                                    VALUES ('Product2' , 'This is the second product ever.', 10, 3.88);"; //note use of '' for literal
        if($conn->query($sql) === TRUE){
            echo "<br>Product2 created";
        }else echo "<br>Failed to create Product2 " . $conn->error;


        $sql = "INSERT INTO product (productName, productDescription, productStock, productPrice)
                                    VALUES ('Product3' , 'This is the third product ever.', 2, 1800.25);"; //note use of '' for literal
        if($conn->query($sql) === TRUE){
            echo "<br>Product3 created";
        }else echo "<br>Failed to create Product3 " . $conn->error;

