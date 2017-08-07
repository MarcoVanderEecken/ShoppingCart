<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 7/3/2017
 * Time: 10:30 PM
 */

//This file is for the admin to create a product

//in case session hasn't been started, e.g. user accessed page directly.
require_once ("requiresLogin.php");

include("mainFunctions.php");


//Only moderator (level 1) and admin (level 2) can add items
if($_SESSION['loggedIn'] == 1 || $_SESSION['loggedIn'] == 2){
	//navigation header
	$title = "Add Product";
	include('html/baseHeader.html');
	include('mainMenu.html');
}else {
	redirectPage( "index.php" );
	exit();
}

//check if user has submitted product
if(isset($_POST['productName']) && isset($_POST['productDescription']) && isset($_POST['productPrice'])
   && isset($_POST['productStock'])){//product variables have been set

	if(!empty($_POST['productName']) && !empty($_POST['productDescription']) && !empty($_POST['productPrice'])
	   && !empty($_POST['productStock'])){//product variables are not empty

		//CHECK IF VARIABLE TYPES ARE CORRECT
		if(is_string($_POST['productName']) && is_string($_POST['productDescription']) && is_decimal($_POST['productPrice'])
		   && is_numeric($_POST['productStock']) && $_POST['productStock'] >= 0){

			if(!$image = @imagecreatefromgif($_POST['productImage'])){//check if image is valid
				//create database connection
				include('dbConn.php');

				//create prepared statement to add product
				$sql = $conn->prepare("INSERT INTO product(productName, productDescription, productStock, productPrice) VALUES (?,?,?,?);");

				//bind statement variables
				$sql->bind_param("ssid",$_POST['productName'], $_POST['productDescription'], $_POST['productStock'], $_POST['productPrice']);
				$sql->execute();
				$sql->close();

				//get product ID of saved file
				$sql = "SELECT productID FROM product WHERE productName = '{$_POST['productName']}';";
				$results = mysqli_fetch_assoc($conn->query($sql));
				$productID = (int) $results['productID'];

				$imgPath = 'images/products/';
				$name = $_FILES["productImage"]["name"];
				$temp = $_FILES["productImage"]["tmp_name"];
				$type = $_FILES["productImage"]["type"];
				$size = $_FILES["productImage"]["size"];
				$error = $_FILES["productImage"]["error"];
				$extension = pathinfo($name, PATHINFO_EXTENSION);

				$imgName = $productID . "." . $extension;

				//Checking file size and for any errors
				if($error > 0){
					//create prepared statement for deletion of product
					$sql = "DELETE FROM product WHERE productID = '{$productID}';";

					//bind statement variables for deletion of product
					$conn->query($sql);
					jsAlert("error uploading file! Code $error.");
				}else if($size > 1000000){
					//create prepared statement for deletion of product
					$sql = "DELETE FROM product WHERE productID = '{$productID}';";

					//bind statement variables for deletion of product
					$conn->query($sql);
					jsAlert("Image file size exceeds 2MB!");
				}else{
					move_uploaded_file($temp, "$imgPath$imgName");
					jsAlert("Image uploaded successfully!");

					//create prepared statement for image
					$sql = $conn->prepare("INSERT INTO productImage(productID, imageName, imagePath) VALUES (?,?,?);");

					//bind statement variables for image
					$sql->bind_param("iss", $productID, $imgName, $imgPath);
					$sql->execute();

					//close prepared statement
					$sql->close();

				}
				//close database connection
				$conn->close();
			}else{//not an image
				jsAlert("Please upload a valid image");
//                    var_dump($_FILES);
//                    print_r($_POST);
			}
		}else{//failed scrubbing
			jsAlert("The values entered were not of the correct type. Please use the website GUI to submit a new product.");
		}
	}else{//end of check for product variables
		if($_POST['productPrice'] == 0){
			jsAlert("You cannot upload a product for free. Please enter a price greater than 0.");
			//in case product is being given for free.
		}
	}
}//end of check if post input

//body of add a product
include("html/addStudent.html");
include("html/indexFooter.html");