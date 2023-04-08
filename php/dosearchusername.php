
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

        $sql = "SELECT userID, username,firstName,lastName,email,bio, enabled FROM users WHERE username like '%" . $username . "%';";
        $result = mysqli_query($connection, $sql);

        if($result -> num_rows > 0){
          while($row = mysqli_fetch_assoc($result)){
            echo $row['username'] . "   " . $row['firstName'] . "   " . $row['lastName'] . "    " . $row['email'] . "   " . $row['bio'] . "<a href=\"deleteuser.php?userID={$row['userID']}\"><button>delete this user</button></a>" . "<a href=\"disableuser.php?userID={$row['userID']}\"><button>enable/disable this user</button></a>" ;
            echo "<br>";
          }
          echo "<a href=\"searchusername.php\">search another user by username</a>";
        }else{
          echo "user does not exist";
          echo "<br>";
          echo "<a href=\"searchusername.php\">try to search again</a>";
        }
        
        echo "<br>";
        echo "<a href=\"adminhome.php\"><button>back to admin home page</button></a>";
        echo "<br>";
        echo "<a href=\"logout.php\"><button>logout</button></a>";


        mysqli_close($connection);
        die;
      }
    }
    else{
        echo "A field was not set. Something went wrong :(";
        echo "<br>";
        echo "<a href=\"searchusername.php\">try to search again</a>";
    }
}
else
  die("Something went wrong with post :(");


?>

