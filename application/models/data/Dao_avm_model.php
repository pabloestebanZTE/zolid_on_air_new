<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_avm_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/AvmModel');
    }

    public function insertAvm($request) {
        try {
            $avm = new AvmModel();
            $datos = $avm->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }
    
    public function toAssignEngineer($k_id_avm, $ingeniero) {
        try {
            $avm = new AvmModel();
            $datos = $avm->where("k_id_avm", "=", $k_id_avm)
                    ->update([
                "i_ingeniero_asignado" => $ingeniero
            ]);
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
