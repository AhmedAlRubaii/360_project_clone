
<?php
 use db\dbConnection;

 require_once 'dbConnection.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
      
      $dbConnection = new dbConnection();
      $connection = $dbConnection->getConnection();
      $error = $dbConnection->getError();


      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['newfile']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $fileTmpPath = $_FILES['newfile']['tmp_name'];
        $fileName = $_FILES['newfile']['name'];
        $fileSize = $_FILES['newfile']['size'];
        $fileType = $_FILES['newfile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        if($fileSize > 100000){
          if($imageFileType == "gif" || $imageFileType == "jpg" || $imageFileType == "png"){
            move_uploaded_file($_FILES['newfile']['tmp_name'], $target_file);
            // echo "nice";
          }
        }
     
        

        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["newfile"]["tmp_name"], $target_file)) {

            $username = $_POST["username"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            $enabled = true;

            $duplicate = "SELECT username FROM users where email = '$email'; ";
            $resultduplicate = mysqli_query($connection, $duplicate);
            if (mysqli_fetch_assoc($resultduplicate)) {

            echo "The user with same email already exists";
            echo "<br>";
              echo "<br><a href='../html/register.html'>Return to user entry</a>";

            }
    
            $stmt = "INSERT INTO users (username,firstName,lastName,email,password,enabled) VALUES ('$username','$firstname','$lastname','$email','$password',true);";
    
            try{
              $result1 = mysqli_query($connection,$stmt);
    
              
              $stmt2 = "SELECT userID from users where username =  '$username'";
              $execute = mysqli_query($connection,$stmt2);
    
              try{
    
                if($result2 = mysqli_fetch_assoc($execute)){
                  
                    
                  $userID = $result2['userID'];
                  session_start();
                  $_SESSION['username'] = $username;
                  $_SESSION['userID'] = $userID;
                  
                  $imagedata = file_get_contents("uploads/" . $fileName);
    
                  $sql = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)";
    
                  $stmt3 = mysqli_stmt_init($connection); //init prepared statement object
                  mysqli_stmt_prepare($stmt3, $sql); // register the query
                  $null = NULL;
                  mysqli_stmt_bind_param($stmt3, "isb", $userID, $imageFileType, $null);
    
                  mysqli_stmt_send_long_data($stmt3, 2, $imagedata);
    
                  $result3 = mysqli_stmt_execute($stmt3) or die(mysqli_stmt_error($stmt3));
    
                  mysqli_stmt_close($stmt3);
    
    
    
    
                }else{
                  echo "sad";
                }
              }catch(Exception $e2){
                echo $e2;
              }
              
              header("Location: viewposttitles.php");
              exit();
              
            }catch(Exception $e){
              echo $e;
              echo "username and/email already exists >:(";
              echo "<br><a href='../html/register.html'>Return to user entry</a>";
            }
          
            mysqli_close($connection);
            die;

        } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }

       

  }else
    echo "A field was not set. Something went wrong :(";
    
}else
  die("Something went wrong with post :(");


?>

