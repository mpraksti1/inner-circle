<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="www/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<script src="http://code.angularjs.org/snapshot/angular.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/vendor/angular-ui-router.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript">
	  	$(document).ready(function(){
	  		$('.pass').on('click', function(){
	  			var answer = prompt("Password");
	  			if(answer === "Mike!") {
	  				$(this).next('.hide').css('display', 'block');
	  			}
	  		});
		});
	</script>
</head>
<body>

<div class="appContainer" ng-controller="AddController">	
	<img class="logo" src="http://florencekarate.com/wp-content/themes/premier/images/logo.png" alt="">
	<div class="header clearfix">
		<a class="pass" href="#">LOG IN</a>
		<form class="hide" ng-submit="addStudent($event)">
			<input type="text" ng-model="formData.name" placeholder="Name"> 
			<input type="text" ng-model="formData.email" placeholder="Email">
			<input type="text" ng-model="formData.phone" placeholder="Phone"> 
			<button>Add Student</button>
	  	</form>
	</div>
  	
	<div class="students-list">
		 <ul>
			<li ng-repeat="student in students">
				<a ui-sref="/student({stuID: '{{student.id}}', stuName: '{{student.student_name}}'})">{{ student.student_name }}</a>
			</li>
		</ul>
  	</div>

	<div class="student-view" ui-view></div>

</div>
</body>
</html>