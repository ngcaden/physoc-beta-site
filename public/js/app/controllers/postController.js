// Angular Logic
angular.module('postApp', [])
    .controller('ListCtrl', ['$http', function($http) {
        var self = this;

        self.events = [];
        
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

        var fetchEvents = function() {
            return $http.get('/api/events_all').then(function(response) {
                    self.events = response.data;
                    console.log(self.events);
            }, function(errResponse) {
                console.error('Error while fetching notes');
            });
        };
    
        fetchEvents();
            
        self.deletePost = function(index) {
            $http.delete('/api/events/' + index)
                .then(fetchEvents);
        };
    }]);

