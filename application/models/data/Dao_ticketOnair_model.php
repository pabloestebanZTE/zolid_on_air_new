<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_ticketOnair_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/TicketOnAirModel');
        $this->load->model('dto/StatusModel');
        $this->load->model('dto/SubstatusModel');
        $this->load->model('dto/OnAir12hModel');
        $this->load->model('dto/OnAir24hModel');
        $this->load->model('dto/OnAir36hModel');
        $this->load->model('bin/ConstStates');
    }

    public function insertTicket($request) {
        try {
            $ticket = new TicketOnAirModel();
            $datos = $ticket->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAll() {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function findByIdOnAir($id) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                    ->first();
            //Evaluamos si se encontró algún registro.
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function findByIdPrecheck($id) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_precheck", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAllStates() {
        try {
            $response = new Response(EMessages::QUERY);
            $statusModel = new StatusModel();
            $subStatusModel = new SubstatusModel();
            $data = array();
            $data["states"] = $statusModel->get();
            $data["substates"] = $subStatusModel->get();
            $response->setData($data);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    function updateTicket($request) {
        try {

            $ticketOnAir = new TicketOnAirModel();
            //CONSULTAMOS EL REGISTRO ONAIR...
            $tempTicketOnAir = $ticketOnAir->where("k_id_onair", "=", $request->ticket_on_air->id_onair)->first();
            if ($tempTicketOnAir) {
                //SE BUSCA EL TK_ID_STATUS_ONAIR Y SE ACTUALIZA...
                $status_onair = DB::table("status_on_air")->where("k_id_status_onair", "=", $tempTicketOnAir->k_id_status_onair)->first();
                $objStatusOnair = [
                    "k_id_status" => $request->ticket_on_air->k_id_status_onair->k_id_status,
                    "k_id_substatus" => $request->ticket_on_air->k_id_status_onair->k_id_substatus
                ];
                $idStatusOnair = 0;
                $idPreparation = 0;
                //ACTUALIZANDO STATUS_ONAIR
                if ($status_onair) {
                    //SE REALIZA LA ACTUALIZACIÓN DEL STATUS_ONAIR...
                    $idStatusOnair = $status_onair->k_id_status_onair;
                    DB::table("status_on_air")
                            ->where("k_id_status_onair", "=", $tempTicketOnAir->k_id_status_onair)
                            ->update($objStatusOnair);
                } else {
                    //SE INSERTA EL STATUS_ONAIR...
                    $idStatusOnair = DB::table("status_on_air")
                            ->insert($objStatusOnair);
                }

                //ACTUALIZANDO PREPARATION STAGE.
                $psModel = new PreparationStageModel();
                //COMPROBAMOS SI EXISTE
                $tempPreparationStage = $psModel
                        ->where("k_id_preparation", "=", $tempTicketOnAir->k_id_preparation)
                        ->first();

                if ($tempPreparationStage) {
                    $idPreparation = $tempPreparationStage->k_id_preparation;
                    //SE ACTUALIZA EL PREPARATION_STAGE.
                    $psModel->where("k_id_preparation", "=", $tempTicketOnAir->k_id_preparation)
                            ->update($request->preparation_stage->all());
                } else {
                    //SE CREA EL PREPARATION_STAGE...
                    $idPreparation = $psModel->insert($request->preparation_stage->all());
                }


                //SE ACTUALIZA EL REGISTRO ONAIR...
                //Antes de hacerlo modificamos algunos de los parámetros
                //asignando los valores correspondientes...
                $request->ticket_on_air->k_id_status_onair = $idStatusOnair;
                $request->k_id_preparation = $idPreparation;
                $ticketOnAir = new TicketOnAirModel();
                $res = $ticketOnAir->where("k_id_onair", "=", $request->ticket_on_air->id_onair)
                        ->update($request->ticket_on_air->all());
                $response = new Response(EMessages::UPDATE);
            } else {
                $response = new Response(EMessages::ERROR);
                $response->setMessage("El ticket solicitado no existe.");
            }
            return $response;
            return null;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    function updatePrecheckOnair($request) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_onair", "=", $request->k_id_ticket)
                    ->update($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    /**
     *
     * @param type $id_onair
     * @param type $table1 = Tabla onair_hh...
     * @param type $table2 = Tabla follow_hh...
     * @param type $field = Field follow....
     */
    function getFollowersProject($id_onair, $table1, $table2, $field) {
        $sql = "SELECT c.k_id_user, n_last_name_user, n_username_user, n_mail_user FROM $table2
                a INNER JOIN $table1 b
                ON a.$field = b.$field
                INNER JOIN user c
                ON c.k_id_user = a.k_id_user WHERE b.k_id_onair = $id_onair";
//        echo $sql;
        $data = (new DB())->select($sql)->get();
        return $data;
    }

    function getProcessTicket($request) {
        try {
            $ticketModel = new TicketOnAirModel();
            //PRIMERO CONSULTAMOS EL TICKET...
            $tck = $ticketModel->where("k_id_onair", "=", $request->id)->first();
            //Verificamos si viene el round desde el cliente...
            $round = $request->round;
            //Ahora, validamos si realmente se encontró algo...
            if (!$tck) {
                return new Response(EMessages::NO_FOUND_REGISTERS);
            }
            if (!$tck->k_id_precheck) {
                return new Response(EMessages::EMPTY_MSG, "Aún no se ha hecho precheck para este proceso.");
            }
            //Si no viene el round desde el cliente, se setea al que tenemos en el tck...
            if (!$round) {
                $round = $tck->n_round;
            }
            //Consultamos el k_id_status_onair.
            $status_onair = DB::table("status_on_air")
                    ->where("k_id_status_onair", "=", $tck->k_id_status_onair)
                    ->first();
            $actual_status = null;
            if ($status_onair) {
                //Comprobamos el status actual...
                switch ($status_onair->k_id_substatus) {
                    case ConstStates::SEGUIMIENTO_12H:
                        $actual_status = "12h";
                        break;
                    case ConstStates::SEGUIMIENTO_24H:
                        $actual_status = "24h";
                        break;
                    case ConstStates::SEGUIMIENTO_36H:
                        $actual_status = "36h";
                        break;
                }
                $details = array();
                $onAir12HModel = new OnAir12hModel();
                $onAir24HModel = new OnAir24hModel();
                $onAir36HModel = new OnAir36hModel();
                //Se consultan los detalles por k_id_onair y i_round...
                $details["12h"] = $onAir12HModel
                        ->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("i_round", "=", $round)
                        ->get();
                if (count($details["12h"]) > 0) {
                    foreach ($details["12h"] as $key => $value) {
                        $value->k_id_follow_up_12h = $this->getFollowersProject($tck->k_id_onair, "on_air_12h", "follow_up_12h", "k_id_follow_up_12h");
                        $details["12h"][$key] = $value;
                    }
                }
                $details["24h"] = $onAir24HModel
                        ->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("i_round", "=", $round)
                        ->get();
                if (count($details["24h"]) > 0) {
                    foreach ($details["24h"] as $key => $value) {
                        $value->k_id_follow_up_24h = $this->getFollowersProject($tck->k_id_onair, "on_air24h", "follow_up_24h", "k_id_follow_up_24h");
                        $details["24h"][$key] = $value;
                    }
                }
                $details["36h"] = $onAir36HModel
                        ->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("i_round", "=", $round)
                        ->get();
                if (count($details["36h"]) > 0) {
                    foreach ($details["24h"] as $key => $value) {
                        $value->k_id_follow_up_36h = $this->getFollowersProject($tck->k_id_onair, "on_air_36h", "follow_up_36h", "k_id_follow_up_36h");
                        $details["36h"][$key] = $value;
                    }
                }
                $response = new Response(EMessages::QUERY);
                $data = [
                    "status" => $status_onair,
                    "details" => $details,
                    "actual_status" => $actual_status
                ];
                $response->setData($data);
                return $response;
            } else {
                return new Response(EMessages::EMPTY_MSG, "Aún no se ha hecho precheck para este proceso.");
            }
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    function updateRoundTicket($id, $value){
      try {
          $ticketOnAir = new TicketOnAirModel();
          $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                  ->update(["n_round" => $value]);
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
      } catch (ZolidException $ex) {
          return $ex;
      }

}

?>
