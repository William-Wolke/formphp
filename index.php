<?php
    session_start();
    $_SESSION['username'] = "";
    $_SESSION["interest"] = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Form</title>
</head>
<body>
    <form action="#" method="POST" name="createUser">
        <legend>Skapa ett nytt konto</legend>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" minlength="4" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" minlength="5" required>
        </div>
        <div class="form-group">
            <label for="password2">Repeat password:</label>
            <input type="password" name="confirmpassword" id="confirmPassword" class="form-control" minlength="5" required>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="createSubmit" class="form-control btn btn-primary mb-3" value="Skapa konto">
        </div>
    </form>
    <form action="#" method="POST" name="logginUser">
        <fieldset>
            <legend>Logga in</legend>
            <div class="form-group">
                <label for="logginUName">Username</label>
                <input type="text" name="logginUName" id="logginUName" class="form-control" minlength="4" required>
            </div>
            <div class="form-group">
            <label for="logginPWord">Password</label>
                <input type="password" name="logginPWord" id="logginPWord" class="form-control" minlength="5" required>
                </div>
            <div class="form-group">
                <input type="submit" name="logginSubmit" class="form-control btn btn-primary mb-3" value="Logga in">
            </div>
        </fieldset>
    </form>
    <?php
        ini_set('display_errors', '1');
        error_reporting(E_ALL | E_STRICT);

        include "./keys.php";

        if(isset($_POST['submit']))
        {
            $passphrase     = $_POST['password'];
            $usernameform   = $_POST['confirmpassword'];
        
            $conn = mysqli_connect($servername, $usernameDB, $passwordDB);

            mysql_query($conn, "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('')");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else {
                #echo "Connection created";

                $dbQuery    = mysqli_query($conn, $sqlDB);

                if ($dbQuery) {
                    echo $servername . $usernameDB . $passwordDB . $dbname;
                    mysqli_close($conn);
                    $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
                }   

                if(mysqli_query($conn, $sqlTB))
                {
                    include "./keys.php";

                    $res_u = mysqli_query($conn, $sql_u);

                    if (mysqli_num_rows($res_u) >= 1) {
                        echo "användarnamnet upptaget";
                    }
                else {
                        $passphrase = password_hash($passphrase, PASSWORD_BCRYPT);
    
                        if(mysqli_query($conn, $sqlData)){
                            #echo "lyckades";
                        }
                        else{
                            #echo "lyckades inte";
                        }
                    }     
                }

                else {
                    #echo "fel tablequery";
                }
            }
            mysqli_close($conn);
        }

        if (isset($_POST['logginSubmit'])) {

            $logginUName = $_POST['logginUName'];
            $logginPWord = $_POST['logginPWord'];

            $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
           
            include "./keys.php";

            $userPass = mysqli_query($conn, $sqlGetPass);

            if (mysqli_num_rows($userPass) == 1) {
                $tuple = mysqli_fetch_assoc($userPass);

                if (password_verify($logginPWord, $tuple["losenord"])){
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["username"] = $tuple["username"];
                    $_SESSION["interest"] = $tuple["intresse"];
                    header('location: inloggad.php');
                }
                else{
                    echo "Felaktigt användarnamn eller lösenord.";
                }
            }
            mysqli_close($conn);
        }
    ?>

    <script src="js/script.js"></script>
</body>
</html>