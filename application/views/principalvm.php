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
            <div class="well">
                <a href="<?= URL::to("acs/acsview") ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Nueva ventana</a>
                <hr/>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <table id="tablaVm" class="table table-hover table-condensed table-striped" width='100%'></table>
                    </div>
                </div>
            </div>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>        
        <!-- CUSTOM SCRIPT   -->
        <?php $this->load->view('parts/generic/scripts'); ?>
        <script src="<?= URL::to("assets/js/modules/acs.js"); ?>" type = "text/javascript"></script>
    </body>
</html>
