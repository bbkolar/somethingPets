<?php
/**
 * Used to update the profile text data of a user in the database
 */

session_start();

include "../../connect.php";


$newProfile = filter_input(INPUT_GET, "newProfile", FILTER_SANITIZE_STRING);
$userId = filter_input(INPUT_GET, "userId", FILTER_VALIDATE_INT);

if ($newProfile != null && $userId != null && $userId != false) {
$command = "UPDATE loginDetails SET profile = ? WHERE user_id= ?";
$smtp = $dbh->prepare($command);
$params = [$newProfile, $userId];
$success = $smtp->execute($params);

$_SESSION['profile'] = $newProfile;
}
