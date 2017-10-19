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
    }])
    .directive('addLinksForm', [function() {
        return {
            templateUrl: '/js/app/templates/addLinksForm.html',
            restrict: 'A'
        };
    }])
    .directive('addPastPapersForm', [function() {
        return {
            templateUrl: '/js/app/templates/addPastPapersForm.html',
            restrict: 'A'
        };
    }])
    .directive('addNewSolutionForm', [function() {
        return {
            templateUrl: '/js/app/templates/addNewSolutionForm.html',
            restrict: 'A'
        };
    }])
    .directive('showSolutionGuide', [function() {
        return {
            templateUrl: '/js/app/templates/solutionGuide.html',
            restrict: 'A'
        };
    }]);