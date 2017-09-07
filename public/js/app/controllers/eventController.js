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
            {id: 1, title: 'Meet Physoc',
                date: '2017-10-05',
                start: '12:00',
                end: '14:00',
                body: 'We begin the year with our annual Meet Physoc meeting. Everyone is welcome.',
                location: 'Room 313, Blackett',
                category:'Social',
                link: 'physoc.co.uk'}
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

