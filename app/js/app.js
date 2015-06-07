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

    });



    angular.module('app').controller('AddController', [
		'$rootScope',
		'$scope', 
		'$http',
		'$state',
		'$stateParams',

		function ($rootScope, $scope, $http, $state, $stateParams) {
			$scope.formData = {};
			$scope.students = [];
			$stateParams.currStudent = {};

			//Retrieve student list

			$http.get('getstudents.php')
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

	    	//Check in functionality
	    	
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

	    	//retrieve classes

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
  	])
	.controller('studentController', [
		'$rootScope',
		'$scope', 
		'$http',
		'$state',
		'$stateParams',

		function ($rootScope, $scope, $http, $state, $stateParams) {

		}
	]);

    angular.element(document).ready(function() {
    	angular.bootstrap(document, ['app']);
    });