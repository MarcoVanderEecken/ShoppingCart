<?php
	/**
	 * Created by PhpStorm.
	 * User: Temporary
	 * Date: 7/27/2017
	 * Time: 10:24 PM
	 */
	require_once ("requiresLogin.php");
	require_once("productCart.php");
	if(!isset($_SESSION)){session_start();}



	//check if there is a cart
	if(!isset($_SESSION['userCart'])) $_SESSION['userCart'] = array();

	if(isset($_POST['addItem'])){
	    //add product ID to cart.
	    array_push($_SESSION['userCart'], new ProductItem($_POST["productID"], $_POST["productName"],
	        $_POST["productDescription"],$_POST["productStock"], $_POST["productPrice"]));
	    unset($_POST['addItem']);
	}

	//Show the user the item added to the cart.
	$title = "Shopping Cart";
	include_once('html/baseHeader.html');
	include_once('mainMenu.html');

	//main body container
	echo "<div class='container'>";

	include_once('html/productCartPage.html');
	//add objects.
	foreach ($_SESSION['recordLog'] as $key => $value){
	    echo "<tr>";
	    echo "<td> {$value->getProductID()}</td>";
	    echo "<td> {$value->getProductName()}</td>";
	    echo "<td> {$value->getProductStock()}</td>";
	    echo "<td> {$value->getProductPrice()}</td>";
	    echo "<td>".($value->getProductPrice()) * $value->getProductStock(). "</td>";
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

	include_once ('html/indexFooter.html');