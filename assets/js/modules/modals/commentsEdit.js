////////////////////////////////////////////////////////////////////////////////////////////////////////
/********************este metodo para llenar datatables es para usarlo directo, sin server side progresing********************/
////////////////////////////////////////////////////////////////////////////////////////////////////////

//funcion Autodeclarable
$(function () {
    comment = {
        baseurl: $('body').attr('data-base'),   
        init: function () {
            //inicializamos las funciones
            comment.events();
        },

        //Eventos de la ventana.
        events: function () {
            //Al darle clic a una fila llama la funcion onClickTrtable_comments
            $('#table_comments').on('click', 'tr', comment.onClickTrtable_comments);

             // Se dispara esta funcion cuando se cierra el mnoldal
            $('#modalEditComment').on('hidden.bs.modal', function (e) {
             


          })
            // al darle clic al boton actualizar del modal
            $('#mbtnUpdComentario').on('click', comment.onClickBotonActualizar); 



        },
        // Capturo los valores de la fila a la que le doy clic
        onClickTrtable_comments: function(){
          var registro = [];
          var fila = $(this);
        
            // if (comment.table_comments) {
               registro['idonair'] = $('#k_id_onair').val();
               registro['idtr'] = $(this).attr("id");
               registro['estacion'] = fila.find('td').eq(0).html();
               registro['tecn'] = fila.find('td').eq(1).html();
               registro['banda'] = fila.find('td').eq(2).html();
               registro['tipo'] = fila.find('td').eq(3).html();
               registro['estado'] = fila.find('td').eq(4).html();
               registro['comentario'] = fila.find('td').eq(5).html();
               registro['actualizacion'] = fila.find('td').eq(6).html();
               registro['usuario'] = fila.find('td').eq(7).html();
               registro['ejecutor'] = fila.find('td').eq(8).html();
               registro['tipificacion'] = fila.find('td').eq(9).html();
               registro['noc'] = fila.find('td').eq(10).html();

                // if (registro != undefined) {
                  comment.modalEditar(registro);   
                // }
            // }
            
        },
        //llama el modal
        modalEditar: function(registro){
          // console.log(registro);
          //mostrar modal
          $('#modalEditComment').modal('show');

          $ ('#modalTitle').html('Editar Comentario del ticket &nbsp;&nbsp;&nbsp;&nbsp;<b>N°' + registro['idonair'] +'</b>');

          // $('#estacion_modal option:contains("'+registro['estacion']+'")').attr('selected','selected');
          $('#select2-estacion_modal-container').html(registro['estacion']);
          // $('#select2-estacion_modal-container').css('max-width', '167px');
          // $('#select2-estacion_modal-container').css('min-width', '167px');
          
          $('#select2-mdl_n_enteejecutor-container').html(registro['ejecutor']);
          $('#select2-modalTecnologia-container').html(registro['tecn']);
          $('#select2-modalBanda-container').html(registro['banda']);
          $('#select2-modalTipotrabajo-container').html(registro['tipo']);
          $('#select2-mdl_n_noc-container').html(registro['noc']);
          $('#select2-mtxtUserCom-container').html(registro['usuario']);

          $('#mdl_n_estado_eb_resucomen').val(registro['estado']);
          $('#tipificacion_resucomen').val(registro['tipificacion']);

          $('#mdl_comentario_resucoment').html(registro['comentario']);

          // para fecha
          registro['actualizacion'] = registro['actualizacion'].replace(" ", "T");
          var dateControl = $('#mdl_d_ingreso_on_air');
          dateControl.val(registro['actualizacion']);

          $('#id_comentario').val(registro['idtr']);
          
        },






        onClickBotonActualizar: function(){

          var idtr = $('#id_comentario').val();
          var estacion = $('#select2-estacion_modal-container').html();
          var tecn = $('#select2-modalTecnologia-container').html();
          var banda = $('#select2-modalBanda-container').html();
          var tipo = $('#select2-modalTipotrabajo-container').html();
          var estado = $('#mdl_n_estado_eb_resucomen').val();
          var comentario = $('#mdl_comentario_resucoment').val();
          var actualizacion = $('#mdl_d_ingreso_on_air').val();
          var usuario = $('#select2-mtxtUserCom-container').html();
          var ejecutor = $('#select2-mdl_n_enteejecutor-container').html();
          var tipificacion = $('#tipificacion_resucomen').val();
          var noc = $('#select2-n_noc-container').html();



          /***************Envio los datos obtenidos por ajax al controlador para actualizar***************/
          // Ruta del controlador y funcion donde enviamos la peticion
          $.post(comment.baseurl+"/User/updateComments", 
            //parametros que vamos a enviar por POST
             {

                k_id_primary : idtr,
                n_nombre_estacion_eb : estacion,
                n_tecnologia : tecn,
                n_banda : banda,
                n_tipo_trabajo : tipo,
                n_estado_eb_resucomen : estado,
                comentario_resucoment : comentario,
                hora_actualizacion_resucomen : actualizacion,
                usuario_resucomen : usuario,
                ente_ejecutor : ejecutor,
                tipificacion_resucomen : tipificacion,
                noc : noc

             },
              //callback, metodo que va a recibir la respuesta del controlador   
              function(data){
                var res = JSON.parse(data);
                var body = "";
                var image = "";
                var title = "";
                if (res == "ok") {
                      title = 'El comentario Seleccionado';
                      body = 'fue actualizado exitosamente!';
                      image = 'logoblue.png';
                      location.reload();


                }else{
                    body = 'NO PUDO ACTUALIZARSE!';
                    image = 'error.png';
                    console.log(data);

                }

                  comment.pushMessage(title, body, image);
                  
              }

          );
        },

        
        //funcion para mostrar mensaje 
        pushMessage: function(title, body, image){
           Push.create( title, {
                      body: body,
                      icon: comment.baseurl + '/assets/img/' + image,
                      timeout: 4000,
                      onClick: function () {
                          window.focus();
                          this.close();
                      }
           });

        },
       

    };

    comment.init();
});
