<?php
session_start();
if (!$_SESSION["loggedIn"]) {
    header("location: index.php");
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
    <div class="news">
        <?php
            //Behövde printa just här för att texten skulle komma här. 
            include "./myfunction.php";
        ?>
        </div>
    
    <form action="#" method="POST" id="logoutContainer">
        <div class="form-group">
            <input type="submit" value="logout" name="logOut" class="form-control btn btn-primary mb-3">
        </div>
    </form>
</body>
</html>
