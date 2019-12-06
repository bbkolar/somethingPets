<?php

    /**
     * Used to attempt to create a user from a valid registration form. 
     * 
     * Checks if a useranme is taken and if it isnt then INSERTS it into the database
     */
    include "../connect.php";

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);    
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    
    if ($username != null && $password != null) {

    // Check database for rows with username
    $command = "SELECT * FROM loginDetails WHERE username = ?";
    $smtp = $dbh->prepare($command);
    $success = $smtp->execute([$username]);

    // If username isnt taken then create new user
    if ($smtp->rowCount() === 0) {
        $command = "INSERT INTO loginDetails(username, user_password) VALUES (?, ?)";
        $smtp = $dbh->prepare($command);
        $params = [$username, $hashed_password]; // hash the password
        $success = $smtp->execute($params);
        $response = Array("username:"=>$username, "response"=>1); // 1 means user has been created
        echo json_encode($response);
    } else {
        // Username is taken
        $response = Array("username"=>$username, "response"=>0); // 0 means user has not been created (username is taken)
        echo json_encode($response);
    }
}