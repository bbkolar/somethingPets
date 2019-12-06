/**
 * Adds event listeners to controls on the petDisplay.php page
 */

window.addEventListener("load", function() {
    console.log("Pet Display Loaded");

    // Change pet name
    $('.nameInput').change(function(e) {
        e.preventDefault();
        let url = "petRename.php/?petId=" + $(this).attr('id').slice(9) + "&newName=" + $(this).val();
        fetch(url, {credentials: "include"})
        .then(response=>console.log(response));
    })

    // Toggle pet display
    $('.imgDisplayOff, .imgDisplayOn').click(function() {
        console.log("img clicked");

        if ($(this).attr('class') == 'imgDisplayOn') {
            $(this).removeClass("imgDisplayOn").addClass("imgDisplayOff");
            let url = "setDisplayChange.php?petId=" + $(this).attr('id').slice(6) + "&setDisplay=0";
            fetch(url, {credentials: "include"})
            .then(response=>console.log(response));
        }
        else {
            $(this).removeClass("imgDisplayOff").addClass("imgDisplayOn");
            let url = "setDisplayChange.php?petId=" + $(this).attr('id').slice(6) + "&setDisplay=1";
            fetch(url, {credentials: "include"})
            .then(response=>console.log(response));
        }
    })

    //profile blurb change
    $("textarea").change(function() {
        
        let url = "profileChange.php?userId=" + $(this).attr('id').slice(9) + "&newProfile=" + $(this).val();
        fetch(url, {credentials: "include"})
        .then(response=>console.log(response));
    })

    



})


