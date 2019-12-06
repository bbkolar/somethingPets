

<?php 

/**
 * Used to allow a user to buy a pet if they have enough coins. 
 * 
 * These scripts update the user details table and pet table in the database
 */
session_start();
include "../../connect.php";

$petTypeId = filter_input(INPUT_POST, "petTypeId", FILTER_VALIDATE_INT);

if ($petTypeId != null && $petTypeId != false) {
$command = "SELECT price FROM PetType WHERE petTypeId = ? ";
$smtp = $dbh->prepare($command);
$params = [$petTypeId];
$success = $smtp->execute($params);



if($row = $smtp->fetch()) {
    $price = $row["price"];
}



if ($_SESSION["coins"] >= $price) {
    //add pet to pets table
    $command = "INSERT INTO Pet(userId, typeId) VALUES (?, ?)";
    $smtp = $dbh->prepare($command);
    $params = [$_SESSION["userId"], $petTypeId];
    $success = $smtp->execute($params);



    //update the user balance
    $command = "UPDATE loginDetails SET coins = coins - ? WHERE user_id = ?";
    $smtp = $dbh->prepare($command);
    $params = [$price, $_SESSION["userId"]];
    $success = $smtp->execute($params);
    $_SESSION["coins"] -= $price;
    

    //get update balance for user
    $command = "SELECT coins FROM loginDetails WHERE user_id = ?";
    $smtp = $dbh->prepare($command);
    $params = [$_SESSION["userId"]];
    $success = $smtp->execute($params);

    if($row = $smtp->fetch())
        $newBalance = $row["coins"];

    echo json_encode([0, $newBalance]); //0 is success message


} else {
    echo json_encode([1, 0]); //1 is failure message
}

}

