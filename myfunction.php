
<?php
        if (isset($_POST["chooseInterest"])) {

            $interest = $_POST["chosenInterest"];

            $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else {
                #echo "Connection created";

                if ($interest != "") {
                   
                    if(mysqli_query($conn, $sqlInsertInterest)){
                        $_SESSION["interest"] = $interest;
                    }
                }
            }
            mysqli_close($conn);
        }
        
        if (isset($_POST["logOut"])) {
            session_destroy();
            header("location: formuppgift.php");
        }

        if ($_SESSION["interest"] != null) {

            $json_data = file_get_contents($api_url);
            try {

                $articleNum = rand(0, 5);
                $response_data = json_decode($json_data,true) or exit("Your code doesn't work");
                
                echo "<h1>".
                        $response_data['results'][$articleNum]['title'].
                     "</h1>";
                echo "<img class='articleImg' src=".
                        $response_data['results'][$articleNum]['image_url'].">
                     </img>";
                echo "<p>".
                        $response_data['results'][$articleNum]['description'].
                     "</p>";

            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }
        else{
            #echo "du har inget intresse :(";
        }
?>