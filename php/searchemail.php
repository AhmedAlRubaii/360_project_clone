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

<form method="post" action="dosearchemail.php" id="mainForm" >
  <br>
  <input type="text" name="email" id="email" class="required" placeholder="enter email to search">
  <br>
  <br>
  <input type="submit" value="search by email">
</form>

</body>

<?php

}

?>

</html>
