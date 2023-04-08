
<?php

use db\dbConnection;

require_once 'dbConnection.php';

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
        $username = "admin";
        $firstname ="admin";
        $lastname = "admin";
        $email = "admin@admin";
        $password = md5("admin");
        // $birthdate = $_POST["birthdate"];
        // $profile = $_POST["profile"];
        // $bio = $_POST["bio"];
        $admin = true;
        $enabled = true;


        // $pstmt = $connection-> prepare ("INSERT INTO users (`username`,`firstName`,`lastName`,`email`,`password`,`bio`) VALUES (?,?,?,?,?,?)");
        // $pstmt->bind_param("ssssss", $username, $firstname, $lastname, $email, $password, $bio);
        // $pstmt->bind_param("ssssss", $username, $firstname, $lastname, $email, $password, $birthdate, $profile, $bio);
        $stmt = "INSERT INTO users (username,firstName,lastName,email,password,admin,enabled) VALUES ('$username','$firstname','$lastname','$email','$password','$admin','$enabled');";

        try{
          // $stmt->execute();
          mysqli_query($connection,$stmt);
          session_start();
          $_SESSION['username'] = $username;
          $_SESSION['userID'] = 2;
          $_SESSION['admin'] = $admin;
          header("Location: adminhome.php");
          exit();
          // echo "happy days :D";
          // echo "<br>account for " . $firstname . " created";
        }catch(Exception $e){
          echo "username and/email already exists >:(";
          echo "<br><a href='../html/register.html'>Return to user entry</a>";

          // echo $e->getMessage();
        }
      
        mysqli_close($connection);
        die;

      }



?>


<!-- INSERT INTO `users` (`username`, `firstName`, `lastName`, `email`, `password`, `admin`) VALUES ('admin', 'admin', 'admin', 'admin@admin', 'md5(admin)', true) -->
