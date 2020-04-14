<?php require "Model/header.php"; ?>
<?php
	if ( isset( $_GET['action'] ) )
	{
		// If action is delete, delete the task_num and exit:
		if ($_GET['action'] == 'delete') 
		{
			$tasks->delete($conn, $username, $_GET['task_num']);
			unset($_SESSION['action']);
			header("location: welcome.php");
			exit;
		} 

		
		// If action is not delete >>
		$id = $_GET['task_num'];

		if ($_GET['action'] != 'submit')   // If the action is create or edit,
			$task = $_GET['action'];	   // sets $task to that value.
		else  // otherwise it uses the previous $task value in submission.
		{
			$name    = $_GET['name'];
			$due     = $_GET['due'];
			$time    = $_GET['due_time'];
			$details = $_GET['details'];
			$done    = $_GET['isdone'];

			$task = $_SESSION['task'];

			if( $task == 'edit')
				$tasks->edit($conn, $username, $id);
			else 
				$tasks->create($conn, $username);

			unset($_SESSION['task']);
			header("location: welcome.php");
			exit;
		}
	}
?>
<body>
    <form id=Page method=submit action="">
		<div id=menu>
		<table>
			<tr>
				<th style="width: 100px";><h3>Selected: </h3></th>
				<th><input type=text id=task_num name=task_num value=<?php echo $id ?>></th>
			</tr>
		</table>
		</div>
		<h3><?php echo"$task" ?> task</h3><br>
		<div class=Task_table>
			<table>
				<tr>
					<th class=th_name>Name</th>
					<th class=th_details>Details</th>
					<th class=th_due>Due</th>
					<th>Time</th>
					<th class=th_done>Complete?</th>
				</tr>
				<?php $tasks->display($conn, $username, $id); ?>
				<tr>
					<th><input  required type=text name=name id=name maxlength=32></th>
					<th><input required type=text name=details id=details maxlength=144></th>
					<th><input  type=date name=due id=due></th>
					<th><input  type=time name=due_time id=due_time></th>
					<th><input type=checkbox name=isdone id=isdone ></th>
				</tr>
			</table>
		</div>
		<table>
			<tr>
				<th><button name=action value=submit class=btn_submit>Submit</button></th>
			</tr>
		</table>
    </form>
    <footer>
        <p>Created by Sofia Buffo & Ryan Doherty</p>
    </footer>
</body>
</html>
