<?php

    /** Generates a client side JavaScript alert message
     * @param $alertMsg String Message to be displayed
     */
    function jsAlert($alertMsg){
        echo "<script type='text/javascript'>alert('$alertMsg');</script>";
    };

    /** returns if number is 2 decimal point number
     * @param $num Numeric Number to be checked
     * @return bool
     */
    function is_decimal($num){
        return is_numeric($num) && floor($num) !== $num;
    }

    /** Refreshes the web page
     *
     */
    function refreshPage(){
        echo "<meta http-equiv=\"refresh\" content='0'>";
    }

    /** Redirects to given web page
     * @param $newURL String web page to redirect to
     */
    function redirectPage($newURL){
        echo "<meta http-equiv=\"refresh\" content='0; url=\"{$newURL}\"'>";
    }

    /** Gets product ID, name, description, price and stock from the database
     * @param $itemID Integer productID to get
     * @return array productID (int), productName (VARCHAR255), productDescription (TEXT), productPrice (DECIMAL(6,2)), productStock (INT 11)
     */
    function getProduct($itemID){
        //set up statement for: get product name, description, price and current stock
        require("dbConn.php");
        $sql = "SELECT productID, productName, productDescription, productPrice, productStock FROM product WHERE productID={$itemID};";
        //save query result
        $result = array();
        if (isset($conn)) {
            $result = $conn->query($sql);
            $conn->close();
        }
        return $result;
    }

    /** Gets product ID, name, description, price and stock from the database
     * @param $itemID Integer productID to get
     * @return array productID (int), productName (VARCHAR255), productDescription (TEXT), productPrice (DECIMAL(6,2)), productStock (INT 11)
     */
    function getStudent($itemID){
        //set up statement for: get product name, description, price and current stock
        require("dbConn.php");
        $sql = "SELECT username, school, school.name, fname, sname, birth_year FROM student INNER JOIN school ON student.school = school.abr WHERE username='{$itemID}';";
        //save query result
        $result = array();
        if (isset($conn)) {
            $result = $conn->query($sql);
            $conn->close();
        }
        return $result;
    }

	/** Gets product ID, name, description, price and stock from the database
	 * @param $itemID Integer productID to get
	 * @return array productID (int), productName (VARCHAR255), productDescription (TEXT), productPrice (DECIMAL(6,2)), productStock (INT 11)
	 */
	function getRecordItem($itemID){
		//set up statement for: get product name, description, price and current stock
		require("dbConn.php");
		$sql = "SELECT recordID, username, sport_id, record, sport.type, sport.unit 
				FROM record INNER JOIN sport ON record.sport_id = sport.id
				WHERE recordID=?;";
		//save query result
		$result = array();
		if (isset($conn)) {
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $itemID);
			$result = $stmt->get_result();
			$conn->close();
		}
		return $result;
	}

	function getRecordStudent($studentID){
		//set up statement for: get product name, description, price and current stock
		require("dbConn.php");
		//save query result
		$result = array();
		if (isset($conn)) {
			$sql = $conn->prepare("SELECT recordID, username, sport_id, record, sport.type, sport.unit 
				FROM record 
				INNER JOIN sport ON record.sport_id = sport.id
				INNER JOIN student ON record.username = student.username
				WHERE username=?;");
			$sql->bind_param("s",$studentID);
			$sql->execute();
			$result = $sql->get_result();
			$sql->close();
		}
		return $result;
	}


	/** Appends string to end of string
	 * @param $string1
	 * @param $string2
	 *
	 * @return string
	 */
	function append($string1, $string2){
        return $string1 . $string2;
    }



    function uploadImage($productID, $imageName, $imagePath){
        require("dbConn.php");
        $sql = "INSERT INTO productImage (productID, imageName, imagePath)
                                VALUES ({$productID}, '{$imageName}', '{$imagePath}');"; //note use of '' for literal
        if (isset($conn)) {
            if($conn->query($sql) === TRUE){
                echo "<br>Product1 created";
            }else echo "<br>Failed to create Product1 " . $conn->error;
            $conn->close();
        }

    }