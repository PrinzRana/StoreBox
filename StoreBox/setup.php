<?php

require_once 'DB_info.php';

//DATABASE SETUP

//Create connection
$conn = new mysqli($servername, $username, $password);

//Check connecion
if ($conn->connect_error){
    die("<br> Connection failed" . $con->connect_error);
}
echo "<br> Connection successful";

// Create database
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
    echo "<br> Database $dbname created successfully";
} else {
    echo "<br> Error creating database: " . $conn->error;
}

$conn->close();


if ($conn->query($sql) === TRUE) {
    echo "<br> Table $register created successfully";
} else {
    echo "<br> Error creating table $register: " . $conn->error;
}

$conn->close();

//FILE SYSTEM SETUP

//Create sub-directory for the alien pictures
if (mkdir($alienPicturesDir,0700) == FALSE) 
    die("<br> Could not create directory $alienPicturesDir");
echo "<br> Directory $alienPicturesDir created successfully";


?>