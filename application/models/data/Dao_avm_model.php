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
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getAllPersonAutocomplete($request) {
        try {
            $db = new DB();
            $datos = $db->select("SELECT " . $request->field . " as label FROM avm WHERE " . $request->field . " LIKE'%" . $request->search . "%' GROUP BY label LIMIT 15")->get();
            return $datos;
        } catch (DeplynException $ex) {
            return [
                "label" => "Error al consultar"
            ];
        }
    }

}

?>
