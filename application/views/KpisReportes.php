<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-40">
            <div class="row">
                <h1>Metricas</h1>
                <div class="col col-md-12 m-t-40">
                    <div class="col col-md-6">
                        <a class="btn btn-primary btn-lg btn-block btnMetricas">KPIS ACS</a>
                    </div>
                    <div class="col col-md-6">
                        <a class="btn btn-primary btn-lg btn-block btnMetricas">KPI ON AIR</a>
                    </div>
                </div>
                <div class="col col-md-12 m-t-20">
                    <div class="col col-md-6">
                        <a class="btn btn-primary btn-lg btn-block btnMetricas">KPI CALIDAD</a>
                    </div>
                    <div class="col col-md-6">
                        <a class="btn btn-primary btn-lg btn-block btnMetricas" href="<?= URL::to('Evaluador/c_calendar') ?>">REPORTERIA</a>
                    </div>
                </div>
                <div class="col col-md-12 m-t-20">
                    <div class="col col-md-6">
                        <a class="btn btn-primary btn-lg btn-block btnMetricas" href="<?= URL::to('User/ticketSampling') ?>">AUDITORIAS ON AIR</a>
                    </div>
                    <div class="col col-md-6">
                        <a class="btn btn-primary btn-lg btn-block btnMetricas">PLANES DE MEJORA</a>
                    </div>
                </div>
            </div>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>        
        <!-- CUSTOM SCRIPT   -->
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
    </body>
</html>
