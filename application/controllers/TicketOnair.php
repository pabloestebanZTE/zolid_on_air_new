<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TicketOnair extends CI_Controller {

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
        $this->load->model('data/Dao_scaledOnair_model');
    }

    public function listTicketOnair() {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $res = $ticketsOnAir->getAll($this->request);
        for ($j = 0; $j < count($res->data); $j++) {
            $res->data[$j]->k_id_status_onair = $statusOnair->findById($res->data[$j]->k_id_status_onair)->data; //Status onair
            $res->data[$j]->k_id_station = $station->findById($res->data[$j]->k_id_station)->data; //Station
            $res->data[$j]->k_id_band = $band->findById($res->data[$j]->k_id_band)->data; //band
            $res->data[$j]->k_id_work = $work->findById($res->data[$j]->k_id_work)->data; //work
            $res->data[$j]->k_id_technology = $technology->findById($res->data[$j]->k_id_technology)->data; //technology
        }
        $this->json($res);
    }

    public function ticketUser() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
        $precheck = new dao_precheck_model();
        $ticket = new dao_ticketOnair_model();
        $ticketsOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $userId = Auth::user()->id();
        $precheckId = $precheck->getPrecheckById($userId)->data;
        for ($j = 0; $j < count($precheckId); $j++) {
            $res = $ticket->findByIdPrecheck($precheckId[$j]->k_id_precheck);
            // $res->data->k_id_band = $band->findById($res->data->k_id_band)->data;//band
            // $res->data->k_id_status_onair = $statusOnair->findById($res->data->k_id_status_onair)->data;//Status onair
            // $res->data->k_id_station = $station->findById($res->data->k_id_station)->data;//Station
            // $res->data->k_id_work = $work->findById($res->data->k_id_work)->data;//work
            // $res->data->k_id_technology = $technology->findById($res->data->k_id_technology)->data;//technology
            $respuesta[$j] = $res->data;
        }
        // print_r($respuesta);//ticket precheck
        $follow12 = new dao_followUp12h_model();
        $onair12 = new dao_onAir12h_model();
        $ticket12 = new dao_ticketOnAir_model();
        $res2 = $follow12->getfollow12ById($userId)->data;
        for ($i = 0; $i < count($res2); $i++) {
            $res3[$i] = $onair12->getOnair12ByFollow($res2[$i]->k_id_follow_up_12h)->data;
            $res = $ticket12->findByIdOnAir($res3[$i]->k_id_onair);
            $respuesta[$j + $i] = $res->data;
        }
        // print_r($respuesta);//ticket prechek+12h
        $follow24 = new dao_followUp24h_model();
        $onair24 = new dao_onAir24h_model();
        $ticket24 = new dao_ticketOnAir_model();
        $res24 = $follow24->getfollow24ById($userId)->data;
        for ($f = 0; $f < count($res24); $f++) {
            $resp[$f] = $onair24->getOnair24ByFollow($res24[$f]->k_id_follow_up_24h)->data;
            $respuesta[$j + $i + $f] = $res->data;
        }
        // print_r($respuesta);//ticket precheck+12+24
        $follow36 = new dao_followUp36h_model();
        $onair36 = new dao_onAir36h_model();
        $ticket36 = new dao_ticketOnAir_model();
        $res36 = $follow36->getfollow36ById($userId)->data;
        for ($g = 0; $g < count($res36); $g++) {
            $respu[$g] = $onair36->getOnair36ByFollow($res36[$g]->k_id_follow_up_36h)->data;
            $respuesta[$j + $i + $f + $g] = $res->data;
        }
        //  print_r($respuesta);//ticket precheck+12+24+36
        for ($r = 0; $r < count($respuesta); $r++) {
            $flag[$r] = $respuesta[$r]->k_id_onair;
        }
        $unique = array_unique($flag);
        $final = array_values($unique);
        $ticketUnic = new dao_ticketOnAir_model();
        for ($t = 0; $t < count($final); $t++) {
            $ticketUser[$t] = $ticketUnic->findByIdOnAir($final[$t])->data;
            $ticketUser[$t]->k_id_band = $band->findById($ticketUser[$t]->k_id_band)->data; //band
            $ticketUser[$t]->k_id_status_onair = $statusOnair->findById($ticketUser[$t]->k_id_status_onair)->data; //Status onair
            $ticketUser[$t]->k_id_station = $station->findById($ticketUser[$t]->k_id_station)->data; //Station
            $ticketUser[$t]->k_id_work = $work->findById($ticketUser[$t]->k_id_work)->data; //work
            $ticketUser[$t]->k_id_technology = $technology->findById($ticketUser[$t]->k_id_technology)->data; //technology
        }
        $response = new Response(EMessages::QUERY);
        $response->setData($ticketUser);
        $this->json($response);
        // header('Content-Type: text/plain');
    }

    public function getAllService() {
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
        $ticketsOnAir = new dao_ticketOnAir_model();
        $preparatinStage = new dao_preparationStage_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $scaledOnair = new dao_scaledOnair_model();
        $precheck = new dao_precheck_model();
        $onair12 = new dao_onAir12h_model();
        $follow12 = new dao_followUp12h_model();
        $onair24 = new dao_onAir24h_model();
        $follow24 = new dao_followUp24h_model();
        $onair36 = new dao_onAir36h_model();
        $follow36 = new dao_followUp36h_model();
        $ticket = $this->request->id;
        $res = $ticketsOnAir->findByIdOnAir($ticket)->data;
        if (!$res) {
            $this->json(new Response(EMessages::NO_FOUND_REGISTERS));
            return;
        }
        $res->k_id_preparation = $preparatinStage->findByIdPreparation($res->k_id_preparation)->data;
        $res->k_id_band = $band->findById($res->k_id_band)->data; //band
        $res->k_id_status_onair = $statusOnair->findById($res->k_id_status_onair)->data; //Status onair
        $res->k_id_station = $station->findById($res->k_id_station)->data; //Station
        $res->k_id_work = $work->findById($res->k_id_work)->data; //work
        $res->k_id_technology = $technology->findById($res->k_id_technology)->data; //technology
        $res->scaledOnair = $scaledOnair->getScaledByTicket($res->k_id_onair)->data; //scaledOnair nuevo elemento
        $res->k_id_precheck = $precheck->getPrecheckByIdPrech($res->k_id_precheck)->data; //precheck
        //Listamos los procesos onair...
        $res->onair12 = $onair12->getOnair12ByIdOnair($res->k_id_onair)->data; //onair12 nuevo elemento
        if ($res->onair12) {
            $res->onair12->k_id_follow_up_12h = $follow12->getfollow12ByIdFollow($res->onair12->k_id_follow_up_12h)->data; //follow up 12
        }
        $res->onair24 = $onair24->getOnair24ByIdOnair($res->k_id_onair)->data; //onair24 nuevo elemento
        if ($res->onair24) {
            $res->onair24->k_id_follow_up_24h = $follow24->getfollow24ByIdFollow($res->onair24->k_id_follow_up_24h)->data; //follow up 24
        }
        $res->onair36 = $onair36->getOnair36ByIdOnair($res->k_id_onair)->data; //onair24 nuevo elemento
        if ($res->onair36) {
            $res->onair36->k_id_follow_up_36h = $follow36->getfollow36ByIdFollow($res->onair36->k_id_follow_up_36h)->data; //follow up 24
        }
<<<<<<< HEAD

=======
>>>>>>> e7f4273ba8d3fbc2860584cdcd40e5bbb564aef3
        $response = new Response(EMessages::QUERY);
        $response->setData($res);
        $this->json($response);
    }

    public function insertTicketOnair() {
        $ticket = new dao_ticketOnAir_model();
        $ticketPS = new dao_preparationStage_model();
        $response = $ticketPS->insertPreparationStage($this->request);
        $this->request->k_id_preparation = $response->data->data;
        $response = $ticket->insertTicket($this->request);
        $this->json($response);
    }

    public function getAllStates() {
        $ticket = new dao_ticketOnAir_model();
        $response = $ticket->getAllStates();
        $this->json($response);
    }

    public function updateTicket() {
        $ticket = new dao_ticketOnAir_model();
        $response = $ticket->updateTicket($this->request);
        $this->json($response);
    }

//
//    public function insertTicketOnair() {
//        $ticket = new dao_ticketOnAir_model();
//        $response = $ticket->insertTicket($this->request);
//        $this->json($response);
//    }

    public function assignTicket() {
        $precheck = new dao_precheck_model();
        $ticket = new dao_ticketOnAir_model();
        $response = $precheck->insertPrecheck($this->request);
        $this->request->k_id_precheck = $response->data->data;
        $response = $ticket->updatePrecheckOnair($this->request);
        $this->json($response);
    }

}
