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

    public function getListPrecheckCoordinador() {
        $response = null;
        if (Auth::check()) {
/*            $dao = new dao_precheck_model();
*/            $dao = new dao_ticketOnAir_model();
              $user = new dao_user_model();
/*            $array = $dao->getPrecheckByIdUser();
*/            $array = $dao->getAssign();
            $array->data["pendingList"] = (is_array($array->data["pendingList"])) ? ($this->getFKRegisters($array->data["pendingList"])) : NULL;
            $array->data["assingList"] = (is_array($array->data["assingList"])) ? ($this->getFKRegisters($array->data["assingList"])) : NULL;
            //asigno datos del usuario asignado
            for ($i=0; $i <count($array->data['assingList']) ; $i++) {
                $array->data['assingList'][$i]->i_actualEngineer = $user->findBySingleId($array->data['assingList'][$i]->i_actualEngineer)->data;
                $array->data['assingList'][$i]->i_actualEngineer->n_name_user = $array->data['assingList'][$i]->i_actualEngineer->n_name_user." ".$array->data['assingList'][$i]->i_actualEngineer->n_last_name_user;
            }
            for ($j=0; $j <count($array->data['pendingList']) ; $j++) {
                $array->data['pendingList'][$j]->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
            }
            $this->json($array);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function getFKRegisters($res) {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $stage = new dao_preparationStage_model();
        for ($j = 0; $j < count($res); $j++) {
            $res[$j]->k_id_status_onair = $statusOnair->findById($res[$j]->k_id_status_onair)->data; //Status onair
            $res[$j]->k_id_station = $station->findById($res[$j]->k_id_station)->data; //Station
            $res[$j]->k_id_band = $band->findById($res[$j]->k_id_band)->data; //band
            $res[$j]->k_id_work = $work->findById($res[$j]->k_id_work)->data; //work
            $res[$j]->k_id_technology = $technology->findById($res[$j]->k_id_technology)->data; //technology
            $res[$j]->k_id_preparation = $stage->findByIdPreparation($res[$j]->k_id_preparation)->data; //preparation
        }
        return $res;
    }

    public function doPrecheck(){
      $preparation =  new Dao_preparationStage_model();
      $ticket =new Dao_ticketOnair_model();
      $precheck = new Dao_precheck_model();
      $response = $ticket->findByIdOnAir($this->request->idOnair);
      $this->request->k_id_onair = $this->request->idOnair;
      $this->request->k_id_user = $response->data->i_actualEngineer;
      $this->request->n_round = 1;
      $this->request->i_round = 1;
      $this->request->k_id_ticket = $this->request->k_id_onair;
      //print_r($response);
      //print_r($this->request);
      if($this->request->k_id_status_onair == 81){
        $follow12h = new Dao_followUp12h_model();
        $onair12 = new Dao_onAir12h_model();
        $response = $follow12h->insert12hFollowUp($this->request);
        $this->request->k_id_follow_up_12h = $response->data->data;
        $this->request->d_start12h = Hash::getDate();
        $response = $onair12->insertOnAir12($this->request);
        $this->request->d_finpre = Hash::getDate();
        $response = $preparation->updatePreparationStage($this->request)->data;
        $response1 = $ticket->updateStatusTicket($this->request->idOnair, 81)->data;
        $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data;//camilo
        $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data;//camilo
        $repsonse2 = $precheck->updatePrecheckCom($this->request)->data;//camilo
        $this->json($response);
      }
      if($this->request->k_id_status_onair == 82){
        $follow24h = new Dao_followUp24h_model();
        $onair24 = new Dao_onAir24h_model();
        $response = $follow24h->insert24hFollowUp($this->request);
        $this->request->k_id_follow_up_24h = $response->data->data;
        $this->request->d_start24h = Hash::getDate();
        $response = $onair24->insertOnAir24($this->request);
        $this->request->d_finpre = Hash::getDate();
        $response = $preparation->updatePreparationStage($this->request)->data;
        $response1 = $ticket->updateStatusTicket($this->request->idOnair, 82)->data;
        $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data;//camilo
        $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data;//camilo
        $repsonse2 = $precheck->updatePrecheckCom($this->request)->data;//camilo
        $this->json($response);
      }
      if($this->request->k_id_status_onair == 83){
        $follow36h = new Dao_followUp36h_model();
        $onair36 = new Dao_onAir36h_model();
        $response = $follow36h->insert36hFollowUp($this->request);
        $this->request->k_id_follow_up_36h = $response->data->data;
        $this->request->d_start36h = Hash::getDate();
        $response = $onair36->insertOnAir36($this->request);
        $this->request->d_finpre = Hash::getDate();
        $response = $preparation->updatePreparationStage($this->request)->data;
        $response1 = $ticket->updateStatusTicket($this->request->idOnair, 83)->data;
        $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data;//camilo
        $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data;//camilo
        $repsonse2 = $precheck->updatePrecheckCom($this->request)->data;//camilo
        $this->json($response);
      }
      // $this->request->d_finpre = Hash::getDate();
      // $response = $preparation->updatePreparationStage($this->request)->data;
      // $response1 = $ticket->updatePrecheckStatus($this->request->k_id_preparation)->data;//camilo
      // $response1 = $ticket->updateRoundTicket($this->request->idOnair, 1)->data;//camilo
      // $repsonse2 = $precheck->updatePrecheckCom($this->request)->data;//camilo
      // $this->json($response);
    }

}
