<!DOCTYPE html>
<html>
<head>

<script type="text/javascript" src="../scripts/validate.js"></script>

<!-- Password checking script here! -->

<?php
session_start();

if(!isset($_SESSION['userID'])){
    header("Location: menu.php");
    exit();
    // echo "hi";
}else {
    ?>


<script>

  function checkPasswordMatch(e){
    var pass1 = document.getElementById("password");
    var pass2 = document.getElementById("password-check");

    if(pass1.value !== pass2.value){
      makeRed(pass1);
      makeRed(pass2);

      alert("passwords dont match >:(");
      e.preventDefault();
  
    }
  }

</script>

</head>

<body>

<form method="post" action="changepassword.php" id="mainForm" >
  Username:<br>
  <input type="text" name="username" id="username" class="required">
  <br>
  Old Password:<br>
  <input type="password" name="oldpassword" id="oldpassword" class="required">
  <br><br>
  New Password:<br>
  <input type="password" name="newpassword" id="password" class="required">
  <br>
  Re-enter New Password:<br>
  <input type="password" name="newpassword-check" id="password-check" class="required">
  <br><br>
  <input type="submit" value="Update Password">
</form>
</body>

<?php

}

?>