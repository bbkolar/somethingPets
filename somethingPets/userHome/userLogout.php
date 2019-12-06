<?php

/**
 * Destroys a session and logs a user outby redirecting back to index.php
 */
// Destroy session
session_start();
session_unset();
session_destroy();

// Redirect user to homepage
header("Location: ../index.php");
die();