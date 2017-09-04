describe('Controller: ListCtrl', function() {
    // Instantiate a new version of my module before each test
    beforeEach(module('eventApp'));
  
    var ctrl;
  
    // Before each unit test, instantiate a new instance
    // of the controller
    beforeEach(inject(function($controller) {
      ctrl = $controller('ListCtrl');
    }));
  
    it('should have items available on load', function() {
        expect(ctrl.items).toEqual([
            {id: 1, title: 'Meet Physoc', time: '2017-10-05', location: 'Room 313, Blackett'},
            {id: 2, title: 'Welcome Dinner', time: '2017-10-13', location: 'Byron South Kensington'},
            {id: 3, title: 'Tri-union Takeover', time: '2017-11-24', location: 'The Union'},
            {id: 4, title: 'Reseach Frontiers: Plasma', time: '2017-11-17', location: 'Blackett LT1'},
            {id: 5, title: 'Pub Golf', time: '2017-10-14', location: 'The Union'}
        ]);
    });  
  });
  