	$(document).ready(function() {

		$('#calendar').fullCalendar({
                    lang: 'ru',
                    columnFormat: 'dddd',
			header: {
				left: '',
				center: 'prev title next',
				right: ''
			},
			businessHours: true, // display business hours
			editable: true,
			events: [
				{
					title: 'Игра Бананц-МикаМика',
					start:  '2016-08-01T14:30:00',
					constraint: 'availableForMeeting', // defined below
					description: '5 - 8',
                                        className: 'played',
                                        url: 'http://yandex.ru'
				},
                                {
					title: 'Игра Бананц-МикаМика',
					start:  '2016-08-08T14:30:00',
					constraint: 'availableForMeeting', // defined below
					description: '---',
                                        className: 'play',
				},
                                {
					title: 'Игра Бананц-МикаМика',
					start:  '2016-07-08T14:30:00',
					constraint: 'availableForMeeting', // defined below
					description: '5 - 8',
				},
                                {
					title: 'Игра Бананц-МикаМика',
					start:  '2016-11-08T14:30:00',
					constraint: 'availableForMeeting', // defined below
					description: '5 - 8',
				},
                                {
					title: 'Игра Бананц-МикаМика',
					start:  '2016-01-08T14:30:00',
					constraint: 'availableForMeeting', // defined below
					description: '5 - 8',
				},
                                {
					title: 'Игра Бананц-Мика  ',
					start: '2016-06-03T14:30:00',
					constraint: 'availableForMeeting', // defined below
                                        description: '1 - 5'
					
				},
				
			

				// red areas where no events can be dropped
			],
                      
    timeFormat: 'H(:mm)',

             eventRender: function(event, element) {
                 if (event.description != undefined){
             element.find('.fc-time').before("<span class='score'>"+event.description+"</span>")
         }
            } 
		});
		
	});