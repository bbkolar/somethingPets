/**
 * Pet Shop Scripts used to provide functionality to a pet purchase (onto a pet purchase button)
 */

window.addEventListener("load", function() {
    console.log("petShop.js loaded");

    // Update the users purse amount on the page
    function success(response) {
        if (response[0] == 0) {
            window.alert("Pet has been bought.");
            $("#currentPurse").html("Current purse: " + response[1]);
        } else {
            window.alert("Not enough money. Go collect some more coins first!");
            
        }
    }


    // When a buy button is pressed attempt to purchase the attributed pet
    $('.petBuyButton').click(function() {
        console.log("pet buy button clicked");
        
        let params = "petTypeId=" + $(this).attr('id');

        fetch("petBuy.php", {
            credentials: 'include',
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded" 
            },
            body: params
        }).then(response=>response.json())
        .then(success)
    })







})