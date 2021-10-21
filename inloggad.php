<?php
session_start();
if (!$_SESSION["loggedIn"]) {
    header("location: formuppgift.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Inloggad</title>
</head>

<body>
    <form action="#" method="POST">
        <h1>Grattis du är inloggad.</h1>
            <div class="form-group">
                <label for="interest"> <?php echo"Hej ".$_SESSION["username"].", ";    ?>välj ditt intresse</label>
                <input list="listInterest" name="chosenInterest" id="Interest" class="form-control">
                <datalist id="listInterest">
                    <option value="business"></option>
                    <option value="entertainment"></option>
                    <option value="environment"></option>
                    <option value="food"></option>
                    <option value="health"></option>
                    <option value="politics"></option>
                    <option value="science"></option>
                    <option value="sports"></option>
                    <option value="technology"></option>
                    <option value="top"></option>
                    <option value="world"></option>
                </datalist>
            </div>
            <div class="form-group">
                <input type="submit" value="submit" name="chooseInterest" class="form-control btn btn-primary mb-3">
            </div>
    </form>
    <div>
        <?php
            function printHeader($headerContent) {
                echo "<h1>".$headerContent."</H1>";
            }
        ?>
    </div>
    <div>
        <?php
            function printPicture($picContent) {
                echo "<h1>".$picContent."</H1>";
            }
        ?>
    </div>
    <div>
        <?php
            function printText($textContent) {
                echo "<p>".$textContent."</p>";
            }
        ?>
    </div>
    <form action="#" method="POST" id="logoutContainer">
        <div class="form-group">
            <input type="submit" value="logout" name="logOut" class="form-control btn btn-primary mb-3">
        </div>
    </form>
</body>
</html>

<?php

        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "";
        $dbname = "User";

        

        if ($_SESSION["interest"] != null) {
            echo "du har intresse grattis".$_SESSION["interest"];

            /*$ap1_url = 'pub_1866ec4393984dff679beb0cebe4231e94b2&language=en&category='.$_SESSION["interest"];

            $json_data = file_get_contents($api_url);

            $response_data = json_decode($json_data);

            echo $response_data;*/
        }
        else{
            echo "du har inte intresse :(";
        }

        if (isset($_POST["chooseInterest"])) {

                $username = $_SESSION['username'];
                $interest = $_POST["chosenInterest"];

                $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                else {
                    echo "Connection created";
                    
                    $sqlInsertInterest = "UPDATE `Users` SET `intresse` = '$interest' WHERE `Users`.`username` = $username";

                    $interestQuery = mysqli_query($conn, $sqlInsertInterest);
                }

                if ($interestQuery) {
                    echo "updated";
                }
                else {
                    echo "inte updated";
                }
            }
        
        if (isset($_POST["logOut"])) {
            session_destroy();
            header("location: formuppgift.php");
        }

        mysqli_close($conn);
?>