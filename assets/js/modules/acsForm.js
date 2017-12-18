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
    });
    
    $("input:checkbox[name=checklist1]").click(function () {
        var checkList = $("input:checkbox[name=checklist1]").length;
        var cheked = $("input:checkbox[name=checklist1]:checked").length;
        if (checkList === cheked) {
            $('#btnGenerarVm').attr("disabled", false);
        } else {
            $('#btnGenerarVm').attr("disabled", true);
        }       
    });
    
    $("input:checkbox[name=checklist2]").click(function () {
        var checkList = $("input:checkbox[name=checklist2]").length;
        var cheked = $("input:checkbox[name=checklist2]:checked").length;
        if (checkList === cheked) {
            $('#btnGenerarApertura').attr("disabled", false);
        } else {
            $('#btnGenerarApertura').attr("disabled", true);
        }       
    });

});
