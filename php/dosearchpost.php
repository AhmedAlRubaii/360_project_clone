
<?php
use db\dbConnection;

require_once 'dbConnection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["title"])){

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
        $title = $_POST["title"];

        $sql = "SELECT postID, title, postText, numLikes, userID FROM post WHERE title like '%" . $title . "%';";
        //TO DO: join with users table to get username

        $result = mysqli_query($connection, $sql);
        if($result -> num_rows > 0){
          while($row = mysqli_fetch_assoc($result)){
             echo $row['title'] . "   " . $row['postText'] . "   " . $row['numLikes'] . "    " . $row['userID'] . "<a href=\"deletepost.php?postID={$row['postID']}\"><button>delete this post</button></a>";
             echo "<br>";
          }
          echo "<a href=\"searchpost.php\">search another post by title</a>";
        }else{
            echo "post does not exist";
            echo "<br>";
            echo "<a href=\"searchpost.php\">try to search again</a>";

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
        echo "<a href=\"searchpost.php\">try to search again</a>";
    }
}
else
  die("Something went wrong with post :(");


?>

