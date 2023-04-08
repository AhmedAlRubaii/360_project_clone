<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href = "../css/reset.css"/>
<link rel="stylesheet" href="../css/masthead.css"/>
<link rel="stylesheet" href = "../css/mainform.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
              <input type="text" placeholder="Search for a post..." name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
    </nav>

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


<?php

}

?>
</body>
</html>
