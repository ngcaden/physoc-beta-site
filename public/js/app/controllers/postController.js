angular.module('postApp', [])
    .controller('ListCtrl', ['$http', '$filter', 'lr.upload', function($http, $filter) {
        var self = this;

        self.events = [];
        self.currentDatetime = new Date();
        self.currentDatetime.setMinutes(0);
        self.NewEvent = {
            date: $filter('date')(self.currentDatetime,"yyyy-MM-dd"),
            start: $filter('date')(self.currentDatetime,"HH:mm"),
            end: $filter('date')(self.currentDatetime.setHours(self.currentDatetime.getHours()+1), "HH:mm"),
            category: 1,
        };

        var fetchCategories = function() {
            return $http.get('/api/categories').then(function(response) {
                    self.categories = response.data;
            }, function(errResponse) {
                console.error('Error while fetching categories');
            });
        };
    
        fetchCategories();

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
            }, function(errResponse) {
                console.error('Error while fetching events');
            });
        };
    
        fetchEvents();
            
        self.deletePost = function(index) {
            $http.delete('/api/events/' + index)
                .then(fetchEvents);
        };

        self.newEvent = function() {
            $http.post('/api/events', {
                title: self.NewEvent.title,
                date: self.NewEvent.date,
                start: self.NewEvent.start,
                end: self.NewEvent.end,
                location: self.NewEvent.location,
                category_id: self.NewEvent.category,
                body: self.NewEvent.body,
                link: self.NewEvent.link
            }).then(self.NewEvent='').then(fetchEvents)
        };

        self.editPost = function(event) {
            self.editForm = event;
            $('#myEditForm').modal('show');
        }

        self.updateEvent = function(index) {
            $http.put('/api/events/' + index, {
                title: self.editForm.title,
                date: self.editForm.date,
                start: self.editForm.start,
                end: self.editForm.end,
                location: self.editForm.location,
                category_id: self.editForm.category_id,
                body: self.editForm.body,
                link: self.editForm.link
            }).then(fetchEvents).then($('#myEditForm').modal('hide'))
        }
    }]);

