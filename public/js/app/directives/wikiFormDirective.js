angular.module('wikiApp')
    .directive('newCourseForm', [function() {
        return {
            templateUrl: '/js/app/templates/newCourseForm.html',
            restrict: 'A'
        };
    }])
    .directive('editDescriptionForm', [function() {
        return {
            templateUrl: '/js/app/templates/editDescriptionForm.html',
            restrict: 'A'
        };
    }])
    .directive('addNotesForm', [function() {
        return {
            templateUrl: '/js/app/templates/addNotesForm.html',
            restrict: 'A'
        };
    }]);