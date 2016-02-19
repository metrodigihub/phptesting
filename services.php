
//    angular.module('HApp', [])
//            .controller('UserCtrl', function ($scope, $http){
//                $scope.userinfolist = [];       
//                $http({
//                    method: 'POST',
//                    url: '/CIDB/index.php/users/GetUsersInfo'                
//                    }).then(function successCallback(response){
//                       $scope.userinfolist = angular.fromJson(response.data._user_info_list); 
//                    }, function errorCallback(response){
//                     // called asynchronously if an error occurs
//                      // or server returns response with an error status.
//                });            
//            }); 
