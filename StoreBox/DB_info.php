<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";  
$myusers = "register"; 
$userPicturesDir = "Users";

$conn = new mysqli($servername, $username, $password, $dbname);

$FirstName = $_POST['firstname'];
$LastName = $_POST['lastname'];
$Username =$_POST['ausername'];
$Email =$_POST['email'];
$Password =$_POST['password'];
$CPassword =$_POST['cpassword'];

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
} 

$sql ="INSERT INTO `register`(`ID`, `FirstName`, `LastName`, `Username`, `Email`, `Password`, `CPassword`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])";
if ($conn->query($sql) === TRUE) {
    echo "New user has been created.";
    echo " Back to <a href= 'StoreBox.html'>login<a>";
} else {
    echo "error";
}


$conn->close();
?>