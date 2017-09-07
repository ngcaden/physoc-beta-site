// Resizing Event Column
function equalHeight() {
    var welcomeColumn = document.getElementById("welcome-column");
    var eventColumn = document.getElementById("event-column");
    eventColumn.style.height = welcomeColumn.offsetHeight + "px";
};

$(document).ready(equalHeight());
var resizeTimer;
$(window).resize(function() {
    if (resizeTimer) {
        clearTimeout(resizeTimer);   // clear any previous pending timer
    }
     // set new timer
    resizeTimer = setTimeout(function() {
        resizeTimer = null;
        equalHeight();
    }, 1);  
});


// Angular Logic
angular.module('eventApp', [])
    .controller('ListCtrl', ['$http', function($http) {
        var self = this;

        self.events = [];
        self.new_events = [];
        
        $http.get('/api/events').then(function(response) {
            self.new_events = response.data;
            self.events = self.new_events;
        }, function(errResponse) {
            console.error('Error while fetching notes');
        });

        self.allEvents = function() {
            console.log('Fetching notes');
            $http.get('/api/events_all').then(function(response) {
                self.events = response.data;
            }, function(errResponse) {
                console.error('Error while fetching notes');
            });
        };

        self.hideAllEvents = function() {
            
            self.events = self.new_events;
        };

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

