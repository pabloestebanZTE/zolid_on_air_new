<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_station_model');
        $this->load->model('data/Dao_band_model');
        $this->load->model('data/Dao_work_model');
        $this->load->model('data/Dao_technology_model');
        $this->load->model('data/Dao_user_model');
        $this->load->model('data/Dao_vm_model');
        $this->load->model('data/Dao_avm_model');
        $this->load->model('data/Dao_cvm_model');
    }

    public function principal() {
        $users = new Dao_user_model();
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $res['users'] = $users->getAllEngineers();
        $answer['usuarios'] = json_encode($res);
        $this->load->view('principalvm', $answer);
    }

    public function vmAcs() {
        $station = new Dao_station_model();
        $band = new Dao_band_model();
        $work = new Dao_work_model();
        $technology = new Dao_technology_model();
        $users = new Dao_user_model();
        $crq = new Dao_preparationStage_model();

        $dataForm = null;
        if ($this->request->id) {
            $vmModel = new VmModel();
            $vm = $vmModel->where("k_id_vm", "=", $this->request->id)->first();
            if ($vm) {
                $avmModel = new AvmModel();
                $cvmModel = new CvmModel();
                $tiketRemedyModel = new TiketRemedyModel();
                $avm = $avmModel->where("k_id_vm", "=", $this->request->id)->first();
                $cvm = $cvmModel->where("k_id_vm", "=", $this->request->id)->first();
                $tiketRemedy = $tiketRemedyModel->where("k_id_vm", "=", $this->request->id)
                        ->orderBy("k_id_tiket_remedy", "desc")
                        ->first();
                //Consultamos si se ha exedido el tiempo límite de desarrollo de el acs...
                $kpiModel = new KpiAcsModel();
                $db = new DB();
                $kpis = $db->select('SELECT * FROM kpi_acs WHERE k_id_vm = ' . $this->request->id . ' AND (n_type = "CREATION_VM" OR n_type = "CREATION_CVM") ORDER BY `n_type` desc')->get();
                $exeded = false;
                if (count($kpis) == 1) {
                    $kpi = $kpis[0]; //VM

                    $todayDay = date("d", Hash::getTime());
                    $kpiDay = date("d", Hash::getTimeStamp($kpi->d_create_at) / 1000);

                    $todayMonth = date("m", Hash::getTime());
                    $kpiMonth = date("m", Hash::getTimeStamp($kpi->d_create_at) / 1000);

                    $todayYear = date("y", Hash::getTime());
                    $kpiYear = date("y", Hash::getTimeStamp($kpi->d_create_at) / 1000);
                    $today = $todayYear + $todayMonth + $todayDay;
                    $dRecord = $kpiYear + $kpiMonth + $kpiDay;
                    $exeded = ($today - $dRecord) != 0;
                }
                $dataForm = [
                    "vm" => $vm,
                    "avm" => $avm,
                    "cvm" => $cvm,
                    "tiketRemedy" => $tiketRemedy,
                    "exeded_time" => $exeded
                ];
            }
        }

        $res['stations'] = $station->getAll();
        $res['bands'] = $band->getAll();
        $res['works'] = $work->getAll();
        $res['technologies'] = $technology->getAll();
        $res['users'] = $users->getAllEngineers();
        $res['crq'] = $crq->getAllCRQ();
        //var_dump($dataForm);

        if ($dataForm) {
            $res['record'] = $dataForm;
        }

        $this->load->view('acsView', ["respuesta" => json_encode($res)]);
    }

    /** Realiza la inserción completa de todo el formulario que se muestra en vmAcs,
      *teniendo en cuenta todas las reglas y demás cosas necesarias...
     */
    public function insertAcs() {
        $dao = new Dao_acs_model();
        $response = $dao->insertAcs($this->request);
        $this->json($response);
    }

    /** Realiza la actualización completa del todo el formulariuo que se muestra en aAcs. */
    public function updateAcs() {
        $dao = new Dao_acs_model();
        $response = $dao->updateAcs($this->request);
        $this->json($response);
    }

    public function insertVmAcs() {
        $vm = new Dao_vm_model();
        $response = $vm->insertVm($this->request);
        $this->json($response);
    }

    public function insertAvmAcs() {
        $vm = new Dao_vm_model();
        $avm = new Dao_avm_model();
        $response = $vm->updateVm($this->request);
        $response = $avm->insertAvm($this->request);
        $this->json($response);
    }

    public function insertCheckPointAcs() {
        $vm = new Dao_vm_model();
        $response = $vm->updateVm($this->request);
        $this->json($response);
    }

    public function insertCvmAcs() {
        $vm = new Dao_vm_model();
        $cvm = new Dao_cvm_model();
        $response = $vm->updateVm($this->request);
        $response = $cvm->insertCvm($this->request);
        $this->json($response);
    }

    public function getALLVm() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }

        $response = null;
        if (Auth::check()) {
            $vm = new Dao_vm_model();
            $res = $vm->getAllVm();

        $rtr = new Dao_tiket_remedy_model();
        $res2 = $rtr->getAllTiketRemedy();
        $res->data['remedy'] = $res2->data;


            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function toAssign() {
        $vm = new Dao_vm_model();
        if ($this->request->i_ingeniero_asignado_avm != null) {
            $response = $vm->toAssignEngineerStage($this->request->k_id_vm, $this->request->i_ingeniero_asignado_avm, "i_ingeniero_apertura");
        }
        if ($this->request->i_ingeniero_asignado_pvm != null) {
            $response = $vm->toAssignEngineerStage($this->request->k_id_vm, $this->request->i_ingeniero_asignado_pvm, "i_ingeniero_punto_control");
        }
        if ($this->request->i_ingeniero_asignado_cvm != null) {
            $response = $vm->toAssignEngineerStage($this->request->k_id_vm, $this->request->i_ingeniero_asignado_cvm, "i_ingeniero_cierre");
        }
        $this->json($response);
    }

    public function getVmAssigned() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }

        $response = null;
        if (Auth::check()) {
            $vm = new Dao_vm_model();
            $res = $vm->getVmAssigned();
            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function insertTiketRemedy() {
        $tr = new Dao_tiket_remedy_model();
        $response = $tr->insertTiketRemedy($this->request);
        $this->json($response);
    }

    public function getAllPersonAutocomplete() {
        $avmModel = new Dao_avm_model();
        $response = $avmModel->getAllPersonAutocomplete($this->request);
        $this->json($response);
    }

}
