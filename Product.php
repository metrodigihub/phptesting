Angular JS Filters

Example:

	$scope.rowlimit = 3;

	<input type="text" ng-model="rowlimit"/>
	<tr ng-repeat="employee in employees | limit:rowlimit">
		<td>{{ employee.name | uppercase }}</td>
		<td>{{ employee.gender | lowercase }}</td>
		<td>{{ employee.date | date:"dd/MM/yyyy" }}</td>
		<td>{{ employee.salary | number:2 }}</td>
		<td>{{ employee.salary | currency:"country currency letter" }}</td>
	</tr>
	
	
	Sorting data in AngularJS

	Use orderbyFilter
	{{ orderBy_expression | orderBy : expression : reverse }}
	
	example :
		ng-repeat="employee in employees | orderBy:'salary':false "
		To sort in ascending order, set reverse to false
		To sort in descending order, set reverse to true
		
	you can also use + and - to sort in ascending and descending order respectively.
	example:
	 <tr ng-repeat="employee in employees | orderBy:'(+ or -)name'"> or
	 <tr ng-repeat="employee in employees | orderBy:'name':(false or true)">
		<td>{{ employee.name | uppercase }}</td>
		<td>{{ employee.gender | lowercase }}</td>
		<td>{{ employee.date | date:"dd/MM/yyyy" }}</td>
		<td>{{ employee.salary | number:2 }}</td>
		<td>{{ employee.salary | currency:"country currency letter" }}</td>
	</tr>
		
		
		
		AngularJS sort rows by table header

	Sort using ng-click with ng-class
	
	example: 
		$scope.employees = employees;
		$scope.sortColumn = "name";
		$scope.reverseSort = false;
		
		$scope.sortData = function (column) {
			$scope.reverseSort = ($scope.sortColumn == column) ? !$scope.reverseSort : false
			$scope.sortColumn = column;
		}
		
		$scope.getSortClass = function(column){
			if($scope.sortColumn == column){
				return $scope.reverseSort ? 'arrow-down' : 'arrow-up'; //it is css class property
			}
			return '';
		}
		
	HTML : 
	<thead>
		<tr>
			<th ng-click="sortData('name')">
				Name <div ng-class="getSortClass('name')"></div>
			</th>
			<th ng-click="sortData('name')">
				Name <div ng-class="getSortClass('dob')"></div>
			</th>
			<th ng-click="sortData('name')">
				Name <div ng-class="getSortClass('gender')"></div>
			</th>
			<th ng-click="sortData('name')">
				Name <div ng-class="getSortClass('salary')"></div>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="employee in employees | orderBy:sortColumn:reverseSort">
			<td>{{ employee.name }}</td>
			<td>{{ employee.dob }}</td>
			<td>{{ employee.gender }}</td>
			<td>{{ employee.salary }}</td>
		</tr>
	</tbody>
		
		
		
		
		Search filter in AngularJS
	*How to implement search in angular using search filter
	
	HTML:
	<input type="text" placeholder="search employees" ng-model="searchtext"/>
	
	<tbody>
		<tr ng-repeat="employee in employees | filter:searchtext">
			<td>{{ employee.name }}</td>
			<td>{{ employee.dob }}</td>
			<td>{{ employee.gender }}</td>
			<td>{{ employee.salary }}</td>
		</tr>
	</tbody>
