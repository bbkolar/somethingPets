<?php
/**
 * PHP scripts to increase the number of coins in a user's purse. 
 */

session_start();
include "../../connect.php";

    
    $numberOfCoins = filter_input(INPUT_POST, "coins", FILTER_SANITIZE_SPECIAL_CHARS);
    
    // Increase coins by the amount specified in the request
    if ($numberOfCoins != null) {
    $command = "UPDATE loginDetails SET coins = coins + ? WHERE username = ?";
    $smtp = $dbh->prepare($command);
    $params = [$numberOfCoins, $_SESSION["username"] ];
    $success = $smtp->execute($params);
    
    $_SESSION["coins"] = $_SESSION["coins"] + $numberOfCoins;
    
    echo $_SESSION["coins"] = $_SESSION["coins"];

    }

   