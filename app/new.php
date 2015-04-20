<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="www/css/styles.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
  <script src="http://code.angularjs.org/snapshot/angular.js"></script>
  <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular-route.min.js"></script>
  <script>

    angular.module('app', ['ngRoute']).config(function($routeProvider){
    	$routeProvider
    		.when('/studentPicked', {
    			templateUrl: 'partial.html'
    		})
    		.otherwise({
    			template: "<p>Welcome to Inner Circle Martial Arts, please pick your name from the list and check in for class!</p>"
    		})
    	;
    });


    angular.module('app').controller('AddController', [
		'$scope', 
		'$http',

		function ($scope, $http) {
			$scope.formData = {};
			$scope.students = [];
			$scope.setStudent = function(studentID) {
				$scope.currStudent = studentID;
			}

			$http.get('getstudents.php')
				.success(function(data) {
					$scope.students = data;
				})
				.error(function(){
					return;
				})
			;


	    	$scope.addStudent = function(evt) {
	    		evt.preventDefault();

	    		var req = {
		    		method: 'POST',
					url: 'addstudent.php',
					headers: {
						'Content-Type': "application/x-www-form-urlencoded; charset=utf-8"
					},
					data: 'name=' + $scope.formData.name + '&email=' + $scope.formData.email + '&phone=' + $scope.formData.phone
 				};

	        	$http(req)
	        		
	        		.success(function(data) {
	        			$scope.formData = {};
	        			$scope.students = data;
	        		})

	        		.error(function(){
	        			return;
	        		})

	        	;
	    	}
  		}
  	]);

    angular.element(document).ready(function() {
    	angular.bootstrap(document, ['app']);
    });
  </script>
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
				<a href="#/studentPicked" ng-click="setStudent(student.student_name)">{{student.student_name}}{{student.email}}</a>
			</li>
		</ul>
  	</div>

	

	<div class="student-view" ng-view></div>

</div>
</body>
</html>