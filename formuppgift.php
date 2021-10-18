<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="#" method="POST">
        <fieldset>
        <legend>Skapa ett nytt konto</legend>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" minlengt="5" require>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="notpassword" id="password" minlength="5" require>
        <br>
        <label for="password2">Repeat password:</label>
        <input type="password" name="notpassword2" id="password2" minlength="5" require>
        <br>
        <input type="submit" name="submit" value="send">
        </fieldset>
    </form>
    <?php
        ini_set('display_errors', '1');
        error_reporting(E_ALL | E_STRICT);

        $servername = "localhost";
        $username = "root";
        $passwordDB = "";
        $dbname = "User";

        if(isset($_POST['submit']))
        {
            echo "subbmitted";

            $passphrase     = $_POST['notpassword'];
            $usernameform   = $_POST['username'];
        
            $conn = mysqli_connect($servername, $username, $passwordDB);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else {
                echo "Connection created";
            }
            $sqlDB      = "CREATE DATABASE IF NOT EXISTS User";
            $dbQuery    = mysqli_query($conn, $sqlDB);

            if ($dbQuery) {
                $conn = mysqli_connect($servername, $username, $passwordDB, $dbname);
                echo "Connectetd to database";
            }

            $sqlTB      = "CREATE TABLE IF NOT EXISTS Users (
                          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          username VARCHAR(30) NOT NULL,
                          losenord VARCHAR(200) NOT NULL
                          )";
            $tbQuery    = mysqli_query($conn, $sqlTB);

            if ($tbQuery) {
                echo "table yes";
            }

            mysqli_close($conn);

        }
    ?>
    
    <?php
/*
$servername = "localhost";
$username = "root";
$passwordDB = "";
$dbname = "User";

$passphrase =   $_POST['notpassword'];
$usernameform = $_POST['username'];

// Create connection
$conn = mysqli_connect($servername, $username, $passwordDB, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected";


$sql = "CREATE DATABASE IF NOT EXISTS User";

if (mysqli_query($conn, $sql)) {
    echo "New Database created successfully, or not idk";
}
else {
    $sql = "CREATE TABLE Users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        losenord VARCHAR(200) NOT NULL
        )";
}

$exists = mysql_query($conn, $sql);

        if(!$exists)
        {
            $sql = "CREATE TABLE Users (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(30) NOT NULL,
                    losenord VARCHAR(200) NOT NULL
                    )";
        }

    if (issett($_POST['submit'])) {

        $servername = "localhost";
        $username = "root";
        $passwordDB = "";
        $dbname = "User";

        $passphrase =   $_POST['notpassword'];
        $usernameform = $_POST['username'];
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $passwordDB, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected";
    

        $sql = "CREATE DATABASE IF NOT EXISTS User";

        if (mysqli_query($conn, $sql)) {
            echo "New Database created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $exists = mysql_query($conn, "select 1 from Users");

        if($exists == FALSE)
        {
            $sql = "CREATE TABLE Users (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(30) NOT NULL,
                    losenord VARCHAR(200) NOT NULL
                    )";

            if (mysqli_query($conn, $sql)) {
                echo "New table created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        $sql = "INSERT INTO Users (username, losenord)
                VALUES ('$passphrase', '$usernameform')";
        
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        $conn->close();
    }
        */
    ?>

    <script src="js/script.js"></script>
</body>
</html>