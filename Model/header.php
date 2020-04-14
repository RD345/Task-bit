<?php
	require_once  "database.php";
	require  "functions.php";

	if(isset($_SESSION) == false)
		session_start();

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set('America/New_York');
		
	// Check if the user is logged in, if not then redirect him to login page:
	if( isset($_SESSION['loggedin']) == false && strpos('login', $_SERVER['PHP_SELF']) == true)
	{
		$_SESSION['loggedin'] == false;
		header("location: login.php");
	}
	$servername = DB_SERVER;
	$dbname     = DB_NAME;

	try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) 
	{
        echo 'ERROR: ' . $e->getMessage();
    }

	
	$username = $_SESSION['username'];
	$id;
	$tasks = new Tasks;
?>
<!--Generic html header-->
<!DOCTYPE html>
<head>
	<html lang=en>
	<link rel=stylesheet href=Model/project.css>
	<link rel=icon href=source/favicon.ico>
	<script src=Model/scripts.js></script>
	<meta charset=utf-8>
	<meta discription="A to-do list site for programmers!">
    <title>Task-bit</title>
</head>
<header>
    <h1>Task-bit</h1><br>
    <div id=bar><h2>Keep your priorities straight!<h2></div>
</header>
 <nav>
    <a id=logout href="logout.php">Logout</a>
    <p id=user><b><?php echo htmlspecialchars($_SESSION["fname"]) . ' ' . $_SESSION['lname'] . ' ('.$username.')'; ?></b></p>
</nav>

