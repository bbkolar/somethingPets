<?php

/**
 * Index page for somethingPets - Displays a welcome banner and a 2 forms (only one shown at a time) for a user to both login and register.
 * 
 * STATEMENT OF AUTHORSHIP:
 * 
 * I, Brandon Kolar, 000800648 certify that this material is my original work. 
 * No other person's work has been used without due acknowledgement.
 * 
 * Date Submitted: December 6, 2019
 *----------------------------------
 * 
 * PROJECT PLAN:
 * 
 * CHANGES:
 * - User table in database is currently named 'LoginDetails'
 * - Pet Type table in database does not include any level of rarity
 * - ADDED profile blurb (integrated as textbox) functionality to profile display
 * - ADDED ability for user to set a custom pet name
 * - Did not implement ability to sell pets
 * - Did not implement ability for admins to simply add new pets
 * - Successfully implemented basic public profile page 
 * 
 * DELIVERED FEATURES (originally outlined in project plan):
 * - Login/Registration system
 * - Click coin game to increase purse balance
 * - Pet Shop page where user can buy pets if they have enough coins
 * - Pet display page where user can select which pets will be displayed
 * 
 * JQUERY INTEGRATION PLAN:
 * 
 * CHANGES:
 * - No jQuery was used to animate opacity changes when display toggling for pets
 * - ADDED slide animation on index page to switch between login and registration forms
 * - ADDED use of jQuery for some element selectors throughout document
 *
 * SECURITY PLAN
 * 
 * CHANGES
 * - ADDED forced user to enter password that must include at least one character (its something)
 * 
 *----------------------------------
 */

session_start(); // Begin session

// If user has a login session then send to user homepage
if (isset($_SESSION["username"])) {
        header("Location: userHome/userHome.php");
}

?>
<!doctype html>

<html lang="en">

<head>
        <title>Login Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="CSS/index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="index.js"></script>

</head>

<body>
        <!-- Title header for page -->
        <h1> somethingPets </h1>

        <!-- Flexbox used to establish row for login screen -->
        <div id="flexTest">
                <div id="registerBanner">
                        <button id="registerButton">Register Here</button>
                </div>

                <!-- Login Form -->
                <div id="loginArea">
                        <form id="loginForm">

                                <label>Username:</label>
                                <br>
                                <input id="username" type="text" name="username">
                                <br>

                                <label>Password:</label>
                                <br>
                                <input id="password" type="password" name="password">
                                <br>
                                <br>

                                <input type="submit" id="loginButton" value="Login">
                                <br>



                                <div id="message">
                                        Login using the form above!
                                </div>
                        </form>

                        <!-- Registration Form -->
                        <div id="registrationForm">

                                <label>Enter username:</label>
                                <input id="registerUsername" type="text" name="username">
                                <br>
                                <label>Enter password:</label>
                                <input id="registerPassword" type="password" name="password">
                                <br>
                                <label>Confirm password:</label>
                                <input id="registerConfirmPassword" type="password" name="password">


                                <button id="createUser">Register</button>


                                <div id="registerMessage"> Use the form above to create a user!
                                </div>
                        </div>

                </div> <!-- END FLEX BOX -->


        </div>

        <div>


        </div>



        </div>


</body>

</html>