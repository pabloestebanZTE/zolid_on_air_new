<!-- Navigation -->
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo"><img id="logo" src="<?= URL::to('assets/img/logo2.png') ?>"/></a><br>
                <span style="color: white; margin-left: -4px;">ACS - On Air</span>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li class="cam"><a >Bienvenid@ <?php echo $_SESSION['userName'] ?></a> -->
                    </li>
                    <li class="cam"><a href="<?= URL::to('index.php/User/principalView') ?>">Home</a>
                    </li>
                    <li class="cam"><a href="#services">Servicios</a>
                        <ul>
                            <li><a href="#">Agendar Actividad</a></li>
                            <li><a href="#">Ver Actividades</a></li>
                            <li><a href="#">Ver</a></li>
                        </ul>
                    <li class="cam"><a href="#contact-sec">Contactos</a>
                    </li>
                    </li>
                    <li class="cam"><a href="<?= URL::to('User/logout') ?>" />Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--End Navigation -->
