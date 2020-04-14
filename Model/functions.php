<?php
class TableGen extends RecursiveIteratorIterator 
{ 
	function current() 
	{
		return "<td>" . parent::current(). "</td>";
	}

	function beginChildren()
	{ 
		global $rowNum;
		echo "<tr type=input name=entry class=row onclick=row_select(this)>"; 
	} 

	function endChildren() 
	{ 
		echo "</tr>" . "\n";
	} 
} 

class Tasks
{
	function delete($conn, $user, $taskId)
	{
		$stmt = $conn->prepare("DELETE FROM todos WHERE id='$taskId'");
		$stmt->execute();
	}
	
	function create($conn, $user)
	{
		$details = $_GET['details'];
		$created = date("Y-m-d H:i:s ");
		$name = $_GET['name'];
		$due = date("Y-m-d",  $_GET['due']);
		$time = time("H:i:s", $_GET['time']);

		
		if ( $_GET['isdone'] == 'on')
			$done = 1;
		else 
			$done = 0;

		$stmt = $conn->prepare("INSERT INTO todos (owneremail, taskName, createddate, duedate, message, isdone) VALUES ('$user', '$name', '$created', '$due', '$details', '$done') ");
		$stmt->execute();
	}

	function edit($conn, $user, $id)
	{
		$details = $_GET['details'];
		$created = date("Y-m-d H:i:s ");
		$name = $_GET['name'];
		$due = date("Y-m-d",  $_GET['due']);
		$time = time("H:i:s", $_GET['time']);


		if ( $_GET['isdone'] == 'on')
			$done = 1;
		else 
			$done = 0;

		$stmt = $conn->prepare("UPDATE todos SET taskName='$name', duedate='$due', message='$details', isdone='$done' WHERE id=$id");
		$stmt->execute();
	}

	function display($conn, $user, $taskId = NULL)
	{
		$stmt = $conn->prepare("SELECT `id`, `taskName`, `message`, `duedate`, `dueTime`, `isdone` FROM `todos` WHERE owneremail='$user' AND `isdone` = '0'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		

		if ( isset($taskId) == false)
			foreach(new TableGen(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
			{
			/*
				if ($k == "isdone")	
					if ($v == 1 || $v == true)
						$this->$check = "Yes";
					else 
						$this->$check = "No";
						*/
				echo $v;
			}
		else
		{
			$stmt = $conn->prepare("SELECT `taskName`, `message`, `duedate`, `dueTime`, `isdone` FROM `todos` WHERE id=$taskId ");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

			foreach(new TableGen(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
			{
			/*
				if ($k == "isdone")	
					if ($v == 1 || $v == true)
						$this->$check = "Yes";
					else 
						$this->$check = "No";
						*/
				echo $v;
			}
		}
	}

	function displayOrder($conn, $user, $taskId = NULL)
	{
		$stmt = $conn->prepare("SELECT `id`, `taskName`, `message`, `duedate`, `dueTime`, `isdone` FROM `todos` WHERE owneremail='$user' AND `isdone` = '1'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

		foreach(new TableGen(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
			echo $v;
	}
}
?>