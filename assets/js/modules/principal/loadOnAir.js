/* 
 * @author = John Vanegas
 */

var load = {
    init: function () {
        load.events();
    },
    events: function () {
        $('#btnLoadOnAir').on('click', load.loadFile);
    },
    loadFile: function () {
        inputFile = document.createElement('input');
        inputFile.type = 'file';
        inputFile.name = 'file[]';
        $(inputFile).on('change', load.onChangeFile);
        $(inputFile).trigger('click');

    },
    onChangeFile: function (e) {
        var input = e.target;
        load.uploadFile(input);
    },
    uploadFile: function (input) {
        $('body').attr('onbeforeunload', "event.returnValue = 'Si cierras la ventana no se guardaran los cambios.'");
        $('#btnLoadOnAir').prop('disabled', true).html('<i class="fa fa-fw fa-refresh fa-spin"></i> Subiendo <span id="progressLoadSpan">(0%)</span>');
        app.uploadFile("Utils/uploadfile", input, ["xlsx"])
                .progress(function (progress) {
                    $('#progressLoadSpan').html('(' + Math.floor(progress) + '%)');
                })
                .complete(function (response) {
                    $('#btnLoadOnAir').prop('disabled', true).html('<i class="fa fa-fw fa-check"></i> Cargado.</span>');
                    if (response.code > 0 && response.data.uploaded) {
                        swal("Correcto", "Se ha subido correctamente el archivo, haga clic a continuación el el botón ok para iniciar la lectura y carga del OnAir que acaba de subir en el sistema.", "success").then(function () {
                            load.processData(response.data);
                        });
                    } else {
                        swal("Error", "Lo sentimos, no se pudo subir el archivo, recuerde que el tamaño máximo permitido es de 100MB", "error");
                    }
                })
                .errorExtension(function (file) {
                    swal("Error", "Extención de archivo no permitida, solo se permiten archivos de extención XLSX y XLS", "error");
                })
                .start();
    },
    processData: function (data) {
        var alert = dom.printAlert('Cargando datos del OnAir en el sistema, por favor no cierre esta ventana.', 'loading', $('#principalAlert'));
        app.post('Utils/processData', {
            file: data.path
        })
                .complete(function () {
                    alert.hide();
                    $('body').removeAttr('onbeforeunload');
                    $('#btnLoadOnAir').html('<i class="fa fa-fw fa-paperclip"></i> Cargar OnAir').prop('disabled', false);
                })
                .success(function (response) {
                    var v = app.validResponse(response);
                    if (v) {
                        swal("Importado", "Se ha importado toda la información del OnAir correctamente.", "success");
                    } else {
                        swal("Error", "Lo sentimos, no se pudo procesar el OnAir que ha subido.", "error");
                    }
                })
                .error(function (e) {
                    swal("Error", "Lo sentimos se ha producido un error inesperado al procesar el OnAir que ha subido.", "error");
                })
                .send();
    }
};
$(load.init);
