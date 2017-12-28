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
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $this->load->view('principalvm');
    }

    public function acsview($answer) {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $this->load->view('acsView', $answer);
    }
    
    public function createVmAcs() {
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $users = new Dao_user_model();

        $res['stations'] = $station->getAll();
        $res['bands'] = $band->getAll();
        $res['works'] = $work->getAll();
        $res['technologies'] = $technology->getAll();
        $res['users'] = $users->getAllEngineers();
        
        
        $answer['respuesta'] = json_encode($res);
        $this->acsview($answer);
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
            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

}