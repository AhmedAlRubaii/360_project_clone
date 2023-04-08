<!DOCTYPE html>
<html>
    
  <head>

  <link rel="stylesheet" href = "../css/reset.css"/>
  <link rel="stylesheet" href="../css/masthead.css"/>
  <link rel="stylesheet" href = "../css/mainform.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>
    <header>
      <h2>
          THE GAMER'S DEN
      </h2>
      <img src="../images/logo.png" height="50px">
    </header>

    <nav>
      <ul class="list">
      <li><a href="viewposttitles.php">Home</a></li>
            <li><a href="makepost.php">Make a Post</a></li>
            <li><a href="accmgmt.php">Account Management</a></li>
      </ul>
      <div class="search-container">
        <form action="/search">
          <input type="text" placeholder="Search for a post..." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </nav>
<?php
 use db\dbConnection;

 require_once 'dbConnection.php';

session_start();

if(!isset($_SESSION['userID'])){
  header("Location: menu.php");
  exit();
}else{

  
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
    }else{

        $userID = $_SESSION['userID'];
        $sql = "SELECT username FROM users where userID = '$userID'";

        $result = mysqli_query($connection, $sql);
        
        
        if($row = $result->fetch_assoc()){
            echo "this is your current username:";
            echo "<br>";
            echo $row['username'];
        }
    }
  ?>

<br>
<br>

<form method="post" action="processusername.php" id="mainForm" >
  Update your username here:<br>
  <input type="text" name="newusername" id="newusername" class="required">
  <br><br>
  <input type="submit" value="update username">
</form>


<?php

}

?>
<html>
