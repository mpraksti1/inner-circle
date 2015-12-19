<div class="header clearfix">
	<a class="pass" href="#">LOG IN</a>
	<form class="hide" ng-submit="addStudent($event)">
		<input type="text" ng-model="formData.name" placeholder="Name"> 
		<input type="text" ng-model="formData.email" placeholder="Email">
		<input type="text" ng-model="formData.phone" placeholder="Phone"> 
		<button>Add Student</button>
  	</form>
</div>