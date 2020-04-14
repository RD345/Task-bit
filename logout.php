<?php
// Initialize the session
require('Model/header.php');

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 ?>
 
<head>
    <title>Logout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>You have been logged out</h1>
    </div>
    <p>
        <a href="login.php" class="btn btn-warning">Log in</a>
        <a href="signup.php" class="btn btn-danger">Sign up</a>
    </p>
</body>
</html>