<?php

    /** Generates a client side JavaScript alert message
     * @param $alertMsg String Message to be displayed
     */
    function jsAlert($alertMsg){
        echo "<script type='text/javascript'>alert('$alertMsg');</script>";
    };


    /** returns if number is 2 decimal point number
     * @param $num Number Number to be checked
     * @return bool
     */
    function is_decimal($num){
        return is_numeric($num) && floor($num) !== $num;
    }


	/**
	 * @param $date
	 *
	 * @return bool
	 */
	function validateDate($date)
	{
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') === $date;
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
        $sql = "SELECT username, school, school.name, fname, sname, birth_year 
				FROM student INNER JOIN school ON student.school = school.abr WHERE username='{$itemID}';";
        //save query result
        $result = array();
        if (isset($conn)) {
            $result = $conn->query($sql);
            $conn->close();
        }
        return $result;
    }

	/**
	 * @return array
	 */
	function getAllStudents(){
	    //set up statement for: get product name, description, price and current stock
	    require("dbConn.php");
	    $sql = "SELECT username, school, school.name, fname, sname, birth_year 
				FROM student INNER JOIN school ON student.school = school.abr
				ORDER BY username;";
	    //save query result
	    $result = array();
	    if (isset($conn)) {
		    $result = $conn->query($sql);
		    $conn->close();
	    }
	    return $result;
    }

	/** Gets product ID, name, description, price and stock from the database
	 * @param $recID Integer productID to get
	 * @return array productID (int), productName (VARCHAR255), productDescription (TEXT), productPrice (DECIMAL(6,2)), productStock (INT 11)
	 */
	function getRecordItem($recID){
		//set up statement for: get product name, description, price and current stock
		require("dbConn.php");
		$sql = "SELECT r.recordID, r.username, r.recordDate, r.approved, sport_id, record, sp.type, sp.unit 
				FROM record r, sport sp, student st
				WHERE r.username = st.username AND r.sport_id = sp.id AND r.recordID = '{$recID}';";
		//save query result
		$result = array();
		if (isset($conn)) {
			$result =$conn->query($sql);
			$conn->close();
		}
		return $result;
	}

	/**
	 * @param $studentID
	 *
	 * @return array
	 */
	function getRecordStudent($studentID){
		//set up statement for: get product name, description, price and current stock
		require("dbConn.php");
		//save query result
		$sql = "SELECT recordID, r.username, rs.description, sport_id, record, sp.type, sp.unit 
				FROM record r, sport sp, student st, recordstatus rs
				WHERE r.username = st.username AND r.approved = rs.status AND r.sport_id = sp.id AND st.username = '{$studentID}'
				ORDER BY sport_id ASC;";
		$result = array();
		if (isset($conn)) {
			$result = $conn->query($sql);
			$conn->close();
		}
		return $result;
	}

	/**
	 * @return array
	 */
	function getAllSchools(){
		require("dbConn.php");
		//save query result
		$sql = "SELECT abr, name FROM school ORDER BY name;";
		$result = array();
		if (isset($conn)) {
			$result = $conn->query($sql);
			$conn->close();
		}
		return $result;
	}

	/**
	 * @return array
	 */
	function getAllSports(){
		//set up statement for: get product name, description, price and current stock
		require("dbConn.php");
		$sql = "SELECT sport.id, sport.type FROM sport ORDER BY sport.type DESC;";
		//save query result
		$result = array();
		if (isset($conn)) {
			$result = $conn->query($sql);
			$conn->close();
		}
		return $result;
	}


	/**
	 *
	 */
	function getAllRecordStatus(){
		require("dbConn.php");
		$sql = "SELECT status FROM recordstatus ORDER BY status DESC;";
		//save query result
		$result = array();
		if (isset($conn)) {
			$result = $conn->query($sql);
			$conn->close();
		}
		return $result;
	}

	function getAllRecordStatusID(){
		$data = getAllRecordStatus();
		$result = array();
		while($row = mysqli_fetch_row($data)){
			array_push($result, $row[0]);
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


	/**
	 * @param $productID
	 * @param $imageName
	 * @param $imagePath
	 */
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