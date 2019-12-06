<?php 
/**
 * Page used to display a users pets collection and allow them to customize a profile page
 */

session_start(); // Begin session

// If user is not logged in then redirect user to homepage
if (!$_SESSION["username"]) {
    header("Location: ../../index.php");
}
?>
<!doctype html>

<?
// Grab all available pets from pet table

include "../../connect.php";

// Query database for all pets owned by user
$command = "SELECT * FROM Pet WHERE userId = ?";
$smtp = $dbh->prepare($command);
$params = [$_SESSION["userId"]];
$success = $smtp->execute($params);




?>

<html lang="en">
<head>
        <title>User Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../../CSS/index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="petDisplay.js"></script>
        <script>
            window.addEventListener("load", function() {

            // Add logout functionality to button
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
            <a href="../petShop/petShop.php">
                <li> Pet Shop</li>
                </li>
            </a>
            <a href="petDisplay.php">
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
        Pet Display
    </div>

    <div     id="petDisplayContent">
    
        <?php

            // Function used to change class for pet image
            function setDisplay($displaySet) {
                if ($displaySet)
                    return "class='imgDisplayOn'";
                else 
                    return "class='imgDisplayOff'";
            };

            // Create top of profile page //

            echo "<div id='profileTop'>";

            // Set public profile url
            echo "<span id='publicUrlInvitation'> Your public profile URL: <strong>localhost:8080/somethingPets/userpage.php/?userId=" . $_SESSION["userId"] . "</strong></span> <br> <br>"; 


            // Set profile textarea
            echo "<h2 id='profileTitle'>Enter Profile Blurb: </h2>";
            echo "<textarea id='profileId" . $_SESSION["userId"] . "' width='100%' min-max-width='500px' cols='25'>" . $_SESSION['profile'] . "</textarea> <br> <br>" ;

            echo "</div>";
            
            // Display pet inventory
            echo "<div id='petInventory'>";

            // Create pet display for each pet owned
            while($row = $smtp->fetch()) {
                echo "<div id='" . $row["petId"] . "'   class='petDisplay' >";

                // Add pet picture based on the type
                switch($row["typeId"]) {
                    case "1":
                        echo "<img id='petImg" . $row["petId"] . "' src='../images/dog.jpg' " . setDisplay($row['display']) .     ">";
                    break;
                    case "2":
                        echo "<img id='petImg" . $row["petId"] . "' src='../images/cat.png' "  . setDisplay($row['display']) . ">";
                    break;
                }
                echo "<p class'textPetId' id='petId' >Pet ID: " . $row["petId"] . "</p>"; // add pet id
                echo "<input class='nameInput' type='text' id='nameInput" . $row["petId"] . "' size='15' value='" . $row["petName"] . "' >"; // add pet text input
                echo "</div>";
            }
            echo "</div>";


        ?>

         
    

        </div>

    <div id="instruction">
            Click a pets image to toggle its display status
        </div>


   




</body>
</html>
