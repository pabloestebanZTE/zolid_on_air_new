<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_ticketOnair_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/TicketOnAirModel');
        $this->load->model('dto/StatusModel');
        $this->load->model('dto/SubstatusModel');
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

}

?>
