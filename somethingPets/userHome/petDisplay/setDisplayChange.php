<?php
/**
 * Changes a pets display status to the specfifies status
 */
include "../../connect.php";

// Acquire request parameters
$setDisplay = filter_input(INPUT_GET, "setDisplay", FILTER_SANITIZE_STRING);
$petId = filter_input(INPUT_GET, "petId", FILTER_SANITIZE_STRING);

// Update display status
if ($setDisplay != null && $petId != null) {
$command = "UPDATE Pet SET display=? WHERE petId=?";
$smtp = $dbh->prepare($command);
$params = [$setDisplay, $petId];
$success = $smtp->execute($params);
}