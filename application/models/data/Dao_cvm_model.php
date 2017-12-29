<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_cvm_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/CvmModel');
    }

    public function insertCvm($request) {
        try {
            $cvm = new CvmModel();
            $datos = $cvm->insert($request->all());
//            echo $cvm->getSQL();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }
    
    public function toAssignEngineer($k_id_cvm, $ingeniero) {
        try {
            $avm = new CvmModel();
            $datos = $avm->where("k_id_cvm", "=", $k_id_cvm)
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
