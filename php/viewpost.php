<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../css/reset.css"/>
        <link rel="stylesheet" href="../css/masthead.css"/>
        <link rel="stylesheet" href=  "../css/mainform.css"/>
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
                <input type="text" id ="search" placeholder="Search for a post..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            </div>
        </nav>

    <?php

    use db\dbConnection;

    require_once 'dbConnection.php';

    $dbConnection = new dbConnection();
    $connection = $dbConnection->getConnection();
    $error = $dbConnection->getError();


        if($error != null){
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
        }
        else{

            $postID = $_GET['postID'];

            $sql = "SELECT title, numLikes, username FROM post NATURAL JOIN users where postID = '$postID'";
            // $sql = "select title from post";
            $result = mysqli_query($connection, $sql);

            if($result -> num_rows > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo $row['title'];
                    echo "<br>";
                    echo "post by: " . $row['username'];
                    echo "<br>";
                    echo "<br>";

                    echo "Add a comment here: ";
                    echo"<br>";
                
                }

                $sql2 = "SELECT commentText, username FROM comments NATURAL JOIN users where postID = '$postID'";
                $result2 = mysqli_query($connection,$sql2);
                
                if($result2 -> num_rows > 0){
                    while($row = mysqli_fetch_assoc($result2)){
                        echo "<br>";
                        echo $row['commentText'];
                        echo "<br>";
                        echo "by: " . $row['username'];
                        echo "<br>";


                    }
            }else{
                echo "No one has commented yet ¯\_(ツ)_/¯. Why not be the first one!";
            }

                ?>

                <form method="post" action="makecomment.php" id="mainForm" >
                add a comment:<br>
                <input type="text" name="comment" id="comment" class="required">
                <input type="hidden" name="postID" value="<?php echo $postID ?>">
                <br><br>
                <input type="submit" value="add a comment">
                </form>

                <?php
            }
        

            



        }

        mysqli_close($connection);
        die;



    ?>

    </body>
</html>