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

    private function getGroupsGeneric($groups, $gh, $d_start, $d_end) {
        //Recorremos los grupos para validar...
        foreach ($gh as $key => $value) {
            if (count($groups) == 0) {
                $groups[] = [
                    "date_start" => $value->{$d_start},
                    "date_end" => $value->{$d_end},
                    "group" => $value->i_round
                ];
            } else {
                foreach ($groups as $i => $v) {
                    if ($v["group"] != $value->i_round) {
                        $groups[] = [
                            "date_start" => $value->{$d_start},
                            "date_end" => $value->{$d_end},
                            "group" => $value->i_round
                        ];
                    } else {
                        //Obteniendo la fecha principal...
                        if (($value->{$d_start}) && ($v["date_start"])) {
                            //Se compara si la fecha del value es menor...
                            $d1 = Hash::getTimeStamp($value->{$d_start});
                            $d2 = Hash::getTimeStamp($v["date_start"]);
                            if ($d1 < $d2) {
                                $groups[$i]["date_start"] = $value->{$d_start};
                            }
                        } else if ($value->{$d_start}) {
                            $groups[$i]["date_start"] = $value->{$d_start};
                        }

                        //Obteniendo la fecha final...
                        if (($value->{$d_end}) && ($v["date_end"])) {
                            //Se compara si la fecha del value es Mayor...
                            $d1 = Hash::getTimeStamp($value->{$d_end});
                            $d2 = Hash::getTimeStamp($v["date_end"]);
                            if (d1 > d2) {
                                $groups[$i]["date_end"] = $value->{$d_end};
                            }
                        } else if ($value->{$d_end}) {
                            $groups[$i]["date_end"] = $value->{$d_end};
                        }
                    }
                }
            }
        }
        return $groups;
    }

    function getGroups($idOnair) {
        try {
            $onAir12HModel = new OnAir12hModel();
            $onAir24HModel = new OnAir24hModel();
            $onAir36HModel = new OnAir36hModel();
            $groups = [];
            //Consultamos los grupos de 12h...
            $gh12 = $onAir12HModel->where("k_id_onair", "=", $idOnair)->get();
            //Consultamos los grupos de 24h...
            $gh24 = $onAir24HModel->where("k_id_onair", "=", $idOnair)->get();
            //Consultamos los grupos de 36h...
            $gh36 = $onAir36HModel->where("k_id_onair", "=", $idOnair)->get();

            $groups = $this->getGroupsGeneric($groups, $gh12, "d_start12h", "d_fin12h");
            $groups = $this->getGroupsGeneric($groups, $gh24, "d_start24h", "d_fin24h");
            $groups = $this->getGroupsGeneric($groups, $gh36, "d_start36h", "d_fin36h");
            return $groups;
        } catch (ZolidException $exc) {
            return null;
        }
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
            $timestamp = 0;
            $percent = 0;
            if ($status_onair) {

                $details = array();
                $onAir12HModel = new OnAir12hModel();
                $onAir24HModel = new OnAir24hModel();
                $onAir36HModel = new OnAir36hModel();
                //Se consultan los detalles por k_id_onair y i_round...
                $details["12h"] = $onAir12HModel
                        ->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("i_round", "=", $round)
                        ->get();
                $haveDetails = 0;
                if (count($details["12h"]) > 0) {
                    foreach ($details["12h"] as $key => $value) {
                        $value->k_id_follow_up_12h = $this->getFollowersProject($tck->k_id_onair, "on_air_12h", "follow_up_12h", "k_id_follow_up_12h");
                        $details["12h"][$key] = $value;
                    }
                    $haveDetails++;
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
                    $haveDetails++;
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
                    $haveDetails++;
                }

                //Comprobamos el status actual...
                $obj = null;
                $dStartField = null;
                $stepModel = null;
                $stepIdField = null;
                $detailState = 0;
                switch ($status_onair->k_id_substatus) {
                    case ConstStates::SEGUIMIENTO_12H:
                        $actual_status = "12h";
                        $stepIdField = "k_id_12h_real";
//                        $onAir12HModel = new OnAir12hModel();
                        $stepModel = new OnAir12hModel();
//                        $obj = $onAir12HModel->getLastDetail($tck);
                        break;
                    case ConstStates::SEGUIMIENTO_24H:
                        $actual_status = "24h";
                        $stepIdField = "k_id_24h_real";
//                        $onAir24HModel = new OnAir24hModel();
                        $stepModel = new OnAir24hModel();
//                        $obj = $onAir24HModel->getLastDetail($tck);
                        break;
                    case ConstStates::SEGUIMIENTO_36H:
                        $actual_status = "36h";
                        $stepIdField = "k_id_36h_real";
//                        $onAir36HModel = new OnAir36hModel();
                        $stepModel = new OnAir36hModel();
//                        $obj = $onAir36HModel->getLastDetail($tck);
                        break;
                }
                //VERIFICAMOS Y ACTUALIZAMOS EL TIEMPO QUE FALTA...
                $timetotal = 0;
                $today = 0;
                $time = 0;
                if ($stepModel) {
                    $temp = $stepModel->updateTimeStamp($tck);
                    if ($temp) {
                        $timestamp = $temp->i_timestamp;
                        $percent = $temp->i_percent;
                        $detailState = $temp->i_state;
                        $timetotal = $temp->i_timetotal;
                        $today = $temp->today;
                        $time = $temp->time;
                    }
//                    $percent = $temp["percent"];
                }


                if ($haveDetails == 0) {
                    return new Response(EMessages::EMPTY_MSG, "No hay ningún detalle para mostrar.");
                }
                $groups = $this->getGroups($tck->k_id_onair);
                //Obtenemos el timestamp...
                $response = new Response(EMessages::QUERY);
                $data = [
                    "status" => $status_onair,
                    "details" => $details,
                    "groups" => $groups,
                    "group" => $round,
                    "actual_status" => $actual_status,
                    "i_timestamp" => $timestamp,
                    "i_timetotal" => $timetotal,
                    "i_percent" => $percent,
                    "i_state" => $detailState,
                    "today" => $today,
                    "time" => $time,
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

    function updateTicketScaling($request) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_onair", "=", $request->k_id_onair)
                    ->update($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    function updateRoundTicket($id, $value) {
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

    public function updatePrecheckStatus($id) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_preparation", "=", $id)
                    ->update(["i_precheck_realizado" => 1]);
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAssign() {
        try {
            //Consultamos la lista de registros pendientes...
            $db = new DB();
            $pending = $db->select("select * from ticket_on_air where i_actualEngineer = 0")->get();
            $assing = $db->select("select * from ticket_on_air where i_actualEngineer != 0")->get();
            //Consultamos la lista de registros asignados...
            $data = [
                "pendingList" => $pending,
                "assingList" => $assing
            ];
            $response = new Response(EMessages::QUERY);
            $response->setData($data);
            return $response;
        } catch (ZolidException $exc) {
            return $exc;
        }
    }

    public function createProrroga($request) {
        try {
            //Se obtiene el id del proceso onair...
            $id = $request->idProceso;
            $hoursProrroga = $request->hours;
            $comment = $request->comment;
            $ticketModel = new TicketOnAirModel();
            $ticket = $ticketModel->where("k_id_onair", "=", $id)->first();
            if ($ticket) {
                //Se actualiza el comentario del ticket...|
                $ticketModel->where("k_id_onair", "=", $id)->update([
                    "n_comentario_coor" => $comment
                ]);
                //Ahora actualizamos el estado del detalle...
                $status_onair = DB::table("status_on_air")
                        ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                        ->first();
                if ($status_onair) {
                    $actual_status = null;
                    $stepIdField = null;
                    $stepModel = null;
                    switch ($status_onair->k_id_substatus) {
                        case ConstStates::SEGUIMIENTO_12H:
                            $actual_status = "12h";
                            $stepIdField = "k_id_12h_real";
                            $stepModel = new OnAir12hModel();
                            break;
                        case ConstStates::SEGUIMIENTO_24H:
                            $actual_status = "24h";
                            $stepIdField = "k_id_24h_real";
                            $stepModel = new OnAir24hModel();
                            break;
                        case ConstStates::SEGUIMIENTO_36H:
                            $actual_status = "36h";
                            $stepIdField = "k_id_36h_real";
                            $stepModel = new OnAir36hModel();
                            break;
                    }
                    //Después de comprobar sobre cual estado se encuentra y 
                    //obtener el modelo necesario simplemente actualizamos el estado
                    //para ese modelo...
                    $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                            ->where("i_round", "=", $ticket->n_round)->update([
                        "i_state" => 2, //Estado prórroga.
                        "d_start_temp" => date("Y-m-d H:i:s"),
                        "i_hours" => $hoursProrroga,
                    ]);

//                    echo $stepModel->getSQL();
                }
            }
            $response = new Response(EMessages::INSERT);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function nextFase($request) {
        try {
            $id = $request->idProceso;
            $fase = $request->fase;
            $comment = $request->comment;
            $ticketModel = new TicketOnAirModel();
            //Consultamos el ticket...
            $ticket = $ticketModel->where("k_id_onair", "=", $id)->first();
            $response = new Response(EMessages::INSERT);
            $idStatus = 0;
            $detailModel = null;
            $dateField = null;
            if ($ticket) {
                //Se obtiene el código del subestado...
                switch ($fase) {
                    case "12h":
                        $idStatus = ConstStates::SEGUIMIENTO_12H;
                        $detailModel = new OnAir12hModel();
                        $dateField = "d_start12h";
                        break;
                    case "24h":
                        $idStatus = ConstStates::SEGUIMIENTO_24H;
                        $detailModel = new OnAir24hModel();
                        $dateField = "d_start24h";
                        break;
                    case "36h":
                        $idStatus = ConstStates::SEGUIMIENTO_36H;
                        $detailModel = new OnAir36hModel();
                        $dateField = "d_start36h";
                        break;
                }
                //Actualizamos el estado de la fase...
                $status_onair = DB::table("status_on_air")
                        ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                        ->update([
                    "k_id_substatus" => $idStatus
                ]);
                //Luego actualizamos o insertamos el nuevo registro de la siguiente fase.
                $temp = $detailModel->where("k_id_onair", "=", $ticket->k_id_onair)
                        ->where("i_round", "=", $ticket->n_round)
                        ->first();
                //Se comprueba si existe, para actualizar...
                if ($temp) {
                    $detailModel->where("k_id_onair", "=", $ticket->k_id_onair)
                            ->where("i_round", "=", $ticket->n_round)
                            ->update([
                                "i_state" => 0,
                                $dateField => Hash::getDate()
                    ]);
                } else {
                    //Se comprueba si no existe para insertarlo.
                    $detailModel->insert([
                        "k_id_onair" => $ticket->k_id_onair,
                        "i_state" => 0,
                        "n_comentario" => $comment,
                        "i_round" => $ticket->n_round,
                        $dateField => Hash::getDate()
                    ]);
                }
            } else {
                $response = new Response(EMessages::EMPTY_MSG, "No se encontró el proceso.");
            }
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
