<?php

$servername         = "localhost";
$usernameDB         = "root";
$passwordDB         = "root";
$dbname             = "User";
$conn               = false;
$interest           = "";
$usernameform       = "";
$logginUName        = "";

$username           = $_SESSION['username'];

$api_url            = 'https://newsdata.io/api/1/news?apikey=pub_1866ec4393984dff679beb0cebe4231e94b2&language=en&category='.$_SESSION["interest"];

$sqlInsertInterest  = "UPDATE Users SET intresse = '$interest' WHERE username = '$username'";

$sqlDB              = "CREATE DATABASE IF NOT EXISTS User";

$sqlTB              = "CREATE TABLE IF NOT EXISTS Users (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(30) NOT NULL,
                        losenord VARCHAR(200) NOT NULL,
                        intresse VARCHAR(40) NOT NULL
                        )";

$sql_u              =  "SELECT * FROM Users WHERE username='$usernameform'";

$sqlGetPass         = "SELECT losenord, username, intresse FROM Users WHERE username='$logginUName'";

?>