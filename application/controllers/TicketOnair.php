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
        $this->load->model('data/Dao_user_model');
    }

    public function prueba() {

        $tick = new Dao_ticketOnair_model();
        $response = $tick->registerReportComment(19);
        $this->json($response);
    }

    public function listTicketOnair() {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $assign = new dao_user_model();
        $stage = new dao_preparationStage_model();
        $res = $ticketsOnAir->getAll($this->request);
        for ($j = 0; $j < count($res->data); $j++) {
            $res->data[$j]->k_id_status_onair = $statusOnair->findById($res->data[$j])->data; //Status onair
            $res->data[$j]->k_id_station = $station->findById($res->data[$j]->k_id_station)->data; //Station
            $res->data[$j]->k_id_band = $band->findById($res->data[$j]->k_id_band)->data; //band
            $res->data[$j]->k_id_work = $work->findById($res->data[$j]->k_id_work)->data; //work
            $res->data[$j]->k_id_technology = $technology->findById($res->data[$j]->k_id_technology)->data; //technology
            $res->data[$j]->k_id_preparation = $stage->findByIdPreparation($res->data[$j]->k_id_preparation)->data; //preparation

            if ($res->data[$j]->i_actualEngineer != 0) {
                $res->data[$j]->i_actualEngineer = $assign->findBySingleId($res->data[$j]->i_actualEngineer)->data; //
                $res->data[$j]->i_actualEngineer = $res->data[$j]->i_actualEngineer->n_name_user . " " . $res->data[$j]->i_actualEngineer->n_last_name_user;
            } elseif ($res->data[$j]->i_actualEngineer == 0) {
                $res->data[$j]->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
            }
        }
        $this->json($res);
    }

    public function getPriorityList() {
        $response = null;
        if (Auth::check()) {
            $dao = new dao_ticketOnAir_model();
            $array = $dao->getPriorityList($this->request);
            $this->getFKRegisters($array->data["data"], true);
            $this->json($array->data);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function getTracingList() {
        $response = null;
        if (Auth::check()) {
            $dao = new dao_ticketOnAir_model();
            $array = $dao->getTracingList($this->request);
            $this->getFKRegisters($array->data["data"], true);
            $this->json($array->data);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function updateTicketDetails() {
        $dao = new Dao_ticketOnair_model();
        $response = $dao->updateTicketDetails($this->request);
        $this->json($response);
    }

    public function getRestartList() {
        $response = null;
        if (Auth::check()) {
            $dao = new dao_ticketOnAir_model();
            $array = $dao->getRestartList($this->request);
            $this->getFKRegisters($array->data["data"], true);
            $this->json($array->data);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function getListTicketDocumentador() {
        $response = null;
        if (Auth::check()) {
            $dao = new dao_ticketOnAir_model();
            $user = new dao_user_model();
            $array = $dao->getPriorityRestartAndTracing();
            $array->data["priorityList"] = (is_array($array->data["priorityList"])) ? ($this->getFKRegisters($array->data["priorityList"])) : NULL;
            $array->data["tracingList"] = (is_array($array->data["tracingList"])) ? ($this->getFKRegisters($array->data["tracingList"])) : NULL;
            $array->data["restartList"] = (is_array($array->data["restartList"])) ? ($this->getFKRegisters($array->data["restartList"])) : NULL;
            //asigno datos del usuario asignado
//            for ($i = 0; $i < count($array->data['priorityList']); $i++) {
//                if ($array->data['priorityList'][$i]->i_actualEngineer != 0) {
//                    $array->data['priorityList'][$i]->i_actualEngineer = $user->findBySingleId($array->data['priorityList'][$i]->i_actualEngineer)->data;
//                    $array->data['priorityList'][$i]->i_actualEngineer->n_name_user = $array->data['priorityList'][$i]->i_actualEngineer->n_name_user . " " . $array->data['priorityList'][$i]->i_actualEngineer->n_last_name_user;
//                } elseif ($array->data['priorityList'][$i]->i_actualEngineer == 0) {
//                    $array->data['priorityList'][$i]->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
//                }
//            }
//            for ($i = 0; $i < count($array->data['tracingList']); $i++) {
//                if ($array->data['tracingList'][$i]->i_actualEngineer != 0) {
//                    $array->data['tracingList'][$i]->i_actualEngineer = $user->findBySingleId($array->data['tracingList'][$i]->i_actualEngineer)->data;
//                    $array->data['tracingList'][$i]->i_actualEngineer->n_name_user = $array->data['tracingList'][$i]->i_actualEngineer->n_name_user . " " . $array->data['tracingList'][$i]->i_actualEngineer->n_last_name_user;
//                } elseif ($array->data['tracingList'][$i]->i_actualEngineer == 0) {
//                    $array->data['tracingList'][$i]->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
//                }
//            }
//            for ($i = 0; $i < count($array->data['restartList']); $i++) {
//                if ($array->data['restartList'][$i]->i_actualEngineer != 0) {
//                    $array->data['restartList'][$i]->i_actualEngineer = $user->findBySingleId($array->data['restartList'][$i]->i_actualEngineer)->data;
//                    $array->data['restartList'][$i]->i_actualEngineer->n_name_user = $array->data['restartList'][$i]->i_actualEngineer->n_name_user . " " . $array->data['restartList'][$i]->i_actualEngineer->n_last_name_user;
//                } elseif ($array->data['restartList'][$i]->i_actualEngineer == 0) {
//                    $array->data['restartList'][$i]->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
//                }
//            }
            $this->json($array);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function getFKRegisters(&$res, $flag = null) {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $stage = new dao_preparationStage_model();
        $assign = new dao_user_model();
        for ($j = 0; $j < count($res); $j++) {
            if ($flag == true) {
                $daoAutoRecord = new Dao_autorecord_model();
                $daoAutoRecord->record($res[$j]);
            }
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

    public function ticketUser() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }

        $response = null;
        if (Auth::check()) {
            $dao = new dao_ticketOnAir_model();
            $array = $dao->getIngenerList($this->request);
            $this->getFKRegisters($array->data["data"], true);
            $this->json($array->data);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function toStandBy() {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $response = $ticketsOnAir->toStandBy($this->request->idTicket, $this->request);
        $this->json($response);
    }

    public function quitStandBy() {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $response = $ticketsOnAir->stopStandBy($this->request->idTicket, $this->request);
        $this->json($response);
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
        $assign = new dao_user_model();
        if (!$res) {
            $this->json(new Response(EMessages::NO_FOUND_REGISTERS));
            return;
        }
        $res->k_id_preparation = $preparatinStage->findByIdPreparation($res->k_id_preparation)->data;
        $res->k_id_band = $band->findById($res->k_id_band)->data; //band
//        var_dump($assign)
        $res->k_id_status_onair = $statusOnair->findById($res->k_id_status_onair)->data; //Status onair
//        if(!$res->k_id_station){
//            var_dump($res);
//        }
        $res->k_id_station = $station->findById($res->k_id_station)->data; //Station
        $res->k_id_work = $work->findById($res->k_id_work)->data; //work
        $res->k_id_technology = $technology->findById($res->k_id_technology)->data; //technology
        $res->scaledOnair = $scaledOnair->getScaledByTicket($res->k_id_onair)->data; //scaledOnair nuevo elemento
        $res->k_id_precheck = $precheck->getPrecheckByIdPrech($res->k_id_precheck)->data; //precheck

        if ($res->i_actualEngineer != 0) {
            $res->i_actualEngineer = $assign->findBySingleId($res->i_actualEngineer)->data; //
            $res->i_actualEngineer = $res->i_actualEngineer->n_name_user . " " . $res->i_actualEngineer->n_last_name_user;
        } elseif ($res->i_actualEngineer == 0) {
            $res->i_actualEngineer = "PENDIENTE POR ASIGNAR";
        }



        $response = new Response(EMessages::QUERY);
        $response->setData($res);
        $this->json($response);
    }

    public function insertTicketOnair() {
        $related_tickets = json_decode($this->request->related_tickets);
        $ticket = new dao_ticketOnAir_model();
        $ticketPS = new dao_preparationStage_model();
        //camilo se envia semana actual y fecha de creacion
        $this->request->i_week = Hash::getDate();
        $this->request->d_asignacion_final = Hash::getDate();
        $this->request->i_week = Date("W");
        $this->request->b_vistamm = "True";
        $response = $ticketPS->insertPreparationStage($this->request);
        $this->request->k_id_preparation = $response->data->data;
        $this->request->i_actualEngineer = 0;
        $this->request->d_created_at = Hash::getDate();
        $response = $ticket->insertTicket($this->request);

        //Ahora insertamos las relaciones...
        if ($related_tickets && $response->code > 0) {
            foreach ($related_tickets as $id) {
                //Creamos la relación del ticket creado con el ticket relacionado...
                $relatedTicketsModel = new RelatedTicketsModel();
                $relatedTicketsModel->setKIdTicket1($response->data->data);
                $relatedTicketsModel->setKIdTicket2($id);
                $relatedTicketsModel->setKIdUserCreator(Auth::user()->k_id_user);
                $relatedTicketsModel->setDCreated(Hash::getDate());
                $relatedTicketsModel->save();

                //Creamos las relaciones entre el ticketrelacionado con el ticket creado.
                $relatedTicketsModel = new RelatedTicketsModel();
                $relatedTicketsModel->setKIdTicket1($id);
                $relatedTicketsModel->setKIdTicket2($response->data->data);
                $relatedTicketsModel->setKIdUserCreator(Auth::user()->k_id_user);
                $relatedTicketsModel->setDCreated(Hash::getDate());
                $relatedTicketsModel->save();

                //Creamos las relaciones entre tikcets relacionados...
                $this->createRelationsTickets($id, $related_tickets);
            }
        }
        $this->json($response);
    }

    private function createRelationsTickets($idTicket, $related_tickets) {
        foreach ($related_tickets as $id) {
            if ($id != $idTicket) {
                $relatedTicketsModel = new RelatedTicketsModel();
                $exist = $relatedTicketsModel->where("k_id_ticket1", "=", $idTicket)
                                ->where("k_id_ticket2", "=", $id)->exist();
                if (!$exist) {
                    $relatedTicketsModel = new RelatedTicketsModel();
                    $relatedTicketsModel->setKIdTicket1($idTicket);
                    $relatedTicketsModel->setKIdTicket2($id);
                    $relatedTicketsModel->setKIdUserCreator(Auth::user()->k_id_user);
                    $relatedTicketsModel->setDCreated(Hash::getDate());
                    $relatedTicketsModel->save();
                }
            }
        }
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

    public function getGroups() {
        $ticket = new dao_ticketOnAir_model();
        $response = $ticket->getGroups(1);
        $this->json($response);
    }

    public function getProcessTicket() {
        $ticket = new Dao_ticketOnAir_model();
        $response = $ticket->getProcessTicket($this->request);
        $this->json($response);
    }

    public function createProrroga() {
        $ticket = new Dao_ticketOnair_model();
        $response = $ticket->createProrroga($this->request);
        $this->json($response);
    }

    public function getStatesProduction() {
        $ticket = new Dao_ticketOnair_model();
        $response = $ticket->getStatesProduction($this->request);
        $this->json($response);
    }

    public function toProduction() {
        $ticket = new Dao_ticketOnair_model();
        $response = $ticket->toProduction($this->request);
        $this->json($response);
    }

    public function nextFase() {
        $ticket = new Dao_ticketOnair_model();
        $response = $ticket->nextFase($this->request);
        $this->json($response);
    }

//
//    public function insertTicketOnair() {
//        $ticket = new dao_ticketOnAir_model();
//        $response = $ticket->insertTicket($this->request);
//        $this->json($response);
//    }

    public function assignTicket() {
        $precheck = new Dao_precheck_model();
        $ticket = new Dao_ticketOnAir_model();
        $response = $ticket->findByIdOnAir($this->request->k_id_ticket);
        $ticketOnAirTemp = $response->data;

        if (!$ticketOnAirTemp) {
            return $this->json(new Response(EMessages::ERROR, "El ticket no existe."));
        }
        //Corregimos los probables errores de data externa...
        $autoRecordDao = new Dao_autorecord_model();
        $autoRecordDao->record($ticketOnAirTemp);

        //JJ: Se actualiza las observaciones de asignación...
        $tempTicket = new TicketOnAirModel();
        $tempTicket->setNComentarioCoor($this->request->n_comentario_coor);
        $tempTicket->where("k_id_onair", "=", $this->request->k_id_ticket);
        $tempTicket->update();

        $flag = 0;
        //Camilo: agrega fecha cada vez que se asigna alguien en tb ticket onair
        $this->request->n_reviewedfo = Hash::getDate();
        //Se cormprueba si es reinicio precheck...
        //Reinicio Precheck = 80 && Reinicio 12H = 79
        if ($ticketOnAirTemp->k_id_status_onair == 97 || $ticketOnAirTemp->k_id_status_onair == 80) {
//            $this->request->d_precheck_init = ($ticketOnAirTemp->k_id_status_onair == 79) ? null : Hash::getDate();
            $this->request->d_precheck_init = null;
            $response = $precheck->insertPrecheck($this->request);
            $this->request->k_id_precheck = $response->data->data;
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $idStatus = 97;
            if ($ticketOnAirTemp->k_id_status_onair == 80) {
                $idStatus = 80;
            }
            $response = $ticket->updatePrecheckOnair($this->request, $idStatus);
            $this->json($response);
            $flag = 1;
        }

        //Precheck.
        if ($flag == 0 && $ticketOnAirTemp->k_id_status_onair == 78) {
            $ticketModel = new TicketOnAirModel();
            $ticketModel->where("k_id_onair", "=", $ticketOnAirTemp->k_id_onair)
                    ->update([
                        "i_actualEngineer" => $this->request->k_id_user
            ]);
            $this->json(new Response(EMessages::SUCCESS, "Se ha asignado el usuario correctamente."));
            $flag = 1;
        }

        //12h
        if ($flag == 0 && $ticketOnAirTemp->k_id_status_onair == 81 || $ticketOnAirTemp->k_id_status_onair == 79) {
            $track12 = new dao_onAir12h_model();
            $follow12 = new dao_followUp12h_model();
            $response = $track12->getOnair12ByIdOnairAndRound($ticketOnAirTemp->k_id_onair, $ticketOnAirTemp->n_round);
            if (!$response->data) {
                $idFollow = $track12->insertOnAir12(new ObjUtil([
                    "d_start12h" => $ticketOnAirTemp->d_fecha_ultima_rev,
                    "i_timestamp" => 0,
                    "k_id_onair" => $ticketOnAirTemp->k_id_onair,
                    "i_round" => $ticketOnAirTemp->n_round,
                    "i_percent" => 0,
                    "i_state" => 0,
                    "i_hours" => 0,
                ]));
                $this->request->k_id_follow_up_12h = $idFollow->data->data;
            } else {
                $this->request->k_id_follow_up_12h = $response->data->k_id_follow_up_12h;
            }
            $response = $follow12->update12FollowUp($this->request);
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $idStatus = 81;
            if ($ticketOnAirTemp->k_id_status_onair == 79) {
                $idStatus = 79;
            }
            $response = $ticket->updatePrecheckOnair($this->request, $idStatus);
            $this->json($response);
            $flag = 1;
        }

        //24h
        if ($flag == 0 && $ticketOnAirTemp->k_id_status_onair == 82 || $ticketOnAirTemp->k_id_status_onair == 108) {
            $track24 = new dao_onAir24h_model();
            $follow24 = new dao_followUp24h_model();
            $response = $track24->getOnair24ByIdOnairAndRound($ticketOnAirTemp->k_id_onair, $ticketOnAirTemp->n_round);
            if (!$response->data) {
                $idFollow = $track24->insertOnAir24(new ObjUtil([
                    "d_start24h" => $ticketOnAirTemp->d_fecha_ultima_rev,
                    "i_timestamp" => 0,
                    "k_id_onair" => $ticketOnAirTemp->k_id_onair,
                    "i_round" => $ticketOnAirTemp->n_round,
                    "i_percent" => 0,
                    "i_state" => 0,
                    "i_hours" => 0,
                ]));
                $this->request->k_id_follow_up_24h = $idFollow->data->data;
            } else {
                $this->request->k_id_follow_up_24h = $response->data->k_id_follow_up_24h;
            }
            $response = $follow24->update24FollowUp($this->request);
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $idStatus = 82;
            if ($ticketOnAirTemp->k_id_status_onair == 108) {
                $idStatus = 108;
            }
            $response = $ticket->updatePrecheckOnair($this->request, $idStatus);
            $this->json($response);
            $flag = 1;
        }

        //36h
        if ($flag == 0 && $ticketOnAirTemp->k_id_status_onair == 83 || $ticketOnAirTemp->k_id_status_onair == 109) {
            $track36 = new dao_onAir36h_model();
            $follow36 = new dao_followUp36h_model();
            $response = $track36->getOnair36ByIdOnairAndRound($ticketOnAirTemp->k_id_onair, $ticketOnAirTemp->n_round);
            if (!$response->data) {
                $idFollow = $track36->insertOnAir36(new ObjUtil([
                    "d_start36h" => $ticketOnAirTemp->d_fecha_ultima_rev,
                    "i_timestamp" => 0,
                    "k_id_onair" => $ticketOnAirTemp->k_id_onair,
                    "i_round" => $ticketOnAirTemp->n_round,
                    "i_percent" => 0,
                    "i_state" => 0,
                    "i_hours" => 0,
                ]));
                $this->request->k_id_follow_up_36h = $idFollow->data->data;
            } else {
                $this->request->k_id_follow_up_36h = $response->data->k_id_follow_up_36h;
            }
            $response = $follow36->update36FollowUp($this->request);
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $idStatus = 83;
            if ($ticketOnAirTemp->k_id_status_onair == 109) {
                $idStatus = 109;
            }
            $response = $ticket->updatePrecheckOnair($this->request, $idStatus);
            $this->json($response);
            $flag = 1;
        }

        //STAND BY...
        $actualizar_fecha_ultima_revision = false;
        if ($flag == 0 && $ticketOnAirTemp->k_id_status_onair == 100) {
            $ticket->stopStandBy($ticketOnAirTemp, $this->request);
            //Detectamos el estado actual...
            $obj = $ticket->getStepModel($ticketOnAirTemp);
            if ($obj) {
                $step = $obj->stepModel
                                ->where("k_id_onair", "=", $ticketOnAirTemp->k_id_onair)
                                ->where("i_hours", "=", $ticketOnAirTemp->i_hours)->first();
                if ($step) {
                    $idFollow = $step->{$obj->k_id_follow};
                    $idUser = $this->request->k_id_user;
                    $ticket->updateFollow($ticketOnAirTemp, $idFollow, $idUser);
                }
            }
            $ticketModel = new TicketOnAirModel();
            $ticketModel->where("k_id_onair", "=", $ticketOnAirTemp->k_id_onair)
                    ->update([
                        "i_actualEngineer" => $this->request->k_id_user
            ]);
//            $this->request->n_comentario_coor = "Se detiene el Stand By --- " . $this->request->n_comentario_coor;
            $this->json(new Response(EMessages::SUCCESS, "Se ha asignado y detenido el Stand by correctamente."));
            $flag = 1;
            $actualizar_fecha_ultima_revision = false;
        }

        if ($flag == 0) {
            $this->json(new Response(EMessages::ERROR, "Verifique el estado del proceso ya que no se puede realizar una asignación."));
        }

        if ($flag == 1) {
            if ($actualizar_fecha_ultima_revision) {
                $ticket->registerReportComment($ticketOnAirTemp->k_id_onair, $this->request->n_comentario_coor);
            }
        }
    }

    public function createScaling() {
        $scaling = new Dao_scaledOnair_model();
        $ticket = new Dao_ticketOnair_model();
        //Se busca el ticket...
        $response = $ticket->findByIdOnAir($this->request->k_id_onair)->data;
        //Se actualiza la fecha final de la fase actual...
        $ticket->updateEndDateFase($response);
        $this->request->n_round = $response->n_round;
        //Se inserta el escalamiento...
        $response = $scaling->insertScaling($this->request);
        $this->request->n_round = $this->request->n_round + 1;
        //Se actualiza la ronda del ticket.
        $response = $ticket->updateRoundTicket($this->request->k_id_onair, $this->request->n_round, $this->request);
        //Se actualiza el ticket en escalamiento...
        $response = $ticket->updateTicketScaling($this->request);
        //Se registra el comentario...
        $ticket->registerReportComment($this->request->k_id_onair, $this->request->n_comentario_esc . " - Solicitado por: " . $this->request->n_responsable_ticket);
        //Se envian todos los tickets relacionados al ticket que se esta escalando a StandBy.
        $this->sendRelatedTicketsToStandBy($this->request->k_id_onair);
        $this->json($response);
    }

    public function sendRelatedTicketsToStandBy($idTicket) {
        $response = new Response(EMessages::UPDATE);
        //Consultamos los tickets relacionados...
        $db = new DB();
        $data = $db->select("select tck.*, rt.k_id_related_ticket from ticket_on_air tck inner join related_tickets rt on rt.k_id_ticket2 = tck.k_id_onair or rt.k_id_ticket2 = tck.k_id_onair where rt.k_id_ticket1 = $idTicket")->get();
        //Se envian todos los tickets relacionados a standby...
        foreach ($data as $ticket) {
            if ($ticket->k_id_onair != $idTicket) {
                $ticketsOnAir = new dao_ticketOnAir_model();
                $ticketsOnAir->toStandBy($ticket, $this->request);
            }
        }
    }

    public function recordRestart() {
        $scaling = new Dao_scaledOnair_model();
        $follow12h = new Dao_followUp12h_model();
        $onair12 = new Dao_onAir12h_model();
        $follow24h = new Dao_followUp24h_model();
        $onair24 = new Dao_onAir24h_model();
        $follow36h = new Dao_followUp36h_model();
        $onair36 = new Dao_onAir36h_model();
        $ticket = new Dao_ticketOnair_model();
        //Verifica que se haya recibido correctamente el id de escalamiento...
        if ($this->request->k_id_scaled_on_air != null) {
            //Actualiza alguna información del registro de escalamiento...
            $response = $scaling->updateScaling($this->request);
//            $follow12h = new Dao_followUp12h_model();
//            $onair12 = new Dao_onAir12h_model();
//            $ticket = new Dao_ticketOnair_model();
            //Busca el ticket...
            $response = $ticket->findByIdOnAir($this->request->k_id_onair)->data;
            //Asigna al request la ronda del ticket...
            $this->request->n_round = $response->n_round;
            $this->request->i_round = $response->n_round;
            //Inserta el responsable del seguimiento 12h...
            //Tratamiento de reinicio 12h
            if ($this->request->k_id_status_onair == 79) {
                $response = $follow12h->insert12hFollowUp($this->request);
                $this->request->k_id_follow_up_12h = $response->data->data;
                $this->request->d_start12h = Hash::getDateForTrack(TimerGlobal::TRACK);
                if ($this->request->k_id_status_onair >= 87 && $this->request->k_id_status_onair <= 105) {
                    $this->request->d_fin12h = Hash::getDateForTrack(TimerGlobal::TRACK);
                }
                $response = $onair12->insertOnAir12($this->request);
            }
            //Tratamiento de reinicio 24h
            if ($this->request->k_id_status_onair == 108) {
                $response = $follow24h->insert24hFollowUp($this->request);
                $this->request->k_id_follow_up_24h = $response->data->data;
                $this->request->d_start24h = Hash::getDateForTrack(TimerGlobal::TRACK);
                if ($this->request->k_id_status_onair >= 87 && $this->request->k_id_status_onair <= 105) {
                    $this->request->d_fin24h = Hash::getDateForTrack(TimerGlobal::TRACK);
                }
                $response = $onair->insertOnAir36($this->request);
            }
            //Tratamiento de reinicio 36h
            if ($this->request->k_id_status_onair == 109) {
                $response = $follow36h->insert36hFollowUp($this->request);
                $this->request->k_id_follow_up_36h = $response->data->data;
                $this->request->d_start36h = Hash::getDateForTrack(TimerGlobal::TRACK);
                if ($this->request->k_id_status_onair >= 87 && $this->request->k_id_status_onair <= 105) {
                    $this->request->d_fin36h = Hash::getDateForTrack(TimerGlobal::TRACK);
                }
                $response = $onair36->insertOnAir36($this->request);
            }
        } else {
            $response = $scaling->insertScaling($this->request);
        }


        //Inserta el precheck...
        $this->request->d_precheck_init = DB::NULLED;
        $this->request->i_prorroga_hours = 0;
        if ($this->request->k_id_status_onair == 80) {
            $this->request->i_precheck_realizado = DB::NULLED;
        }
        //Actualiza algunos campos y la fecha correcciones_pendientes en prepartion_stage...
        $response = $ticket->updateTicketScaling($this->request);
        //Registra el comentario...
        $ticket->registerReportComment($this->request->k_id_onair, $this->request->n_detalle_solucion, $this->request->solicitante_reinicio);
        $this->json($response);
    }

    public function restart12h() {
        $ticketOnAirDAO = new Dao_ticketOnair_model();
        $response = $ticketOnAirDAO->restart12h($this->request);
        $this->json($response);
    }

    public function restart24h() {
        $ticketOnAirDAO = new Dao_ticketOnair_model();
        $response = $ticketOnAirDAO->restart24h($this->request);
        $this->json($response);
    }

    public function restart36h() {
        $ticketOnAirDAO = new Dao_ticketOnair_model();
        $response = $ticketOnAirDAO->restart36h($this->request);
        $this->json($response);
    }

    public function getSectores() {
        $ticketOnAirDAO = new Dao_ticketOnair_model();
        $response = $ticketOnAirDAO->getSectores($this->request);
        $this->json($response);
    }

    public function getCommentsTicket() {
        $ticketOnAirDAO = new Dao_ticketOnair_model();
        $response = $ticketOnAirDAO->getCommentsTicket($this->request);
        $this->json($response);
    }

}
