<?php  
	include_once('dbhandle.php');
	$dbhandle = new DBHandle();
	$dbhandle->connect('inner_circle', 'root', '');
	$students = $dbhandle->select('SELECT * FROM students');

	echo json_encode($students);

	$dbhandle->close();
?>