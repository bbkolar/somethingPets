<!DOCTYPE html>

<?php

/**
 * Page that allows a user to share their public profile (customized in userDisplay) to any other user without having to login for an account.
 * 
 * Displays a profile block and all the pets they have set to display.
 */
    include "connect.php";
    $userId = filter_input(INPUT_GET, "userId", FILTER_SANITIZE_STRING);

    


?>

<head>
    <title>User Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../CSS/userpage.css">


</head>

<body>
    <?php

    // Acquire user ID associated with query
    $command = "SELECT profile FROM loginDetails WHERE user_id=?";
    $smtp = $dbh->prepare($command);
    $params = [$userId];
    $success = $smtp->execute($params);

    
    // Set the users profile into the profile box
    echo "<h3>" . $smtp->fetch()['profile'] . "</h3>";

    // Select all pets that the user has set to display on 
    $command = "SELECT * FROM Pet WHERE userId=? and display=1";
        $smtp = $dbh->prepare($command);
        $params = [$userId];
        $success = $smtp->execute($params);

        
    
        if ($userId != null) {

            

        echo "<div class='content'>";
    while ($row = $smtp->fetch()) {
        // Populate pets row with all the pets the owner has set to display
        echo "<div class='petDisplay'>";
        switch($row["typeId"]) {
            case "1":
                echo "<img id='petImg" . $row["petId"] . "' src='../userHome/images/dog.jpg'>";
            break;
            case "2":
                echo "<img id='petImg" . $row["petId"] . "' src='../userHome/images/cat.png''>";
            break;
    };

    echo "<div class='petName'>" . $row["petName"] . "</div>"; 

    echo "</div>";
} 

} else {
    echo "<h3>" . "User does not exist. " . "</h3>";
}
echo "</div>";
    ?>

    <br>
    <!-- Insert url pitch to show where a user can sign up for their own -->
    <div id='pitch'>Get your own at <strong>localhost/:8080/somethingPets</strong></div>
    
</body>

</html>