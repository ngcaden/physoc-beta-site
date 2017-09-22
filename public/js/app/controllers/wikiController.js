angular.module('wikiApp', [])
.controller('MainCtrl', ['$http', function($http) {
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
                 description:'Select your course on the left tab.',
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
            if (self.pastPapers.length > 0) {
                $http.get('/api/answers/' + paper_id).then(function(response) {
                    self.answers = response.data;    
                
                }, function(errResponse) {
                    console.error('Error while fetching answers');
                    });
                };
            });
        };
    

    self.fetchWiki = function(course) {
            self.wiki = course;
                        
            fetchCourseNotes(course.id);
            fetchUsefulLinks(course.id);
            fetchPastPapers(course.id);
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
                }).then(self.NewCourse='').then(fetchCourses)
                .then($('#myNewCourseForm').modal('hide'))
        };

    self.editDescriptionForm = function() {
            self.EditDescription = self.wiki;
            $('#myEditDescriptionForm').modal('show');
        };

    self.editDescription = function(index) {
        $http.put('/api/courses/' + index, {
                    description:self.EditDescription.description,
                }).then(self.EditDescription='').then(self.fetchWiki(self.wiki)).then($('#myEditDescriptionForm').modal('hide'))    
        };

    
   
    // self.NewSponsor = {
    //     logo: "/images/sponsors/",
    // };
    
    // self.newSponsor = function() {
    //     $http.post('/api/sponsors', {
    //         name: self.NewSponsor.name,
    //         url: self.NewSponsor.url,
    //         description: self.NewSponsor.description,
    //         logo: self.NewSponsor.logo
    //     }).then(self.NewSponsor='').then(fetchSponsors)
    // };
    
    // self.editSponsor = function(sponsor) {
    //     self.EditForm = sponsor;
    //     $('#myEditForm').modal('show');
    // }

    // self.updateSponsor = function(index) {
    //     $http.put('/api/sponsors/' + index, {
    //         name: self.EditForm.name,
    //         url: self.EditForm.url,
    //         description: self.EditForm.description,
    //         logo: self.EditForm.logo
    //     }).then(fetchSponsors).then($('#myEditForm').modal('hide'))
    // }
}]);

