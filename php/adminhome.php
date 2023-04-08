<!DOCTYPE html>
<html>
    
<head>

</head>

<body>
<?php

session_start();
// if($_SESSION['admin'] = true){

if(isset($_SESSION['admin'])){
    echo "welcome " . $_SESSION['username'];
    echo "<br>";
    echo "<a href=\"logout.php\"><button>logout</button></a>";
    echo "<br>";
    echo "<a href=\"searchusername.php\"><button>search by username</button></a>";
    echo "<br>";
    echo "<a href=\"searchemail.php\"><button>search by email</button></a>";
    echo "<br>";
    echo "<a href=\"searchpost.php\"><button>search by post title</button></a>";
    echo "<br>";
    echo "<a href=\"menu.php\"><button>switch to user view</button></a>";
    
}else{
    echo "you are not admin please leave this page >:(";
    echo "<br>";
    echo "<a href=\"menu.php\"> <button>go back to login and dont come back!!!</button> </a> ";
}


?>