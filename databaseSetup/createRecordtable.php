<?php

//invoke database connection
include('../dbConn.php');

//create product table, NEED TO CHANGE TO ADD IMAGE LOCATION LATER.
$sql =
		"create table record
	(
		recordID int auto_increment
			primary key,
		username varchar(50) null,
		sport_id int null,
		record varchar(50) null,
		approved INT REFERENCES recordStatus(status) default '1' null,
		recordDate datetime default CURRENT_TIMESTAMP not null
	)
	;
	
	create index sport_id
		on record (sport_id)
	;
	
	create index username
		on record (username)
	;
	
	ALTER TABLE record
	ADD CONSTRAINT approval_constraint
	FOREIGN KEY (approved) REFERENCES recordstatus (status);";

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
