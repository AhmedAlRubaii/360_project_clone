
<?php
use db\dbConnection;

require_once 'dbConnection.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["username"]) || !empty($_POST["password"])){

      $dbConnection = new dbConnection();
      $connection = $dbConnection->getConnection();
      $error = $dbConnection->getError();


      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{

        $mdpass = md5($_POST["password"]);
        $username = $_POST["username"];

        $sql = "SELECT username, userID, admin, enabled FROM users WHERE username = '$username' AND password = '$mdpass';";

        $result = mysqli_query($connection, $sql);
        
        
        if($row = $result->fetch_assoc()){

          if($row['enabled'] == false){
            die("your account has been disabled. looks like you have been a bad user >:(");
          }

          session_start();
          $_SESSION['username'] = $username;
          $temp = $row['userID'];
          $_SESSION['userID'] = $temp;
          
          // echo "<p>".$row['username']. $row['admin']. "</p>";

          if($row['admin'] == true){
            $_SESSION['admin'] = true;
            header("Location: adminhome.php");
            exit();
          }else{
            header("Location: viewposttitles.php");
            exit();
          }
          
        }
            // echo "user is valid and in database";
        else
            echo "username and/or password invalid";
            echo "<br>";
            echo "<a href=\"../html/login.html\">try to log in again</a>";

      
        mysqli_close($connection);
        die;

      }

     
    }
    else{
        echo "A field was not set. Something went wrong :(";
        echo "<br>";
        echo "<a href=\"../html/login.html\">try to log in again</a>";
    }
}
else
  die("Something went wrong with post :(");


?>

