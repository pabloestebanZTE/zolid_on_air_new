$(function () {
    crono = {
        init: function () {
            crono.events();
            crono.getMonthActual();
            crono.getMonthSelected();

            
        },

        //Eventos de la ventana.
        events: function () {
			crono.meses = ['',31,28,31,30,31,30,31,31,30,31,30,31];
			crono.weekday = ["D","L","M","M","J","V","S"];
			crono.months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        	crono.mes = new Date();
        	// console.log(baseurl);
        	$.post( baseurl + "/Evaluador/c_cronograma",
        		{
        			mes: (crono.mes.getMonth()+1)
        		},
        		function(data){
        			var obj = JSON.parse(data);
        			crono.llenar_tabla(obj, crono.mes);

        			$('#btn-hoy').on('click', function(){
                        crono.onClickVerActividadHoy(obj, (crono.mes.getMonth()+1));
                    });
        		}
        	);

        	// Actualizar eventos
        	$('#table_cronograma').on('click', 'a.actualizar', crono.onClickActualizar);
        	$('#table_cronograma').on('click', 'a.bloqueado', crono.onClickAlert);

        	$('#table_modal').on('click', 'a.actualizar', crono.onClickActualizar);
        	
        	// mostrar u ocultar calendario y cronograma
        	$('#btn-calendario').click(function(){
        		$('.panel-cronograma').hide(500);
        		$('.calendario').show(500);
        	});

        	$('#btn-cronograma').click(function(){
        		$('.calendario').hide(500);
        		$('.panel-cronograma').show(500);
        	});


        	// menu sticky
        	$('#btn_fixed').on('click', function(){
                $(this).hide();                
                $('#content_fixed').removeClass('closed');
                $('#content_fixed #menu_fixed').removeClass('hidden').hide().fadeIn(500);
            });
            $('#btn_close_fixed').on('click', function(){                
                $('#content_fixed').addClass('closed');
                $('#content_fixed #menu_fixed').hide();
                $('#btn_fixed').fadeIn(500);
            });


        },


        //mostrar modal de eventos de hoy
        onClickVerActividadHoy: function(obj){
        	// console.log(obj);
            $('#modal_hoy').modal('show');
            var hoy = new Date();
            $('#titleType').html('Detalle total de actividades Para entregar Hoy: '+hoy.getDate()+' de '+crono.months[(hoy.getMonth()+1)]+' de '+hoy.getFullYear());
            $('#body_table_modal').html('');

            var frec = "";
            var hora = "";
            var ini = 0;
	        var cuerpo = "";

            $.each(obj, function(i,item){

            	cuerpo = "";
        		 ini = (item.start[8] == 0) ? 9 : 8;
				num_dia = item.start.slice(ini, 10);
				if (num_dia == hoy.getDate() && item.estado == 1) {
					if (item.id_reporte == 1) {
						frec = 'Lunes';
						hora = '18:00';
					} 
					else if (item.id_reporte == 2) {
						frec = 'Diario';
						hora = '10:00';
					}
					else if (item.id_reporte == 3) {
						frec = 'Diario';
						hora = '12:00';
					}
					else if (item.id_reporte == 4) {
						frec = 'Diario';
						hora = '18:00';
					}
					else if (item.id_reporte == 5) {
						frec = 'Miercoles';
						hora = '18:00';
					}
					else if (item.id_reporte == 6 || item.id_reporte == 7) {
						frec = 'Martes';
						hora = '10:00';
					}
					else if (item.id_reporte == 8 || item.id_reporte == 9) {
						frec = 'Martes';
						hora = '18:00';
					}
					else if (item.id_reporte == 10) {
						frec = 'Miercoles';
						hora = '18:00';
					}
					else if (item.id_reporte == 11) {
						frec = 'Viernes';
						hora = '18:00';
					}
					else if (item.id_reporte == 12 || item.id_reporte == 13 || item.id_reporte == 14 || item.id_reporte == 15) {
						frec = 'Diario';
						hora = '06:00';
					}



					cuerpo += '<tr>';
		              cuerpo += '<th>'+item.reporte+'</th>';
		              cuerpo += '<td>'+frec+'</td>';
		              cuerpo += '<td>'+hora+'</td>';
		              cuerpo += '<td><a class="actualizar" id="'+item.id+'"><i class="fa fa-fw fa-calendar"></i></a></td>';
		            cuerpo += '</tr>';

					$('#body_table_modal').append(cuerpo);
					// $('#body_table_modal').append(cuerpo);
				}
            }); 
            
        },



        getMonthActual: function(){
        	var f = new Date();
        	$('#mes > option[value='+ (f.getMonth()+1) +']').attr('selected', 'selected');
        },

        //trae los datos del mes seleccionado
        getMonthSelected: function(){
            $('#mes').on('change', function(){
        		//Elimino la tabla actual y la vuelvo a crear
        		var newTable = '';
        						newTable += '<thead>';
					              newTable += '<tr id="tb_header">';
					                newTable += '<th>ACTIVIDADES</th>';
					                newTable += '<th>Frecuen cia</th>';
					                newTable += '<th>H Max</th>';
					              newTable += '</tr>';
					            newTable += '</thead>';
					            newTable += '<tbody>';
					              newTable += '<tr id="report_1">';
					                newTable += '<th>Envio de Dash board de KPI Contractuales</th>';
					                newTable += '<td>Lunes</td>';
					                newTable += '<td>18:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_2">';
					                newTable += '<th>Envio Reporte ON AIR </th>';
					                newTable += '<td>Diario</td>';
					                newTable += '<td>10:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_3">';
					                newTable += '<th>Envio reporte ON AIR-Comentarios</th>';
					                newTable += '<td>Diario</td>';
					                newTable += '<td>12:00</td>    ';
					              newTable += '</tr>';
					              newTable += '<tr id="report_4">';
					                newTable += '<th>Reporte tareas Remedy</th>';
					                newTable += '<td>Diario</td>';
					                newTable += '<td>18:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_5">';
					                newTable += '<th>Reporte KPI-ALARMAS-PRODUCCION depues del medio dia</th>';
					                newTable += '<td>Miercoles</td>';
					                newTable += '<td>18:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_6">';
					                newTable += '<th>Reporte escalados O&M depues del medio dia</th>';
					                newTable += '<td>Martes</td>';
					                newTable += '<td>10:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_7">';
					                newTable += '<th>Reporte Reubicaciones depues del medio dia</th>';
					                newTable += '<td>Martes</td>';
					                newTable += '<td>10:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_8">';
					                newTable += '<th>Reporte P&D  depues del medio dia </th>';
					                newTable += '<td>Martes</td>';
					                newTable += '<td>18:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_9">';
					                newTable += '<th>Reporte de gestion ACS Despues del medio dia</th>';
					                newTable += '<td>Martes</td>';
					                newTable += '<td>18:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_10">';
					                newTable += '<th>Presentacion Gestion del proyecto ACS-ONAIR </th>';
					                newTable += '<td>Miercoles</td>';
					                newTable += '<td>18:00</td>    ';
					              newTable += '</tr>';
					              newTable += '<tr id="report_11">';
					                newTable += '<th>Reporte tarea 53</th>';
					                newTable += '<td>Viernes</td>';
					                newTable += '<td>18:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_12">';
					                newTable += '<th>Reporte de estado de tk generados antes de las 6:00 a.m</th>';
					                newTable += '<td>Diario</td>';
					                newTable += '<td>06:00</td>    ';
					              newTable += '</tr>';
					              newTable += '<tr id="report_13">';
					                newTable += '<th>Reporte de sitios con afectacion de servicios antes de las 6:00 a.m</th>';
					                newTable += '<td>Diario</td>';
					                newTable += '<td>06:00</td>    ';
					              newTable += '</tr>';
					              newTable += '<tr id="report_14">';
					                newTable += '<th>Reporte de sitios con degradacion de servicio antes de las 6:00 a.m</th>';
					                newTable += '<td>Diario</td>';
					                newTable += '<td>06:00</td>';
					              newTable += '</tr>';
					              newTable += '<tr id="report_15">';
					                newTable += '<th>Reporte de revision de KPI noche antes de las 6:00 a.m</th>';
					                newTable += '<td>Diario</td>';
					                newTable += '<td>06:00</td>';
					              newTable += '</tr>';
					            newTable += '</tbody>';
	        		$('#table_cronograma').html(newTable);

	        		var num_mes = $('#mes option:selected').val();
	        		$.post( baseurl + "/Evaluador/c_cronograma", 
	        			{mes: num_mes}, 
	        			function(data) {
	        			var obj = JSON.parse(data);
	        			// console.log(obj);
	        			var date = new Date('2018-'+ num_mes + '-01');
	        			crono.llenar_tabla(obj, date);

	        		});
            });
        },

        //
        llenar_tabla: function(obj, mes){
        	// console.log(obj);
        	// console.log(mes.getDate());
			var fecha = "";
			var header = '';
			var hoy = new Date();			
	        var cont_badge = 0;

			// armo la tablla vacia	        				
			for (var d = 1; d <= crono.meses[(mes.getMonth()+1)] ; d++) {
				header = '';
				fecha = new Date("'2018-"+(mes.getMonth()+1)+"-"+d+"'");

				header+=	'<th>';
				header+=crono.weekday[fecha.getDay()]+'<br>'+d;
				header+='</th>';
				$('#tb_header').append(header);		        				

				for (var i = 1; i <= 15; i++) {
					// console.log('#report_'+i);
					$('#report_'+i).append('<td id="'+d+'_'+ i+'"></td>');
				}
			}


			
			var total_1  = 0; var eje_1  = 0; var prog_1  = 0;
			var total_2  = 0; var eje_2  = 0; var prog_2  = 0;
			var total_3  = 0; var eje_3  = 0; var prog_3  = 0;
			var total_4  = 0; var eje_4  = 0; var prog_4  = 0;
			var total_5  = 0; var eje_5  = 0; var prog_5  = 0;
			var total_6  = 0; var eje_6  = 0; var prog_6  = 0;
			var total_7  = 0; var eje_7  = 0; var prog_7  = 0;
			var total_8  = 0; var eje_8  = 0; var prog_8  = 0;
			var total_9  = 0; var eje_9  = 0; var prog_9  = 0;
			var total_10 = 0; var eje_10 = 0; var prog_10 = 0;
			var total_11 = 0; var eje_11 = 0; var prog_11 = 0;
			var total_12 = 0; var eje_12 = 0; var prog_12 = 0;
			var total_13 = 0; var eje_13 = 0; var prog_13 = 0;
			var total_14 = 0; var eje_14 = 0; var prog_14 = 0;
			var total_15 = 0; var eje_15 = 0; var prog_15 = 0;
			// lleno los datos
			for (var f = 0; f < obj.length; f++) {
				var num_dia = "";
				var posicion = "";
					var ini = (obj[f].start[8] == 0) ? 9 : 8;
					// console.log(obj[f].start[8]);
					num_dia = obj[f].start.slice(ini, 10);
					posicion = "#"+num_dia+"_"+obj[f].id_reporte;
					// console.log(posicion);
					if (obj[f].estado == 1) {

						if (num_dia == mes.getDate()) {
							$(posicion).html("<a class='actualizar' id='"+obj[f].id+"'><i class='fa fa-fw fa-calendar'></i></a>");							
						} else {
							$(posicion).html("<a class='bloqueado' id='"+obj[f].id+"'><i class='fa fa-fw fa-calendar-times-o'></i></a>");
						}

						
					} 	else if(obj[f].estado == 2) {
							$(posicion).css("color", "green");
							$(posicion).html("<i class='fa fa-fw fa-check'></i>");
						}



				//calculo los porcentajes
				if (obj[f].id_reporte == 1)  {total_1++; if (obj[f].estado == 2) {eje_1++;}  else if (obj[f].estado == 1) {prog_1++;}}
				if (obj[f].id_reporte == 2)  {total_2++; if (obj[f].estado == 2) {eje_2++;}  else if (obj[f].estado == 1) {prog_2++;}}
				if (obj[f].id_reporte == 3)  {total_3++; if (obj[f].estado == 2) {eje_3++;}  else if (obj[f].estado == 1) {prog_3++;}}
				if (obj[f].id_reporte == 4)  {total_4++; if (obj[f].estado == 2) {eje_4++;}  else if (obj[f].estado == 1) {prog_4++;}}
				if (obj[f].id_reporte == 5)  {total_5++; if (obj[f].estado == 2) {eje_5++;}  else if (obj[f].estado == 1) {prog_5++;}}
				if (obj[f].id_reporte == 6)  {total_6++; if (obj[f].estado == 2) {eje_6++;}  else if (obj[f].estado == 1) {prog_6++;}}
				if (obj[f].id_reporte == 7)  {total_7++; if (obj[f].estado == 2) {eje_7++;}  else if (obj[f].estado == 1) {prog_7++;}}
				if (obj[f].id_reporte == 8)  {total_8++; if (obj[f].estado == 2) {eje_8++;}  else if (obj[f].estado == 1) {prog_8++;}}
				if (obj[f].id_reporte == 9)  {total_9++; if (obj[f].estado == 2) {eje_9++;}  else if (obj[f].estado == 1) {prog_9++;}}
				if (obj[f].id_reporte == 10) {total_10++;if (obj[f].estado == 2) {eje_10++;} else if (obj[f].estado == 1) {prog_10++;}}
				if (obj[f].id_reporte == 11) {total_11++;if (obj[f].estado == 2) {eje_11++;} else if (obj[f].estado == 1) {prog_11++;}}
				if (obj[f].id_reporte == 12) {total_12++;if (obj[f].estado == 2) {eje_12++;} else if (obj[f].estado == 1) {prog_12++;}}
				if (obj[f].id_reporte == 13) {total_13++;if (obj[f].estado == 2) {eje_13++;} else if (obj[f].estado == 1) {prog_13++;}}
				if (obj[f].id_reporte == 14) {total_14++;if (obj[f].estado == 2) {eje_14++;} else if (obj[f].estado == 1) {prog_14++;}}
				if (obj[f].id_reporte == 15) {total_15++;if (obj[f].estado == 2) {eje_15++;} else if (obj[f].estado == 1) {prog_15++;}}
				
				// calculo el badge del boton
				if (num_dia == hoy.getDate() && obj[f].estado == 1) {
					cont_badge++;
				}
			}

			// Pinto cantidad del badge
			$('#hoyBadge').html(cont_badge);

			// calculo de porcentaje de las barra de tabla cron
			$('#tb_header').append('<th>Porcentaje</th>');
			$('#report_1').append(crono.getporcen(eje_1, total_1));
			$('#report_2').append(crono.getporcen(eje_2, total_2));
			$('#report_3').append(crono.getporcen(eje_3, total_3));
			$('#report_4').append(crono.getporcen(eje_4, total_4));
			$('#report_5').append(crono.getporcen(eje_5, total_5));
			$('#report_6').append(crono.getporcen(eje_6, total_6));
			$('#report_7').append(crono.getporcen(eje_7, total_7));
			$('#report_8').append(crono.getporcen(eje_8, total_8));
			$('#report_9').append(crono.getporcen(eje_9, total_9));
			$('#report_10').append(crono.getporcen(eje_10, total_10));
			$('#report_11').append(crono.getporcen(eje_11, total_11));
			$('#report_12').append(crono.getporcen(eje_12, total_12));
			$('#report_13').append(crono.getporcen(eje_13, total_13));
			$('#report_14').append(crono.getporcen(eje_14, total_14));
			$('#report_15').append(crono.getporcen(eje_15, total_15));

			// para calculo de menu sticky porcentages y cantidad
			var cant_total = (total_1) + (total_2) + (total_3) + (total_4) + (total_5) + (total_6) + (total_7) + (total_8) + (total_9) + (total_10) + (total_11) + (total_12) + (total_13) + (total_14) + (total_15);
			var cant_ejec = (eje_1) + (eje_2) + (eje_3) + (eje_4) + (eje_5) + (eje_6) + (eje_7) + (eje_8) + (eje_9) + (eje_10) + (eje_11) + (eje_12) + (eje_13) + (eje_14) + (eje_15);
			var cant_progr = (prog_1) + (prog_2) + (prog_3) + (prog_4) + (prog_5) + (prog_6) + (prog_7) + (prog_8) + (prog_9) + (prog_10) + (prog_11) + (prog_12) + (prog_13) + (prog_14) + (prog_15);
        	crono.llenarstiky(cant_total, cant_ejec, cant_progr);

        },


        // calculo y pinto menu sticky con porcentajes
        llenarstiky: function(total, ejec, prog){
            var porc_ejec = (ejec * 100) / total;
            var porc_prog = (prog * 100) / total;
            // cantidades
            $('#total_total').html('Total: ' + total);
            $('#cant_eje').html('Cantidad: ' + ejec);
            $('#cant_prog').html('Cantidad: ' + prog);
            // porcentages para barra
            $('#porc_eje').html(Math.round(porc_ejec, -1) + '%');
            $('#bar_eje').css('width', porc_ejec + '%');

            $('#porc_prog').html(Math.round(porc_prog, -1) + '%');
            $('#bar_prog').css('width', porc_prog + '%');




        },

        //retorna barras de progreso con porcentaje total
        getporcen: function(eje, total){
            var porEjecutadas = (eje * 100) / total;
            var barras = "";
            barras+= "<div class='containerfluid' style='position:absolute; width: 63px'>";
                barras+= "<div class='row'>";
                  barras+= "<div class='col-md-12'>";
                    barras+= "<div class='progress' style='height: 13px;'>";
                      barras+= "<div class='progress-bar progress-bar-ínfo progress-bar-striped active' role='progressbar' style='width: " + porEjecutadas + "%; '>";
                        barras+= "<div style='font-size: 10px; margin-top: -3px;'>" + Math.round(porEjecutadas, -1) + "%</div>";
                      barras+= "</div>";
                    barras+= "</div>";
                  barras+= "</div>";
                barras+= "</div>";
             barras+= "</div>";
            return barras;
        },
         
        //Al darle clic a actializar 
        onClickActualizar: function(){
            var aLink = $(this).attr("id");
            var href = $(this);
            var tdParent = href.parents('td').attr("id");// posicion
            swal({
				  title: "¿Desea actualizar este evento?",
				  text: "Una vez que se actualice, ¡no podrá recuperar el actual estado!",
				  icon: "warning",
				  buttons: true,
				  
				  dangerMode: true,
				  buttons: ["Cancelar!", "Actualizar!"],
			})
				.then((actualizar) => {
				  	if (actualizar) {
				  		crono.updateEvent(aLink, tdParent);
				   		swal("¡Genial! ¡Tu archivo ha sido actualizado!", {
				    		icon: "success",
				    	});
				 	} else {
				    swal("¡Cancelaste la actualización!",{
				    	icon: "error",
				    	dangerMode: true,
				    });
					}
				});
        },


        // Alerta solo puede editar eventos de hoy
        onClickAlert: function(){
            swal({
			  title: "Error!",
			  text: "Solo puedes editar eventos de hoy!",
			  icon: "error",
			  dangerMode: true,
			  // className: "red-bg",
			})
        },

        //actualizo a ejecutado el evento
        updateEvent: function(id, posicion){
            $.post(baseurl + "/Evaluador/c_updateCrono",
        		{
        			k_id_cronograma: id,
        			k_id_crono_estado: 2
        		},
        		function(data){
        			if (data.code == 1) {
        				$('#' + posicion).css("color", "green");
						$('#' + posicion).html("<i class='fa fa-fw fa-check'></i>");						
						setTimeout('document.location.reload()',1000);
        			}
        		}
    		);
        },








    };
    crono.init();
});