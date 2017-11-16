<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TimerGlobal {

    function __construct() {
        $this->load->model('dto/OnAir12hModel');
        $this->load->model('dto/OnAir24hModel');
        $this->load->model('dto/OnAir36hModel');
    }

    public function updateTimeStamp($tck) {
        try {
            $id = (is_object($tck)) ? $tck->k_id_status_onair : $tck;
            if (!is_object($tck)) {
                $tck = $ticketModel->where("k_id_onair", "=", $id)->first();
            }
            if ($tck) {
                $actual_status = null;
                $status_onair = DB::table("status_on_air")
                        ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                        ->first();
                switch ($status_onair->k_id_substatus) {
                    case ConstStates::SEGUIMIENTO_12H:
                        $actual_status = "12h";
                        $stepIdField = "k_id_12h_real";
                        $stepModel = new OnAir12hModel();
                        break;
                    case ConstStates::SEGUIMIENTO_24H:
                        $actual_status = "24h";
                        $stepIdField = "k_id_24h_real";
                        $stepModel = new OnAir24hModel();
                        break;
                    case ConstStates::SEGUIMIENTO_36H:
                        $actual_status = "36h";
                        $stepIdField = "k_id_36h_real";
                        $stepModel = new OnAir36hModel();
                        break;
                    case ConstStates::NOTIFICACION:
                        $actual_status = "NOTY";
                        break;
                }
                //VERIFICAMOS Y ACTUALIZAMOS EL TIEMPO QUE FALTA...
                $temp = null;
                if ($stepModel) {
                    $temp = $stepModel->updateTimeStamp($tck);
                    if ($temp) {
                        $temp = $temp->all();
                    }
                }
                return $temp;
            } else {
                return null;
            }
        } catch (ZolidException $ex) {
            return null;
        }
    }

    public function getTimeNotification() {
        
    }

}
