// Angular Logic
angular.module('postApp', [])
    .controller('ListCtrl', ['$http', function($http) {
        var self = this;

        self.events = [];
        
        $http.get('/api/events_all').then(function(response) {
            self.events = response.data;
        }, function(errResponse) {
            console.error('Error while fetching notes');
        });

        self.getEventClass = function(item) {
            if(item.category === 'Careers') {
                return 'panel-success';
            };
            if(item.category === 'Social') {
                return 'panel-info';
            };
            if(item.category === 'Research') {
                return 'panel-danger';
            };
            if(item.category === 'Lab Tour') {
                return 'panel-warning';
            };
        };
    }]);

