<?php
//create username and password table, password being
$sql =
	"CREATE TABLE Type(
            id INT PRIMARY KEY AUTO_INCREMENT,
            description VARCHAR(50) UNIQUE 
            )";

if($conn->query($sql) === TRUE){
	echo "table \"School\" created successfully";
}else echo "Failed to create table \"School\"" . $conn->error;

echo "<br>Starting value insertion <br>";

//do value insertion.
$sql = "INSERT INTO Type (description)
                    VALUES ('application/pdf')"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>Added application/pdf value";
}else echo "<br>Failed to add application/pdf value " . $conn->error;

$conn->close();