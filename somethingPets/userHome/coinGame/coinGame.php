<?php

/**
 * Coin game page that allows a user to click a coin image that changes location every second. Clicking the coin is the way for a user to collect coins in order to buy pets.
 */
session_start(); // Begin session

// If user is not logged in then redirect to home
if (!$_SESSION["username"]) {
    header("Location: ../../index.php");
}
?>
<!doctype html>

<html lang="en">

<head>
    <title>User Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../../CSS/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        // Add logout functionality to logout button
        window.addEventListener("load", function() {
            console.log("window loaded. js time");
            $("accountBlockLoggedIn").css("background-color", "red");
            logouts = document.querySelectorAll(".logoutButton");
            logouts.forEach((logoutButton) => {
                logoutButton.addEventListener("click", function() {
                    // Redirect user to userlogout page to destroy session
                    console.log("You hit logout.");
                    window.location.replace("../userLogout.php");
                })
            })

            // Add event listener to coin so coins are added upon click
            $('#coinButton').click(function() {
                console.log("in coin button");
                let params = "coins=1";
                fetch("increaseCoins.php", {
                        credentials: "include",
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: params
                    }).then(response => response.text())
                    .then(updateButton)
            });

            // Set interval for coin location to change
            let myInterval = setInterval(moveButton, 1000);

            function updateButton(e) {
                //first update coin purse in account block
                console.log(e);
                $("#currentPurse").html("Current purse: " + e);
                clearInterval(myInterval);
                myInterval = setInterval(moveButton, 1000);
                //update random location of button
                $("#coinButton").css({
                    marginLeft: Math.floor(Math.random() * 91) + "%",
                    marginTop: Math.floor(Math.random() * 45) + "%"
                })

            }

        });

        // Function used to change button location
        function moveButton() {
            $("#coinButton").css({
                marginLeft: Math.floor(Math.random() * 91) + "%",
                marginTop: Math.floor(Math.random() * 48) + "%"
            })
        }
    </script>

</head>

<body>

    <div id="accountBlockLoggedIn">

        <ul id="navBar">
        <a href="../userHome.php">
                <li>Home</li>
            </a>
            <a href="coinGame.php">
                <li>Coin Game</li>
            </a>
            <a href="../petShop/petShop.php">
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
        Coin Game
    </div>

    <div id="content">
        



        <button id="coinButton" type="submit">
            <img src="../../CSS/images/coin.png">
        </button>

        


    </div>

        <div id="instruction">
            Click the coin to earn coins. 
        </div>





</body>

</html>