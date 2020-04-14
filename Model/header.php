<?php
	if(isset($_SESSION) == false)
		session_start();

	if( isset($_SESSION['loggedin']) == false && strpos('login', $_SERVER['PHP_SELF']) == true)
	{
		$_SESSION['loggedin'] == false;
			header("location: login.php");
	}
	
 
	// Check if the user is logged in, if not then redirect him to login page:
	//if($_SESSION['host'] != )
	/*
	if($_SESSION['loggedin'] == false)
	{
		header("location: login.php");
		
	}*/
	///
	require_once "database.php";
	require		 "functions.php";

	$servername = DB_SERVER;
	$dbname     = DB_NAME;
	$_SESSION['conn'] = $conn = new PDO("mysql:host=$servername; dbname=$dbname", DB_USERNAME, DB_PASSWORD);

	$username = $_SESSION['username'];
	$tasks = new Tasks;
?>
<html lang=en>
<link rel=stylesheet href=project.css>
<link rel=icon href=source/favicon.ico>
<script src=scripts.js></script>
<meta charset=utf-8>

<head>
    <title>Task-bit</title>
</head>
<header>
    <h1>Task-bit: Keep your priorities straight!</h1>
    <div id=bar></div>
</header>

