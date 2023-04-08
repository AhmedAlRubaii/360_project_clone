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

<form method="post" action="dosearchusername.php" id="mainForm" >
  <br>
  <input type="text" name="username" id="username" class="required" placeholder="enter username to search">
  <br>
  <br>
  <input type="submit" value="search by username">
</form>

<?php

}

?>

</body>

</html>
