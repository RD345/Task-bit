<?php require "Model/header.php"; ?>
<body>
    <nav>
        <a id=logout href="logout.php">Logout</a>
        <p id=user><b><?php echo htmlspecialchars($_SESSION["fname"]).' ('.$username.')'; ?></b></p>
    </nav>
    <form id=Page method=submit action=Model/index.php>
		<div id=menu>
			<table>
				<tr>
					<th><button name=action value=create>Create</button></th>
					<th><button name=action value=edit>Edit</button></th>
					<th><button name=action value=delete>Delete</button></th>
				</tr>
			</table>
		</div>
		<div id=Task_table>
			<table id=Task_table>
				<tr>
					<th>Details</th>
					<th>Created</th>
					<th>Due</th>
					<th>Complete?</th>
				</tr>
				<?php $tasks->display($conn, $username); ?>
			</table>
		</div>
    </form>
    <footer>
        <p>Created by Sofia Buffo & Ryan Doherty</p>
    </footer>
</body>
</html>
