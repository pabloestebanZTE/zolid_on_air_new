<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_autorecord_model extends CI_Model {

    public function corregirSectores($ticket) {
        try {
            if (!$ticket) {
                return;
            }
            $ticketOnAirModel = new TicketOnAirModel();
//            $ticket = $ticketOnAirModel->where("k_id_onair", "=", $ticket->k_id_onair)->first();
            if ($ticket && ($ticket->n_json_sectores == null || (strlen(trim($ticket->n_json_sectores))) == 0) || (!$ticket->n_json_sectores)) {
                $resposne = new Response(EMessages::QUERY);
                $db = new DB();
                $sql = "SELECT s.* FROM sectores s INNER JOIN sectores_on_air sa
                    inner JOIN `work` w
                    ON s.k_id_sector = sa.k_id_sector WHERE sa.k_id_tecnology = $ticket->k_id_technology
                    AND sa.k_id_band = $ticket->k_id_band AND w.k_id_work = $ticket->k_id_work "
                        . "AND w.b_aplica_bloqueo = 1 group by s.k_id_sector ";
                $data = $db->select($sql)->get();

                $sectores_json = [];
                $sectoresString = "";
                foreach ($data as $dat) {
                    $sectores_json[] = [
                        "id" => $dat->k_id_sector,
                        "name" => $dat->name,
                        "state" => "1" //Bloqueados...
                    ];
                    $sectoresString = $sectoresString . $dat->name . ", ";
                }

                $ticketOnAirModel = new TicketOnAirModel();
                $ticketOnAirModel->where("k_id_onair", "=", $ticket->k_id_onair)->update([
                    "n_sectoresbloqueados" => $sectoresString,
                    "n_json_sectores" => json_encode($sectores_json),
                    "n_estado_sectores" => "BLOQUEADOS"
                ]);
            }
        } catch (DeplynException $exc) {
            return $ext;
        }
    }

    /**
     * Esta función evaluará el estado actual de un ticket, y de no existir 
     * un control 12, 24, 36, lo creará...
     * Así mitigaremos el problema que está surgiendo al cargar la data.
     * @param type $ticket | Object OR ID del ticket.
     */
    public function record($ticket) {
        $ticketModel = new TicketOnAirModel();
        if (!is_object($ticket)) {
            $ticket = $ticketModel->where("k_id_onair", "=", $ticket)->first();
            $this->record($ticket);
            return;
        }
        $response = new Response(EMessages::CORRECT);

        //Correjimos los sectores...       
        $this->corregirSectores($ticket);

        //Comprobamos el estado del ticket y obtenemos el modelo de la tabla a la que 
        //pertenece el seguimiento...
        $segModel = null;
        $d_start = null;
        $idTable = null;
        switch ($ticket->k_id_status_onair) {
            case ConstStates::PRECHECK:
//                $ticketModel->where("k_id_onair", "=", $ticket->k_id_onair)->first();
//                if ($ticket) {
                $ticketModel->where("k_id_onair", "=", $ticket->k_id_onair)->update([
                    "d_precheck_init" => $ticket->d_fecha_ultima_rev
                ]);
//                }
                return $response;
            case ConstStates::REINICIO_PRECHECK:
                $ticketModel->where("k_id_onair", "=", $ticket->k_id_onair)->update([
                    "d_precheck_init" => $ticket->d_fecha_ultima_rev
                ]);
                return $response;
            case ConstStates::REINICIO_12H:
                $ticketModel->where("k_id_onair", "=", $ticket->k_id_onair)->update([
                    "d_precheck_init" => $ticket->d_fecha_ultima_rev
                ]);
                return $response;
            case ConstStates::PRECHECK:
                break;
            case ConstStates::SEGUIMIENTO_12H:
                $segModel = new OnAir12hModel();
                $idTable = "k_id_12h_real";
                $d_start = "d_start12h";
                break;
            case ConstStates::SEGUIMIENTO_24H:
                $segModel = new OnAir24hModel();
                $idTable = "k_id_24h_real";
                $d_start = "d_start24h";
                break;
            case ConstStates::SEGUIMIENTO_36H:
                $segModel = new OnAir36hModel();
                $idTable = "k_id_36h_real";
                $d_start = "d_start36h";
                break;
        }

        if (($ticket->d_fecha_ultima_rev == null || (strlen(trim($ticket->d_fecha_ultima_rev))) == 0) || (!$ticket->d_fecha_ultima_rev)) {
            $ticket->d_fecha_ultima_rev = Hash::getDate();
        }

        if ($segModel != null) {
            $seg = $segModel->where("k_id_onair", "=", $ticket->k_id_onair)->where("i_round", "=", $ticket->n_round)->first();
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
                //Comprobamos si la fecha start no existe para actualizarla...
                if (($seg->{$d_start} == null || (strlen(trim($seg->{$d_start}))) == 0) || (!$seg->{$d_start})) {
                    $segModel->where($idTable, "=", $seg->{$idTable})
                            ->where("i_round", "=", $ticket->n_round)
                            ->update([
                                $d_start => $ticket->d_fecha_ultima_rev
                    ]);
//                    echo "SE ACTUALIZA EL REGISTRO " . $ticket->k_id_onair;
                } else {
//                    echo "NO SE ACTUALIZA EL REGISTRO " . $ticket->k_id_onair . " - " . $seg->{$d_start} . " --- " . $seg->{$idTable} . " :: SQL :: " . $segModel->getSQL() . " <br/>";
                }
                $response = new Response(EMessages:: CORRECT, "No fue necesario crear el registro.");
            }
        }
        return $response;
    }

}
