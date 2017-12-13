var contControles = 0;
var contCausas = 0;
$(document).ready(function () {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        if($(this).attr("id") === 'contentAll'){
            $("div.bhoechie-tab>div.bhoechie-tab-content").addClass("active");
//            $("button").css("display","none");
        }
    });
});

function AgregarControles() {
    contControles++;
    campos = '<div class="form-inline form-group" id="contenedorControles' + contControles + '">'
            +     '<label for="cmbControles" class="col-sm-2 control-label">Control</label>'
            +     '<div class="col-sm-10">'
            +         '<select class="form-control m-r-5" id="cmbControles" name="cmbControles[]" style="width: 87%;">'
            +               '<option value="">Seleccione</option>'
            +         '</select>'
            +         '<button type="button" class="btn btn-success m-r-5" onclick="AgregarCampos()"><i class="fa fa-plus" aria-hidden="true"></i></button>'
            +         '<button type="button" class="btn btn-danger" onclick="eliminarControles(' + contControles + ');"><i class="fa fa-minus" aria-hidden="true"></i></button>'
            +     '</div>' 
            + '</div>';
    $("#contenedorControles").append(campos);
}

function eliminarControles(idControl) {
    $("#contenedorControles" + idControl).remove();
}

function AgregarCausas() {
    contCausas++;
    campos = '<div class="form-inline form-group" id="contenedorCausas' + contCausas + '">'
            +     '<label for="cmbControles" class="col-sm-2 control-label">Causa</label>'
            +     '<div class="col-sm-10">'
            +         '<input type="text" class="form-control m-r-5" id="txtCausa" name="txtCausa[]" style="width: 87%;">'
            +         '<button type="button" class="btn btn-success m-r-5" onclick="AgregarCausas()"><i class="fa fa-plus" aria-hidden="true"></i></button>'
            +         '<button type="button" class="btn btn-danger" onclick="eliminarCausas(' + contCausas + ');"><i class="fa fa-minus" aria-hidden="true"></i></button>'
            +     '</div>' 
            + '</div>';
    $("#contenedorCausas").append(campos);
}

function eliminarCausas(idCausa) {
    $("#contenedorCausas" + idCausa).remove();
}

function cambiarSoporteImpacto() {
    var soporteProbabilidad = $('#cmbSoporteProbabilidad').val();
    var option = '';
    if (soporteProbabilidad === '1') {
        option = '<option value="">Seleccione</option>'
                + '<option value="">CONTROL: La estructura de control es adecuada</option>'
                + '<option value="">OPERACIONAL: No hay interrupción de las operaciones</option>'
                + '<option value="">CUMPLIMIENTO: No genera sanciones económicas y/o administrativas</option>'
                + '<option value="">REPUTACIONAL: No afecta las relaciones con los clientes</option>'
                + '<option value="">INFORMACIÓN: No afecta la oportunidad de la información</option>';
    }
    if (soporteProbabilidad === '2') {
        option = '<option value="">Seleccione</option>'
                + '<option value="">CONTROL: La estructura de control actual es susceptible de mejoras</option>'
                + '<option value="">OPERACIONAL: Interrupción de las operaciones por 1 hora</option>'
                + '<option value="">REPUTACIONAL: Existen algunos reclamaciones por parte de los clientes, accionistas, proveedores pero no se afecta la continuidad de la relación</option>';
    }
    if (soporteProbabilidad === '3') {
        option = '<option value="">Seleccione</option>'
                + '<option value="">CONTROL: Existen algunos controles pero no son los suficientes.</option>'
                + '<option value="">OPERACIONAL: Interrupción de las operaciones de 2 a 4 horas</option>'
                + '<option value="">REPUTACIONAL: Reclamaciones de clientes, accionistas, proveedores que requieren de un plan de acción de corto plazo</option>'
                + '<option value="">OPERACIONAL: Reproceso de actividades y aumento de la carga operativa</option>';
    }
    if (soporteProbabilidad === '4') {
        option = '<option value="">Seleccione</option>'
                + '<option value="">CONTROL: Estructura de control débil</option>'
                + '<option value="">OPERACIONAL: Interrupción de las operaciones de 4 a 6 horas</option>'
                + '<option value="">CUMPLIMIENTO: Observaciones por incumplimiento de las normas establecidas por los entes reguladores que generen un plan de acción a corto plazo</option>'
                + '<option value="">REPUTACIONAL: Afectación de la imagen en el mercado por atención ineficaz o inoportuna</option>'
                + '<option value="">INFORMACIÓN: Inoportunidad de la información ocasionando retrasos en las labores de las áreas, respuesta a los entes reguladores y a los clientes</option>';
    }
    if (soporteProbabilidad === '5') {
        option = '<option value="">Seleccione</option>'
                + '<option value="">CONTROL: No existe estructura de control</option>'
                + '<option value="">OPERACIONAL: Interrupción de las operaciones por más de 6 horas.</option>'
                + '<option value="">CUMPLIMIENTO:Sanciones económicas por incumplimiento de las normas establecidas por los entes reguladores</option>'
                + '<option value="">REPUTACIONAL: Imagen negativa en el mercado por mal servicio</option>'
                + '<option value="">INFORMACIÓN: Perdida de información crítica de la organización</option>';
    }
    
    $('#cmbSoporteImpacto1').empty();
    $('#cmbSoporteImpacto2').empty();
    $('#cmbSoporteImpacto1').append(option);
    $('#cmbSoporteImpacto2').append(option);
}