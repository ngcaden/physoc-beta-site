angular.module('wikiApp', ['ngSanitize','ngFileUpload'])
.controller('MainCtrl', ['$http', 'Upload', function($http, Upload) {
    var self = this;

    self.years = [
        {name: 'First Year', year_id: 1},
        {name: 'Second Year', year_id: 2},
        {name: 'Third Year', year_id: 3},
        {name: 'Options', year_id: 0}
    ];


    var fetchCourses = function() {
        $http.get('/api/courses').then(function(response) {
            self.courses = response.data;
            }, function(errResponse) {
            console.error('Error while fetching courses');
            });
        };

    fetchCourses();

    self.wiki = {name: 'Welcome to Imperial Physics Wiki',
                 html_description:'Select your course on the left tab.',
                 welcome: 'true'};

    var fetchCourseNotes = function(course_id) {
        $http.get('/api/uniquesets/' + course_id).then(function(response) {
                self.uniqueSets = response.data;
                
                // Adding id for uniqueSets
                for (i = 0; i < self.uniqueSets.length; i++) { 
                    (self.uniqueSets[i])['id'] = i;
                }   
            }, function(errResponse) {
                console.error('Error while fetching unique sets');
                }).then(function() {
                    $http.get('/api/coursenotes/' + course_id).then(function(response) {
                        self.courseNotes = response.data;
                    }, function(errResponse) {
                        console.error('Error while fetching course notes');
                    });
            });
        };

    var fetchUsefulLinks = function(course_id) {
        $http.get('/api/usefullinks/' + course_id).then(function(response) {
            self.usefulLinks = response.data;
            }, function(errResponse) {
            console.error('Error while fetching useful links');
            });
        };

    var fetchPastPapers = function(course_id) {
        $http.get('/api/pastpapers/' + course_id).then(function(response) {
                self.pastPapers = response.data;
                
                // Adding id for pastPapers years
                for (i = 0; i < self.pastPapers.length; i++) { 
                    (self.pastPapers[i])['year_id'] = i;
                };
            }, function(errResponse) {
                console.error('Error while fetching past papers');
            }).then(function() {
                if (self.pastPapers.length > 0) {
                    self.fetchAnswers(self.pastPapers[0].id);
                };
            });
        };

    self.fetchAnswers = function(paper_id) {
        $http.get('/api/unique_questions/' + paper_id).then(function(response) {
            self.questions = response.data;
        }, function(errResponse) {
            console.error('Error while fetching unique questions');
        }).then(function() {
            $http.get('/api/answers/' + paper_id).then(function(response) {
                self.answers = response.data;    
            
            }, function(errResponse) {
                console.error('Error while fetching answers');
                });
            });
        };
    

    self.fetchWiki = function(course_id) {
        $http.get('/api/courses/' + course_id).then(function(response) {
            self.wiki = angular.copy(response.data);
            self.wiki.html_description = '<p>' + self.wiki.description.replace(/\n([ \t]*\n)+/g, '</p><p>')
            .replace('\n', '<br />') + '</p>';
        }).then(fetchCourseNotes(course_id))
        .then(fetchUsefulLinks(course_id))
        .then(fetchPastPapers(course_id)
        , function(errResponse) {
            console.error('Error while fetching wiki');
        })
    };

    self.newCourseForm = function() {
            $('#myNewCourseForm').modal('show');
            self.NewCourse = {
                year: 1
            };
        };

    self.newCourse = function() {
        $http.post('/api/courses', {
                    name: self.NewCourse.name,
                    year: self.NewCourse.year,
                    description: self.NewCourse.description,
                }).then(fetchCourses)
                .then($('#myNewCourseForm').modal('hide'))
        };

    self.editDescriptionForm = function() {
            self.EditDescription = angular.copy(self.wiki);
            $('#myEditDescriptionForm').modal('show');
        };

    self.editDescription = function(course_id) {
        // Fetch current course data from database
        $http.get('/api/courses/' + course_id).then(function(response) {
            self.current_course = response.data;
            }, function(errResponse) {
            console.error('Error while fetching courses');
            }).then(function() {
                if (self.wiki.description != self.current_course.description) {
                    self.current_course.html_description = '<p>' + self.current_course.description.replace(/\n([ \t]*\n)+/g, '</p><p>')
                    .replace('\n', '<br />') + '</p>';
                    self.EditDescription.error = "Wiki content has changed, please revise your edit!";
                    } else {
                        updateDescription(course_id);
                    }
                }
            );
        };

    var updateDescription = function(course_id) {
        $http.put('/api/courses/' + course_id, {
                description:self.EditDescription.description,
                }).then(function() {
                    self.fetchWiki(course_id);
                    self.EditDescription='';
                    $('#myEditDescriptionForm').modal('hide');    
                });
        };

    self.addNotesForm = function() {
        $('#myAddNotesForm').modal('show');
        self.NewNotes= {set: self.uniqueSets[0].set};
    }

    self.addNotes = function(notes) {
        notes.upload = Upload.upload({
            url: '/api/coursenotes',
            data: {notes: notes,
                   course_id: self.wiki.id,
                   name: self.NewNotes.name,
                   set: self.NewNotes.set
            }
        });

        notes.upload.then(function() {
            self.fetchWiki(self.wiki.id);
            $('#myAddNotesForm').modal('hide');
        });
    }

    self.addLinksForm = function() {
        $('#myAddLinksForm').modal('show');
    }

    self.addLinks = function(notes) {
        notes.upload = Upload.upload({
            url: '/api/usefullinks',
            data: {notes: notes,
                course_id: self.wiki.id,
                name: self.NewLink.name,
                url: self.NewLink.url
        }
    });

    notes.upload.then(function() {
        self.fetchWiki(self.wiki.id);
        $('#myAddNotesForm').modal('hide');
    });
}

}]);

