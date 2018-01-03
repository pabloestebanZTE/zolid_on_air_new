<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_autorecord_model extends CI_Model {

    /**
     * Esta función evaluará el estado actual de un ticket, y de no existir 
     * un control 12, 24, 36, lo creará...
     * Así mitigaremos el problema que está surgiendo al cargar la data.
     * @param type $ticket | Object OR ID del ticket.
     */
    public function record($ticket) {
        if (!is_object($ticket)) {
            $ticketModel = new TicketOnAirModel();
            $ticket = $ticketModel->where("k_id_onair", "=", $ticket)->first();
            $this->record($ticket);
            return;
        }
        $response = new Response(EMessages::CORRECT);

        //Comprobamos el estado del ticket y obtenemos el modelo de la tabla a la que 
        //pertenece el seguimiento...
        $segModel = null;
        $d_start = null;
        switch ($ticket->k_id_status_onair) {
            case ConstStates::PRECHECK:
                $ticketModel->where("k_id_onair", "=", $ticket->k_id_onair)->update([
                    "d_precheck_init" => $ticket->d_fecha_ultima_rev
                ]);
                return $response;
            case ConstStates::PRECHECK:
                break;
            case ConstStates::SEGUIMIENTO_12H:
                $segModel = new OnAir12hModel();
                $d_start = "d_start12h";
                break;
            case ConstStates::SEGUIMIENTO_24H:
                $segModel = new OnAir24hModel();
                $d_start = "d_start24h";
                break;
            case ConstStates::SEGUIMIENTO_36H:
                $segModel = new OnAir36hModel();
                $d_start = "d_start36h";
                break;
        }
        if ($segModel != null) {
            $seg = $segModel->where("k_id_onair", "=", $ticket->k_id_onair)
                            ->where("i_round", "=", $ticket->n_round)->first();
            //Si no existe, lo creamos...
            if (!$seg) {
                $data = [
                    "k_id_onair" => $ticket->k_id_onair,
                    $d_start => $ticket->d_fecha_ultima_rev,
                    "i_state" => 0,
                    "i_round" => $ticket->n_round,
                ];
                $segModel->insert($data);
            } else {
                $response = new Response(EMessages::CORRECT, "No fue necesario crear el registro.");
            }
        }
        return $response;
    }

}
