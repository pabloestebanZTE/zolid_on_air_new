<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_statusOnair_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/StatusOnAirModel');
        $this->load->model('dto/StatusModel');
        $this->load->model('dto/SubstatusModel');
    }

    public function getAll() {
        try {
            $statusOnair = new StatusOnairModel();
            $datos = $statusOnair->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function findById($id) {
        try {
            $statusOnair = new StatusOnairModel();
            $status = new StatusModel();
            $substatus = new SubstatusModel();
            $datos = $statusOnair->where("k_id_status_onair", "=", $id)
                    ->first();
            // consulto status...
            $statusObj = $status->where("k_id_status", "=", $datos->k_id_status)
                    ->first();
            // Consulto substatus
            $substatusObj = $substatus->where("k_id_substatus", "=", $datos->k_id_substatus)
                    ->first();
            if ($statusObj) {//si no es vacia la consulta asigna el objeto
                $datos->k_id_status = $statusObj;
            }

            if ($substatusObj) {//si no es vacia la consulta asigna el objeto
                $datos->k_id_substatus = $substatusObj;
            }
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAllStatus() {
        try {
            $datos = DB::table("status")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAllSubstatus() {
        try {
            $datos = DB::table("substatus")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
