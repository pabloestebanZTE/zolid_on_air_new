<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TimerGlobal {

    const NOTY = "NOTY";
    const TRACK = "SEGUIMIENTO";

    function __construct() {
        
    }

    public function updateTimeStamp($tck, $customDate = null) {
        try {
            $id = (is_object($tck)) ? $tck->k_id_onair : $tck;
            if (!is_object($tck)) {
                $ticketModel = new TicketOnAirModel();
                $tck = $ticketModel->where("k_id_onair", "=", $id)->first();
            }
            if ($tck) {
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
                        case ConstSubStates::SEGUIMIENTO_12H:
                            $actual_status = "12h";
                            $stepIdField = "k_id_12h_real";
                            $stepModel = new OnAir12hModel();
                            break;
                        case ConstSubStates::SEGUIMIENTO_24H:
                            $actual_status = "24h";
                            $stepIdField = "k_id_24h_real";
                            $stepModel = new OnAir24hModel();
                            break;
                        case ConstSubStates::SEGUIMIENTO_36H:
                            $actual_status = "36h";
                            $stepIdField = "k_id_36h_real";
                            $stepModel = new OnAir36hModel();
                            break;
                        case ConstSubStates::NOTIFICACION:
                            $actual_status = "NOTY";
                            $temp = $this->getTimeNotification($tck, $customDate);
                            break;
                        case ConstSubStates::PRECHECK:
                            $actual_status = "PCHK";
                            $temp = $this->getTimePrecheck($tck, $customDate);
                            break;
                        case ConstSubStates::REINICIO_PRECHECK:
                            $actual_status = "R_PCHK";
                            $temp = $this->getTimePrecheck($tck, $customDate);
                            break;
                        case ConstSubStates::REINICIO_12H:
                            $actual_status = "R_12H";
                            $temp = $this->getTimePrecheck($tck, $customDate);
                            break;
                        case ConstSubStates::REINICIO_24H:
                            $actual_status = "R_24H";
                            $temp = $this->getTimePrecheck($tck, $customDate);
                            break;
                        case ConstSubStates::REINICIO_36H:
                            $actual_status = "R_36H";
                            $temp = $this->getTimePrecheck($tck, $customDate);
                            break;
                    }
                }
                //VERIFICAMOS Y ACTUALIZAMOS EL TIEMPO QUE FALTA...
                if ($stepModel) {
                    $temp = $stepModel->updateTimeStamp($tck, $customDate);
                }
                if (is_object($temp)) {
                    $temp->actual_status = $actual_status;
                    $temp = $temp->all();
                }
                return $temp;
            } else {
                return ["status" => $status_onair];
            }
        } catch (DeplynException $ex) {
            return ["ERROR" => "dfasdf"];
        }
    }

    public function getObjectModel() {
        return new ObjUtil([
            "actual_status" => null,
            "i_percent" => 0,
            "i_state" => 0,
            "i_timestamp" => 0,
            "i_timetotal" => 0,
            "i_timeexceeded" => 0,
            "time" => 0,
            "today" => 0
        ]);
    }

    public function getTimeNotification($tck, $customDate = null) {
        //Suponiendo que ya conocemos el estado, lo que haremos será arrancar el cronómetro...
        $obj = $this->getObjectModel();
        $obj->d_created_at = ($customDate == null) ? $tck->d_created_at : $customDate;
        $this->timer($obj, "d_created_at", 3);
        return $obj;
    }

    public function getTimePrecheck($tck, $customDate = null) {
        //Suponiendo que ya conocemos el estado, lo que haremos será arrancar el cronómetro...
        $obj = $this->getObjectModel();
        $obj->d_precheck_init = ($customDate == null) ? $tck->d_precheck_init : $customDate;
        //Detectamos si está en stand by...
        $time = 3;
        if ($tck->i_prorroga_hours > 0) {
            $time = $tck->i_prorroga_hours;
        }
        if ($tck->d_precheck_init == null) {
            return null;
        }
        $this->timer($obj, "d_precheck_init", $time, TimerGlobal::NOTY);
        return $obj;
    }

    public function nextDate(&$obj, $field, $timeMath) {
        $time = Hash::getTimeStamp($obj->{$field});
        //Comprobamos si la fecha final supera el rango...
        $timeFinal = $time + (((1000 * 60) * 60) * $timeMath);
        $temp = date("H:i:s", $timeFinal / 1000);
        //Si no está entre el rango...
        $parts = explode(":", $temp);
        $hour = $parts[0];
        $v = Hash::betweenHoras("06:00:00", "18:00:00", $timeFinal);
        if (!$v) {
            $hrs = 0;
            if (floor($hour) < 6) {
                $hrs = floor($hour);
            } else if (floor($hour) > 18) {
                $hrs = 12;
            }
            $timeFinal += $hrs * (((1000 * 60) * 60));
        }
//        else {
//            if (date("d", $time / 1000) != date("d", $timeFinal / 1000)) {
//                $hrs = 12;
//                $timeFinal += $hrs * (((1000 * 60) * 60));
//            }
//        }
        $obj->next_date = $timeFinal;
    }

    private function timer(&$obj, $field, $timeMath, $track = "NOTY") {
        $timestamp = 0;
        $percent = 0;
        $timeexceeded = 0;

        $timeTemp = new Date($obj->{$field});
        $todayTemp = new Date(Hash::getDate());
        $limit = 18;
        $hs = 12;
        switch ($track) {
            case TimerGlobal::NOTY:
                $limit = 22;
                $hs = 8;
                break;
            case TimerGlobal::TRACK:
                $limit = 18;
                $hs = 12;
                break;
        }

        $now = time(); // or your date as well
        $your_date = strtotime($timeTemp->getDate());
        $datediff = $now - $your_date;
        $days = round($datediff / (60 * 60 * 24));

        if ($days <= 1) {
            if (($todayTemp->day != $timeTemp->day)) {
                $todayTemp = new Date(Hash::getDateForTrack());
            }
            //Se se ha pasado la hora habíl, se buscará cuanto tiempo ha pasado de la hora hábil...
            if ($todayTemp->hour > $limit) {
                $h_e = $todayTemp->hour - $limit;
                $timeTemp->hour += $h_e;
            } else {
                $h_e = $limit - $timeTemp->hour;
                if ($todayTemp->hour < 6 && $timeTemp->day != $todayTemp->day) {
                    $timeTemp->hour = 6;
                    $todayTemp->hour = 6 + $h_e;
                } else {
                    if ($todayTemp->hour < 6) {
                        $todayTemp->minute = 0;
                        $todayTemp->secound = 0;
                        $todayTemp->hour += (6 - $todayTemp->hour);
                    }
                }
            }
//            if ($todayTemp->day > $timeTemp->day) {
//                $timeTemp->day = $todayTemp->day;
//            }
            $time = Hash::getTimeStamp($timeTemp->getDate());
        } else {
            $time = Hash::getTimeStamp($obj->{$field});
        }

        $today = Hash::getTimeStamp($todayTemp->getDate());

        $timeFinal = $time + ((1000 * 60) * 60) * $timeMath;
        //Milisegundos entre la fecha y hoy (tiempo que falta)...
        $timestamp = ($timeFinal - $today);

        //Obtenemos el porcentaje...
        $percent = round((($today - $time) / ($timeFinal - $time)) * 100);

        if ($percent >= 100) {
            $timeexceeded = $today - $timeFinal;
        }

        $obj->time = $time;
        $obj->i_timestamp = $timestamp;
        $obj->i_timetotal = $timeFinal;
        $obj->i_percent = $percent;
        $obj->i_timeexceeded = $timeexceeded;
        $obj->today = $today;
    }

}
