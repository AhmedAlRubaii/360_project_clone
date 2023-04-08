<!DOCTYPE html>
<html>
    
<head>
  <link rel="stylesheet" href = "../css/reset.css"/>
  <link rel="stylesheet" href="../css/masthead.css"/>
  <link rel="stylesheet" href="../css/mainform.css"/>
  <link rel ="stylsheet" href ="../css/menuphp.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <header>
      <h2>
          THE GAMER'S DEN
      </h2>
      <img src="../images/logo.png" height="50px">
    </header>


    <!-- add the page styling of masthead and logo -->

<?php

session_start();
if(isset($_SESSION['username'])){
   

    echo "<h2> welcome " . $_SESSION['username'] . "</h2>";
    // echo "<br>";

    if(isset($_SESSION['admin'])){
        echo "<a href=\"adminhome.php\"><button>return to admin view</button></a>";
        echo "<br>";
    }
    
    echo "<a href=\"logout.php\"><button>logout</button></a>";
    echo "<br>";
    echo "<a href=\"makepost.php\"><button>make a post</button></a>";
    echo "<br>";
    echo "<a href=\"accmgmt.php\"><button>account managment</button></a>";
    
}else{
    echo "<a href=\"login.php\"> <button>login</button> </a> ";
    echo "<br>";
    echo "<a href=\"register.php\"> <button>sign up</button> </a> ";
    echo "<br>";
    echo "<a href=\"viewposttitles.php\"> <button>continue as guest</button> </a> ";
}


?>
 <!-- <br>
 <br>
    <a href="../html/login.html">
        <button>login</button>
    </a> 
<br>
<br>
    <a href="../html/register.html">
        <button>sign up</button>
    </a>  -->

    
</body>


</html>