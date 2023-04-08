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
        $userID = $_GET['userID'];

        $check = "SELECT enabled from users where userID = '$userID';";
        $result1 = mysqli_query($connection, $check);
        $row = mysqli_fetch_assoc($result1);

        if($row['enabled'] == false){
            $sql = "UPDATE users SET enabled = true WHERE userID = '$userID';";
            $result = mysqli_query($connection, $sql);
            echo "user has been enabled";
            echo "<br>";
            echo "<a href=\"adminhome.php\"><button>back to admin home page</button></a>";
            echo "<br>";
            echo "<a href=\"logout.php\"><button>logout</button></a>";
        }else if ($row['enabled'] == true){
            $sql = "UPDATE users SET enabled = false WHERE userID = '$userID';";
            $result = mysqli_query($connection, $sql);
            echo "user has been disabled from the database";
            echo "<br>";
            echo "<a href=\"adminhome.php\"><button>back to admin home page</button></a>";
            echo "<br>";
            echo "<a href=\"logout.php\"><button>logout</button></a>";
        }


        // if($result = mysqli_query($connection, $sql)){
        //     echo "user has been disabled from the database";
        //     echo "<br>";
        //     echo "<a href=\"adminhome.php\"><button>back to admin home page</button></a>";
        //     echo "<br>";
        //     echo "<a href=\"logout.php\"><button>logout</button></a>";
        // }else{
        //     echo "something went wrong";
        // }
      }
    }else{
      echo "you are not admin please leave this page >:(";
      echo "<br>";
      echo "<a href=\"menu.php\"> <button>go back to login and dont come back!!!</button> </a> ";
  }
    


?>