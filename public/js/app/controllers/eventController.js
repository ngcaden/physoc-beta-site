angular.module('eventApp', [])
    .controller('ListCtrl', [function() {
        var self = this;

        self.events = [
            {id: 1, title: 'Meet Physoc', time: '2017-10-05', location: 'Room 313, Blackett', category:'Social'},
            {id: 2, title: 'Welcome Dinner', time: '2017-10-13', location: 'Byron South Kensington', category:'Social'},
            {id: 3, title: 'Tri-union Takeover', time: '2017-11-24', location: 'The Union', category:'Social'},
            {id: 4, title: 'Reseach Frontiers: Plasma', time: '2017-11-17', location: 'Blackett LT1', category:'Research'},
            {id: 5, title: 'Pub Golf', time: '2017-10-14', location: 'The Union', category:'Social'}
        ];

        self.getEventClass = function(item) {
            if(item.category === 'Careers') {
                return 'panel-default';
            };
            if(item.category === 'Social') {
                return 'panel-info';
            };
            if(item.category === 'Research') {
                return 'panel-danger';
            };
            if(item.category === 'Lab Tours') {
                return 'panel-warning';
            };
        };
    }]);