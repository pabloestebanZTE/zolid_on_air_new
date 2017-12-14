$(function () {
    vista = {
        init: function () {
            vista.events();
            stadistics = JSON.parse(stadistics);
            vista.createChar('26,179,148', 'lineChart', stadistics.all);
            vista.createChar('129,12,232', 'lineChart2', stadistics.precheck);
            vista.createChar('255,83,13', 'lineChart3', stadistics.postcheck);
            vista.getUsers();
        },
        events: function () {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });
        },
        getUsers: function () {
            app.post('Evaluador/getUsers').success(function (response) {
                var data = app.parseResponse(response);
                console.log(data);
                if (data) {
                    vista.listUsers(data);
                } else {
                    vista.listUsers([]);
                }
            }).error(function (e) {
                swal("Error", "Se ha producido un error inesperado y no se han podido listar los usuarios.", "error");
            }).send();
        },
        getButtons: function (obj) {
            return '<div class="btn-group">'
                    + '<a class="btn btn-xs btn-default" href="' + app.urlTo('Evaluador/evaluacionPorUsuario?id=' + obj.k_id_user) + '"><i class="fa fa-fw fa-eye"></i></a>'
                    + '<button class="btn btn-xs btn-default"><i class="fa fa-fw fa-list"></i></button>'
                    + '</div>';
        },
        getNameUser: function (obj) {
            return obj.n_name_user + ' ' + obj.n_last_name_user;
        },
        listUsers: function (data) {
            vista.tablaUsuarios = $('#tablaUsuarios').DataTable(dom.configTable(data,
                    [
                        {title: "Nit", data: 'k_id_user'},
                        {title: "Cod. Usuario", data: "n_code_user"},
                        {title: "Nombre", data: vista.getNameUser},
                        {title: "Rol", data: 'n_role_user'},
                        {title: "Opciones", data: vista.getButtons},
                    ]
                    ));
        },
        createChar: function (color, idChar, data, borderCustomOpacity) {
            var dataValues = [], dataValues2 = [];
            //Recorremos los objetos...
            if (data.onTime || data.overTime) {
                for (var key in data.onTime) {
                    dataValues.push(data.onTime[key]);
                    dataValues2.push(data.overTime[key]);
                }
            }
            if (!borderCustomOpacity) {
                borderCustomOpacity = ',0.7)';
            } else {
                borderCustomOpacity = ',' + borderCustomOpacity + ')';
            }
            var lineData = {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                datasets: [

                    {
                        label: "Ejecutadas a tiempo",
                        backgroundColor: 'rgba(' + color + ',0.5)',
                        borderColor: 'rgba(' + color + borderCustomOpacity,
                        pointBackgroundColor: 'rgba(' + color + ',1)',
                        pointBorderColor: "#fff",
                        data: dataValues
//                        data: [28, 48, 40, 19, 86, 27, 90, 60, 23, 44, 55, 22]
                    }, {
                        label: "No ejecutadas a tiempo",
                        backgroundColor: 'rgba(220, 220, 220, 0.5)',
                        pointBorderColor: "#fff",
                        data: dataValues2
//                        data: [65, 59, 80, 81, 56, 55, 40, 23, 44, 55, 76, 23]
                    }
                ]
            };
            var lineOptions = {
                responsive: true
            };
            var ctx1 = document.getElementById(idChar).getContext("2d");
            new Chart(ctx1, {
                type: 'line', data: lineData, options: lineOptions});
        }
    };
    vista.init();
});