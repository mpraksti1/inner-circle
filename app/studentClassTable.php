<?php  
	include_once('dbhandle.php');
	$dbhandle = new DBHandle();
	$dbhandle->connect('inner_circle', 'root', '');
	$studentClasses = $dbhandle->select('SELECT * FROM student_classes');

	echo json_encode($studentClasses);
?>