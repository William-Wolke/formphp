
<?php

        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "";
        $dbname = "User";

        if (isset($_POST["chooseInterest"])) {

                $username = $_SESSION['username'];
                $interest = $_POST["chosenInterest"];

                $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                else {
                    echo "Connection created";
                    
                    $sqlInsertInterest = "UPDATE Users SET intresse = '$interest' WHERE username = '$username'";

                    $interestQuery = mysqli_query($conn, $sqlInsertInterest);

                    $_SESSION["interest"] = $interest;
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

        if ($_SESSION["interest"] != null) {
            echo "du har intresse grattis".$_SESSION["interest"];

            $api_url = 'https://newsdata.io/api/1/news?apikey=pub_1866ec4393984dff679beb0cebe4231e94b2&language=en&category='.$_SESSION["interest"];

            $json_data = file_get_contents($api_url);
            try {
                
                $response_data = json_decode($json_data,true) or exit("Your code doesn't work");
                
                echo "<h1>".$headerContent['results'][0]['title']."</h1>";
                echo "<img src=".$picContent['results'][0]['image_url']."></img>";
                echo "<p>".$textContent['results'][0]['description']."</p>";

            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
        else{
            echo "du har inte intresse :(";
        }

        mysqli_close($conn);
?>