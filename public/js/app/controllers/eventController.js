angular.module('eventApp', [])
    .controller('ListCtrl', [function() {
        var self = this;

        self.items = [
            {id: 1, title: 'Meet Physoc', time: '2017-10-05', location: 'Room 313, Blackett'},
            {id: 2, title: 'Welcome Dinner', time: '2017-10-13', location: 'Byron South Kensington'},
            {id: 3, title: 'Tri-union Takeover', time: '2017-11-24', location: 'The Union'},
            {id: 4, title: 'Reseach Frontiers: Plasma', time: '2017-11-17', location: 'Blackett LT1'},
            {id: 5, title: 'Pub Golf', time: '2017-10-14', location: 'The Union'}
        ];
    }]);