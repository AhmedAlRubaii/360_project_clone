
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


    if($error != null){
      $output = "<p>Unable to connect to database!</p>";
      exit($output);
    }else{

        $userID = $_SESSION['userID'];
        $sql = "SELECT bio FROM users where userID = '$userID'";

        $result = mysqli_query($connection, $sql);
        
        
        if($row = $result->fetch_assoc()){
            echo "this is your current bio:";
            echo "<br>";
            echo $row['bio'];
        }
    }
  ?>

<br>
<br>

<form method="post" action="processbio.php" id="mainForm" >
  Update your bio here:<br>
  <input type="text" name="newbio" id="newbio" class="required">
  <br><br>
  <input type="submit" value="update bio">
</form>


<?php

}

?>

