angular.module('sponsorApp', [])
    .controller('ListCtrl', ['$http', function($http) {
        var self = this;

        self.sponsors = [];
        
        $http.get('/api/sponsors').then(function(response) {
            self.sponsors = response.data;
        }, function(errResponse) {
            console.error('Error while fetching sponsors');
        });
    }]);

