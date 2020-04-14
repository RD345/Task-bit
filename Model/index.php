<?php
	require('header.php');

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	//$action = $_GET["action"];

	if ($_GET["action"] == 'create') 
	{
		echo "Create is true";
		if (!isset($_SESSION['conn']) || !isset($conn))
			echo "Nope";

		$tasks->create($conn, $username, "indexed");
	}
	else if ($action == 'edit') 
	{
		$product_id = filter_input(INPUT_POST, 'product_id', 
				FILTER_VALIDATE_INT);
		$id = filter_input(INPUT_POST, 'id', 
				FILTER_VALIDATE_INT);
		if ($id == NULL || $id == FALSE ||
				$product_id == NULL || $product_id == FALSE) {
			$error = "Missing or incorrect product id or category id.";
			include('../errors/error.php');
		} else { 
			delete_product($product_id);
			header("Location: .?id=$id");
		}
	} 
	else if ($action == 'delete') 
	{
		$categories = get_categories();
		include('product_add.php');    
	} 
	header("location: ../welcome.php");
		exit;
?>