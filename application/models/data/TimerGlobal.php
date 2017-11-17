<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TimerGlobal {

    function __construct() {
        
    }

    public function updateTimeStamp($tck) {
        try {
            $id = (is_object($tck)) ? $tck->k_id_onair : $tck;
            if (!is_object($tck)) {
                $tck = $ticketModel->where("k_id_onair", "=", $id)->first();
            }
            if ($tck) {
//                var_dump($tck);
                $temp = null;
                $statusOnair = new StatusOnairModel();
                $actual_status = null;
                $stepModel = null;
                $db = new DB();
                $status_onair = $db->select("select * from status_on_air where status_on_air.k_id_status_onair = $tck->k_id_status_onair")
                        ->first();
//                echo "SI HAY TCK $tck->k_id_onair";
                if ($status_onair) {
//                    var_dump($status_onair);
//                    echo "ENCONTRO STATUS $status_onair->k_id_substatus";
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
                            $temp = $this->getTimeNotification($tck);
                            break;
                        case ConstStates::PRECHECK:
                            $actual_status = "PCHK";
                            $temp = $this->getTimePrecheck($tck);
                            break;
                    }
                }
                //VERIFICAMOS Y ACTUALIZAMOS EL TIEMPO QUE FALTA...
                if ($stepModel) {
                    $temp = $stepModel->updateTimeStamp($tck);
                }
                if (is_object($temp)) {
                    $temp->actual_status = $actual_status;
                    $temp = $temp->all();
                }
                return $temp;
            } else {
                return ["status" => $status_onair];
            }
        } catch (ZolidException $ex) {
            return ["ERROR" => "dfasdf"];
        }
    }

    private function getObjectModel() {
        return new ObjUtil([
            "actual_status" => null,
            "i_percent" => 0,
            "i_state" => 0,
            "i_timestamp" => 0,
            "i_timetotal" => 0,
            "time" => 0,
            "today" => 0
        ]);
    }

    public function getTimeNotification($tck) {
        //Suponiendo que ya conocemos el estado, lo que haremos será arrancar el cronómetro...
        $obj = $this->getObjectModel();
        $obj->d_created_at = $tck->d_created_at;
        $this->timer($obj, "d_created_at", 3);
        return $obj;
    }

    public function getTimePrecheck($tck) {
        //Suponiendo que ya conocemos el estado, lo que haremos será arrancar el cronómetro...
        $obj = $this->getObjectModel();
        $obj->d_precheck_init = $tck->d_precheck_init;
        $this->timer($obj, "d_precheck_init", 3);
        return $obj;
    }

    private function timer(&$obj, $field, $timeMath) {
        $timestamp = 0;
        $percent = 0;

        $time = Hash::getTimeStamp($obj->{$field});
        $today = Hash::getTimeStamp(date("Y-m-d H:i:s"));

        $date = date("H:i:s");
        $parts = explode(":", $date);
        $hour = $parts[0];
        $minute = $parts[1];
        $v = Hash::betweenHoras("06:00:00", "18:00:00");
        if (!$v) {
            $hrs = 0;
            if (floor($hour) < 6) {
                $hrs = floor($hour);
                //Detectamos si el día de hoy es igual o inferior al día del registro...                    
                if (date("d", $time / 1000) != date("d", $today / 1000)) {
                    $hrs += 6;
                }
            } else if (floor($hour) > 18) {
                $hrs = floor($hour) - 18;
            }
            $time += $hrs * (((1000 * 60) * 60));
        } else {
            if (date("d", $time / 1000) != date("d", $today / 1000)) {
                $hrs = 12;
                $time += $hrs * (((1000 * 60) * 60));
            }
        }

        $timeFinal = $time + ((1000 * 60) * 60) * $timeMath;
        //Milisegundos entre la fecha y hoy (tiempo que falta)...
        $timestamp = ($timeFinal - $today);

        //Obtenemos el porcentaje...
        $percent = round((($today - $time) / ($timeFinal - $time)) * 100);

        $obj->time = $time;
        $obj->i_timestamp = $timestamp;
        $obj->i_timetotal = $timeFinal;
        $obj->i_percent = $percent;
        $obj->today = $today;
    }

}
