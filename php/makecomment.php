<?php
 use db\dbConnection;

 require_once 'dbConnection.php';

 session_start();
 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userID'])){

    if(!empty($_POST["comment"])){

      $dbConnection = new dbConnection();
      $connection = $dbConnection->getConnection();
      $error = $dbConnection->getError();

    

      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{

        // $mdpass = md5($_POST["oldpassword"]);
        // $mdpass = $_POST["oldpassword"];

        $postID = $_POST["postID"];
        $comment = $_POST["comment"];
        $userID = $_SESSION['userID'];



        $sql = "INSERT INTO comments (commentText, postID, userID) VALUES ('$comment' , '$postID', '$userID');";


        try{
            mysqli_query($connection, $sql);

            header("Location: viewpost.php?postID={$postID}");
            exit();
  
        }catch(Exception $e){
            echo $e;
        }
      
        mysqli_close($connection);
        //mysqli_free_result($result);
        die;

      }

     
    }
    else{
        echo "A field was not set. Something went wrong :(";
    }
}
else
  die("you need to log in");


?>

