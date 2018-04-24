$(function () {
    calendar = {
        init: function () {
            calendar.getDates();
            calendar.events();
            
        },

        //traigo todos los eventos del cronograma
        getDates: function(){
            $.post(baseurl + "/Evaluador/getAllEventsCron", 
            function(data){
            	var obj = JSON.parse(data);
            	calendar.printCalendar(obj);

            });

        },

        //	Pintar el calendario
        printCalendar: function(obj){
        	// console.log(obj);
        	$('#calendar').fullCalendar({
        		defaultDate: new Date(),
				header: {
					left: 'prev, next, today',
					center: 'title',
					right: 'month, basicWeek, basicDay'
				},
				lang: 'es',
				editable: false,
				eventLimit: false, // allow "more" link when too many events
				events: calendar.getEventos(obj),
				eventClick: function(calEvent, jsEvent, view){
					console.log(calEvent.start._i);

					swal({
						  title: "¿Desea actualizar el evento: "+calEvent.title+" del \n"+calEvent.start._i+"?",
						  text: "Una vez que se actualice la tarea, ¡desaparecerá!",
						  icon: "warning",
						  buttons: true,
						  // dangerMode: true,
						  buttons: ["Cancelar!", "Actualizar!"],
					})
						.then((actualizar) => {
						  	if (actualizar) {
						  		calendar.updateEvent(calEvent.id);
						   		swal("¡Genial!, ¡Tu archivo ha sido actualizado!", {
						    		icon: "success",
						    	});
						 	} else {
						    swal("¡Cancelaste la actualización!",{
						    	icon: "error",
						    });
							}
						});
			    },
        	});            
        },

        //
        getEventos: function(obj){
            // console.log(obj);
            var response = [];
            $.each(obj, function(i,item){
            	// console.log(item);
            	if (item.estado == 1) {
            		response.push(item);
            	}
            }); 
            return response;
        },

        // actrualiza el evento
        updateEvent: function(id){
            $.post(baseurl + "/Evaluador/c_updateCrono",
        		{
        			k_id_cronograma: id,
        			k_id_crono_estado: 2
        		},
        		function(data){
        			if (data.code == 1) {
        				$('#calendar').fullCalendar('removeEvents', id);
        				setTimeout('document.location.reload()',1000);
        			}
        		}
    		);
        },



        //Eventos de la ventana.
        events: function () {
        	
        },
    };
    calendar.init();
});