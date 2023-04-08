<?php
 use db\dbConnection;

 require_once 'dbConnection.php';
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["username"]) && !empty($_POST["oldpassword"]) && !empty($_POST["newpassword"]) && !empty($_POST["newpassword-check"])){

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

        $mdpass = md5($_POST["oldpassword"]);
        // $mdpass = $_POST["oldpassword"];

        $username = $_POST["username"];

        $sql = "SELECT username FROM users WHERE username = '$username' AND password = '$mdpass';";

        $result = mysqli_query($connection, $sql);

        if(mysqli_fetch_assoc($result)){
            $newpass = md5($_POST["newpassword"]);

            $sql = "UPDATE users SET password = '$newpass' WHERE username = '$username';";

            if(mysqli_query($connection, $sql)){
                echo "password update for username" .$username;
            }
            
        }
        else
            echo "username and/or password invalid";

      
        mysqli_close($connection);
        mysqli_free_result($result);
        die;

      }

     
    }
    else{
        echo "A field was not set. Something went wrong :(";
    }
}
else
  die("Something went wrong with post :(");


?>

