angular.module('docsSimpleDirective', [])
.controller('Controller', ['$scope', function($scope) {
  $scope.customer = {
    name: 'Naomi',
    address: '1600 Amphitheatre'
  };
}])
.directive('myCustomer', function() {
  return {
    template: 'Name: {{customer.name}} Address: {{customer.address}}'
  };
});

my $pre = $`; my $match = $&;
					($ln, $cl) = LineCol($pre);
					

sub LineCol
{
	my $cal = shift; my ($line,$col) = (0, 0);
	
	$line = ($cal =~ s/\n/\n/g);
	$line++;
	$cal =~ s/(?:.+)\n(.*)$/$1/si;
	$col = length($cal);
	$col=1 if($col == 0);
	return($line, $col);
}


angular.module('myApp', [])
.run(function($rootScope) {
    $rootScope.test = new Date();
})
.controller('myCtrl', function($scope, $rootScope) {
  $scope.change = function() {
        $scope.test = new Date();
    };
    
    $scope.getOrig = function() {
        return $rootScope.test;
    };
})
.controller('myCtrl2', function($scope, $rootScope) {
    $scope.change = function() {
        $scope.test = new Date();
    };
    
    $scope.changeRs = function() {
        $rootScope.test = new Date();
    };
    
    $scope.getOrig = function() {
        return $rootScope.test;
    };
});
