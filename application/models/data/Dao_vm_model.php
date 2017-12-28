<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_vm_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/VmModel');
    }

    public function insertVm($request) {
        try {
            $vm = new VmModel();
            $datos = $vm->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function updateVm($request) {
        try {
            $vm = new VmModel();
            $datos = $vm->where("k_id_vm", "=", $request->k_id_vm)
                    ->update($request->all());
//            echo $vm->getSQL();
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }
    
    public function getAll() {
        try {
            $vm = new VmModel();
            $datos = $vm->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }
    
    public function getAllVm() {
        try {
            $db = new DB();
            $datos = $db->select("SELECT vm.*, us1.n_name_user ingeniero_creador_grupo, us2.n_name_user ingeniero_control, 
                                    us3.n_name_user ingeniero_apertura, us4.n_name_user ingeniero_cierre, cvm.n_sub_estado, cvm.n_falla_final,
                                    st.n_name_station, tg.n_name_technology, bn.n_name_band, wk.n_name_ork
                                FROM vm
                                INNER JOIN station st ON st.k_id_station = vm.k_id_station
                                INNER JOIN technology tg ON tg.k_id_technology = vm.k_id_technology
                                INNER JOIN band bn ON bn.k_id_band = vm.k_id_band
                                INNER JOIN work wk ON wk.k_id_work = vm.k_id_work
                                LEFT JOIN avm ON avm.k_id_vm = vm.k_id_vm
                                LEFT JOIN cvm ON cvm.k_id_vm = vm.k_id_vm
                                LEFT JOIN user us1 ON us1.k_id_user = vm.i_ingeniero_creador_grupo 
                                LEFT JOIN user us2 ON us2.k_id_user = vm.i_ingeniero_control
                                LEFT JOIN user us3 ON us3.k_id_user = avm.i_ingeniero_apertura
                                LEFT JOIN user us4 ON us4.k_id_user = cvm.i_ingeniero_cierre")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
