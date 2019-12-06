<?php
session_start(); // Begin session
?>
<!doctype html>

<html lang="en">

<head>
    <title>User Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    <script>
        window.addEventListener("load", function() {


            logouts = document.querySelectorAll(".logoutButton");
            logouts.forEach((logoutButton) => {
                logoutButton.addEventListener("click", function() {
                    console.log("you hit logout");
                    window.location.replace("./userLogout.php");
                })
            })

        });
    </script>

</head>

<body>

    <div id="accountBlockLoggedIn">

        <ul id="navBar">
            <a href="userHome.php">
                <li>Home</li>
            </a>
            <a href="coinGame/coinGame.php">
                <li>Coin Game</li>
            </a>
            <a href="petShop/petShop.php">
                <li> Pet Shop</li>
                </li>
            </a>
            <a href="petDisplay/petDisplay.php">
                <li>Pet Display</li>
            </a>
        </ul>

        <span id="loginBlock">
            Welcome <strong><? echo $_SESSION["username"] ?></strong>
            <button class="logoutButton"> Logout </button>
            <br>
            <span id="currentPurse">Current purse: <? echo $_SESSION["coins"] ?>
            
            </span>
        </span>

    </div>

    <div id="header">
        Home
    </div>

    <div id="content">
        <div>

        </div>

    </div>
    <div id="instruction">
        Click the coin to earn coins.
    </div>





</body>

</html>