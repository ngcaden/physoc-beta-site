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
    .controller('ListCtrl', [function() {
        var self = this;

        self.events = [
            {id: 1, title: 'Meet Physoc', time: '2017-10-05', location: 'Room 313, Blackett', category:'Social'},
            {id: 2, title: 'Welcome Dinner', time: '2017-10-13', location: 'Byron South Kensington', category:'Social'},
            {id: 3, title: 'Tri-union Takeover', time: '2017-11-24', location: 'The Union', category:'Social'},
            {id: 4, title: 'Reseach Frontiers: Plasma', time: '2017-11-17', location: 'Blackett LT1', category:'Research'},
            {id: 5, title: 'Pub Golf', time: '2017-10-14', location: 'The Union', category:'Social'},
            {id: 6, title: 'Lab Tour', time: '2017-12-05', location: 'Mega Lab', category:'Lab Tour'},
            {id: 7, title: 'Careers Fair', time: '2017-01-04', location: 'Blackett', category:'Careers'},
            {id: 8, title: 'Tri-union Takeover', time: '2017-11-24', location: 'The Union', category:'Social'},
            {id: 9, title: 'Reseach Frontiers: Plasma', time: '2017-11-17', location: 'Blackett LT1', category:'Research'},
            {id: 10, title: 'Pub Golf', time: '2017-10-14', location: 'The Union', category:'Social'}
        ];

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

