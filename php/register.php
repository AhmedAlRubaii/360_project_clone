<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href = "../css/reset.css"/>
<link rel="stylesheet" href = "../css/register.css"/>
<link rel="stylesheet" href = "../css/masthead.css"/>
<link rel="stylesheet" href = "../css/mainform.css"/>

<?php
session_start();

if(isset($_SESSION['userID'])){
    header("Location: menu.php");
    exit();
    // echo "hi";
}else {
    ?>

<script type="text/javascript" src="../scripts/validate.js"></script>

<!-- Password checking script here!! -->
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
<header>
        <h2>
            THE GAMER'S DEN
        </h2>
        <img src="../images/logo.png" height="50px">
    </header>

    <nav>
        <ul class="list">
            <li><a href="#Home">Home</a></li>
            <li><a href="#Post">Make a Post</a></li>
            <li><a href="#Manage">Account Management</a></li>
        </ul>
    </nav>

<br>
<form method="post" action="newuser.php" id="mainForm" enctype="multipart/form-data">
  First Name:<br>
  <input type="text" name="firstname" id="firstname" class="required">
  <br>
  Last Name:<br>
  <input type="text" name="lastname" id="lastname" class="required">
  <br>
  Username:<br>
  <input type="text" name="username" id="username" class="required">
  <br>
  Email:<br>
  <input type="email" name="email" id="email" class="required">
  <br>
  Profile Photo:<br>
  <input type="file" name="newfile" id="newfile">
  <br>
  Short Bio:<br>
  <input type="text" name="bio" id="bio">
  <br>
  Password:<br>
  <input type="password" name="password" id="password" class="required">
  <br>
  Re-enter Password:<br>
  <input type="password" name="password-check" id="password-check" class="required">
  <br><br>
  <input type="submit" value="Create New User">
</form>
</body>
</html>

<?php

}

?>