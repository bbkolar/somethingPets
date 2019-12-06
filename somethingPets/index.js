/**
 * JS Scripts for Index.php used as a homepage for users that are not logged in. Provides functionality to register and login as a user. 
 */

window.addEventListener("load", function () {
        console.log("Javascript content loaded.");



        // Determine login success
        function success(response) {


                if (response.response === 1)
                        // Redirect user to user homepage
                        window.location.replace("userHome/userHome.php");
                else {
                        // Update error message
                        let message = document.getElementById("message");
                        message.style.color = "red";
                        message.innerHTML = "Invalid login.";
                }
        }


        let loginButton = document.getElementById("loginButton");

        // If login is successful then receive username back. If fail, receive username and fail.
        loginButton.addEventListener("click", function (event) {
                event.preventDefault();
                let params = "username=" + document.getElementById("username").value +
                        "&password=" + document.getElementById("password").value;
                console.log("User attempting to login");
                fetch("loginScripts/verifyUser.php", {
                                credentials: "include",
                                method: "POST",
                                headers: {
                                        "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body: params
                        }).then(response => response.json())
                        .then(success)

        })

        // Registration requests
        function createSuccess(response) {
                console.log("in create user");
                console.log(response);
                if (response.response == 1) {
                        // Grey out form to confirm proper user creation
                        $("#registrationForm input").prop("readonly", "true");
                        $("#registrationForm input").css({
                                "background-color": "lightgrey"
                        });
                        $("#createUser").css({
                                "background-color": "lightgray"
                        })
                        $("#createUser").prop("disabled", "true");

                        // Update user message
                        document.getElementById("registerMessage").innerHTML = "Account has been created. Click 'LoginHere' to login."
                } else {
                        // If username is taken then update message
                        document.getElementById("registerMessage").innerHTML = response.username + " has already been taken. Please try another";
                }
        }

        // Add event listener to create user form to send fetch requests
        document.getElementById("createUser").addEventListener("click", function () {
                let params = "username=" + document.getElementById("registerUsername").value +
                        "&password=" + document.getElementById("registerPassword").value;


                // Only send request if both passwords match
                if (document.getElementById("registerPassword").value === document.getElementById("registerConfirmPassword").value && document.getElementById("registerUsername").value.length > 0 &&
                        document.getElementById("registerPassword").value.length > 0) {

                        fetch("loginScripts/createUser.php", {
                                        credentials: "include",
                                        method: "POST",
                                        headers: {
                                                "Content-Type": "application/x-www-form-urlencoded"
                                        },
                                        body: params
                                }).then(response => response.json())
                                .then(createSuccess);
                } else if (document.getElementById("registerPassword").value.length == 0 || document.getElementById("registerUsername").value.length == 0) {
                        // Update message
                        console.log("passwords dont match.")
                        $("#registerMessage").text("Username and password must be greater than 1 char");
                } else {
                        $("#registerMessage").text("Passwords do not match.");
                }




        })

        /* Add event listeners for form animations */
        $('#registerButton').click(function () {
                // Switch to registration form
                if ($("#loginForm").is(":visible")) {

                        $('#registerButton').text("Login Here");

                        $("#loginArea").slideUp(500, function () {
                                $('#loginForm').hide();
                                $('#registrationForm').show();

                                $("#loginArea").slideDown();
                        });

                } else {
                        // Switch to login form
                        $('#registerButton').text("Register Here");

                        $("#loginArea").slideUp(500, function () {
                                $('#loginForm').show();
                                $('#registrationForm').hide();

                                $("#loginArea").slideDown();
                        });

                }
        })
})