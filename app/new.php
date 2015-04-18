<!doctype html>
<html>
<head>
  <script src="http://code.angularjs.org/snapshot/angular.js"></script>
  <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular-route.min.js"></script>
  <script>
    angular.module('app', []);

    angular.module('app', ['ngRoute']).config(function($routeProvider){
    	$routeProvider
    		.when('/', {
    			templateUrl: 'partial.html'
    		})
    		.when('/one', {
    			template: '<p>page one!</p>'
    		});
    });


    angular.module('app').controller('AddController', [
		'$scope', 
		'$http',

		function ($scope, $http) {
			$scope.formData = {};
			$scope.students = [];

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

<div ng-controller="AddController">	
	<a class="pass" href="#">LOG IN</a>
  	
  	<form class="hide" style="display: none;" ng-submit="addStudent($event)">
		<input type="text" ng-model="formData.name" placeholder="Name"> 
		<input type="text" ng-model="formData.email" placeholder="Email">
		<input type="text" ng-model="formData.phone" placeholder="Phone"> 
		<button>Add Student</button>
  	</form>

	<ul>
		<li ng-repeat="student in students">
		{{ $index }}: 
		{{student.student_name}}
		{{student.email}}
		{{student.phone}}
		</li>
	</ul>

	<a href="#/one">One</a>
	<a href="#/two">Two</a>

	<div ng-view></div>

</div>
</body>
</html>