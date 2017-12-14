<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_kpi_model extends CI_Model {

    function __construct() {
        $this->load->model('bin/ConstStates');
        $this->load->model('dto/KpiSummaryModel');
        $this->load->model('dto/KpiSummaryOnairModel');
        $this->load->model('data/TimerGlobal');
    }

    private function recordKPIPrecheck($tck) {
        $kpiOnAirModel = new KpiSummaryOnairModel();
        $kpiModel = new KpiSummaryModel();
        //Consultamos el registro KPI...
        $temp = $kpiOnAirModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("n_round", "=", $tck->n_round)->first();
        //Calculamos el tiempo...
        $timeTemp = new TimerGlobal();
        $obj = $timeTemp->getObjectModel();
        $obj->d_precheck_start = $tck->d_precheck_init;
        $timeTemp->nextDate($obj, "d_precheck_start", 3);
        $d_final = Hash::timeStampToDate($obj->next_date);
        //Comprobamos si temp es válido...
        if ($temp) {
            //Si existe tenemos que buscar los detalles...
            $temp2 = $kpiModel->where("k_kpi_summary", "=", $temp->k_id_summary_precheck)
                    ->update([
                "d_start" => Hash::getDate(),
                "d_end" => $d_final
            ]);
        } else {
            $idSummary = $kpiModel->insert([
                "d_start" => $tck->d_precheck_init,
                "d_end" => $d_final,
                "e_type" => "PRE",
                "d_created_at" => Hash::getDate()
            ]);
            $kpiOnAirModel->insert([
                "k_id_onair" => $tck->k_id_onair,
                "n_round" => $tck->n_round,
                "k_id_summary_precheck" => $idSummary->data,
                "d_created_at" => Hash::getDate()
            ]);
        }
    }

    public function recordKpiPoscheck($tck, $fase) {
        $kpiOnAirModel = new KpiSummaryOnairModel();
        $kpiModel = new KpiSummaryModel();
        //Consultamos el registro KPI...
        $temp = $kpiOnAirModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("n_round", "=", $tck->n_round)->first();
        //Insertamos/actualizamos el detalle del KPI...
        if ($temp) {
            //Si existe tenemos que buscar los detalles...
            if ($temp->{$fase}) {
                $temp2 = $kpiModel->where("k_kpi_summary", "=", $temp->{$fase})->first();
                if ($temp2) {
                    return;
                }
                $kpiModel->update([
                    "d_start" => Hash::getDate(),
                    "d_created_at" => Hash::getDate()
                ]);
            }
            //Si no existe creamos el detalle y actualizamos el id de la cabecera del registro kpi.
            else {
                $idModel = $kpiModel->insert([
                    "d_start" => Hash::getDate(),
                    "d_created_at" => Hash::getDate()
                ]);
                $kpiOnAirModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("n_round", "=", $tck->n_round)->update([
                    $fase = $idModel
                ]);
            }
        } else {
            $idSummary = $kpiModel->insert([
                "d_start" => Hash::getDate(),
                "d_created_at" => Hash::getDate()
            ]);
            //Insertamos la cabecera del detalle KPI...
            $kpiOnAirModel->insert([
                "k_id_onair" => $tck->k_id_onair,
                "e_type" => "POS",
                "n_round" => $tck->n_round,
                $fase => $idSummary->data,
                "d_created_at" => Hash::getDate()
            ]);
        }
    }

    public function record($tck, $flag = false, $recordExec = false) {
        if ($tck) {
            if (!is_object($tck) && (!$flag)) {
                $ticketModel = new TicketOnAirModel();
                $tck = $ticketModel->where("k_id_onair", "=", $tck)->first();
                $this->record($tck, true, $recordExec);
            }
        } else {
            return new Response(EMessages::ERROR, "No se recibió un objeto o id de ticket válido.");
        }
        //Se procesa la información del ticket, para iniciar el registro del kpi...
        //Inicialmente consutlamos el estado actual del ticket...
        $idStatus = $tck->k_id_status_onair;
        switch ($idStatus) {
            case ConstStates::PRECHECK:
                if ($recordExec === false) {
                    $this->recordKPIPrecheck($tck);
                } else {
                    //Actualiza la fecha de ejecución...
                    $this->updateKPIPrecheck($tck);
                }
                break;
            case ConstStates::SEGUIMIENTO_12H:
                echo "12H";
                if ($recordExec === false) {
                    echo "12H RECORDed";
                    $this->recordKpiPoscheck($tck, "k_id_summary_12h");
                }
                break;
            case ConstStates::SEGUIMIENTO_24H:
                if ($recordExec === false) {
                    $this->recordKpiPoscheck($tck, "k_id_summary_24h");
                }
                break;
            case ConstStates::SEGUIMIENTO_36H:
                if ($recordExec === false) {
                    $this->recordKpiPoscheck($tck, "k_id_summary_36h");
                }
                break;
            default :
                break;
        }
    }

    private function updateKPIPrecheck($tck) {
        $kpiOnAirModel = new KpiSummaryOnairModel();
        $kpiModel = new KpiSummaryModel();
        //Consultamos el registro KPI...
        $temp = $kpiOnAirModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("n_round", "=", $tck->n_round)->first();
        //Comprobamos si temp es válido...
        if ($temp) {
            //Si existe tenemos que buscar los detalles...
            $temp2 = $kpiModel->where("k_kpi_summary", "=", $temp->k_id_summary_precheck)->first();
            if ($temp2) {
                $now = Hash::getDate();
                $onTime = Hash::betweenHoras($temp2->d_start, $temp2->d_end, $now);
                $kpiModel->where("k_kpi_summary", "=", $temp->k_id_summary_precheck)
                        ->update([
                            "on_time" => $onTime,
                            "d_exec" => $now,
                            "k_id_executor" => Auth::user()->k_id_user
                ]);
            }
        }
    }

}
