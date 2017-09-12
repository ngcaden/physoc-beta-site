angular.module('committeeApp',[])
.controller('ListCtrl', ['$http', function($http) {
    var self = this;
    
    self.members = [];
    
    $http.get('/api/committee').then(function(response) {
        self.members = response.data;
    }, function(errResponse) {
        console.error('Error while fetching members');
    });
}]);