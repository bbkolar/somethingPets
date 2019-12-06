<?php
/**
 * Verifys a user's login details from a valid login form.
 * 
 * If user is found and details are correct then a successful login occurs. Otherwise it will fail.
 */

session_start(); // keep session
include "../connect.php";
include "userClass.php";

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

if ($username != null && $password != null) {

// Check login details for user in database
$command = "SELECT * FROM loginDetails WHERE username = ?";
$smtp = $dbh->prepare($command);
$success = $smtp->execute([$username]);

// If user is found
if ($row = $smtp->fetch()) {
    // Verify password
    if (password_verify($password, $row["user_password"])) { // check hashed password
        $response = array("username"=>$username, "response"=>1); // Valid login details
        // Set session details
        $_SESSION["username"] = $row["username"];
        $_SESSION["userId"] = $row["user_id"];
        $_SESSION["coins"] = $row["coins"];
        $_SESSION["profile"] = $row["profile"];
    
        echo json_encode($response);
    } else {
        $response = array("username"=>$username, "response"=>2); // Valid username but not password
        echo json_encode($response);
    }
} else {
    $response = array("username"=>$username, "response"=>3); // Unable to find a user with that username
    echo json_encode($response);
}
}