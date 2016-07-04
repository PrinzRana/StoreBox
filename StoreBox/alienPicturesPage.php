<?php

require_once 'DB_info.php'; 

session_start(); //retrieve the session

//Get relavant data from the session array, where they were put 
//for this script by the checkAlien script
$username = $_SESSION['ausername']; 
$userDir = getcwd() . "/" . $PicturesDir . "/" . $username; 

//Create connection to database 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

///////////////////
//PROCESS FORM: 
///////////////////

//Upload
if (isset($_POST["submitUpload"])){
    $fileObject = $_FILES["uploadFile"]; 
    $filename = $fileObject["name"];
    $targetFile = $userDir . "/" . $filename;
    if ($filename != "" && ! file_exists($targetFile)){      
        move_uploaded_file($fileObject["tmp_name"], $targetFile);
    }
}

//Download
if (isset($_POST["submitDownload"]) && isset($_POST["checked"]))
{
    if (count($_POST["checked"]) == 1) {
        $filename = $_POST["checked"][0];  
        $targetFile = $userDir . "/" . $filename;
        
        header("Content-disposition: attachment; filename=$filename");
        header('Content-type: application/octet-stream');
        readfile($targetFile);
        die(); 
    }
} 

$result = scandir($userDir);

///////////////////
//DISPLAY FORM: 
/////////////////// 

//Remember that a PHP scripts produces html content: here, 
//we produce an html page which imports a CSS file
echo '<head> 
<link rel="stylesheet" type="text/css" href="CSS/tinyStyle.css"></head>'; 

echo '<body>'; 

echo "<h1> $username's picture files </h1>";
  
echo '<form action="alienPicturesPage.php" method="POST" enctype="multipart/form-data">'; 

//The form is devided in two parts: 
//a part where the file names are displayed (filePart)
//and 
//a part where actions such as upload and download are offered (actionPart)

//The file part: 
echo "<div id = 'filePart'>";
echo "<br> <br>";
foreach ($result as $filename){
    if ($filename == "." || $filename == "..") continue;
    echo "<br>";
    echo "&nbsp;&nbsp;" . $filename . " ";  
    echo "<input name = 'checked[]' value = '$filename' type = 'checkbox'>";
}
echo "</div> ";
 
//The action part: 
echo "<td>";
echo '<div id = "actionPart"> 
    <br> <br> 
    Upload a new file 
    <input type="file" name="uploadFile"> 
    <input type="submit" value="Submit" name="submitUpload">
    <br> 
    Download selected file (please only select one)
    <input type="submit" value="Submit" name="submitDownload">
    </div>
    </form>
'; 
//Note: a signout option is missing
echo '</body>'; 

?> 