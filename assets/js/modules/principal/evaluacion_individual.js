$(function () {
    var vista = {
        init: function () {
            vista.events();
            stadistics = JSON.parse(stadistics);
            vista.createChar('39,127,230', 'lineChart0', stadistics.today, 'horizontalBar');
            vista.createChar('26,179,148', 'lineChart', stadistics.all);
            vista.createChar('129,12,232', 'lineChart2', stadistics.precheck);
            vista.createChar('255,83,13', 'lineChart3', stadistics.postcheck);
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
        createChar: function (color, idChar, data, type, borderCustomOpacity) {
            var dataValues = [], dataValues2 = [];
            //Recorremos los objetos...
            if (data.onTime || data.overTime) {
                if (type == "horizontalBar") {
                    dataValues.push(data.onTime);
                    dataValues2.push(data.overTime);
                } else {
                    for (var key in data.onTime) {
                        dataValues.push(data.onTime[key]);
                        dataValues2.push(data.overTime[key]);
                    }
                }
            }
            if (!borderCustomOpacity) {
                borderCustomOpacity = ',0.7)';
            } else {
                borderCustomOpacity = ',' + borderCustomOpacity + ')';
            }
            var labels = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            if (type == 'horizontalBar') {
                labels = ["Hoy"];
                if (dataValues.length == 1 && dataValues[0] == 0) {
                    dataValues = [];
                    console.log("ASDFASDF");
                }
                if (dataValues2.length == 1 && dataValues2[0] == 0) {
                    console.log("ASDFASDF");
                    dataValues2 = [];
                }
            }
            var lineData = {
                labels: labels,
                datasets: [
                    {
                        label: "Ejecutadas a tiempo",
                        backgroundColor: 'rgba(' + color + ',0.5)',
                        borderColor: 'rgba(' + color + borderCustomOpacity,
                        pointBackgroundColor: 'rgba(' + color + ',1)',
                        pointBorderColor: "#fff",
                        data: dataValues
                    }, {
                        label: "No ejecutadas a tiempo",
                        backgroundColor: 'rgba(220, 220, 220, 0.5)',
                        pointBorderColor: "#fff",
                        data: dataValues2
                    }
                ]
            };


            var lineOptions = {
                responsive: true
            };

            if (type == "horizontalBar" && (dataValues.length > 0 || dataValues2.length > 0)) {
                console.log(lineData);
                lineOptions.scales = {
                    xAxes: [{
                            ticks: {
                                min: 0 // Edit the value according to what you need
                            }
                        }]
                };
            }
            if (!type) {
                type = 'line';
            }
            var ctx1 = document.getElementById(idChar).getContext("2d");
            new Chart(ctx1, {
                type: type, data: lineData, options: lineOptions});
        }
    };
    vista.init();
});