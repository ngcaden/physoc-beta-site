angular.module('wikiApp', ['ngSanitize','ngFileUpload'])
.controller('MainCtrl', ['$http', 'Upload', function($http, Upload) {
    var self = this;


    // COURSE FETCH
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





    // WIKI FETCH
    self.wiki = {name: 'Welcome to Imperial Physics Wiki',
                 html_description:'Select your course.',
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

    var fetchSolutions = function(course_id){
        $http.get('/api/solutions/' + course_id).then(function(response) {
            self.solutions = response.data;
        }, function(errResponse) {
            console.error('Error while fetching solutions');
        })
    }

    var fetchPastPapers = function(course_id) {
        $http.get('/api/pastpapers/' + course_id).then(function(response) {
            self.pastPapers = response.data;
            
            // Adding id for pastPapers years
            for (i = 0; i < self.pastPapers.length; i++) { 
                (self.pastPapers[i])['year_id'] = i;
            };
        }, function(errResponse) {
            console.error('Error while fetching past papers');
        }).then(fetchSolutions(course_id))
    };

    self.fetchWiki = function(course_id) {
        $http.get('/api/courses/' + course_id).then(function(response) {
            self.wiki = angular.copy(response.data);
            if (self.wiki.description)
            {
                self.wiki.html_description = '<p>' + self.wiki.description.replace(/\n([ \t]*\n)+/g, '</p><p>')
                .replace('\n', '<br />') + '</p>';
            }
        }).then(fetchCourseNotes(course_id))
        .then(fetchUsefulLinks(course_id))
        .then(fetchPastPapers(course_id)
        , function(errResponse) {
            console.error('Error while fetching wiki');
        })
    };




    
    // FORM HANDLER FUNCTIONS
    // NEW COURSE FORM
    self.newCourseForm = function() {
        self.NewCourse = {
            year: 1
        };
        $('#myNewCourseForm').modal('show');
    };

    self.newCourse = function() {
        $http.post('/api/courses', 
            {
                name: self.NewCourse.name,
                year: self.NewCourse.year,
                description: self.NewCourse.description,
            }
        ).then(fetchCourses)
        .then($('#myNewCourseForm').modal('hide'))
    };

    // EDIT DESCRIPTION FORM
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
                self.wiki.description = self.current_course.description;
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

    // ADD NOTES FORM
    self.addNotesForm = function() {
        self.NewNotes= {set: self.uniqueSets[0].set};
        $('#myAddNotesForm').modal('show');
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

    // ADD LINKS FORM
    self.addLinksForm = function() {
        self.NewLink = {};
        $('#myAddLinksForm').modal('show');
    }

    self.addLinks = function() {
        $http.post('/api/usefullinks', {
            notes: notes,
            course_id: self.wiki.id,
            name: self.NewLink.name,
            url: self.NewLink.url
        }).then(function() {
            self.fetchWiki(self.wiki.id);
            $('#myAddLinksForm').modal('hide');
        });
    }

    // ADD PAST PAPERS FORM
    self.PastPapersYears = [];
    
    for (var i = 1990; i <= (new Date()).getFullYear(); i++) {
        self.PastPapersYears.push(i);
    }

    self.addPastPapersForm = function() {
        self.NewPastPapers = {year: (new Date()).getFullYear()};
        $('#myAddPastPapersForm').modal('show');
    }

    self.addPastPapers = function(paper) {
        paper.upload = Upload.upload({
            url: '/api/pastpapers',
            data: {paper: self.NewPastPapers.paper,
                   year: self.NewPastPapers.year,
                   course_id: self.wiki.id
            }
        });

        paper.upload.then(function() {
            self.fetchWiki(self.wiki.id);
            $('#myAddPastPapersForm').modal('hide');
        });
    }

    // SOLUTION GUIDE
    self.solutionGuide = function() {
        $('#mySolutionGuide').modal('show');
    }

    // ADD NEW SOLUTION FORM
    self.addNewSolutionForm = function($paper_id) {
        $http.get('/api/paper/' + $paper_id).then(function(response) {
            self.Solution = response.data;
        }).then(function() {
            $('#myNewSolutionForm').modal('show');
        });
    }

    self.addSolution = function() {
        $http.post('/api/solutions', {
            course_id: self.wiki.id,
            paper_id: self.Solution.id,
            url: self.Solution.link
        }).then(function() {
            self.fetchWiki(self.wiki.id);
            $('#myNewSolutionForm').modal('hide');
        });
    }
}]);