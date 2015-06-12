<?php  
	include_once('dbhandle.php');
	$dbhandle = new DBHandle();
	$dbhandle->connect('inner_circle', 'root', '');
	$records = $dbhandle->select('
		Select students.student_name, students.id, classes.name, COUNT(student_classes.class_id) as classCount
		From Students
		Join student_classes
		On student_classes.student_id = students.id
		Join classes
		on classes.id = student_classes.class_id
		GROUP BY students.id, student_classes.class_id
		order by students.id
	');

	$dbhandle->close();

	$output = array();
	$currStudent;
	$currID = -1;
	$currRow = 0;

	foreach ($records as $record) {
		// Check if the ID of this record is the same as the last one
		if ($record["id"] != $currID) {
			// push previously built student record since we're on a new one
			if ($currID != -1) {
				$output[] = $currStudent;
			}
			// create our new student record
			$currStudent = array();
			$currStudent['name'] = $record['student_name'];
			$currStudent['classes'] = array(
				array(
					'name' => $record['name'],
					'count' => $record['classCount']
				)
			);
			$currID = $record['id'];
		} else {
			// build onto currently existing student record the additional class(es)
			$currStudent['classes'][] = array(
				'name' => $record['name'],
				'count' => $record['classCount']
			);
		}
		$currRow++;
		// we need to push the last record manually because it won't loop again 
		if ($currRow == count($records)) $output[] = $currStudent;
	}

	echo json_encode($output);
?>