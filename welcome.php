<?php require "Model/header.php"; ?>
<body>
    <form id=Page method=submit action=modify_tasks.php>
		<div id=menu>
			<table>
				<tr>
					<th><h3>Selected: </h3><input type=text id=task_num name=task_num value=0></th>
					<th><button name=action class=btn_submit value=create>+ Create +</button></th>
					<th><button name=action class=btn_submit value=edit>~ Edit ~</button></th>
					<th><button name=action class=btn_submit value=delete>- Delete -</button></th>
				</tr>
			</table>
		</div>
		<h3>To do: </h3><br>
		<div class=Task_table>
			<table class=Task_table>
				<tr>
					<th class=th_id>Task Id</th>
					<th class=th_name>Name</th>
					<th class=th_details>Details</th>
					<th class=th_due>Due Date</th>
					<th class=th_due>Due Time</th>
					<th class=th_done>Complete?</th>
				</tr>
				<?php $tasks->display($conn, $username); ?>
			</table>
		</div>
		<h3>Complete </h3><br>
		<div class=Task_table>
			<table class=Task_table>
				<tr>
					<th class=th_id>Task Id</th>
					<th class=th_name>Name</th>
					<th class=th_details>Details</th>
					<th class=th_due>Due</th>
					<th class=th_due>Due Time</th>
					<th class=th_done>Complete?</th>
				</tr>
				<?php $tasks->displayOrder($conn, $username); ?>
			</table>
		</div>
    </form>
    <footer>
        <p>Created by Sofia Buffo & Ryan Doherty</p>
    </footer>
</body>
</html>
