
<?php

use db\dbConnection;

require_once 'dbConnection.php';


session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["newbio"])){

      $dbConnection = new dbConnection();
      $connection = $dbConnection->getConnection();
      $error = $dbConnection->getError();

      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{

        $userID = $_SESSION['userID'];
        $newbio = $_POST['newbio'];
        
        $sql = "UPDATE users SET bio = '$newbio' WHERE userID = '$userID'";

        if(mysqli_query($connection, $sql)){
            echo "your bio has been updated";
            echo "<br>";
            echo "<a href=\"accmgmt.php\"><button>back to account managment</button></a>";
            echo "<br>";
            echo "<a href=\"menu.php\"><button>back to home</button></a>";
        }
        
        
        mysqli_close($connection);
        die;

      }

     
    }
    else{
        echo "A field was not set. Something went wrong :(";
        echo "<br>";
        echo "<a href=\"changebio.php\">try again</a>";
    }
}
else
  die("Something went wrong with post :(");


?>

