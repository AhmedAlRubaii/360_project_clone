<!DOCTYPE html>
<html>
<head>

</head>

<body>

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
  <input type="text" name="postTitle" id="postTitle" class="required" placeholder="enter post title here">
  <br>
  <br>
  <input type="text" name="postText" id="postText" class="required" placeholder="enter text here">
  <br>
  <br>
  <input type="file" name="image" id="image">
  <br>
  <br><br>
  <input type="submit" value="make post">
</form>

</body>

<?php

}

?>
