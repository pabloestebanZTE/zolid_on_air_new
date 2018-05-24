<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_preparationStage_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/PreparationStageModel');
    }

    public function findByIdPreparation($id) {
        try {
            $preparation = new PreparationStageModel();
            $datos = $preparation->where("k_id_preparation", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function insertPreparationStage($request) {
        try {
            $PS = new PreparationStageModel();
            $datos = $PS->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function updatePreparationStage($request) {
        try {
            $preparation = new PreparationStageModel();
            $datos = $preparation->where("k_id_preparation", "=", $request->k_id_preparation)
                    ->update($request->all());
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findByIdCRQ($id) {
        try {
            $preparation = new PreparationStageModel();
            $datos = $preparation->where("n_crq", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getAllCRQ() {
        try {
            $db = new DB();
            $datos = $db->select("SELECT n_crq FROM preparation_stage")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    

}

?>
