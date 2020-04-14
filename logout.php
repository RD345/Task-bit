<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log out</title>
    <link rel=stylesheet href=Model/project.css>
</head>
<body>
    <div class="page-header">
        <h1>You have been logged out</h1>
    </div>
    <p class = "center">
        <a href="login.php" class="btn-logout">Log in</a>
        <a href="signup.php" class="btn-logout">Sign up</a>
    </p>
</body>
</html>