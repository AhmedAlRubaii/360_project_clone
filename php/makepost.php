<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href = "../css/reset.css"/>
  <link rel="stylesheet" href=  "../css/mainform.css"/>
  <link rel="stylesheet" href="../css/masthead.css"/>
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
      session_start();

      if(!isset($_SESSION['userID'])){
          header("Location: menu.php");
          exit();
          // echo "hi";
      }else {
    ?>

  <form method="post" action="postpost.php" id="mainForm" >
    <br>
    <input type="text" name="postTitle" id="postTitle" class="required" placeholder="Enter post title here">
    <br>
    <br>
    <input type="text" name="postText" id="postText" class="required" placeholder="Enter text here">
    <br>
    <br>
    <input type="file" name="image" id="image">
    <br>
    <br><br>
    <input type="submit" value="make post">
  </form>



    <?php

    }

    ?>
  </body>
</html>
