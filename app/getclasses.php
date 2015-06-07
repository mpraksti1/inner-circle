<?php  
	include_once('dbhandle.php');
	$dbhandle = new DBHandle();
	$dbhandle->connect('inner_circle', 'root', '');
	$classes = $dbhandle->select('SELECT * FROM classes');

	echo json_encode($classes);

	$dbhandle->close();
?>