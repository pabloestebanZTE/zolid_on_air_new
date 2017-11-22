<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Precheck extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ticketOnair_model');
        $this->load->model('data/Dao_station_model');
        $this->load->model('data/Dao_band_model');
        $this->load->model('data/Dao_work_model');
        $this->load->model('data/Dao_technology_model');
        $this->load->model('data/Dao_statusOnair_model');
        $this->load->model('data/Dao_precheck_model');
        $this->load->model('data/Dao_followUp12h_model');
        $this->load->model('data/Dao_followUp24h_model');
        $this->load->model('data/Dao_followUp36h_model');
        $this->load->model('data/Dao_onAir12h_model');
        $this->load->model('data/Dao_onAir24h_model');
        $this->load->model('data/Dao_onAir36h_model');
        $this->load->model('data/Dao_preparationStage_model');
        $this->load->model('data/Dao_precheck_model');
        $this->load->model('data/Dao_user_model');
    }

    public function prueba() {
        $db = new DB();
        $obj = $db->select("select count(k_id_onair) as count from ticket_on_air")->first();
        var_dump($obj->count);
    }

    public function getPendingList() {
        $response = null;
        if (Auth::check()) {
            $dao = new dao_ticketOnAir_model();
            $array = $dao->getPendingList($this->request);
            $this->getFKRegisters($array->data["data"]);
            $this->json($array->data);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function getAssignList() {
        $response = null;
        if (Auth::check()) {
            $dao = new dao_ticketOnAir_model();
            $array = $dao->getAssignList($this->request);
            $this->getFKRegisters($array->data["data"]);
            $this->json($array->data);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function getFKRegisters(&$res) {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $stage = new dao_preparationStage_model();
        $assign = new dao_user_model();
        for ($j = 0; $j < count($res); $j++) {
            $res[$j]->k_id_status_onair = $statusOnair->findById($res[$j])->data; //Status onair
            $res[$j]->k_id_station = $station->findById($res[$j]->k_id_station)->data; //Station
            $res[$j]->k_id_band = $band->findById($res[$j]->k_id_band)->data; //band
            $res[$j]->k_id_work = $work->findById($res[$j]->k_id_work)->data; //work
            $res[$j]->k_id_technology = $technology->findById($res[$j]->k_id_technology)->data; //technology
            $res[$j]->k_id_preparation = $stage->findByIdPreparation($res[$j]->k_id_preparation)->data; //preparation
            if ($res[$j]->i_actualEngineer != 0) {
                $res[$j]->i_actualEngineer = $assign->findBySingleId($res[$j]->i_actualEngineer)->data; //
//                $res[$j]->i_actualEngineer = $res[$j]->i_actualEngineer->n_name_user . " " . $res[$j]->i_actualEngineer->n_last_name_user;
            } elseif ($res[$j]->i_actualEngineer == 0) {
                $res[$j]->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
            }
        }
        return $res;
    }

    public function doPrecheck() {
        $preparation = new Dao_preparationStage_model();
        $ticket = new Dao_ticketOnair_model();
        $precheck = new Dao_precheck_model();
        $response = $ticket->findByIdOnAir($this->request->idOnair);
        $this->request->k_id_onair = $this->request->idOnair;
        $this->request->k_id_user = $response->data->i_actualEngineer;
        $this->request->n_round = 1;
        $this->request->i_round = 1;
        $this->request->i_actualEngineer = 0;
        $this->request->k_id_ticket = $this->request->k_id_onair;
        $response1 = $ticket->updateEngTicket($this->request->idOnair, 0)->data; //camilo

        //print_r($response);
        //print_r($this->request);
        //Sirve para veriificar si va para 12
        if ($this->request->k_id_status_onair == 81) {
            $follow12h = new Dao_followUp12h_model();
            $onair12 = new Dao_onAir12h_model();
            $response = $follow12h->insert12hFollowUp($this->request);
            $this->request->k_id_follow_up_12h = $response->data->data;
            $this->request->d_start12h = Hash::getDate();
            $response = $onair12->insertOnAir12($this->request);
            $this->request->d_finpre = Hash::getDate();
            $response = $preparation->updatePreparationStage($this->request)->data;
            $response1 = $ticket->updateStatusTicket($this->request->idOnair, 81)->data;
            $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data; //camilo
            $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data; //camilo
            $repsonse2 = $precheck->updatePrecheckCom($this->request)->data; //camilo
            $this->json($response);
        }
        // si va para 24
        if ($this->request->k_id_status_onair == 82) {
            $follow24h = new Dao_followUp24h_model();
            $onair24 = new Dao_onAir24h_model();
            $response = $follow24h->insert24hFollowUp($this->request);
            $this->request->k_id_follow_up_24h = $response->data->data;
            $this->request->d_start24h = Hash::getDate();
            $response = $onair24->insertOnAir24($this->request);
            $this->request->d_finpre = Hash::getDate();
            $response = $preparation->updatePreparationStage($this->request)->data;
            $response1 = $ticket->updateStatusTicket($this->request->idOnair, 82)->data;
            $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data; //camilo
            $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data; //camilo
            $repsonse2 = $precheck->updatePrecheckCom($this->request)->data; //camilo
            $this->json($response);
        }
        //si va para 36
        if ($this->request->k_id_status_onair == 83) {
            $follow36h = new Dao_followUp36h_model();
            $onair36 = new Dao_onAir36h_model();
            $response = $follow36h->insert36hFollowUp($this->request);
            $this->request->k_id_follow_up_36h = $response->data->data;
            $this->request->d_start36h = Hash::getDate();
            $response = $onair36->insertOnAir36($this->request);
            $this->request->d_finpre = Hash::getDate();
            $response = $preparation->updatePreparationStage($this->request)->data;
            $response1 = $ticket->updateStatusTicket($this->request->idOnair, 83)->data;
            $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data; //camilo
            $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data; //camilo
            $repsonse2 = $precheck->updatePrecheckCom($this->request)->data; //camilo
            $this->json($response);
        }
        //Actualizamos la fecha en la que se inició el precheck.
        $temp = new TicketOnAirModel();
        $temp->where("k_id_onair", "=", $this->request->k_id_onair)->update([
            "d_precheck_init" => Hash::getDate()
        ]);
        $ticket->registerReportComment($this->request->k_id_onair, $this->request->n_comentario_ing);
        // $this->request->d_finpre = Hash::getDate();
        // $response = $preparation->updatePreparationStage($this->request)->data;
        // $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data;//camilo
        // $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data;//camilo
        // $repsonse2 = $precheck->updatePrecheckCom($this->request)->data;//camilo
        // $this->json($response);
    }

}
