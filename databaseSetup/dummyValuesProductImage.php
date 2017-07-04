<?php
    $imagePath = "images/products/";
    $sql = $conn->prepare("INSERT INTO productImage (productID, imageName, imagePath)
                                VALUES (?, ?, ?);");
    for($i = 0; $i < 3; $i++){
        $imgName = $i . "." . "jpg";
        $sql->bind_param("iss", $i, $imgName, $imagePath);
        if($sql->execute() === TRUE){
            echo "<br>Product1 created";
        }else echo "<br>Failed to create Product1 " . $conn->error;
    }
    $sql->close();