<?php  
	// Report all errors
	error_reporting(E_ALL);

	// Same as error_reporting(E_ALL);
	ini_set("error_reporting", E_ALL);

	include_once('dbhandle.php');
	$dbhandle = new DBHandle();
	$dbhandle->connect('inner_circle', 'root', '');
	
	$dbhandle->insert('students', array(
		'student_name' 	=> $_POST['name'], 
		'email' 		=> $_POST['email'],
		'phone' 		=> $_POST['phone']
	));

	header('location: getstudents.php');

	$dbhandle->close();
?>