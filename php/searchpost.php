<!DOCTYPE html>
<html>
<head>

</head>

<body>

<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: menu.php");
    exit();
    // echo "hi";
}else {
    ?>

<form method="post" action="dosearchpost.php" id="mainForm" >
  <br>
  <input type="text" name="title" id="title" class="required" placeholder="enter post title to search">
  <br>
  <br>
  <input type="submit" value="search by post title">
</form>

</body>

<?php

}

?>

</html>
