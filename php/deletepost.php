<?php
 use db\dbConnection;

 require_once 'dbConnection.php';
 

session_start();
if(isset($_SESSION['admin'])){
 
  $dbConnection = new dbConnection();
  $connection = $dbConnection->getConnection();
  $error = $dbConnection->getError();
  // $host = "localhost";
  //     // $database = "lab9";
  //     $database = "project";
  //     $user = "webuser";
  //     $password = "P@ssw0rd";
  //     // $host = "cosc360.ok.ubc.ca";
  //     // $database = "db_28878544";
  //     // $user = "28878544";
  //     // $password = "28878544";

  //     $connection = mysqli_connect($host, $user, $password, $database);

  //     $error = mysqli_connect_error();

      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{
        $postID = $_GET['postID'];

        $sql = "DELETE FROM post WHERE postID = '$postID';";

        if($result = mysqli_query($connection, $sql)){
            echo "post has been deleted from the database";
            echo "<br>";
            echo "<a href=\"adminhome.php\"><button>back to admin home page</button></a>";
            echo "<br>";
            echo "<a href=\"logout.php\"><button>logout</button></a>";
        }else{
            echo "something went wrong";
        }
      }
    }else{
      echo "you are not admin please leave this page >:(";
      echo "<br>";
      echo "<a href=\"menu.php\"> <button>go back to login and dont come back!!!</button> </a> ";
  }
    


?>