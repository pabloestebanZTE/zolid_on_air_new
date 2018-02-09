<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <label id="lblProgressInformation" class="hidden">0 de 0</label>
            <div class="progress hidden" id="progressProcessImportData">
                <div class="progress-bar progress-bar-striped active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    0%
                </div>
            </div>
            <?php
            if (Auth::isCoordinador()) {
                $this->load->view('parts/principal/coordinador');
            }
            if (Auth::isDocumentador()) {
                $this->load->view('parts/principal/documentador');
            }
            if (Auth::isIngeniero()) {
                $this->load->view('parts/principal/ingeniero');
            }
            //::Evaluador
            if (Auth::isEvaluador()) {
                $this->load->view('parts/principal/evaluador', ["stadistics" => $stadistics]);
            }
            ?>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>        
        <!-- CUSTOM SCRIPT   -->
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
    </body>
</html>
