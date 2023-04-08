<?php

use db\dbConnection;

require_once 'dbConnection.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["username"])){

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

        $username = $_POST["username"];

        $sql = "SELECT username, firstname, lastname, email FROM users WHERE username = '$username';";

        $result = mysqli_query($connection, $sql);

        if($row =mysqli_fetch_assoc($result)){
            echo "
            <fieldset>
            <table>
                
                <legend>User: ".$row['username']."</legend>
                    <tr><td>First Name:</td><td>".$row['firstname']."</td></tr>
                    <tr><td>Last Name: </td><td>".$row['lastname']."</td></tr>
                    <tr><td>Email:</td><td>".$row['email']."</td></tr>
                
            </table>
            </fieldset>";
        
        }else
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

