<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" href = "../css/reset.css">
        <link rel="stylesheet" href="../css/home.css">
        <link rel="stylesheet" href="../css/masthead.css">
        <link rel="stylesheet" href=  "../css/mainform.css">
        <link rel="stylesheet" href=  "../css/viewposttitlesphp.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <?php

        use db\dbConnection;

        require_once 'dbConnection.php';

        session_start();
    ?>
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <div class="search-container">
            <form action="/search">
                <input type="text" id ="search" placeholder="Search for a post..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            </div>
        </nav>


    <?php

// use db\dbConnection;

// require_once 'dbConnection.php';

// session_start();


$dbConnection = new dbConnection();
$connection = $dbConnection->getConnection();
$error = $dbConnection->getError();


if(isset($_SESSION['userID'])){

    echo "<h2> Welcome " . $_SESSION['username'] . "!</h2>";

    if(isset($_SESSION['admin'])){
        echo "<a href=\"adminhome.php\"><button>return to admin view</button></a>";
        echo "<br>";
    } 
    
}else{
    echo "<a href=\"login.php\"> <button>login</button> </a> ";
    echo "<br>";
    echo "<a href=\"register.php\"> <button>sign up</button> </a> ";
    echo "<br>";
}

    if($error != null){
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    }
    else{

        $sql = "SELECT postID, title, numLikes, username FROM post NATURAL JOIN users";
        // $sql = "select title from post";
        $result = mysqli_query($connection, $sql);
        if($result -> num_rows > 0){
            while($row = mysqli_fetch_assoc($result)){
                // echo $row['title'];
                $title = $row['title'];
                echo "<a href=\"viewpost.php?postID={$row['postID']}\" class = 'titles'>$title</a>";
                echo "<br>";
        
            }
        }
        else{
            echo "there are no posts here ¯\_(ツ)_/¯";
        }

    }



?>


<section>

<div id="main">
    <article id="latest">
        <p></p>
        <p></p>
    </article>
    
    <article id="right">
        <h1> #Gamer's Den's top 5 pick of latest gaming news and trends!</h1>
        <div id="featured">
            <div id="upcoming">
                <h2>#1. TSM may sell its LCS franchise spot amid financial struggles</h2>
                <p>According to a report by the Sports Business Journal, TSM is reportedly pausing its esports efforts across multiple games, which could lead to the sale of its franchised slot in the LCS, as well as its exit from the esports industry altogether. TSM is one of the original franchises in the LCS and has competed in every split of the league alongside CLG.</p>
                    <div class="right">
                        <a href="https://dotesports.com/league-of-legends/news/breaking-tsm-may-sell-lcs-franchise-spot-report">Read full article at dotesports</a>
                    </div>
                    

                <h2>#2. Bungie reacts to player feedback of Destiny 2 lightfall launch amidst record high player counts</h2>
                <p>Destiny 2's latest expansion, Lightfall, has received positive feedback from millions of players just over a month after its launch. The game has seen a surge in daily active players, including new and returning players, with its highest number of concurrent players in years. The World First Race with Root of Nightmares garnered record-breaking viewership, while the Lightfall OST debuted as the #1 soundtrack on iTunes. The developers have also decided to respond to criticsm as a gesture of good will.</p>
                    <div class="right">
                        <a href="https://www.bungie.net/7/en/News/article/reflecting-on-lightfall">Read full article at bungie.net</a>
                    </div>

                <h2>#3. Resident Evil 4 remake a huge success</h2>
                <p>Resident Evil 4's remake has received widespread critical acclaim, according to Metacritic. The gameplay and story updates were praised by IGN's Tristan Ogilvie, who noted various enhancements throughout the game. GameSpot's Kurt Indovina praised the improved characterizations of Leon, Ashley, and the Merchant. However, Destructoid's Zoey Handley criticized the game for not improving some of the original's weaker aspects, and added that the game never reaches the same level of excellence as the village section.</p>
                    <div class="right">
                        <a href="https://kotaku.com/resident-evil-4-re4-remaster-remake-review-capcom-ps5-1850278891">Read our favorite review at kotaku.com</a>
                    </div>
                
                <h2>#4. CLG brand has been official acquired</h2>
                <p>NRG Esports has acquired Counter Logic Gaming's (CLG) League of Legends Championship Series (LCS) spot, marking the end of the organization's decade-long legacy in North American LoL esports. Reports suggest that CLG has also experienced layoffs as part of the acquisition. The move marks NRG's return to the LCS after competing in the 2015 and 2016 seasons. All current CLG LCS talent has reportedly been transferred to NRG, while CLG will seemingly continue to operate teams in other games.</p>
                    <div class="right">
                        <a href="https://esports.gg/news/league-of-legends/clg-is-officially-no-more-as-news-of-the-nrg-acquisition-goes-official/">Read full article at esports.gg</a>
                    </div>
                <h2>#5. Release dates for highly anticipated Diablo IV announced by lead developer</h2>
                <p>Blizzard Entertainment's president, Mike Ybarra, has clarified the global release times for Diablo 4 and confirmed that the Deluxe and Ultimate pre-orders will be the first to play on June 1, 2023. Ybarra corrected a previous tweet of his and shared the exact times fans can jump into the game. The regular launch will be on June 5, 2023.</p>
                    <div class="right">
                        <a href="https://www.ign.com/articles/blizzard-lead-reveals-global-release-times-for-diablo-iv">Read full article at ign.com</a>
                    </div>
        
            </div>
        </div>
    </article>
</div>
</section>

<?php
    mysqli_close($connection);
    die;
?>

</body>
</html>