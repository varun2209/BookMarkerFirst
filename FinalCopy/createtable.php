<?php
$con=mysqli_connect("localhost","root","","bookmarksorter");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create table
$sql = "CREATE TABLE `resultfile` (
    `id`        Int Unsigned Not Null Auto_Increment,
	`UserName`      Char(12) Not Null,
    `name`      VarChar(255) Not Null Default 'Untitled.txt',
    `mime`      VarChar(50) Not Null Default 'text/plain',
    `size`      BigInt Unsigned Not Null Default 0,
    `data`      MediumBlob Not Null,
    `created`   DateTime Not Null,
	`download_count`      Int Unsigned Not Null Default 0 ,
	`downloaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
	FOREIGN KEY (`UserName`) REFERENCES userinfo(`UserName`)
)";

// Execute query
if (mysqli_query($con,$sql)) {
  echo "Table resultfile created successfully";
} else {
  echo "Error creating table: " . mysqli_error($con);
}
?>