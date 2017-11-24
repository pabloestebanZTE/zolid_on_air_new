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
            $this->getFKRegisters($array->data["data"]);
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
            $this->getFKRegisters($array->data["data"]);
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
            $this->getFKRegisters($array->data["data"]);
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
                $res[$j]->i_actualEngineer = $res[$j]->i_actualEngineer->n_name_user . " " . $res[$j]->i_actualEngineer->n_last_name_user;
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
        $ticket = new TicketOnAirModel();
        $data = $ticket->Where("i_actualEngineer", "=", Auth::user()->k_id_user)->get();
        $data = $this->getFKRegisters($data);
        $response = new Response(EMessages::QUERY);
        $response->setData($data);
        $this->json($response);
        // $precheck = new dao_precheck_model();
        // $ticket = new dao_ticketOnair_model();
        // $ticketsOnAir = new dao_ticketOnAir_model();
        // $station = new dao_station_model();
        // $band = new dao_band_model();
        // $work = new dao_work_model();
        // $technology = new dao_technology_model();
        // $statusOnair = new dao_statusOnair_model();
        // $stage = new dao_preparationStage_model();
        // $assign = new dao_user_model();
        // $userId = Auth::user()->k_id_user;
        // $respuesta = [];
        // $res = [];
        // $flag = [];
        //
        //
        //
        //
        // $precheckId = $precheck->getPrecheckById($userId)->data;
        // for ($j = 0; $j < count($precheckId); $j++) {
        //     $res = $ticket->findByIdPrecheck($precheckId[$j]->k_id_precheck);
        //     // $res->data->k_id_band = $band->findById($res->data->k_id_band)->data;//band
        //     // $res->data->k_id_status_onair = $statusOnair->findById($res->data->k_id_status_onair)->data;//Status onair
        //     // $res->data->k_id_station = $station->findById($res->data->k_id_station)->data;//Station
        //     // $res->data->k_id_work = $work->findById($res->data->k_id_work)->data;//work
        //     // $res->data->k_id_technology = $technology->findById($res->data->k_id_technology)->data;//technology
        //     $respuesta[$j] = $res->data;
        // }
        // // print_r($respuesta);//ticket precheck
        // $follow12 = new dao_followUp12h_model();
        // $onair12 = new dao_onAir12h_model();
        // $ticket12 = new dao_ticketOnAir_model();
        // $res2 = $follow12->getfollow12ById($userId)->data;
        // for ($i = 0; $i < count($res2); $i++) {
        //     $res2[$i] = $onair12->getOnair12ByFollow($res2[$i]->k_id_follow_up_12h)->data;
        //     $res = $ticket12->findByIdOnAir($res2[$i]->k_id_onair);
        //     $respuesta[$j + $i] = $res->data;
        // }
        // // print_r($respuesta);//ticket prechek+12h
        // $follow24 = new dao_followUp24h_model();
        // $onair24 = new dao_onAir24h_model();
        // $ticket24 = new dao_ticketOnAir_model();
        // $res24 = $follow24->getfollow24ById($userId)->data;
        // for ($f = 0; $f < count($res24); $f++) {
        //     $resp[$f] = $onair24->getOnair24ByFollow($res24[$f]->k_id_follow_up_24h)->data;
        //     $respuesta[$j + $i + $f] = $res->data;
        // }
        // // print_r($respuesta);//ticket precheck+12+24
        // $follow36 = new dao_followUp36h_model();
        // $onair36 = new dao_onAir36h_model();
        // $ticket36 = new dao_ticketOnAir_model();
        // $res36 = $follow36->getfollow36ById($userId)->data;
        // for ($g = 0; $g < count($res36); $g++) {
        //     $respu[$g] = $onair36->getOnair36ByFollow($res36[$g]->k_id_follow_up_36h)->data;
        //     $respuesta[$j + $i + $f + $g] = $res->data;
        // }
        // //  print_r($respuesta);//ticket precheck+12+24+36
        // for ($r = 0; $r < count($respuesta); $r++) {
        //     $flag[] = $respuesta[$r]->k_id_onair;
        // }
        // $unique = array_unique($flag);
        // $final = array_values($unique);
        // $ticketUnic = new dao_ticketOnAir_model();
        // $ticketUser = [];
        // for ($t = 0; $t < count($final); $t++) {
        //     $ticketUser[$t] = $ticketUnic->findByIdOnAir($final[$t])->data;
        //     $ticketUser[$t]->k_id_band = $band->findById($ticketUser[$t]->k_id_band)->data; //band
        //     $ticketUser[$t]->k_id_status_onair = $statusOnair->findById($ticketUser[$t])->data; //Status onair
        //     $ticketUser[$t]->k_id_station = $station->findById($ticketUser[$t]->k_id_station)->data; //Station
        //     $ticketUser[$t]->k_id_work = $work->findById($ticketUser[$t]->k_id_work)->data; //work
        //     $ticketUser[$t]->k_id_technology = $technology->findById($ticketUser[$t]->k_id_technology)->data; //technology
        //     $ticketUser[$t]->k_id_preparation = $stage->findByIdPreparation($ticketUser[$t]->k_id_preparation)->data; //preparation
        //     if ($ticketUser[$t]->i_actualEngineer != 0) {
        //         $ticketUser[$t]->i_actualEngineer = $assign->findBySingleId($ticketUser[$t]->i_actualEngineer)->data; //
        //         $ticketUser[$t]->i_actualEngineer = $ticketUser[$t]->i_actualEngineer->n_name_user . " " . $ticketUser[$t]->i_actualEngineer->n_last_name_user;
        //     } elseif ($ticketUser[$t]->i_actualEngineer == 0) {
        //         $ticketUser[$t]->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
        //     }
        // }
        // $response = new Response(EMessages::QUERY);
        // $response->setData($ticketUser);
        // $this->json($response);
        // header('Content-Type: text/plain');
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
        $response = new Response(EMessages::QUERY);
        $response->setData($res);
        $this->json($response);
    }

    public function insertTicketOnair() {
        $ticket = new dao_ticketOnAir_model();
        $ticketPS = new dao_preparationStage_model();
        //camilo se envia semana actual y fecha de creacion
        $this->request->i_week = Hash::getDate();
        $this->request->d_asignacion_final = Hash::getDate();
        $this->request->i_week = Date("W");
        $response = $ticketPS->insertPreparationStage($this->request);
        $this->request->k_id_preparation = $response->data->data;
        $this->request->i_actualEngineer = 0;
        $this->request->d_created_at = Hash::getDate();
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
        $flag = 0;
        //Camilo: agrega fecha cada vez que se asigna alguien en tb ticket onair
        $this->request->n_reviewedfo = Hash::getDate();
        $this->request->d_precheck_init = Hash::getDate();
        if ($response->data->k_id_status_onair == 97 || $response->data->k_id_status_onair == 80) {
            $response = $precheck->insertPrecheck($this->request);
            $this->request->k_id_precheck = $response->data->data;
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $response = $ticket->updatePrecheckOnair($this->request, 78);
            $this->json($response);
            $flag = 1;
        }
        if ($flag == 0 && $response->data->k_id_status_onair == 81 || $response->data->k_id_status_onair == 79) {
            $track12 = new dao_onAir12h_model();
            $follow12 = new dao_followUp12h_model();
            $response = $track12->getOnair12ByIdOnairAndRound($response->data->k_id_onair, $response->data->n_round);
            if (!$response->data) {
                $this->json(new Response(EMessages::ERROR, "El proceso no existe, o no se creó correctamente."));
                return;
            }
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $this->request->k_id_follow_up_12h = $response->data->k_id_follow_up_12h;
            $response = $follow12->update12FollowUp($this->request);
            $response = $ticket->updatePrecheckOnair($this->request, 81);
            $this->json($response);
            $flag = 1;
        }



        if ($flag == 0 && $response->data->k_id_status_onair == 78) {
            $ticketModel = new TicketOnAirModel();
            $ticketModel->where("k_id_onair", "=", $response->data->k_id_onair)
                    ->update([
                        "i_actualEngineer" => $this->request->k_id_user
            ]);
            $this->json(new Response(EMessages::SUCCESS, "Se ha asignado el usuario correctamente."));
            $flag = 1;
        }


        if ($flag == 0 && $response->data->k_id_status_onair == 82) {
            $track24 = new dao_onAir24h_model();
            $follow24 = new dao_followUp24h_model();
            $response = $track24->getOnair24ByIdOnairAndRound($response->data->k_id_onair, $response->data->n_round);
            if (!$response->data) {
                $this->json(new Response(EMessages::ERROR, "El proceso no existe, o no se creó correctamente."));
                return;
            }
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $this->request->k_id_follow_up_24h = $response->data->k_id_follow_up_24h;
            $response = $follow24->update24FollowUp($this->request);
            $response = $ticket->updatePrecheckOnair($this->request, 82);
            $this->json($response);
            $flag = 1;
        }

        if ($flag == 0 && $response->data->k_id_status_onair == 83) {
            $track36 = new dao_onAir36h_model();
            $follow36 = new dao_followUp36h_model();
            $response = $track36->getOnair36ByIdOnairAndRound($response->data->k_id_onair, $response->data->n_round);
            if (!$response->data) {
                $this->json(new Response(EMessages::ERROR, "El proceso no existe, o no se creó correctamente."));
                return;
            }
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $this->request->k_id_follow_up_36h = $response->data->k_id_follow_up_36h;
            $response = $follow36->update36FollowUp($this->request);
            $response = $ticket->updatePrecheckOnair($this->request, 83);
            $this->json($response);
            $flag = 1;
        }

        //STAND BY...
        if ($flag == 0 && $response->data->k_id_status_onair == 100) {
            $ticket->stopStandBy($response->data, $this->request);
            //Detectamos el estado actual...
            $obj = $ticket->getStepModel($response->data);
            if ($obj) {
                $step = $obj->stepModel
                                ->where("k_id_onair", "=", $response->data->k_id_onair)
                                ->where("i_hours", "=", $response->data->i_hours)->first();
                if ($step) {
                    $idFollow = $step->{$obj->k_id_follow};
                    $idUser = $this->request->k_id_user;
                    $ticket->updateFollow($response->data, $idFollow, $idUser);
                }
            }
            $this->json(new Response(EMessages::SUCCESS, "Se ha asignado y detenido el Stand by correctamente."));
            $flag = 1;
        }

        if ($flag == 0) {
            $this->json(new Response(EMessages::ERROR, "Verifique el estado del proceso ya que no se puede realizar una asignación."));
        }

        $ticket->registerReportComment($ticketOnAirTemp->k_id_onair, $this->request->n_comentario_coor);
    }

    public function createScaling() {
        $scaling = new Dao_scaledOnair_model();
        $ticket = new Dao_ticketOnair_model();
        $response = $ticket->findByIdOnAir($this->request->k_id_onair)->data;
        $this->request->n_round = $response->n_round;
        $response = $scaling->insertScaling($this->request);
        $this->request->n_round = $this->request->n_round + 1;
        $response = $ticket->updateRoundTicket($this->request->k_id_onair, $this->request->n_round);
        $response = $ticket->updateTicketScaling($this->request);
        $this->json($response);
    }

    public function recordRestart() {
        $scaling = new Dao_scaledOnair_model();
        $ticket = new Dao_ticketOnair_model();
        if ($this->request->k_id_scaled_on_air != null) {
            $response = $scaling->updateScaling($this->request);
            $follow12h = new Dao_followUp12h_model();
            $onair12 = new Dao_onAir12h_model();
            $response = $ticket->findByIdOnAir($this->request->k_id_onair)->data;
            $this->request->n_round = $response->n_round;
            $this->request->i_round = $response->n_round;
            $response = $follow12h->insert12hFollowUp($this->request);
            $this->request->k_id_follow_up_12h = $response->data->data;
            $this->request->d_start12h = Hash::getDate();
            if ($this->request->k_id_status_onair >= 87) {
                $this->request->d_fin12h = Hash::getDate();
            }
            $response = $onair12->insertOnAir12($this->request);
        } else {
            $response = $scaling->insertScaling($this->request);
        }

        $response = $ticket->updateTicketScaling($this->request);
        $this->json($response);
    }

}
