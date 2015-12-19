<?php  
	// Report all errors
	error_reporting(E_ALL);

	// Same as error_reporting(E_ALL);
	ini_set("error_reporting", E_ALL);

	include_once('dbhandle.php');
	$dbhandle = new DBHandle();
	$dbhandle->connect('inner_circle', 'root', '');
	
	$dbhandle->insert('student_classes', array(
		'student_id' 	=> $_POST['studentID'], 
		'class_id'		=> $_POST['classID'],
		'date'			=> date('Y-m-d H:i:s')
	));

	$dbhandle->close();
?>