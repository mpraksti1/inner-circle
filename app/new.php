<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="www/css/flexslider.css">
	<link rel="stylesheet" href="www/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Trade+Winds' rel='stylesheet' type='text/css'>
	<script src="http://code.angularjs.org/snapshot/angular.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/vendor/angular-ui-router.min.js"></script>
	<script type="text/javascript" src="js/vendor/jquery.flexslider-min.js"></script>
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
<header><img class="logo" src="/img/logo-destaurated.png" alt=""></header>

<div class="appContainer" ng-controller="AddController">	
  	
	<div class="students-list">
		 <ul>
			<li ng-repeat="student in students">
				<a ui-sref="/student({stuID: '{{student.id}}', stuName: '{{student.student_name}}'})">{{ student.student_name }}</a>
				<hr/>
			</li>
		</ul>
  	</div>

	<div class="student-view" ui-view></div>

</div>
</body>
</html>