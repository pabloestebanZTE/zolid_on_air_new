<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>ZOLID LOGIN</title>

        <!--   SWEET ALERT    -->
        <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css') ?>" />
        <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js') ?>"></script>

        <!--   JQUERY   -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <!--BOOTSTRAP-->
        <link rel="stylesheet" href="<?= URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') ?>"/>
        <script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap.min.js') ?>" /></script>
    <!--   ICONO PAGINA    -->
    <link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
    <!--   ANIMACION LOGIN    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <!--   CSS ESTILOS LOGIN    -->
    <link rel="stylesheet" href="<?= URL::to('assets/css/stylelogin.css?v=1.0') ?>">
    <!--   SCRIPT PROPIOS   -->
    <script type="text/javascript" charset="utf-8" async defer>
        //Funcion para mostrar mensaje de error de validacion de datos
        function showMessage() {
            swal({
                title: "Error de autentificación!",
                text: "Por favor verificar los datos",
                type: "error",
                confirmButtonText: "Ok"
            });
        }
    </script>
</head>
<body>
    <div id="warp">
        <br><br><br><br>
        <form id="formu" method="post">
            <div class="admin">
                <div class="rota">
                    <h1>ZOLID</h1>
                    <input id="username" class="form-control" type="text" name="username" value="" placeholder="Username" required/>
                    <input id="password" class="form-control" type="password" name="password" value="" placeholder="Password" required/>
<!--                    <input id="projectList" class="form-control" type="text" name="projectList" list="project" placeholder="seleccione su proyecto" required>
                    <datalist id="project">
                        <option value="Fonade" />
                        <option value="On-Air" />
                    </datalist>-->
                </div>
            </div>
            <div class="cms">
                <div class="roti">
                    <h1>ZTE</h1>
                    <button type="submit" class="button btn" id="valid" name="valid" onclick = "this.form.action = '<?= URL::to('User/loginUser') ?>'">Login</button><br />
                    <p><a href="#">ZTE</a> <a>And</a> <a href="#">ZTE Colombia</a></p>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (isset($error)) {
        echo '<script type="text/javascript">showMessage();</script>';
    }
    ?>
    <!--   ANIMACION DE LOGIN   -->
    <script src="<?= URL::to('assets/js/index.js?v=1.2') ?>"></script>
</body>
</html>
