<?php
/**
 * Used to rename a pet in the database by pet ID
 */
include "../../connect.php";


$newName = filter_input(INPUT_GET, "newName", FILTER_SANITIZE_STRING);
$petId = filter_input(INPUT_GET, "petId", FILTER_SANITIZE_STRING);

// Update database to change pet nme for associated pet Id
if ($newName != null && $petId != null) {
$command = "UPDATE Pet SET petName=? WHERE petId=?";
$smtp = $dbh->prepare($command);
$params = [$newName, $petId];
$success = $smtp->execute($params);
}