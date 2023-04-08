
<?php
 use db\dbConnection;

 require_once 'dbConnection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
      
      $dbConnection = new dbConnection();
      $connection = $dbConnection->getConnection();
      $error = $dbConnection->getError();


      if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        // $birthdate = $_POST["birthdate"];
        $profile = $_POST["newfile"];
        $bio = $_POST["bio"];


        $stmt = "INSERT INTO users (username,firstName,lastName,email,password,bio) VALUES ('$username','$firstname','$lastname','$email','$password','$bio');";

        try{
          // $stmt->execute();
          mysqli_query($connection,$stmt);
          session_start();
          $_SESSION['username'] = $username;

          if($_FILES['newfile']['error'] === UPLOAD_ERR_OK){

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["newfile"]["name"]);
            $flag1 = 1;
            $flag2 = 0;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // $fileTmpPath = $_FILES['newfile']['tmp_name'];
            $fileName = $_FILES['newfile']['name'];
            $fileSize = $_FILES['newfile']['size'];
            // $fileType = $_FILES['newfile']['type'];
            // $fileNameCmps = explode(".", $fileName);
            // $fileExtension = strtolower(end($fileNameCmps));

            // if($fileSize > 100000){
              if($imageFileType != "gif" || $imageFileType != "jpg" || $imageFileType != "png"){
                echo "file type not supported";
                $flag1 = 0;
                // move_uploaded_file($_FILES['newfile']['tmp_name'], $target_file);
              }
            // }

            if($filesize > 500000){
              echo "file size too large";
              $flag1 = 0;
            }

            if(flag1==0){
              echo "something went wrong and file not uploaded";
            }else{
              if(move_uploaded_file($_FILES['newfile']['temp_name'], $target_file))
                $flag2 = 1;
            }else{
              echo "error while uploading";
            }

            if($flag2 = 1){
              $imagedata = file_get_contents("uploads/".$fileName);
              $insert = "INSERT INTO userImages (userID, contentType, image) VALUES (?,?,?)";

            }



            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["newfile"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["newfile"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }

    
            if($fileSize > 100000){
              if($imageFileType == "gif" || $imageFileType == "jpg" || $imageFileType == "png"){
                
                $stmt2 = "SELECT userID FROM users WHERE email = '$email'";
                $exectute = mysqli_query($connection,$stmt2);

                try{
                  if($result2 = mysqli_fetch_assoc($exectute)){
                    $userID = $result2['userID'];
                    $imagedata = file_get_contents($fileName);

                    $insert = "INSERT INTO userImages (userID, contentType, image) VALUES (?,?,?)";

                    $stmt3 = mysqli_stmt_init($connection); //init prepared statement object
                    mysqli_stmt_prepare($stmt3, $insert); // register the query
                    $null = NULL;
                    mysqli_stmt_bind_param($stmt3, "isb", $userID, $imageFileType, $null);
      
                    mysqli_stmt_send_long_data($stmt3, 2, $imagedata);
      
                    $result3 = mysqli_stmt_execute($stmt3) or die(mysqli_stmt_error($stmt3));
      
                    mysqli_stmt_close($stmt3); 

                  }
                }catch(Exception $e){
                  echo $e;
                }
                  

              }else
                die("file format not supported");
            }else
              die("file size too large");
          }

          $stmt2 = "SELECT userID FROM users WHERE email = '$email'";
          $exectute = mysqli_query($connection,$stmt2);

          try{
            if($result2 = mysqli_fetch_assoc($exectute)){
              $userID = $result2['userID'];
              $_SESSION['userID'] = $userID;
            }
          }
            catch(Exception $e){
              echo $e;
            }

          header("Location: menu.php");
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

      // mysqli_close($connection);

    }
    else{
        echo "A field was not set. Something went wrong :(";
    }
  }
else
  die("Something went wrong with post :(");


?>

