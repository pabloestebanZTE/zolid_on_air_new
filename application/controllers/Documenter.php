<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documenter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ticketOnair_model');
        $this->load->model('data/Dao_preparationStage_model');
        $this->load->model('data/Dao_station_model');
        $this->load->model('data/Dao_band_model');
        $this->load->model('data/Dao_work_model');
        $this->load->model('data/Dao_technology_model');
        $this->load->model('data/Dao_statusOnair_model');
        $this->load->model('data/Dao_precheck_model');
        $this->load->model('data/Dao_scaledOnair_model');
        if (!Auth::check()) {
            return Redirect::to(URL::base());
        }
    }

    public function documenterFields() {
        // header('Content-Type: text/plain');
        $ticketOnair = new dao_ticketOnAir_model();
        $preparation = new dao_preparationStage_model();
        $band = new dao_band_model();
        $station = new dao_station_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $scaledOnair = new dao_scaledOnair_model();
        $precheck = new dao_precheck_model();
        $ticket = $this->request->id;
        $res = $ticketOnair->findByIdOnAir($ticket)->data;
        if ($res != "") {
            $res->k_id_preparation = $preparation->findByIdPreparation($res->k_id_preparation)->data;
            $res->k_id_band = $band->findById($res->k_id_band)->data; //band
            $res->k_id_status_onair = $statusOnair->findById($res->k_id_status_onair)->data; //Status onair
            $res->k_id_station = $station->findById($res->k_id_station)->data; //Station
            $res->k_id_work = $work->findById($res->k_id_work)->data; //work
            $res->k_id_technology = $technology->findById($res->k_id_technology)->data; //technology
            $res->scaledOnair = $scaledOnair->getScaledByTicket($res->k_id_onair)->data; //scaledOnair nuevo elemento
            $res->k_id_precheck = $precheck->getPrecheckByIdPrech($res->k_id_precheck)->data; //precheck
        }
        $answer['fields'] = json_encode($res);
        $this->load->view('documenterPrincipal', $answer);
    }

    public function restartFields() {
        // header('Content-Type: text/plain');
        $ticketOnair = new dao_ticketOnAir_model();
        $preparation = new dao_preparationStage_model();
        $band = new dao_band_model();
        $station = new dao_station_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $scaledOnair = new dao_scaledOnair_model();
        $precheck = new dao_precheck_model();
        $ticket = $this->request->id;
        $res = $ticketOnair->findByIdOnAir($ticket)->data;
        $res->statusOnAir = $statusOnair->getAll();
        $res->status = $statusOnair->getAllStatus();
        $res->substatus = $statusOnair->getAllSubstatus();
        for ($i = 0; $i < count($res->statusOnAir->data); $i++) {
            for ($j = 0; $j < count($res->status->data); $j++) {
                if ($res->statusOnAir->data[$i]->k_id_status == $res->status->data[$j]->k_id_status) {
                    $res->statusOnAir->data[$i]->n_name_status = $res->status->data[$j]->n_name_status;
                }
            }
            for ($j = 0; $j < count($res->substatus->data); $j++) {
                if ($res->statusOnAir->data[$i]->k_id_substatus == $res->substatus->data[$j]->k_id_substatus) {
                    $res->statusOnAir->data[$i]->n_name_substatus = $res->substatus->data[$j]->n_name_substatus;
                }
            }
        }
        if ($res != "") {
            $res->k_id_preparation = $preparation->findByIdPreparation($res->k_id_preparation)->data;
            $res->k_id_band = $band->findById($res->k_id_band)->data; //band
            $res->k_id_status_onair = $statusOnair->findById($res->k_id_status_onair)->data; //Status onair
            $res->k_id_station = $station->findById($res->k_id_station)->data; //Station
            $res->k_id_work = $work->findById($res->k_id_work)->data; //work
            $res->k_id_technology = $technology->findById($res->k_id_technology)->data; //technology
            $res->scaledOnair = $scaledOnair->getScaledByTicketRound($res->k_id_onair, $res->n_round)->data; //scaledOnair nuevo elemento
            $res->k_id_precheck = $precheck->getPrecheckByIdPrech($res->k_id_precheck)->data; //precheck
        }
        $users = new Dao_user_model();
        $answer['fields'] = json_encode($res);
        $answer['users'] = json_encode($users->getAllEngineers());
        $this->load->view('restart', $answer);
    }

    public function updateDetails() {
        $ticket = new dao_ticketOnAir_model();
        $preparation = new dao_preparationStage_model();
        $response = $ticket->updatePrecheckOnair($this->request);
        $this->request->k_id_preparation = $this->request->k_id_prep;
        $response = $preparation->updatePreparationStage($this->request);
        $this->json($response);
    }

}
