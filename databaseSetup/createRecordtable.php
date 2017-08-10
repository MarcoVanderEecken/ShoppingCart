<?php

//invoke database connection
include('../dbConn.php');

//create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
$sql =
	"CREATE TABLE Record(
			recordID INT(11) PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50), FOREIGN KEY (username) REFERENCES student(username),
            sport_id INT, FOREIGN KEY (sport_id) REFERENCES sport(id),
            record VARCHAR(50)
            )";

if($conn->query($sql) === TRUE){
	echo "table \"Record\" created successfully";
}else echo "Failed to create table \"Record\"" . $conn->error;

echo "<br>Starting dummy value insertion <br>";

$sql = "INSERT INTO Record (username, sport_id, record)
                        VALUES ('firststudent' , 1 , 10)"; //note use of '' for literal
if($conn->query($sql) === TRUE){
	echo "<br>record for firststudent created";
}else echo "<br>Failed to create firststudent record " . $conn->error;


echo "<br>dummy value insertion complete.<br>";

echo "<a href='../index.php'> Return to main page</a>";
//close database connection
$conn->close();
