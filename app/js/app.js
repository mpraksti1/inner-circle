angular.module('app', ['ui.router'])

	.config(function($stateProvider, $urlRouterProvider) {
    	
    	$urlRouterProvider.otherwise('/home');
    	
    	$stateProvider

	    	.state('home', {
	    		url: '/home',
	    		templateUrl: '../home.html',
	    		controller: 'AddController'
	    	})

	    	.state('/student', {
	    		url: '/student/:stuID?stuName',
	    		templateUrl: '../partial.html',
	    		controller: function($http, $scope, $rootScope, $stateParams){
	    			$rootScope.stuID   = $stateParams.stuID;
					$rootScope.stuName = $stateParams.stuName;

					$scope.wtf = function() {

						setTimeout(function() {
			    		
				    		$('.class-btn').click(function(){
				    			
				    			var $this = $(this);

				    			$scope.IDs.classID = $this[0].id;
				    			$scope.IDs.studentID = $rootScope.stuID;
				    			
				    			var req = {
						    		method: 'POST',
									url: 'studentClass.php',
									data: 'classID=' + $scope.IDs.classID + '&studentID=' + $scope.IDs.studentID,
									headers: {
										'Content-Type': "application/x-www-form-urlencoded; charset=utf-8"
									},
									
				 				};

					        	$http(req)
					        		
					        		.success(function(data) {
					        			$scope.IDs = {};
					        			$scope.classTable = data;
					        		})

					        		.error(function(){
					        			return;
					        		})

					        	;
				    		});
				    	}, 500);
			    	}
			    	$scope.wtf();
	    		}
	    	});

    })
;

angular.module('app').constant('config', {
	url: {
		students: 'getstudents.php',
		classes: 'getclasses.php',
		records: 'getrecords.php'
	}
});


angular.module('app').controller('AddController', [
	'$rootScope',
	'$scope', 
	'$http',
	'$state',
	'$stateParams',
	'config',

	function ($rootScope, $scope, $http, $state, $stateParams, config) {
		$scope.formData = {};
		$scope.students = [];
		$stateParams.currStudent = {};

		// Start home state slider
		$('.flexslider').flexslider({
		    animation: "slide",
		});

		//Retrieve student list

		$http.get(config.url.students)
			.success(function(data) {
				$scope.students = data;
			})
			.error(function(){
				return;
			})
		;

		//Add a new student

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

    	$scope.getCount = function(record, _class) {
    		var count = 0;
    		angular.forEach(record.classes, function(val, key) {
    			console.log(_class);
    			if (val.name == _class.name) count = val.count;
    		});
    		return count;
    	}

    	// Check in functionality
    	
    	$scope.IDs = {};
		$scope.classTable = [];

		$http.get('studentClassTable.php')
			.success(function(data) {
				$scope.classTable = data;
			})
			.error(function(){
				return;
			})
		;

		// Check in functionality
    	
    	$scope.IDs = {};
		$scope.records = [];

		$http.get('getrecords.php')
			.success(function(data) {
				$scope.records = data;
			})
			.error(function(){
				return;
			})
		;

    	// Retrieve classes

    	$scope.classesList;

    	$http.get('getclasses.php')
			.success(function(data) {
				$scope.classesList = data;
			})
			.error(function(){
				return;
			})
		;
		}
	]);

/*angular.module('app').controller('AdminController', [
	'data',

	function(data){
		$scope.students = [];

		data.getStudents()
			.then(function(students){
				$scope.students = students;
			}
		);
	}
]);

angular.module('app').factory('data', [
	'$q',
	'$http',

	function($q, $http){
		// Private vars
		var students = [];
		var classes = [];
		var records = [];

		// Public functions/vars
		var _public = {
			getStudents: function(){
				// if we've already retrieved these
				if (students.length > 0) return students;
				// otherwise, we need to make the ajax call
				else {
					$http.get('getstudents.php')
						.success(function(data) {
							students = data;
						})
						.error(function(){
							return;
						})
					;
				}
			},

			getClasses: function(){

			},

			getRecords: function(){

			}
		};

		// Private functions here
		function getStudents(){

		}

		return _public;
	}
]); */


angular.element(document).ready(function() {
	angular.bootstrap(document, ['app']);
});