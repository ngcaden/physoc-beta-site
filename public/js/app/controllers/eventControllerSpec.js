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
        expect(ctrl.events).toEqual([
            {id: 1, title: 'Meet Physoc', time: '2017-10-05', location: 'Room 313, Blackett', category:'Social'},
            {id: 2, title: 'Welcome Dinner', time: '2017-10-13', location: 'Byron South Kensington', category:'Social'},
            {id: 3, title: 'Tri-union Takeover', time: '2017-11-24', location: 'The Union', category:'Social'},
            {id: 4, title: 'Reseach Frontiers: Plasma', time: '2017-11-17', location: 'Blackett LT1', category:'Research'},
            {id: 5, title: 'Pub Golf', time: '2017-10-14', location: 'The Union', category:'Social'}
        ]);
    });  

    it('should have the right class based on category', function() {
        var items = [{id:1, category:'Social'},
                    {id:2, category:'Careers'},
                    {id:3, category:'Research'},
                    {id:4, category:'Lab Tours'},
                    ];
        
        var actualClass = ctrl.getEventClass(items[0]);
        expect(actualClass).toEqual('panel-info');
        
        actualClass = ctrl.getEventClass(items[1]);
        expect(actualClass).toEqual('panel-default');        

        actualClass = ctrl.getEventClass(items[2]);
        expect(actualClass).toEqual('panel-danger');        

        actualClass = ctrl.getEventClass(items[3]);
        expect(actualClass).toEqual('panel-warning');        
    });

  });
  