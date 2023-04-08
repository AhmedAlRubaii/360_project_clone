<?php

use db\dbConnection;

require_once 'dbConnection.php';

session_start();


$dbConnection = new dbConnection();
$connection = $dbConnection->getConnection();
$error = $dbConnection->getError();


if(isset($_SESSION['userID'])){

    echo "<h2> welcome " . $_SESSION['username'] . "</h2>";
    // echo "<br>";

    if(isset($_SESSION['admin'])){
        echo "<a href=\"adminhome.php\"><button>return to admin view</button></a>";
        echo "<br>";
    }
    
    echo "<a href=\"logout.php\"><button>logout</button></a>";
    echo "<br>";
    echo "<a href=\"makepost.php\"><button>make a post</button></a>";
    echo "<br>";
    echo "<a href=\"accmgmt.php\"><button>account managment</button></a>";
    echo "<br>";

    
}else{
    echo "<a href=\"login.php\"> <button>login</button> </a> ";
    echo "<br>";
    echo "<a href=\"register.php\"> <button>sign up</button> </a> ";
    echo "<br>";
}

    if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    }
    else{

        $sql = "SELECT postID, title, numLikes, username FROM post NATURAL JOIN users";
        // $sql = "select title from post";
        $result = mysqli_query($connection, $sql);
        if($result -> num_rows > 0){
            while($row = mysqli_fetch_assoc($result)){
                // echo $row['title'];
                $title = $row['title'];
                echo "<a href=\"viewpost.php?postID={$row['postID']}\">$title</a>";
                echo "<br>";
        
            }
        }
        else{
            echo "there are no posts here ¯\_(ツ)_/¯";
        }

        



    }

    mysqli_close($connection);
    die;



?>