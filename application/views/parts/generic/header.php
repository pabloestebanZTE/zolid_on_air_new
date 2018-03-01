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
                <a class="logo" href="<?= URL::to('index.php/User/principalView') ?>">
                    <img id="logo" src="<?= URL::to('assets/img/logo2.png') ?>"/>
                </a><br>
                <span style="color: white; margin-left: -4px;">ACS - On Air</span>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div>
                            <div id="divImg"><img id="imgRol" src="<?= URL::to('assets/img/' . Auth::user()->k_id_user . '.png') ?>"/></div>
                            <div id="infoUsu">
                                <span>
                                    <?php echo Auth::user()->n_name_user . ' ' . Auth::user()->n_last_name_user; ?><br>
                                    <?php echo Auth::getRole(); ?>
                                </span>
                            </div>
                        </div>
                        <ul class="m-t-20">
                            <li>
                                <a href="<?= URL::to('index.php/User/principalView') ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Home</a>
                            </li>
                            <li>
                                <a href="<?= URL::to('Acs/principal') ?>"><i class="fa fa-fw fa-tags"></i>&nbsp;&nbsp;Acs</a>
                            </li>

                            <li>
                                <?php
                                if (Auth::getRole() == 'COORDINADOR') {
                                   echo  " <a href=". URL::to('Reportes/reportComments')."/><i class='glyphicon glyphicon-export'></i>&nbsp;&nbsp;exportar Reporte Comentarios</a>";
                                   echo  " <a href=". URL::to('reportes/reportOnair')."/><i class='glyphicon glyphicon-export'></i>&nbsp;&nbsp;exportar Reporte ONAIR</a>";
                                  }
                                ?>
                            </li>
                            <li>
                                <a id="exitLink" href="<?= URL::to('User/logout') ?>" /><i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp;Salir</a>
                            </li>
                        </ul>
                    </li>
<!--                    <li class="cam"><a href="<?= URL::to('index.php/User/principalView') ?>">Home</a>
                    </li>
                    <li class="cam"><a href="#services">Servicios</a>
                        <ul>
                            <li><a href="#">Agendar Actividad</a></li>
                            <li><a href="#">Ver Actividades</a></li>
                            <li><a href="#">Ver</a></li>
                        </ul>
                    </li>
                    <li class="cam"><a href="#contact-sec">Contactos</a>
                    </li>
                    </li>
                    <li class="cam"><a href="<?= URL::to('User/logout') ?>" />Salir</a>
                    </li>-->
                </ul>
            </div>
        </div>
    </nav>
</header>
<br>
<!--End Navigation -->
