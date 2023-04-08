<!DOCTYPE html>
<html>
    
<head>

</head>

<body>
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