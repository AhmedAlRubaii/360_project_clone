
<?php

use db\dbConnection;

require_once 'dbConnection.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["postText"]) || !empty($_POST["postTitle"])){

      $dbConnection = new dbConnection();
      $connection = $dbConnection->getConnection();
      $error = $dbConnection->getError();

      // $host = "localhost";
      // // $database = "lab9";
      // $database = "project";
      // $user = "webuser";
      // $password = "P@ssw0rd";
      // // $host = "cosc360.ok.ubc.ca";
      // // $database = "db_28878544";
      // // $user = "28878544";
      // // $password = "28878544";

      // $connection = mysqli_connect($host, $user, $password, $database);

      // $error = mysqli_connect_error();

      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{
        session_start();
        $userID = $_SESSION['userID'];
        $postTitle = $_POST["postTitle"];
        $postText = $_POST["postText"];
        //insert into post*****************
        

        $stmt = "INSERT INTO post (title, userID, postText, numLikes) VALUES ('$postTitle','$userID','$postText', 0);";

        try{
          // $stmt->execute();
          mysqli_query($connection,$stmt);
          // session_start();
          // $_SESSION['username'] = $username;
          // header("Location: menu.php");
          // exit();
          echo "post made with this title: " . $postTitle;
          echo "<br>";
          echo "<br><a href='viewposttitles.php'>go back to home page</a>";
          // echo "<br>account for " . $firstname . " created";
        }catch(Exception $e){
          echo "something went wrong";
          echo "<br><a href='makepost.php'>Return and try again</a>";

          // echo $e->getMessage();
        }
      
        mysqli_close($connection);
        die;

      }

      // mysqli_close($connection);

    }
    else{
        echo "A field was not set. Something went wrong :(";
    }
  }
else
  die("Something went wrong with post :(");


?>

