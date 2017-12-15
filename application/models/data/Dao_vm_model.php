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
    
    public function updateVm($request){
          try {
            $vm = new VmModel();
            $datos = $vm->where("k_id_vm","=",$request->k_id_vm)
                          ->update($request->all());
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
          } catch (ZolidException $ex) {
            return $ex;
          }
        }

}

?>
