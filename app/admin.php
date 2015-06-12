<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="www/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<script src="http://code.angularjs.org/snapshot/angular.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/vendor/angular-ui-router.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
</head>
<body>

<div class="appContainer" ng-controller="AddController" style="background: #fff;">	
	<img class="logo" src="http://florencekarate.com/wp-content/themes/premier/images/logo.png" alt="">
	<div class="header clearfix">		
	</div>
  	
	<div class="admin-panel">
		<div class="row">
			<div class="cell">
				<p>Student</p>
			</div>
			<div ng-repeat="_class in classesList" class="cell">
				<p>{{ _class.name }}</p>
			</div>
		</div>
		<div ng-repeat="record in records" class="row">
			<div class="cell">
				<p>{{record.name}}</p>
			</div>
			<div class="cell" ng-repeat="_class in classesList" ng-class="{blank: getCount(record, _class) == 0}">
				<p>{{ getCount(record, _class) }}</p>
			</div>			
			<!--
			<div class="cell">
				<p>{{record.name}}</p>
			</div>
			<div class="cell" ng-repeat="class in record.classes">
				<p ng-if="class.name === 'JKD'">{{ class.count }}</p>
				<p ng-if="class.name != 'JKD'">None</p>
			</div>

			<div class="cell" ng-repeat="class in record.classes">
				<p ng-if="class.name === 'Jujitsu'">{{ class.count }}</p>
				<p ng-if="class.name != 'Jujitsu'">None</p>
			</div>

			<div class="cell" ng-repeat="class in record.classes">
				<p ng-if="class.name === 'Escrema'">{{ class.count }}</p>
				<p ng-if="class.name != 'Escrema'">None</p>
			</div>

			<div class="cell" ng-repeat="class in record.classes">
				<p ng-if="class.name === 'Kempo'">{{ class.count }}</p>
				<p ng-if="class.name != 'Kempo'">None</p>
			</div>

			<div class="cell" ng-repeat="class in record.classes">
				<p ng-if="class.name === 'Krav'">{{ class.count }}</p>
				<p ng-if="class.name != 'Krav'">None</p>
			</div>
			-->
		</div>
  	</table>
</div>
</body>
</html>