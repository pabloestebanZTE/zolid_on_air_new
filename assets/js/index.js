$(function () {
    $("#valid").click(function () {
        var username = document.getElementById("username").value;
        var pass = document.getElementById("password").value;
        if (username != "" && pass != "") {
            $(".admin").addClass("up").delay(100).fadeOut(100);
            $(".cms").addClass("down").delay(150).fadeOut(100);
        }
    });

    var keyPrev = null;
    window.addEventListener('keydown', function (e) {
        console.log(e);
        var isKey = function (e, code) {
            return e.which == code || e.keyCode == code;
        };
        if (keyPrev == 17) { //Tecla Shit.
            if (isKey(e, 68)) {//C = Documentador...
                $('[name="username"]').val("rlflores");
                $('[name="password"]').val("abc123");
//                $('[name="projectList"]').val("On Air");
                $('#formu button[type="submit"]').click();
            } else if (isKey(e, 67)) {//D = Coordinador...
                $('[name="username"]').val("jebermudezr");
                $('[name="password"]').val("abc123");
//                $('[name="projectList"]').val("On Air");
                $('#formu button[type="submit"]').click();
            } else if (isKey(e, 66)) {//E = Evaluador...
                $('[name="username"]').val("admin");
                $('[name="password"]').val("abc123");
//                $('[name="projectList"]').val("On Air");
                $('#formu button[type="submit"]').click();
            } else if (isKey(e, 73)) {//I = Ingeniero...
                $('[name="username"]').val("wmamador");
                $('[name="password"]').val("abc123");
//                $('[name="projectList"]').val("On Air");
                $('#formu button[type="submit"]').click();
            }
        }
        keyPrev = (e.which) ? e.which : e.keyCode;
    });
});
