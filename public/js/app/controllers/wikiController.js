angular.module('wikiApp', [])
.controller('MainCtrl', ['$http', function($http) {
    var self = this;

    self.years = [
        {name: 'First Year', year_id: 1},
        {name: 'Second Year', year_id: 2},
        {name: 'Third Year', year_id: 3},
        {name: 'Options', year_id: 0}
    ];


    self.subjects = [
        {name: 'Mathematical Analysis', year: 1},
        {name: 'Mechanics', year:1},
        {name: 'Comprehensives 1', year: 3},
        {name: 'Environmental Physics', year: 0}
    ];

    self.wiki = [
        {welcome: 'Welcome to Imperial Physics Wiki',subject:''},
    ];

    console.log(self.wiki);
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

