<?php 
/**
 * Shop page used to allow a user to view the current selection of pets and purchase them if they have enough coins
 */

session_start(); // Begin session

// If user isnt logged in then redirect to home
if (!$_SESSION["username"]) {
    header("Location: ../../index.php");
}
?>
<!doctype html>

<?
// Query database for all pet types 
include "../../connect.php";

$command = "SELECT * FROM PetType";
$smtp = $dbh->prepare($command);
$success = $smtp->execute();

?>





<html lang="en">
<head>
        <title>User Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../../CSS/index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="petShop.js"></script>
        <script>

            window.addEventListener("load", function() {

            // Add logout functionality to logout buttons on page
            logouts = document.querySelectorAll(".logoutButton");
            logouts.forEach((logoutButton) => {
                logoutButton.addEventListener("click", function() {
                    // Redirect user to userlogout page to destroy session
                    console.log("You hit logout.");
                    window.location.replace("../userLogout.php");
                })
            })

        });
</script>
        
</head>

<body>

<div id="accountBlockLoggedIn">
        
        <ul id="navBar">
        <a href="../userHome.php">
                <li>Home</li>
            </a>
            <a href="../coinGame/coinGame.php">
                <li>Coin Game</li>
            </a>
            <a href="petShop.php">
                <li> Pet Shop</li>
                </li>
            </a>
            <a href="../petDisplay/petDisplay.php">
                <li>Pet Display</li>
            </a>
        </ul>
    
        <span>
            Welcome <strong><? echo $_SESSION["username"] ?></strong>
            <button class="logoutButton"> Logout </button>
            <br>
            <span id="currentPurse">Current purse: <? echo $_SESSION["coins"] ?></span>
        </span>

        
    </div>

    <div id="header">
        Pet Shop
    </div>

    <div id="content">
    <div>
        <?php
            
            
            // Create a display div for each row found in pets datbase
            while($row = $smtp->fetch()) {
                echo "<div id= '" . $row["petTypeId"] . "' class='pet'>"; // add pet id
                echo "<img class='petImage' src='../images/" . $row["image"] . "' >"; // add image
                echo "<h3>" . $row["name"] . "</h3>"; // add pet name
                echo "Price: " .$row["price"] . "<img class='smallCoin' src='../../CSS/images/coin.png'>"; // add price
                echo " <button class='petBuyButton' Id='" . $row["petTypeId"] . "'> Buy </button>";  // add button

                echo "</div>";
            }



        ?>

        

         
    </div>

    

    </div>

    <div id="instruction">
            Click 'buy' to buy a pet (be sure you have enough coins)
        </div>




</body>
</html>
