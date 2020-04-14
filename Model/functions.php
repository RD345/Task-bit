<?php

class TableGen extends RecursiveIteratorIterator 
{ 
	function current() 
	{
		return "<td>" . parent::current(). "</td>";
	}

	function beginChildren()
	{ 
		echo "<tr>"; 
	} 

	function endChildren() 
	{ 
		echo "</tr>" . "\n";
	} 
} 

class Tasks
{
	function delete($conn)
	{
		$stmt = $conn->prepare("DELETE FROM todos WHERE owneremail=$username");
		$stmt->execute();
	}

	function create($conn, $user, $msg)
	{
		$date;
		date($date);

		$stmt = $conn->prepare("INSERT INTO todos (owneremail, createddate, duedate, message, isdone) VALUES ('$user', '$date', '$date', '$msg', 0) ");
		$stmt->execute();
	}

	function edit($conn)
	{
		$stmt = $conn->prepare("UPDATE products SET productCode = 'updated', productName= 'updated' WHERE productID = 3");
		$stmt->execute();
	}

	function display($conn, $user)
	{
		$stmt = $conn->prepare("SELECT `message`, `createddate`, `duedate`, `isdone` FROM `todos` WHERE owneremail='$user'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

		foreach(new TableGen(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
			echo $v;
	}
}
?>