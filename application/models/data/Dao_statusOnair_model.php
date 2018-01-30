<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_statusOnair_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/StatusModel');
        $this->load->model('dto/SubstatusModel');
        $this->load->model('dto/OnAir12hModel');
        $this->load->model('dto/OnAir24hModel');
        $this->load->model('dto/OnAir36hModel');
        $this->load->model('data/TimerGlobal');
    }

    public function getAll() {
        try {
            $statusOnair = new StatusOnairModel();
            $datos = $statusOnair->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findById($tck) {
        try {
            $idStatusOnAir = (is_object($tck)) ? $tck->k_id_status_onair : $tck;
//            var_dump($tck);
            $statusOnair = new StatusOnairModel();
            $status = new StatusModel();
            $substatus = new SubstatusModel();
            $datos = $statusOnair->where("k_id_status_onair", "=", $idStatusOnAir)
                    ->first();
            $datos = new ObjUtil($datos);
            // consulto status...
            $statusObj = $status->where("k_id_status", "=", $datos->k_id_status)
                    ->first();
            // Consulto substatus
            $substatusObj = $substatus->where("k_id_substatus", "=", $datos->k_id_substatus)
                    ->first();
            if ($statusObj) {//si no es vacia la consulta asigna el objeto
                $datos->k_id_status = $statusObj;
            }
            $time = null;
            if ($substatusObj) { //si no es vacia la consulta asigna el objeto
                $datos->k_id_substatus = $substatusObj;
                if (is_object($tck)) {
//                    var_dump($substatusObj);
                    $timeGlobal = new TimerGlobal();
                    $time = $timeGlobal->updateTimeStamp($tck);
//                    var_dump($time);
                }
            }
            $datos->time = $time;
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos->all());
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }

//        try {
//            $id = (is_object($tck)) ? $tck->k_id_status_onair : $tck;
//            $statusOnair = new StatusOnairModel();
//            $status = new StatusModel();
//            $substatus = new SubstatusModel();
//            $datos = $statusOnair->where("k_id_status_onair", "=", $id)
//                    ->first();
//            $datos = new ObjUtil($datos);
//            // consulto status...
//            $statusObj = $status->where("k_id_status", "=", $datos->k_id_status)
//                    ->first();
//            // Consulto substatus
//            $substatusObj = $substatus->where("k_id_substatus", "=", $datos->k_id_substatus)
//                    ->first();
//            if ($statusObj) {//si no es vacia la consulta asigna el objeto
//                $datos->k_id_status = $statusObj;
//            }
//
//            if ($substatusObj) { //si no es vacia la consulta asigna el objeto
//                $datos->k_id_substatus = $substatusObj;
//                $onAirState = null;
//                switch ($substatusObj->k_id_substatus) {
//                    case ConstStates::SEGUIMIENTO_12H:
//                        $onAirState = new OnAir12hModel();
//                        break;
//                    case ConstStates::SEGUIMIENTO_24H:
//                        $onAirState = new OnAir24hModel();
//                        break;
//                    case ConstStates::SEGUIMIENTO_36H:
//                        $onAirState = new OnAir36hModel();
//                        break;
//                }
//                $time = null;
//                if ($onAirState != null) {
//                    if (!is_object($tck)) {
//                        $temp = new TicketOnAirModel();
//                        $tck = $temp->where("k_id_onair", "=", $id)->first();
//                        if ($tck) {
//                            $time = $onAirState->updateTimeStamp($tck);
//                            if ($time) {
//                                $time = $time->all();
//                            }
//                        }
//                    }
//                }
//            }
//            $datos->time = $time;
//            $response = new Response(EMessages::SUCCESS);
//            $response->setData($datos->all());
//            return $response;
//        } catch (DeplynException $ex) {
//            return $ex;
//        }
    }

    public function getAllStatus() {
        try {
            $datos = DB::table("status")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getAllSubstatus() {
        try {
            $datos = DB::table("substatus")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

}

?>
