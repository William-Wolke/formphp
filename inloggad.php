<?php
setcookie('interest', $_COOKIE['interest'], time() + 2592000);
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
            <input list="interest" name="chosenInterest" id="interest" class="form-control">
            <datalist id="interest">
                <option value="tech"></option>
                <option value="sport"></option>
                <option value="animals"></option>
            </datalist>
        </div>
        <div class="form-group">
            <input type="submit" value="submit" name="chooseInterest" class="form-control btn btn-primary mb-3">
        </div>
    </form>
    <form action="#" method="POST" id="logoutContainer">
        <div class="form-group">
            <input type="submit" value="logout" name="logOut" class="form-control btn btn-primary mb-3">
        </div>
    </form>
</body>
</html>

<?php
if (isset($_POST["chooseInterest"])) {
    $_COOKIE['interest'] = $_POST["chosenInterest"];
    echo $_COOKIE['interest'];
}
if (isset($_POST["logOut"])) {
    session_destroy();
    header("location: formuppgift.php");
}
?>