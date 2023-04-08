<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href = "../css/login.css"/>

<script type="text/javascript" src="../scripts/validate.js"></script>

</script>
</head>

<body>

<?php
session_start();

if(isset($_SESSION['userID'])){
    header("Location: menu.php");
    exit();
    // echo "hi";
}else {
    ?>
  
  <header>
        <h2>
            THE GAMER'S DEN
        </h2>
        <img src="../images/logo.png" height="50px">
  </header>

  <nav>
      <ul class="list">
          <li><a href="#Home">Home</a></li>
          <li><a href="#Trending">Trending</a></li>
          <li><a href="#Post">Make a Post</a></li>
          <li><a href="#Manage">Account Management</a></li>
      </ul>
  </nav>
  <form method="post" action="processlogin.php" id="mainForm" >
    Username:<br>
    <input type="text" name="username" id="username" class="required">
    <br>
    <br>
    Password:<br>
    <input type="password" name="password" id="password" class="required">
    <br>
    <br><br>
    <input type="submit" value="Login">
    <a href="../html/forgot_pass.html">
    <button type = "button" class = "forgot">Forgot password</button>
    </a> 
  </form>
<br>
</body>
<?php

}

?>


