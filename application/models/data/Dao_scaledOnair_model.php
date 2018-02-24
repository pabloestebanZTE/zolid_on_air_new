<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_scaledOnair_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/ScaledOnAirModel');
    }

    public function getAll() {
        try {
            $scaledOnair = new ScaledOnAirMOdel();
            $datos = $scaledOnair->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getScaledByTicket($ticket) {
        try {
            $scaledOnair = new ScaledOnAirMOdel();
            $datos = $scaledOnair->where("k_id_onair", "=", $ticket)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getScaledByTicketRound($ticket, $round) {
        try {
            $scaledOnair = new ScaledOnAirMOdel();
            $datos = $scaledOnair->where("k_id_onair", "=", $ticket)
                    ->where("n_round", "=", $round - 1)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function insertScaling($request) {
        /* print_r($request); */
        try {
            $scaledOnair = new ScaledOnAirMOdel();
            $request->d_fecha_escalado = HASH::getDate();
            $datos = $scaledOnair->insert($request->all());
//            print_r($scaledOnair->getsql());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function updateScaling($request) {
        try {
            //Consultamos el registro...                        
            $scaled = $this->getScaledWithCalculations($request);
            if (!$scaled) {
                return new Response(EMessages::ERROR_QUERY, "No se ha encontrado el escalamiento.");
            }
            $scaled->where("k_id_scaled_on_air", "=", $request->k_id_scaled_on_air);
            $scaled->update();
            $response = new Response(EMessages::SUCCESS);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    /**
     * Realizará los calculos de escalamientos necesarios para llevar el registro
     * de tiempos de escalamiento que tienen los registros OnAir...
     * @param type $idOnAir
     */
    private function getScaledWithCalculations($request) {
        $scaledModel = new ScaledOnAirModel();
        //Consultamos el registro de escalamiento que se está llevando actualmente...
        $scaled = $scaledModel->where("k_id_scaled_on_air", "=", $request->k_id_scaled_on_air)
                ->first();
        //Primero verificamos que el registro exista realmente...
        if ($scaled) {
            $scaledOnAirModel = new ScaledOnAirModel($scaled);
            $scaledOnAirModel->fill($request->all());
            //Se crea una nueva instancia para realizar la actualización...
//            $scaledOnAirModel = new ScaledOnAirModel($request->all());
            //Ahora vamos a empezar a analizar el objeto...
            //Primero verificamos que tipo de escalamiento tiene, para esto es necesario conocer el registro onair...
            $onAirModel = new TicketOnAirModel();
            $ticket = $onAirModel->where("k_id_onair", "=", $scaledOnAirModel->k_id_onair)->first();
            if ($ticket) {
                $idStatus = $ticket->k_id_status_onair;
                $status = (new StatusOnairModel())->where("k_id_status_onair", "=", $idStatus)->first();
                //Ahora que ya conocemos el status, tenemos que verificar el estado para actualizar el escalamiento para cada caso...
                if ($status) {
                    $idStatus = $status->k_id_status;
                    $actualRecordTime = Hash::getMinutesBettween($scaledOnAirModel->getDFechaEscalado());
                    switch ($idStatus) {
                        case ConstStates::ESCALADO_A_IMPLEMENTACION:
                            $scaledOnAirModel->setIContEscImp($scaledOnAirModel->getIContEscImp() + 1);
                            $scaledOnAirModel->setTimeEscImp($scaledOnAirModel->getTimeEscImp() + $actualRecordTime);
                            break;
                        case ConstStates::ESCALADO_GRUPO_CALIDAD:
                            $scaledOnAirModel->setContEscCalidad($scaledOnAirModel->getContEscCalidad() + 1);
                            $scaledOnAirModel->setITimeEscCalidad($scaledOnAirModel->getITimeEscCalidad() + $actualRecordTime);
                            break;
                        case ConstStates::ESCALADO_A_OYM:
                            $scaledOnAirModel->setIContEscOym($scaledOnAirModel->getIContEscOym() + 1);
                            $scaledOnAirModel->setTimeEscOym($scaledOnAirModel->getTimeEscOym() + $actualRecordTime);
                            break;
                        case ConstStates::ESCALADO_A_RF:
                            $scaledOnAirModel->setIContEscRf($scaledOnAirModel->getIContEscRf() + 1);
                            $scaledOnAirModel->setITimeEscRf($scaledOnAirModel->getITimeEscRf() + $actualRecordTime);
                            break;
                        case ConstStates::ESCALADO_CONTROL_CAMBIOS:
                            break;
                        case ConstStates::ESCALADO_A_GDRT:
                            $scaledOnAirModel->setIContEscGdrt($scaledOnAirModel->getIContEscGdrt() + 1);
                            $scaledOnAirModel->setITimeEscGdrt($scaledOnAirModel->getITimeEscGdrt() + $actualRecordTime);
                            break;
                    }
                    //Se suman todos los tiempos...
                    $timeTotalEsc = 0;
                    $timeTotalEsc += $scaledOnAirModel->getTimeEscImp();
                    $timeTotalEsc += $scaledOnAirModel->getITimeEscCalidad();
                    $timeTotalEsc += $scaledOnAirModel->getIContEscOym();
                    $timeTotalEsc += $scaledOnAirModel->getITimeEscRf();
                    $timeTotalEsc += $scaledOnAirModel->getITimeEscGdrt();

                    //Se suman todos los contadores...
                    $contTotalEsc = 0;
                    $contTotalEsc += $scaledOnAirModel->getIContEscImp();
                    $contTotalEsc += $scaledOnAirModel->getContEscCalidad();
                    $contTotalEsc += $scaledOnAirModel->getIContEscOym();
                    $contTotalEsc += $scaledOnAirModel->getIContEscRf();
                    $contTotalEsc += $scaledOnAirModel->getITimeEscGdrt();
                    $scaledOnAirModel->setDTimeEscalado($timeTotalEsc);

                    $ticketModel = new TicketOnAirModel();
                    $ticketModel->setIContTotalEscalamiento($contTotalEsc);
                    $ticketModel->setITimeTotalEscalamiento($timeTotalEsc);
                    $ticketModel->setKIdStatusOnair($request->k_id_status_onair);
                    $ticketModel->where("k_id_onair", "=", $ticket->k_id_onair);
                    $ticketModel->update();

                    //::FORFIX Fijar el total de los contadores...
                    return $scaledOnAirModel;
                }
            }
        }
        return null;
    }

}

?>
