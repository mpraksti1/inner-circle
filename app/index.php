<!doctype html>
<html>
<head>
	<script src="http://code.angularjs.org/snapshot/angular.js"></script>
  <script>
    angular.module('myApp', [])
      .controller('MyController', ['$scope', '$http', function ($scope, $http) {
        	$http.get('getstudents.php').
        		success(function(data) {
        			$scope.students = data;
        		}).
        		error(function(){
        			return
        		});
    	}]);

    angular.element(document).ready(function() {
      angular.bootstrap(document, ['myApp']);
    });
  </script>
</head>
<body>

  <div ng-controller="MyController">
    <ul>
    	<li ng-repeat="student in students">
    		{{ $index }}: 
    		{{student.student_name}}
    		{{student.email}}
    		{{student.phone}}
    	</li>
    </ul>
  </div>

</body>
</html>