vista = {
    init: function () {
        vista.events();
        vista.fillTable([]);
    },
    events: function () {

    },
    temp: function () {
        return "N/A";
    },
    fillTable: function (data) {
        vista.tablaVm = $('#tablaVm').DataTable(dom.configTable([1, 2, 3, 4, 5],
                [
                    {title: "Id ZTE", data: vista.temp},
                    {title: "Site Acces", data: vista.temp},
                    {title: "General", data: vista.temp},
                    {title: "Estado", data: vista.temp},
                    {title: "SubEstado", data: vista.temp},
                    {title: "Est. Notificación", data: vista.temp},
                    {title: "Tipo Falla Final", data: vista.temp},
                    {title: "Ing. Crea Grupo", data: vista.temp},
                    {title: "Ing. Apertura", data: vista.temp},
                    {title: "Ing. Punto Control", data: vista.temp},
                    {title: "Ing. Cierre", data: vista.temp},
                    {title: "VM hoy", data: vista.temp},
                ]));
    },
};
$(function () {
    vista.init();
});