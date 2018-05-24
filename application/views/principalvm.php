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
            <?php
            if (Auth::isCoordinador()) {
                $this->load->view('parts/principalVm/coordinadorVm');
            }
            if (Auth::isDocumentador() || Auth::isIngeniero()) {
                $this->load->view('parts/principalVm/ingenieroVM');
            }
            ?>
        </div>

        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <!-- CUSTOM SCRIPT   -->
        <?php $this->load->view('parts/generic/scripts'); ?>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script>
        $(function () {
            var info = <?php echo $usuarios; ?>;
//            console.log(info);
            dom.llenarCombo($('.select-ingeniero'),info.users.data, {text:"n_name_user", value:"k_id_user"});
        });
        </script>
    </body>
</html>
