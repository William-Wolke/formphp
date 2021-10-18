<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Form</title>
</head>
<body>
    <form action="#" method="POST">
        <fieldset>
        <legend>Skapa ett nytt konto</legend>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" minlengt="5" require>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="notpassword" id="password" class="form-control" minlength="5" require>
        </div>
        <div class="form-group">
            <label for="password2">Repeat password:</label>
            <input type="password" name="notpassword2" id="password2" class="form-control" minlength="5" require>
        </div>
        <div class="form-group">
        <input type="submit" name="submit" class="form-control" value="send">
        </div>
        
        </fieldset>
    </form>
    <form action="#" method="POST">
        <fieldset>
            <legend>Logga in</legend>
            <div class="form-group">
                <label for="logginUName">Username</label>
                <input type="text" name="logginUName" id="logginUName" class="form-control" minlength="5" require>
            </div>
            <div class="form-group">
            <label for="logginPWord">Password</label>
                <input type="password" name="logginPWord" id="logginPWord" class="form-control" minlength="5" require>
                </div>
            <div class="form-group">
                <input type="submit" name="logginSubmit" class="form-control" value="send">
            </div>
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
            $passphrase     = $_POST['notpassword'];
            #$usernameform   = $_POST['username'];
        
            $conn = mysqli_connect($servername, $username, $passwordDB);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else {
                echo "Connection created";

                $sqlDB      = "CREATE DATABASE IF NOT EXISTS User";
                $dbQuery    = mysqli_query($conn, $sqlDB);

                if ($dbQuery) {
                    $conn = mysqli_connect($servername, $username, $passwordDB, $dbname);
                }   

                $sqlTB      = "CREATE TABLE IF NOT EXISTS Users (
                              id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                              username VARCHAR(30) NOT NULL,
                              losenord VARCHAR(200) NOT NULL
                              )";
                $tbQuery    = mysqli_query($conn, $sqlTB);

                if ($tbQuery) {

                    $dataQuery = 0;

                    $sql_u =  "SELECT * FROM Users WHERE username='$usernameform'";

                    $res_u = mysqli_query($conn, $sql_u);

                    if (mysqli_num_rows($res_u) >= 1) {
                        echo "användarnamnet upptaget";
                    }
                    else {
                        $passphrase = password_hash($passphrase, PASSWORD_BCRYPT);

                        $sqlData =  "INSERT INTO Users (username, losenord)
                                    VALUES ('$usernameform', '$passphrase')";
    
                        $dataQuery = mysqli_query($conn, $sqlData);
                    }
                        
                }

                else {
                    echo "fel tablequery";
                }
            }
            mysqli_close($conn);
        }

        if (isset($_POST['logginSubmit'])) {

            $logginUName = $_POST['logginUName'];
            $logginPWord = $_POST['logginPWord'];

            $conn = mysqli_connect($servername, $username, $passwordDB, $dbname);

            $sqlGetPass = "SELECT losenord FROM Users WHERE username='$logginUName'";

            $userPass = mysqli_query($conn, $sqlGetPass);

            if (mysqli_num_rows($userPass) == 1) {
                $tuple = mysqli_fetch_assoc($userPass);

                if (password_verify($logginPWord, $tuple["losenord"])){
                    header('location: inloggad.php');
                }
                else{
                    echo "Felaktigt användarnamn eller lösenord.";
                }
            }
        }
    ?>

    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>