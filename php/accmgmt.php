<!DOCTYPE html>
<html>
    
<head>

</head>

<body>
<?php

use db\dbConnection;

require_once 'dbConnection.php';

session_start();
if(isset($_SESSION['userID'])){

    $userID = $_SESSION['userID'];

    $dbConnection = new dbConnection();
    $connection = $dbConnection->getConnection();
    $error = $dbConnection->getError();

    if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
      }
      else{
        $sql = "SELECT userID, username, firstname, lastname, email FROM users WHERE userID = '$userID';";

        $result = mysqli_query($connection, $sql);

        if($row =mysqli_fetch_assoc($result)){
        //   $userID = $row['userID'];
            echo "
            <fieldset>
            <table>
                
                <legend>User: ".$row['username']."</legend>
                    <tr><td>First Name:</td><td>".$row['firstname']."</td></tr>
                    <tr><td>Last Name: </td><td>".$row['lastname']."</td></tr>
                    <tr><td>Email:</td><td>".$row['email']."</td></tr>
                    <tr><td>user ID:</td><td>".$row['userID']."</td></tr>
                
            </table>
            </fieldset>";

            $sql = "SELECT contentType, image FROM userImages where userID=?";

            $stmt = mysqli_stmt_init($connection);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "i", $userID);

            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));

          

            

            mysqli_stmt_bind_result($stmt, $type, $image); //bind in results
            mysqli_stmt_fetch($stmt);

            // mysqli_stmt_close($stmt);

            echo '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>';
        

        }
    }
      

   

    // echo "welcome " . $_SESSION['username'];
    // echo "<br>";

    if(isset($_SESSION['admin'])){
        echo "<a href=\"adminhome.php\"><button>return to admin view</button></a>";
        echo "<br>";
    }
    echo "<a href=\"logout.php\"><button>logout</button></a>";
    echo "<br>";
    echo "<a href=\"change_pass.php\"><button>change password</button></a>";
    echo "<br>";
    echo "<a href=\"changeusername.php\"><button>change username</button></a>";
    echo "<br>";
    echo "<a href=\"changebio.php\"><button>change bio</button></a>";
    
}else{
    header("Location: menu.php");
    exit();
}


?>
 <!-- <br>
 <br>
    <a href="../html/login.html">
        <button>login</button>
    </a> 
<br>
<br>
    <a href="../html/register.html">
        <button>sign up</button>
    </a>  -->

    
</body>


</html>