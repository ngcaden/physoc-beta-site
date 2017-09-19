angular.module('wikiApp', [])
.controller('MainCtrl', ['$http', function($http) {
    var self = this;

    self.years = [
        {name: 'First Year', year_id: 1},
        {name: 'Second Year', year_id: 2},
        {name: 'Third Year', year_id: 3},
        {name: 'Options', year_id: 0}
    ];


    self.courses = [
        {name: 'Mathematical Analysis', year: 1},
        {name: 'Mechanics', year:1},
        {name: 'Comprehensives 1', year: 3},
        {name: 'Environmental Physics', year: 0}
    ];

    self.wiki = {name: 'Welcome to Imperial Physics Wiki',
                 description:'Select your course on the left tab.'};

    self.fetchCourse = function(coursename) {
        self.wiki = {id: 11,
                     course: 'Test Course',
                     description:'This course is no longer in teaching but relevant to course 2',
                     year: 1
                    };
        self.wiki.name = coursename;
                    
        fetchCourseNotes();
    };


    var fetchCourseNotes = function() {
        self.uniqueSets = [
            {id: 1, set:'2016 Professor X', course_id: 11},
            {id: 2, set:'2017 Cambridge', course_id: 11},
        ];
        self.courseNotes = [
            {id: 1, name:'Lecture 1', link:'/', set:'2016 Professor X', course_id: 11},
            {id: 2, name:'Lecture 2', link:'/', set:'2016 Professor X', course_id: 11},
            {id: 3, name:'Lecture 3', link:'/', set:'2016 Professor X', course_id: 11},
            {id: 4, name:'Lecture 4', link:'/', set:'2016 Professor X', course_id: 11},
            {id: 5, name:'Lecture 1', link:'/', set:'2017 Cambridge', course_id: 11},
            {id: 6, name:'Lecture 2', link:'/', set:'2017 Cambridge', course_id: 11},
        ];
    };

    // self.fetchCourse();
    // self.sponsors = [];
    
    // var fetchSponsors = function() {
    //         return $http.get('/api/sponsors').then(function(response) {
    //         self.sponsors = response.data;
    //     }, function(errResponse) {
    //         console.error('Error while fetching sponsors');
    //     });
    // };

    // fetchSponsors();

    // self.deleteSponsor = function(index) {
    //     $http.delete('/api/sponsors/' + index)
    //         .then(fetchSponsors);
    // };
    
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

