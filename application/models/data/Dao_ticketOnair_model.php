<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_ticketOnair_model extends CI_Model {

    var $request;

    public function __construct() {
        set_time_limit(-1);
        $this->load->model('dto/TicketOnAirModel');
        $this->load->model('dto/StatusModel');
        $this->load->model('dto/SubstatusModel');
        $this->load->model('dto/OnAir12hModel');
        $this->load->model('dto/OnAir24hModel');
        $this->load->model('dto/OnAir36hModel');
        $this->load->model('data/Dao_followUp12h_model');
        $this->load->model('data/Dao_followUp24h_model');
        $this->load->model('data/Dao_followUp36h_model');
        $this->load->model('bin/ConstSubStates');
        $this->load->model('bin/SubstatusModel');
        $this->load->model('data/Dao_kpi_model');
    }

    public function getTicketById($id) {
        $ticketsOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $statusOnair = new dao_statusOnair_model();
        $assign = new dao_user_model();
        $stage = new dao_preparationStage_model();
        $res = $ticketsOnAir->findByIdOnAir($id);
        if ($res->data == null) {
            return null;
        }
        $res->data->k_id_status_onair = $statusOnair->findById($res->data->k_id_status_onair)->data; //Status onair
        $res->data->k_id_station = $station->findById($res->data->k_id_station)->data; //Station
        $res->data->k_id_band = $band->findById($res->data->k_id_band)->data; //band
        $res->data->k_id_work = $work->findById($res->data->k_id_work)->data; //work
        $res->data->k_id_technology = $technology->findById($res->data->k_id_technology)->data; //technology
        $res->data->k_id_preparation = $stage->findByIdPreparation($res->data->k_id_preparation)->data; //preparation

        if ($res->data->i_actualEngineer != 0) {
            $res->data->i_actualEngineer = $assign->findBySingleId($res->data->i_actualEngineer)->data; //
            $res->data->i_actualEngineer = $res->data->i_actualEngineer->n_name_user . " " . $res->data->i_actualEngineer->n_last_name_user;
        } elseif ($res->data->i_actualEngineer == 0) {
            $res->data->i_actualEngineer = "<b>PENDIENTE POR ASIGNAR</b>";
        }
        return $res->data;
    }

    public function registerReportComment($idTicket, $comment = null, $solicitante = null) {
        try {
            $ticket = new TicketOnAirModel();
            $tck = $this->getTicketById($idTicket);
            $response = new Response(EMessages::QUERY);
            if ($tck) {
                //Se registra el reporte...
                $reportCommentModel = new ReporteComentarioModel();
                $reportCommentModel->insert([
                    "k_id_on_air" => $tck->k_id_onair,
                    "n_nombre_estacion_eb" => ($tck->k_id_station) ? $tck->k_id_station->n_name_station : "Indefinido",
                    "n_tecnologia" => ($tck->k_id_technology) ? $tck->k_id_technology->n_name_technology : "Indefinido",
                    "n_banda" => ($tck->k_id_band) ? $tck->k_id_band->n_name_band : "Indefinido",
                    "n_tipo_trabajo" => ($tck->k_id_work) ? $tck->k_id_work->n_name_ork : "Indefinido",
//                    "n_estado_eb_resucomen" => ($tck->k_id_status_onair) ? $tck->k_id_status_onair["k_id_substatus"]->n_name_substatus : "Indefinido",
                    "n_estado_eb_resucomen" => ($tck->k_id_status_onair) ? $tck->k_id_status_onair["k_id_status"]->n_name_status . " - " . (($tck->k_id_status_onair) ? $tck->k_id_status_onair["k_id_substatus"]->n_name_substatus : null) : "Indefinido",
                    "comentario_resucoment" => $comment,
                    "hora_actualizacion_resucomen" => Hash::getDate(),
                    "usuario_resucomen" => (($solicitante) ? $solicitante : ((Auth::check()) ? Auth::user()->n_name_user . " " . Auth::user()->n_last_name_user : "Indefinido ")),
                    "ente_ejecutor" => ($tck->k_id_preparation) ? $tck->k_id_preparation->n_enteejecutor : "Indefinido",
                    "tipificacion_resucomen" => null,
                    "noc" => $tck->n_noc,
                ]);
                DB::table("preparation_stage")
                        ->where("k_id_preparation", "=", $tck->k_id_preparation->k_id_preparation)
                        ->update([
                            "n_comentarioccial" => $comment
                ]);
                $ticket->where("k_id_onair", "=", $tck->k_id_onair)->update([
                    "d_actualizacion_final" => Hash::getDate(),
                    "d_fecha_ultima_rev" => Hash::getDate()
                ]);
                $response->setData($tck);
            } else {
                $response = new Response(EMessages::NO_FOUND_REGISTERS);
            }
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function insertTicket($request) {
        try {
            $ticket = new TicketOnAirModel();
            $datos = $ticket->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            if ($datos->data <= 0) {
                $response = new Response(EMessages::ERROR_INSERT);
                $response->setData($ticket->getSQL());
            }
            $this->registerReportComment($datos->data, $request->n_comentario_doc, $request->n_persona_solicita_notificacion);
            return $response;
        } catch (DeplynException $ex) {
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
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findByIdOnAir($id) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                    ->first();
            if ($datos && !$datos->k_id_station) {
                $ticketOnAir->getSQL();
//                var_dump($datos);
            }
            //Evaluamos si se encontró algún registro.
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
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
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getAllStates() {
        try {
            $response = new Response(EMessages::QUERY);
            $statusModel = new StatusModel();
            $subStatusModel = new SubstatusModel();
            $workModel = new WorkModel();
            $bandModel = new BandModel();
            $technologyModel = new TechnologyModel();
            $statusOnAir = new StatusOnairModel();
            $data = array();
            $data["states"] = $statusModel->get();
            $data["substates"] = $subStatusModel->get();
            $data["bands"] = $bandModel->get();
            $data["technologies"] = $technologyModel->get();
            $data["works"] = $workModel->get();
            $data["statusOnAir"] = $statusOnAir->get();
            $response->setData($data);
            return $response;
        } catch (DeplynException $ex) {
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
                //ACTUALIZANDO PREPARATION STAGE.
                $psModel = new PreparationStageModel();
                //COMPROBAMOS SI EXISTE
                $tempPreparationStage = $psModel
                        ->where("k_id_preparation", "=", $tempTicketOnAir->k_id_preparation)
                        ->first();

                if ($tempPreparationStage) {
                    $idPreparation = $tempPreparationStage->k_id_preparation;
                    if ($request->preparation_stage->b_vistamm == 1) {
                        $request->preparation_stage->b_vistamm = "True";
                    } else {
                        $request->preparation_stage->b_vistamm = "False";
                    }
                    //SE ACTUALIZA EL PREPARATION_STAGE.
                    $psModel->where("k_id_preparation", "=", $tempTicketOnAir->k_id_preparation)
                            ->update($request->preparation_stage->all());
                } else {
                    //SE CREA EL PREPARATION_STAGE...
                    $idPreparation = $psModel->insert($request->preparation_stage->all());
                }

                $obj = new ObjUtil([
                    "fecha_rft" => $request->ticket_on_air->fecha_rft,
                    "d_fecha_cg" => $request->ticket_on_air->d_fecha_cg,
                    "n_exclusion_bajo_trafico" => $request->ticket_on_air->n_exclusion_bajo_trafico,
                ]);

                //Se actualizan los sectores...
                //Comprobamos en que estado se encuentran los sectores...
                $estadoSectores = $tempTicketOnAir->n_estado_sectores;
                $valid = new Validator();
                if ($valid->required(null, $request->ticket_on_air->n_json_sectores)) {
                    $tempOnair = new TicketOnAirModel();
                    $obj->n_json_sectores = $request->ticket_on_air->n_json_sectores;
                    if ($request->typeBlock == 1) {
                        $obj->n_sectoresbloqueados = $request->ticket_on_air->n_sectoresbloqueados;
                        $obj->n_sectoresdesbloqueados = DB::NULLED;
                        if ($estadoSectores != "BLOQUEADOS") {
                            $obj->d_bloqueo = Hash::getDate();
                            $obj->n_estado_sectores = "BLOQUEADOS";
                        }
                    } else
                    if ($request->typeBlock == 0) {
                        $obj->n_sectoresbloqueados = DB::NULLED;
                        $obj->n_sectoresdesbloqueados = $request->ticket_on_air->n_sectoresdesbloqueados;
                        if ($estadoSectores != "DESBLOQUEADOS") {
                            $obj->d_desbloqueo = Hash::getDate();
                            $obj->n_estado_sectores = "DESBLOQUEADOS";
                        }
                    }
                }

                if ($request->ticket_on_air->statuschanged) {
                    $obj->k_id_status_onair = $request->ticket_on_air->k_id_substatus;
                }

                //Se buscan los sectores...
                //Se actualiza el ticket.
                $ticketModel = new TicketOnAirModel();
                $obj->i_priority = $request->ticket_on_air->i_priority . "";
                $ticketModel->where("k_id_onair", "=", $request->ticket_on_air->id_onair)->update($obj->all());

                if ($request->ticket_on_air->statuschanged) {
                    $this->registerReportComment($request->ticket_on_air->id_onair, $request->ticket_on_air->coordinador_comment);
                }
                $response = new Response(EMessages::UPDATE);
                $response->setData($ticketOnAir->getSQL());
            } else {
                $response = new Response(EMessages::ERROR);
                $response->setMessage("El ticket solicitado no existe.");
            }
            return $response;
            return null;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    function updatePrecheckOnair($request, $id = null) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            if ($id) {
                $request->k_id_status_onair = $id;
            }
            $datos = $ticketOnAir->where("k_id_onair", "=", $request->k_id_ticket)
                    ->update($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            $response->setMessage("Se ha actualizado el precheck correctamente");
            return $response;
        } catch (DeplynException $ex) {
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
                ON c.k_id_user = a.k_id_user WHERE b.k_id_onair = $id_onair GROUP BY c.k_id_user";
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
                            if ($d1 > $d2) {
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
        } catch (DeplynException $exc) {
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
                return new Response(EMessages::EMPTY_MSG, "Este ticket no cuenta con precheck, no se puede mostrar.");
            }
            //Si no viene el round desde el cliente, se setea al que tenemos en el tck...
            if (!$round) {
                $round = $tck->n_round;
            }
            //Corregimos los probables errores de data externa...
            $autoRecordDao = new Dao_autorecord_model();
            $autoRecordDao->record($tck);

            //Consultamos el k_id_status_onair.
            $sql = "select * from status_on_air where k_id_status_onair = " . $tck->k_id_status_onair;
            $status_onair = (new DB())->select($sql)->first();
            $actual_status = null;
            $timestamp = 0;
            $percent = 0;
            $escalado = false;
            if ($status_onair) {
                $status = $status_onair->k_id_status;
                $escalado = $status == 3 || $status == 4 || $status == 5 || $status == 6 || $status == 7;

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
                    case ConstSubStates::SEGUIMIENTO_12H:
                        $actual_status = "12h";
                        $stepIdField = "k_id_12h_real";
//                        $onAir12HModel = new OnAir12hModel();
                        $stepModel = new OnAir12hModel();
//                        $obj = $onAir12HModel->getLastDetail($tck);
                        break;
                    case ConstSubStates::SEGUIMIENTO_24H:
                        $actual_status = "24h";
                        $stepIdField = "k_id_24h_real";
//                        $onAir24HModel = new OnAir24hModel();
                        $stepModel = new OnAir24hModel();
//                        $obj = $onAir24HModel->getLastDetail($tck);
                        break;
                    case ConstSubStates::SEGUIMIENTO_36H:
                        $actual_status = "36h";
                        $stepIdField = "k_id_36h_real";
//                        $onAir36HModel = new OnAir36hModel();
                        $stepModel = new OnAir36hModel();
//                        $obj = $onAir36HModel->getLastDetail($tck);
                        break;
                    default :
                        $actual_status = $status_onair->k_id_substatus;
                        break;
                }
                //VERIFICAMOS Y ACTUALIZAMOS EL TIEMPO QUE FALTA...
                $timetotal = 0;
                $today = 0;
                $time = 0;
                $temp = null;
                if ($stepModel) {
                    if (is_object($tck)) {
                        $timeGlobal = new TimerGlobal();
                        $temp = new ObjUtil($timeGlobal->updateTimeStamp($tck));
                    }
//                    $temp = $stepModel->updateTimeStamp($tck);
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

                $groups = [];
//
                if ($haveDetails > 0) {
                    $groups = $this->getGroups($tck->k_id_onair);
                }

                if ($escalado) {
                    $actual_status = "escalado";
                }


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

                if ($temp) {
                    $data["i_timeexceeded"] = $temp->i_timeexceeded;
                    $data["today"] = $temp->today;
//                 $data->i_timestamp = $timestamp;
//        $obj->i_timetotal = $timeFinal;
//        $obj->i_percent = $percent;
//        $obj->i_timeexceeded = $timeexceeded;
//        $obj->today = $today;
                }
                if ($haveDetails == 0 && !$escalado) {
                    return new Response(EMessages::EMPTY_MSG, "No hay ningún detalle para mostrar.");
                } else if ($escalado) {
                    $response = new Response(EMessages::QUERY, "No hay registros pero se habilitan los controles por escalamiento encontrado.", $data);
                    $response->setData($data);
                    return $response;
                }
                //Obtenemos el timestamp...
                $response = new Response(EMessages::QUERY);
                $response->setData($data);
                return $response;
            } else {
                return new Response(EMessages::EMPTY_MSG, "No se pudo verificar el estado actual del ticket.");
            }
        } catch (DeplynException $ex) {

            return $ex;
        }
    }

    function updateTicketScaling($request) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $request->i_actualEngineer = 0;
            $request->d_precheck_init = Hash::getDate();
            $datos = $ticketOnAir->where("k_id_onair", "=", $request->k_id_onair)
                    ->update($request->all());
            //Consultamos el ticket para verificar el prepartion stage...
            $ticketOnAir = new TicketOnAirModel();
            $temp = $ticketOnAir->where("k_id_onair", "=", $request->k_id_onair)->first();
            if ($temp) {
                $psModel = new PreparationStageModel();
                $psModel->where("k_id_preparation", "=", $temp->k_id_preparation)
                        ->update([
                            "d_correccionespendientes" => Hash::getDate()
                ]);
            }
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    function updateRoundTicket($id, $value, $request = null) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $obj = ["n_round" => $value];
            if ($request != null) {
                $obj["n_ticket"] = $request->n_ticket;
                $obj["n_responsable_ticket"] = $request->n_responsable_ticket;
            }
            $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                    ->update($obj);
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    function updateStatusTicket($id, $value, $request = null) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            if ($request && $request->TO_PRODUCCTION == null) {
                $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                        ->update(["k_id_status_onair" => $value]);
            } else {
                $obj = [
                    "k_id_status_onair" => $value,
                    "d_fechaproduccion" => Hash::getDate(),
                    "n_estadoonair" => "ON_AIR"
                ];

                $valid = new Validator();
                $ticket = (new TicketOnAirModel())->where("k_id_onair", "=", $id)->first();
                $estadoSectores = $ticket->n_estado_sectores;
                if ($request && $valid->required(null, $request->jsonSectores)) {
                    $obj["n_json_sectores"] = $request->jsonSectores;
                    if ($request->typeBlock == 1) {
                        $obj["n_sectoresbloqueados"] = $request->sectoresBloqueados;
                        $obj["n_sectoresdesbloqueados"] = DB::NULLED;
                        if ($estadoSectores != "BLOQUEADOS") {
                            $obj["d_bloqueo"] = Hash::getDate();
                            $obj["n_estado_sectores"] = "BLOQUEADOS";
                        }
                    } else
                    if ($request->typeBlock == 0) {
                        $obj["n_sectoresbloqueados"] = DB::NULLED;
                        $obj["n_sectoresdesbloqueados"] = $request->sectoresDesbloqueados;
                        if ($estadoSectores != "DESBLOQUEADOS") {
                            $obj["d_desbloqueo"] = Hash::getDate();
                            $obj["n_estado_sectores"] = "DESBLOQUEADOS";
                        }
                    }
                }

                $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                        ->update($obj);
            }
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    function updateEngTicket($id, $value) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                    ->update([
                "i_actualEngineer" => $value,
                "n_en_prorroga" => "FALSE"
            ]);

            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function updatePrecheckStatus($id) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                    ->update(["i_precheck_realizado" => 1]);
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    private function getListTicket($request, $condition, $orderBy = null) {
        try {
            //CONSULTAMOS LA LISTA DE REGISTROS PENDIENTES...
            $db = new DB();
            $pending = null;
            $sql = "";
            $sqlCount = "";
            $order = "";
            $listOrders = ["tk.d_fecha_ultima_rev" => "asc", "tk.d_created_at" => "desc"];
            if ($orderBy) {
                $listOrders = [];
                //Se agregan los orders adicionales...
                $flag = true;
                foreach ($listOrders as $key => $val) {
                    if ($orderBy["col"] == $key) {
                        $flag = false;
                    }
                }
                if ($flag) {
                    $listOrders[$orderBy["col"]] = $orderBy["dir"];
                }
            }

//            if (strpos($order, "n_name_user") !== false) {
//                $searchValue = $request->search->value;
//                $condition .= " AND n_name_user LIKE = '%$searchValue%' ";
//            }
            //Armamos la sentencia de ordenamiento.
            $i = 0;
            $max = count($listOrders);
            foreach ($listOrders as $key => $value) {
                $order .= $key . " " . $value;
                $order .= ($i < ($max - 1)) ? ", " : " ";
                $i++;
            }

            if ($request->search->value || $orderBy) {
                $request->searchValue = $request->search->value;
                $sql = "SELECT tk.* FROM ticket_on_air tk
                        INNER JOIN technology t ON t.k_id_technology = tk.k_id_technology
                        INNER JOIN preparation_stage ps ON tk.k_id_preparation = ps.k_id_preparation
                        INNER JOIN `status` s
                        INNER JOIN substatus sb
                        INNER JOIN status_on_air sa ON
                        sa.k_id_status_onair = tk.k_id_status_onair
                        AND sa.k_id_status = s.k_id_status
                        AND sb.k_id_substatus = sa.k_id_substatus
                        INNER JOIN band bd ON bd.k_id_band = tk.k_id_band
                        INNER JOIN station st ON st.k_id_station = tk.k_id_station
                        INNER JOIN `work` w ON w.k_id_work = tk.k_id_work 
                        LEFT JOIN user u ON u.k_id_user = tk.i_actualEngineer OR tk.i_actualEngineer = 0 
                        WHERE
                        (t.n_name_technology LIKE '%$request->searchValue%' 
                        OR s.n_name_status LIKE '%$request->searchValue%' 
                        OR sb.n_name_substatus LIKE '%$request->searchValue%' 
                        OR bd.n_name_band LIKE '%$request->searchValue%' 
                        OR st.n_name_station LIKE '%$request->searchValue%' 
                        OR w.n_name_ork LIKE '%$request->searchValue%' 
                        OR u.n_name_user LIKE '%$request->searchValue%')
                        AND $condition 
                        group by tk.k_id_onair 
                        order by $order limit $request->start, $request->length";

                $sqlCount = "SELECT count(tk.k_id_onair) as count FROM ticket_on_air tk
                        INNER JOIN technology t ON t.k_id_technology = tk.k_id_technology
                        INNER JOIN preparation_stage ps ON tk.k_id_preparation = ps.k_id_preparation
                        INNER JOIN `status` s
                        INNER JOIN substatus sb
                        INNER JOIN status_on_air sa ON
                        sa.k_id_status_onair = tk.k_id_status_onair
                        AND sa.k_id_status = s.k_id_status
                        AND sb.k_id_substatus = sa.k_id_substatus
                        INNER JOIN band bd ON bd.k_id_band = tk.k_id_band
                        INNER JOIN station st ON st.k_id_station = tk.k_id_station
                        INNER JOIN `work` w ON w.k_id_work = tk.k_id_work
                        LEFT JOIN user u ON u.k_id_user = tk.i_actualEngineer OR tk.i_actualEngineer = 0 
                        WHERE
                        (t.n_name_technology LIKE '%$request->searchValue%' 
                        OR s.n_name_status LIKE '%$request->searchValue%' 
                        OR sb.n_name_substatus LIKE '%$request->searchValue%' 
                        OR bd.n_name_band LIKE '%$request->searchValue%' 
                        OR st.n_name_station LIKE '%$request->searchValue%' 
                        OR w.n_name_ork LIKE '%$request->searchValue%' 
                        OR u.n_name_user LIKE '%$request->searchValue%') 
                        AND $condition
                        order by $order";
            } else {
                $sql = "select * from ticket_on_air tk "
                        . "inner join status_on_air sa on sa.k_id_status_onair = tk.k_id_status_onair
                                    inner join `status` s on s.k_id_status = sa.k_id_status "
                        . "where $condition "
                        . "order by $order limit $request->start, $request->length";
                $sqlCount = "select count(k_id_onair) as count from ticket_on_air tk "
                        . "inner join status_on_air sa on sa.k_id_status_onair = tk.k_id_status_onair
                                    inner join `status` s on s.k_id_status = sa.k_id_status "
                        . "where $condition "
                        . "order by $order";
            }

            $pending = $db->select($sql)->get();

            $db = new DB();
            $count = $db->select($sqlCount)->first();

//            echo $sqlCount;

            $count = ($count) ? $count->count : 0;
            $data = [
                "draw" => intval($request->draw),
                "recordsTotal" => intval($count),
                "recordsFiltered" => intval($count),
                "data" => $pending,
                "sql" => $sql,
            ];
            $response = new Response(EMessages::QUERY);
            $response->setData($data);
            return $response;
        } catch (DeplynException $exc) {
            return $exc;
        }
    }

    //Coordinador...
    public function getPendingList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "(sa.k_id_status <> 1 and sa.k_id_status <> 2 and sa.k_id_status <> 11 and sa.k_id_status <> 3 and sa.k_id_status <> 4 and sa.k_id_status <> 5 and sa.k_id_status <> 6 and sa.k_id_status <> 7 and sa.k_id_status <> 8) AND i_actualEngineer = 0", $orderBy);
    }

    public function getAssignList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "i_actualEngineer != 0", $orderBy);
    }

    public function getNotificationList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 97 and i_actualEngineer = 0", $orderBy);
    }

    public function getIngenerList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.i_actualEngineer = " . Auth::user()->k_id_user, $orderBy);
    }

    public function getPrecheckList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 78 and i_actualEngineer = 0", $orderBy);
    }

    public function getReinicioPrecheckList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 80 and i_actualEngineer = 0", $orderBy);
    }

    public function getReinicio12hList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 79 and i_actualEngineer = 0", $orderBy);
    }

    public function getStandByList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 100 and i_actualEngineer = 0", $orderBy);
    }

    public function getSeguimiento12hList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 81 and i_actualEngineer = 0", $orderBy);
    }

    public function getSeguimiento24hList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 82 and i_actualEngineer = 0", $orderBy);
    }

    public function getSeguimiento36hhList($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "tk.k_id_status_onair = 83 and i_actualEngineer = 0", $orderBy);
    }

    //Fin Coordinador...
    //Documentador...
    public function getPriorityList($request) {
        $sql = "i_priority = '1'";
        if ($request->hidescaled == true) {
            if ($request->byIngener == true) {
                $sql .= " AND i_actualEngineer = " . Auth::user()->k_id_user;
            } else {
                $sql .= " AND i_actualEngineer > 0";
            }
        }
        return $this->getListTicket($request, $sql);
    }

    public function getTracingList($request) {
        return $this->getListTicket($request, "s.n_name_status LIKE '%Seguimiento%'");
    }

    public function getRestartList($request) {
        return $this->getListTicket($request, "s.n_name_status LIKE '%Escalado%'");
    }

    //Fin documentador...
    public function getAllTickets($request) {
        $columns = ["n_name_station", "n_name_ork", "n_name_status", "n_name_substatus", "d_fecha_ultima_rev", "n_name_technology", "n_name_band", "d_ingreso_on_air", "d_fecha_ultima_rev", "n_name_user"];
        $orderBy = null;
        if ($request->order) {
            $col = $columns[$request->order->all()[0]->column];
            $orderBy["col"] = $col;
            $dir = $request->order->all()[0]->dir;
            $orderBy["dir"] = $dir;
        }
        return $this->getListTicket($request, "1 = 1", $orderBy);
    }

    public function getAssign() {
        try {
            //CONSULTAMOS LA LISTA DE REGISTROS PENDIENTES...
            $db = new DB();
            $pending = $db->select("select * from ticket_on_air "
                            . "where i_actualEngineer = 0 "
                            . "and YEAR(d_created_at) = YEAR(CURRENT_DATE) "
                            . "and MONTH(d_created_at) = MONTH(CURRENT_DATE) "
                            . "order by d_created_at desc limit 20")->get();

            //CONSULTAMOS LA LISTA DE REGISTROS ASIGNADOS...
            $assing = $db->select("select * from ticket_on_air "
                            . "where i_actualEngineer != 0 "
                            . "and YEAR(d_created_at) = YEAR(CURRENT_DATE) "
                            . "and MONTH(d_created_at) = MONTH(CURRENT_DATE) "
                            . "order by d_created_at desc limit 20")->get();
            $data = [
                "pendingList" => $pending,
                "assingList" => $assing
            ];
            $response = new Response(EMessages::QUERY);
            $response->setData($data);
            return $response;
        } catch (DeplynException $exc) {
            return $exc;
        }
    }

    public function getPriorityRestartAndTracing() {
        try {
            $db = new DB();
            $restart = $db->select("select a.*
                                    from ticket_on_air a
                                    inner join status_on_air b on b.k_id_status_onair = a.k_id_status_onair
                                    inner join status c on c.k_id_status = b.k_id_status
                                    where c.n_name_status LIKE '%Escalado%'
                                    order by d_created_at desc")->get();
//
//            $tracing = $db->select("select * from ticket_on_air where i_priority = '1'")->limit(20)->get();
            $priority = $db->select("select * from ticket_on_air where i_priority = '1' "
                            . "and YEAR(d_created_at) = YEAR(CURRENT_DATE)
                                    and MONTH(d_created_at) = MONTH(CURRENT_DATE) LIMIT 55")->get();

            $tracing = $db->select("select a.*
                                    from ticket_on_air a
                                    inner join status_on_air b on b.k_id_status_onair = a.k_id_status_onair
                                    inner join status c on c.k_id_status = b.k_id_status
                                    where c.n_name_status LIKE '%Seguimiento%'
                                    order by d_created_at desc LIMIT 55")->get();
            //Consultamos la lista de registros ...
            $data = [
                "priorityList" => $priority,
                "tracingList" => $tracing,
                "restartList" => $restart
            ];
            $response = new Response(EMessages::QUERY);
            $response->setData($data);
            return $response;
        } catch (DeplynException $exc) {
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
//                $ticketModel->where("k_id_onair", "=", $id)->update([
//                    "n_comentario_coor" => $comment
//                ]);
                $status_onair = DB::table("status_on_air")
                        ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                        ->first();
                if ($status_onair) {
                    $actual_status = null;
                    $stepIdField = null;
                    $stepModel = null;
                    switch ($status_onair->k_id_substatus) {
                        case ConstSubStates::SEGUIMIENTO_12H:
                            $actual_status = "12h";
                            $stepIdField = "k_id_12h_real";
                            $stepModel = new OnAir12hModel();
                            break;
                        case ConstSubStates::SEGUIMIENTO_24H:
                            $actual_status = "24h";
                            $stepIdField = "k_id_24h_real";
                            $stepModel = new OnAir24hModel();
                            break;
                        case ConstSubStates::SEGUIMIENTO_36H:
                            $actual_status = "36h";
                            $stepIdField = "k_id_36h_real";
                            $stepModel = new OnAir36hModel();
                            break;
                    }
//                    //Después de comprobar sobre cual estado se encuentra y
//                    //obtener el modelo necesario simplemente actualizamos el estado
//                    //para ese modelo...
//                    $temp = $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
//                                    ->where("i_round", "=", $ticket->n_round)->first();
//
//                    $commentEdit = null;
//                    if ($temp) {
//                        $commentEdit = $temp->n_comentario;
//                        $tempComment = [
//                            "comment" => $comment,
//                            "date" => Hash::getDate()
//                        ];
//
//                        if ($commentEdit) {
//                            $commentEdit = json_decode($commentEdit, true);
//                            $commentEdit[] = $tempComment;
//                        } else {
//                            $commentEdit = [$tempComment];
//                        }
//                    }
//                    $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
//                            ->where("i_round", "=", $ticket->n_round)->update([
//                        "i_state" => 2, //Estado prórroga.
//                        "d_start_temp" => date("Y-m-d H:i:s"),
//                        "i_hours" => $hoursProrroga,
//                        "n_comentario" => json_encode($commentEdit, true)
//                    ]);
                    $this->insertCommentDetail($stepModel, $ticket, [
                        "i_state" => 2, //Estado prórroga.
                        "d_start_temp" => Hash::getDate(),
                        "i_hours" => $hoursProrroga,
                        "n_comentario" => $comment
                    ]);
                }
                //Se deja el ticket para volver a reasignar por parte del coordinador.
                $obj = [
                    "i_actualEngineer" => 0,
                ];
                $estadoSectores = $ticket->n_estado_sectores;
                $valid = new Validator();
                if ($valid->required(null, $request->jsonSectores)) {
                    $obj["n_json_sectores"] = $request->jsonSectores;
                    if ($request->typeBlock == 1) {
                        $obj["n_sectoresbloqueados"] = $request->sectoresBloqueados;
                        $obj["n_sectoresdesbloqueados"] = DB::NULLED;
                        if ($estadoSectores != "BLOQUEADOS") {
                            $obj["d_bloqueo"] = Hash::getDate();
                            $obj["n_estado_sectores"] = "BLOQUEADOS";
                        }
                    } else
                    if ($request->typeBlock == 0) {
                        $obj["n_sectoresbloqueados"] = DB::NULLED;
                        $obj["n_sectoresdesbloqueados"] = $request->sectoresDesbloqueados;
                        if ($estadoSectores != "DESBLOQUEADOS") {
                            $obj["d_desbloqueo"] = Hash::getDate();
                            $obj["n_estado_sectores"] = "DESBLOQUEADOS";
                        }
                    }
                }
                $obj["n_en_prorroga"] = "TRUE";
                $obj["n_cont_prorrogas"] = ($ticket->n_cont_prorrogas >= 0) ? ($ticket->n_cont_prorrogas + 1) : 1;
                $ticketModel->where("k_id_onair", "=", $id)->update($obj);
            } else {
                $response = new Response(EMessages::EMPTY_MSG, "No se encontró el proceso.");
            }
            $this->registerReportComment($id, $comment);
            $response = new Response(EMessages::INSERT);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    private function changeFase($obj, $ticket, $stepModel, $followModel, $type) {
        //Actualizamos o insertamos el nuevo registro de la siguiente fase.
        $this->createProcess($stepModel, $ticket, $obj->d_start, $obj->d_end, $obj->comment, $type);
        if ($type == "START") {
            $request = $this->request;
            $request->n_round = $ticket->n_round;
            $idFollow = $followModel->insert($request->all())->data;
            $objTemp = [
                $obj->fieldIdFollow => $idFollow
            ];

            $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                    ->where("i_round", "=", $ticket->n_round)
                    ->update($objTemp);
            $this->updateEngTicket($ticket->k_id_onair, 0);
            $this->updateStatusTicket($ticket->k_id_onair, $obj->state);
        }
    }

    private function finishFase($ticket, $cog12, $cog24, $cog36) {
        $status_onair = DB::table("status_on_air")
                ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                ->first();
        $faseActual = null;
        if ($status_onair) {
            switch ($status_onair->k_id_substatus) {
                case ConstSubStates::SEGUIMIENTO_12H:
                    $faseActual = "12h";
                    $stepModel = new OnAir12hModel();
                    $followModel = new FollowUp12hModel();
                    $obj = new ObjUtil($cog12);
                    //Finalizo el 12h...
                    $this->changeFase($obj, $ticket, $stepModel, $followModel, "END");
                    break;
                case ConstSubStates::SEGUIMIENTO_24H:
                    $faseActual = "24h";
                    $stepModel = new OnAir24hModel();
                    $followModel = new FollowUp24hModel();
                    $obj = new ObjUtil($cog24);
                    //Finalizo el 24h...
                    $this->changeFase($obj, $ticket, $stepModel, $followModel, "END");
                    break;
                case ConstSubStates::SEGUIMIENTO_36H:
                    $faseActual = "36h";
                    $stepModel = new OnAir36hModel();
                    $followModel = new FollowUp36hModel;
                    $obj = new ObjUtil($cog36);
                    //Finalizo el 36h...
                    $this->changeFase($obj, $ticket, $stepModel, $followModel, "END");
                    break;
            }
        }
        return $faseActual;
    }

    private function toFase($fase, $ticket, $cog12, $cog24, $cog36, $faseActual) {
        switch ($fase) {
            case "12h":
                $stepModel = new OnAir12hModel();
                $followModel = new FollowUp12hModel();
                $obj = new ObjUtil($cog12);
                //Inicio el 12h...
                $this->changeFase($obj, $ticket, $stepModel, $followModel, "START");
                break;
            case "24h":
                $stepModel = new OnAir24hModel();
                $followModel = new FollowUp24hModel();
                $obj = new ObjUtil($cog24);
                //Inicio el 24h...
                $this->changeFase($obj, $ticket, $stepModel, $followModel, "START");
                break;
            case "36h":
                //Aquí comprobaremos si la fase anterior se encontraba en 12h,
                //con el fin de actualizar el 24h...
                if ($faseActual == "12h") {
                    $stepModel = new OnAir24hModel();
                    $followModel = new FollowUp24hModel();
                    $obj = new ObjUtil($cog24);
                    //Finalizo el 24h...
                    $temp = $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                                    ->where("i_round", "=", $ticket->n_round)->first();
                    if ($temp) {
                        $this->changeFase($obj, $ticket, $stepModel, $followModel, "END");
                    } else {
                        $this->changeFase($obj, $ticket, $stepModel, $followModel, "CREATE");
                    }
                }
                $stepModel = new OnAir36hModel();
                $followModel = new FollowUp36hModel();
                $obj = new ObjUtil($cog36);
                //Inicio el 36h...
                $this->changeFase($obj, $ticket, $stepModel, $followModel, "START");
                break;
        }
    }

    public function nextFase($request) {
        $this->request = $request;
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

            $cog12 = [
                "state" => 81,
                "d_start" => "d_start12h",
                "d_end" => "d_fin12h",
                "fieldIdFollow" => "k_id_follow_up_12h",
                "comment" => $comment,
            ];

            $cog24 = [
                "state" => 82,
                "d_start" => "d_start24h",
                "d_end" => "d_fin24h",
                "fieldIdFollow" => "k_id_follow_up_24h",
                "comment" => $comment,
            ];

            $cog36 = [
                "state" => 83,
                "d_start" => "d_start36h",
                "d_end" => "d_fin36h",
                "fieldIdFollow" => "k_id_follow_up_36h",
                "comment" => $comment,
            ];

            if ($ticket) {
                //Finalizamos la fase actual...
                //Cerramos el KPI...
                $kpiDao = new Dao_kpi_model();
                //Se registra el KPI.
                $kpiDao->record($ticket, false, true);

                $faseActual = $this->finishFase($ticket, $cog12, $cog24, $cog36);

                //Pasamos a la siguiente fase...
                $this->toFase($fase, $ticket, $cog12, $cog24, $cog36, $faseActual);

                $estadoSectores = $ticket->n_estado_sectores;
                //Se actualizan los sectores...
                $valid = new Validator();
                if ($valid->required(null, $request->jsonSectores)) {
                    $tempOnair = new TicketOnAirModel();
                    $obj = ["n_json_sectores" => $request->jsonSectores];
                    if ($request->typeBlock == 1) {
                        $obj["n_sectoresbloqueados"] = $request->sectoresBloqueados;
                        $obj["n_sectoresdesbloqueados"] = DB::NULLED;
                        if ($estadoSectores != "BLOQUEADOS") {
                            $obj["d_bloqueo"] = Hash::getDate();
                            $obj["n_estado_sectores"] = "BLOQUEADOS";
                        }
                    } else
                    if ($request->typeBlock == 0) {
                        $obj["n_sectoresbloqueados"] = DB::NULLED;
                        $obj["n_sectoresdesbloqueados"] = $request->sectoresDesbloqueados;
                        if ($estadoSectores != "DESBLOQUEADOS") {
                            $obj["d_desbloqueo"] = Hash::getDate();
                            $obj["n_estado_sectores"] = "DESBLOQUEADOS";
                        }
                    }
                    $tempOnair->where("k_id_onair", "=", $id)->update($obj);
                }

                $this->registerReportComment($ticket->k_id_onair, $comment);
                $response = new Response(EMessages::SUCCESS);
            } else {
                $response = new Response(EMessages::EMPTY_MSG, "No se encontró el proceso.");
            }
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getStatesProduction() {
        try {
            $responde = new Response(EMessages::QUERY);
            $subStatusModel = new SubstatusModel();
            $data = $subStatusModel->join("status_on_air", "substatus.k_id_substatus", "=", "status_on_air.k_id_substatus")
                            ->where("status_on_air.k_id_status", "=", 8)->get();
            $responde->setData($data);
            return $responde;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function updateFollow($ticket, $idFollow = null, $idUser = null) {
        $status_onair = DB::table("status_on_air")
                ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                ->first();
        if ($status_onair) {
            $followIdField = null;
            $followModel = null;
            $d_fin = null;
            switch ($status_onair->k_id_substatus) {
                case ConstSubStates::SEGUIMIENTO_12H:
                    $followIdField = "k_id_follow_up_12h";
                    $followModel = new FollowUp12hModel();
                    break;
                case ConstSubStates::SEGUIMIENTO_24H:
                    $followIdField = "k_id_follow_up_24h";
                    $followModel = new FollowUp24hModel();
                    break;
                case ConstSubStates::SEGUIMIENTO_36H:
                    $followIdField = "k_id_follow_up_36h";
                    $followModel = new FollowUp36hModel();
                    break;
            }
            if ($followModel) {
                $obj = new ObjUtil([
                    "followModel" => $followModel,
                    "followIdField" => $followIdField,
                ]);

                //Actualizamos si viene el id del usuario...
                if ($idFollow) {
                    //Actualizamos el usuario...
                    $followModel->where($followIdField, "=", $idFollow)->update([
                        "k_id_user" => $idUser,
                    ]);
                    //Actualizamos el usuario actual del onair...
                    $ticketModel = new TicketOnAirModel();
                    $ticketModel->where("k_id_onair", "=", $ticket->k_id_onair)
                            ->update([
                                "i_actualEngineer" => $idUser
                    ]);
                }

                return $obj;
            }
        } else {
            return null;
        }
    }

    public function getStepModel($ticket) {
        $status_onair = DB::table("status_on_air")
                ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                ->first();
        if ($status_onair) {
            $actual_status = null;
            $stepIdField = null;
            $stepModel = null;
            $k_id_follow = null;
            $d_start = null;
            $d_fin = null;
            switch ($status_onair->k_id_substatus) {
                case ConstSubStates::SEGUIMIENTO_12H:
                    $actual_status = "12h";
                    $stepIdField = "k_id_12h_real";
                    $stepModel = new OnAir12hModel();
                    $k_id_follow = "k_id_follow_up_12h";
                    $d_start = "d_start12h";
                    $d_fin = "d_fin12h";
                    break;
                case ConstSubStates::SEGUIMIENTO_24H:
                    $actual_status = "24h";
                    $stepIdField = "k_id_24h_real";
                    $stepModel = new OnAir24hModel();
                    $k_id_follow = "k_id_follow_up_24h";
                    $d_start = "d_start24h";
                    $d_fin = "d_fin24h";
                    break;
                case ConstSubStates::SEGUIMIENTO_36H:
                    $actual_status = "36h";
                    $stepIdField = "k_id_36h_real";
                    $k_id_follow = "k_id_follow_up_36h";
                    $stepModel = new OnAir36hModel();
                    $d_start = "d_start36h";
                    $d_fin = "d_fin36h";
                    break;
            }
            if ($stepModel) {
                $obj = new ObjUtil([
                    "stepModel" => $stepModel,
                    "stepIdField" => $stepIdField,
                    "d_start" => $d_start,
                    "d_fin" => $d_fin,
                    "k_id_follow" => $k_id_follow
                ]);
                return $obj;
            }
        } else {
            return null;
        }
    }

    public function updateEndDateFase($ticket) {
        try {
            $stepModel = $this->getStepModel($ticket);
            if ($stepModel) {
                $res = $stepModel->stepModel
                                ->where("k_id_onair", "=", $ticket->k_id_onair)
                                ->where("i_round", "=", $ticket->n_round)->update([
                    $stepModel->d_fin => Hash::getDate()
                ]);
                return $res;
            } else {
                return 0;
            }
        } catch (DeplynException $ex) {
            return 0;
        }
    }

    private function createProcess($stepModel, $ticket, $d_start, $d_end, $comment, $type = "CREATE") {
        if ($stepModel) {
            $temp = $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                            ->where("i_round", "=", $ticket->n_round)->first();
            $commentEdit = null;
            $tempComment = [
                "comment" => $comment,
                "date" => Hash::getDate()
            ];
            //Comprobar si existe el proceso (12h, 24h, 36h) y agrego el comentario...
            if ($temp) {
                $commentEdit = $temp->n_comentario;
                if ($commentEdit) {
                    $commentEdit = json_decode($commentEdit, true);
                    $commentEdit[] = $tempComment;
                } else {
                    $commentEdit = [$tempComment];
                }
                $obj = [
                    "i_state" => 0,
                    "n_comentario" => json_encode($commentEdit, true)
                ];
                if ($type == "CREATE") {
                    $obj[$d_start] = Hash::getDate();
                    $obj[$d_end] = Hash::getDate();
                } else if ($type == "START") {
                    $obj[$d_start] = Hash::getDate();
                } else if ($type == "END") {
                    $obj[$d_end] = Hash::getDate();
                }
                $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                        ->where("i_round", "=", $ticket->n_round)->update($obj);
            } else {
                $commentEdit = $tempComment;
                $obj = [
                    "k_id_onair" => $ticket->k_id_onair,
                    "i_round" => $ticket->n_round,
                    "n_comentario" => json_encode($commentEdit, true),
                    "i_state" => 0,
                ];
                if ($type == "CREATE") {
                    $obj[$d_start] = Hash::getDate();
                    $obj[$d_end] = Hash::getDate();
                } else if ($type == "START") {
                    $obj[$d_start] = Hash::getDate();
                } else if ($type == "END") {
                    $obj[$d_end] = Hash::getDate();
                }
                $stepModel->insert($obj);
                if ($type == "CREATE") {
                    $kpiDao = new Dao_kpi_model();
                    $kpiDao->record($ticket, false, false, $stepModel->getConstantState());
                }
            }
        }
    }

    public function toProduction($request) {
        try {
            $response = new Response(EMessages::INSERT);
            //Variables...
            $id = $request->idProceso;
            //El estado del combobox: Pendiente tareas remedy y producción...
            $idStatus = $request->idStatus;
            $comment = $request->comment;
            $ticketModel = new TicketOnAirModel();
            $preparationModel = new PreparationStageModel();
            $ticket = $ticketModel->where("k_id_onair", "=", $id)->first();
            if ($ticket) {
                //Detectar el estado actual...
                //SE AGREGA EL COMENTARIO A LA FASE (12h,24h,36h)...
                //Comprobamos sobre cual estado se encuentra el proceso...
                $status_onair = DB::table("status_on_air")
                        ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                        ->first();

                if ($status_onair) {
                    $actual_status = null;
                    $stepIdField = null;
                    $stepModel = null;
                    $d_start = null;
                    $d_end = null;
                    //Creamos el proceso 12H
                    $stepModel = new OnAir12hModel();
                    $d_start = "d_start12h";
                    $d_end = "d_fin12h";
                    $kpiDao = new Dao_kpi_model();
                    $this->createProcess($stepModel, $ticket, $d_start, $d_end, $comment);
                    //Cerramos el KPI...
                    $kpiDao->record($ticket, false, true, ConstStates::SEGUIMIENTO_12H);


                    //Creamos el proceso 24H
                    $stepModel = new OnAir24hModel();
                    $d_start = "d_start24h";
                    $d_end = "d_fin24h";
                    $this->createProcess($stepModel, $ticket, $d_start, $d_end, $comment);
                    //Cerramos el KPI...
                    $kpiDao->record($ticket, false, true, ConstStates::SEGUIMIENTO_24H);

                    //Creamos el proceso 36H
                    $stepModel = new OnAir36hModel();
                    $d_start = "d_start36h";
                    $d_end = "d_fin36h";
                    $this->createProcess($stepModel, $ticket, $d_start, $d_end, $comment);
                    //Cerramos el KPI...
                    $kpiDao->record($ticket, false, true, ConstStates::SEGUIMIENTO_36H);
                }


                //Se pasan todos los sectores bloqueados a desbloqueados...
                $sectores = $ticket->n_json_sectores;
                $sectoresDesbloqueados = "";
                if ($sectores) {
                    $finalSectores = [];
                    $sectores = json_decode($sectores, true);
                    $i = 0;
                    if (is_array($sectores) || is_object($sectores)) {
                        $count = count($sectores);
                        foreach ($sectores as $value) {
                            $obj = [
                                "id" => $value["id"],
                                "name" => $value["name"],
                                "state" => 0, //Desbloqueado...
                            ];
                            $finalSectores[] = $obj;
                            $sectoresDesbloqueados .= $value["name"] . (($i < ($count - 1) ? ", " : ""));
                            $i++;
                        }
                        $sectores = $finalSectores;
                        $sectores = json_encode($sectores, true);
                    } else {
                        $sectores = DB::NULLED;
                    }
                } else {
                    $sectores = DB::NULLED;
                }

                //Se actualiza el estado a producción y se establece la fecha en la que inició la producción...
                $ticketModel->where("k_id_onair", "=", $id)->update([
                    "k_id_status_onair" => $idStatus,
                    "d_fechaproduccion" => Hash::getDate(),
                    "n_estadoonair" => "ON_AIR",
                    "i_actualEngineer" => 0,
                    "n_estado_sectores" => "DESBLOQUEADOS",
                    "n_json_sectores" => $sectores,
                    "n_sectoresbloqueados" => DB::NULLED,
                    "n_sectoresdesbloqueados" => $sectoresDesbloqueados,
                    "n_en_prorroga" => "FALSE"
                ]);
                $preparationModel->where("k_id_preparation", "=", $ticket->k_id_preparation)->update([
                    "b_vistamm" => "False"
                ]);
                $this->registerReportComment($ticket->k_id_onair, $comment);
            } else {
                $response = new Response(EMessages::EMPTY_MSG, "No se encontró el proceso.");
            }
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function updateTicketDetails($request) {
        try {
            $response = new Response(EMessages::UPDATE);
            $model = new TicketOnAirModel();
            $ticket = $model->where("k_id_onair", "=", $request->idOnAir)->first();
            if ($ticket) {
                $model->where("k_id_onair", "=", $request->idOnAir)->update([
                    "k_id_technology" => $request->k_id_technology->k_id_technology,
                    "k_id_band" => $request->k_id_band->k_id_band,
                    "k_id_work" => $request->k_id_work->k_id_work
                ]);
                $model2 = new PreparationStageModel();
                $model2->where("k_id_preparation", "=", $ticket->k_id_preparation)->update([
                    "n_wp" => $request->k_id_preparation->n_wp,
                    "n_bcf_wbts_id" => $request->k_id_preparation->n_bcf_wbts_id,
                    "n_enteejecutor" => $request->k_id_preparation->n_enteejecutor
                ]);
                return $response;
            } else {
                return new Response(EMessages::ERROR, "El ticket no existe.");
            }
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function stopStandBy($tck, $request, $idIng = null) {
        if (!is_object($tck) && $tck > 0) {
            //Consultamos el ticket...
            $ticket = new TicketOnAirModel();
            $tck = $ticket->where("k_id_onair", "=", $tck)->first();
            if (!$tck) {
                return new Response(EMessages::ERROR, "El ticket no existe.");
            }
        } else if ($tck == null) {
            return new Response(EMessages::ERROR, "Ticket no referido.");
        }
        //Se detiene el stand by...
        //Primero, lo primero, verificamos el estado actual del ticket...
        if ($tck->k_id_status_onair == 100) {
            $json = null;
            //Si se encuentra en Stand By obtenemos el objeto JSON...
            if ($tck->data_standby) {
                $json = json_decode($tck->data_standby, true);
            } else {
                //Si el objeto no tiene nada se dejará en precheck...
                $json = [
                    "k_id_status_onair" => 78, //Precheck por defecto..
                    "actual_status" => "precheck", //Precheck, 12h, 24h, 36h.
                    "time_elapsed" => 0, //Tiempo transcurrido.....
                ];
            }
//            var_dump($json);
            //Parceamos el objeto a un objeto que podamos acceder sin ningún problema...
            $json = new ObjUtil($json);
            //Ahora vamos a las tablas...
            $date = (Hash::getTimeStamp(Hash::getDate()) - $json->time_elapsed);
            $date = Hash::timeStampToDate($date);
            //Verificamos los sectores y los pasamos a desbloqueados...
            //Se pasan todos los sectores bloqueados a desbloqueados...
            $sectores = $tck->n_json_sectores;
            $sectoresDesbloqueados = "";
            if ($sectores) {
                $finalSectores = [];
                $sectores = json_decode($sectores, true);
                $i = 0;
                if (is_array($sectores) || is_object($sectores)) {
                    $count = count($sectores);
                    foreach ($sectores as $value) {
                        $obj = [
                            "id" => $value["id"],
                            "name" => $value["name"],
                            "state" => (($value["state"] != -1) ? 0 : -1), //Desbloqueado...
                        ];
                        $finalSectores[] = $obj;
                        $sectoresDesbloqueados .= $value["name"] . (($i < ($count - 1) ? ", " : ""));
                        $i++;
                    }
                    $sectores = $finalSectores;
                    $sectores = json_encode($sectores, true);
                } else {
                    $sectores = DB::NULLED;
                }
            } else {
                $sectores = DB::NULLED;
            }

            $objForUpdate = new ObjUtil([
                "n_sectoresbloqueados" => DB::NULLED,
                "n_sectoresdesbloqueados" => $sectoresDesbloqueados,
                "n_json_sectores" => $sectores,
                "n_estado_sectores" => "DESBLOQUEADOS"
            ]);

            if ($json->actual_status == "precheck") {
                //Lo ponemos en seguimiento precheck...
                $ticketModel = new TicketOnAirModel();
                $objForUpdate->k_id_status_onair = $json->k_id_status_onair;
                $objForUpdate->d_precheck_init = $date;
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update($objForUpdate->all());
                $comment = "Se detiene el Stand By --- $request->comment";
//                $this->registerReportComment($tck->k_id_onair, $comment);
            } else if ($json->actual_status == "12h") {
                //Lo ponemos en seguimiento 12h...
                $ticketModel = new TicketOnAirModel();
                $objForUpdate->k_id_status_onair = $json->k_id_status_onair;
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update($objForUpdate->all());
                //Actualizmos el detalle de 12h...
                $comment = "Se detiene el Stand By --- $request->comment";
                $seguimientoModel = new OnAir12hModel();
                $this->insertCommentDetail($seguimientoModel, $tck, [
                    "n_comentario" => $comment,
                    "d_start12h" => $date,
                ]);
//                $this->registerReportComment($tck->k_id_onair, $comment);
            } else if ($json->actual_status == "24h") {
                //Lo ponemos en seguimiento 12h...
                $ticketModel = new TicketOnAirModel();
                $objForUpdate->k_id_status_onair = $json->k_id_status_onair;
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update($objForUpdate->all());
                //Actualizmos el detalle de 12h...
                $comment = "Se detiene el Stand By --- $request->comment";
                $seguimientoModel = new OnAir24hModel();
                $this->insertCommentDetail($seguimientoModel, $tck, [
                    "n_comentario" => $comment,
                    "d_start12h" => $date,
                ]);
//                $this->registerReportComment($tck->k_id_onair, $comment);
            } else if ($json->actual_status == "36h") {
                //Lo ponemos en seguimiento 12h...
                $ticketModel = new TicketOnAirModel();
                $objForUpdate->k_id_status_onair = $json->k_id_status_onair;
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update($objForUpdate->all());
                //Actualizmos el detalle de 12h...
                $comment = "Se detiene el Stand By --- $request->comment";
                $seguimientoModel = new OnAir36hModel();
                $this->insertCommentDetail($seguimientoModel, $tck, [
                    "n_comentario" => $comment,
                    "d_start12h" => $date,
                ]);
//                $this->registerReportComment($tck->k_id_onair, $comment);
            }
            return new Response(EMessages::CORRECT, "Se ha detenido correctamente el Stand By.");
        } else {
            return new Response(EMessages::ERROR, "El ticket no se encuentra en Stand By.");
        }
    }

    public function stopStandByManual($tck, $request) {
        $newState = null;
        $ticketOnAirModel = new TicketOnAirModel();
        switch ($request->new_state_standby) {
            case ConstStates::PRECHECK:
                //Lo pasamos a precheck...
                $newState = ConstStates::PRECHECK;
                $ticketOnAirModel->setIPrecheckRealizado(0);
                $ticketOnAirModel->setDPrecheckInit(Hash::getDateForTrack(TimerGlobal::NOTY));
                break;
            case ConstStates::SEGUIMIENTO_12H:
                $newState = ConstStates::SEGUIMIENTO_12H;
                break;
            case ConstStates::SEGUIMIENTO_24H:
                //Aquí actualizamos el seguimiento 24h o lo creamos...
                $newState = ConstStates::SEGUIMIENTO_24H;
                break;
            case ConstStates::SEGUIMIENTO_36H:
                //Aquí actualiamos el seguimiento 36h o lo creamos...
                $newState = ConstStates::SEGUIMIENTO_36H;
                break;
        }
        //Se actualiza el estado del ticket...
        if ($newState) {
            $ticketOnAirModel->where("k_id_onair", "=", $tck->k_id_onair);
            $ticketOnAirModel->update([
                "k_id_status_onair" => $newState
            ]);

            $step = $this->getStepModel($tck);
            if ($step) {
                $stepModel = $step->stepModel;
                $v = $stepModel->where("k_id_onair", "=", $tck->k_id_onair)
                                ->where("i_round", "=", $tck->n_round)->exist();

                //Si existe, lo actualiza...
                $stepModel = $step->stepModel;
                $obj = [
                    "k_id_onair" => $tck->k_id_onair,
                    $step->d_start => Hash::getDateForTrack(TimerGlobal::TRACK),
                    "d_fin12h" => DB::NULLED,
                    "d_start_temp" => DB::NULLED,
                    "i_state" => 0,
                    "i_hours" => 0,
                    "i_percent" => 0,
                    "i_timestamp" => 0,
                    "n_comentario" => DB::NULLED,
                    "i_round" => $tck->n_round,
                    "d_created_at" => Hash::getDate(),
                ];
                $stepModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("i_round", "=", $tck->n_round);
                if ($v) {
                    $stepModel->update($obj);
                }
                //De lo contrario, lo inserta...
                else {
                    $stepModel->insert($obj);
                }
            }
            $ticket->registerReportComment($tck->k_id_onair, $request->n_comentario_coor);
        }
    }

    private function insertCommentDetail($stepModel, $tck, $obj) {
        //Insetamos el comentario...
        $temp = $stepModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->where("i_round", "=", $tck->n_round)->first();
        $commentEdit = null;
        $tempComment = [
            "comment" => $obj["n_comentario"],
            "date" => Hash::getDate()
        ];
        if ($temp) {
            $commentEdit = $temp->n_comentario;
            if ($commentEdit) {
                $commentEdit = json_decode($commentEdit, true);
                $commentEdit[] = $tempComment;
            } else {
                $commentEdit = [$tempComment];
            }
        }
        $obj["n_comentario"] = json_encode($commentEdit, true);
        //Se actualiza el comentario del seguimiento actual...
        $stepModel->where("k_id_onair", "=", $tck->k_id_onair)
                ->where("i_round", "=", $tck->n_round)->update($obj);
    }

    public function toStandBy($tck, $request) {
        if (!is_object($tck) && $tck > 0) {
            //Consultamos el ticket...
            $ticket = new TicketOnAirModel();
            $tck = $ticket->where("k_id_onair", "=", $tck)->first();
            if (!$tck) {
                return new Response(EMessages::ERROR, "El ticket no existe.");
            }
        } else if ($tck == null) {
            return new Response(EMessages::ERROR, "Ticket no referido.");
        }

        $comment = $request->comment;
        $status_onair = (new StatusOnairModel())
                ->where("k_id_status_onair", "=", $tck->k_id_status_onair)
                ->first();
        if ($status_onair) {
            $actual_status = null;
            $stepIdField = null;
            $stepModel = null;
            $d_fin = null;
            switch ($status_onair->k_id_substatus) {
                case ConstStates::SEGUIMIENTO_12H:
                    $actual_status = "12h";
                    $stepIdField = "k_id_12h_real";
                    $stepModel = new OnAir12hModel();
                    $d_fin = "d_fin12h";
                    break;
                case ConstStates::SEGUIMIENTO_24H:
                    $actual_status = "24h";
                    $stepIdField = "k_id_24h_real";
                    $stepModel = new OnAir24hModel();
                    $d_fin = "d_fin24h";
                    break;
                case ConstStates::SEGUIMIENTO_36H:
                    $actual_status = "36h";
                    $stepIdField = "k_id_36h_real";
                    $stepModel = new OnAir36hModel();
                    $d_fin = "d_fin36h";
                    break;
            }
////            //Esto por si hay un seguimiento actual...
            if ($stepModel) {
                $this->insertCommentDetail($stepModel, $tck, [
                    "n_comentario" => $comment
                ]);
            } else {
                //Esto generalmente por si está en precheck...
                $actual_status = "precheck";
            }
////            //Se obtiene el tiempo que lleva...
            $timeGlobal = new TimerGlobal();
            $time = $timeGlobal->updateTimeStamp($tck);
            if ($time) {
                $time_elapsed = $time["today"] - $time["time"];
            } else {
                $time_elapsed = 0;
            }

            $json = [
                "k_id_status_onair" => $tck->k_id_status_onair,
                "actual_status" => $actual_status, //Precheck, 12h, 24h, 36h.
                "time_elapsed" => $time_elapsed, //Tiempo transcurrido...
            ];

            $ticket = new TicketOnAirModel();
            $ticket->where("k_id_onair", "=", $tck->k_id_onair)->update([
                "k_id_status_onair" => 100,
                "data_standby" => json_encode($json, true),
                "i_actualEngineer" => 0,
                "n_en_prorroga" => "FALSE"
            ]);


            //Se actualizan los sectores...
            $estadoSectores = $tck->n_estado_sectores;
            $valid = new Validator();
            if ($valid->required(null, $request->n_json_sectores)) {
                $tempOnair = new TicketOnAirModel();
                $obj = ["n_json_sectores" => $request->n_json_sectores];
                if ($request->typeBlock == 1) {
                    $obj["n_sectoresbloqueados"] = $request->n_sectores_bloqueados;
                    $obj["n_sectoresdesbloqueados"] = DB::NULLED;
                    if ($estadoSectores != "BLOQUEADOS") {
                        $obj["d_bloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "BLOQUEADOS";
                    }
                } else
                if ($request->typeBlock == 0) {
                    $obj["n_sectoresbloqueados"] = DB::NULLED;
                    $obj["n_sectoresdesbloqueados"] = $request->n_sectores_desbloqueados;
                    if ($estadoSectores != "DESBLOQUEADOS") {
                        $obj["d_desbloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "DESBLOQUEADOS";
                    }
                }
                $tempOnair->where("k_id_onair", "=", $request->idOnAir)->update($obj);
            }

            $this->registerReportComment($tck->k_id_onair, $comment);
            return new Response(EMessages::SUCCESS, "Se ha actualizado el estado del proceso correctamente.");
        } else {
            return new Response(EMessages::ERROR, "No se pudo actualizar el estaod del proceso.");
        }
    }

    public function restart12h($request) {
        try {
            $ticketModel = new TicketOnAirModel();
            $tck = $ticketModel->where("k_id_onair", "=", $request->idTicket)->first();
            if (!$tck) {
                return new Response(EMessages::ERROR, "El Ticket no existe o no es válido.");
            }
            $response = new Response(EMessages::UPDATE);
            $ticketModel->where("k_id_onair", "=", $request->idTicket)->update([
                "k_id_status_onair" => 81,
            ]);
            $ticketModel->where("k_id_onair", "=", $request->idTicket)->update([
                "i_actualEngineer" => 0,
            ]);


            //Se actualizan los sectores...
            $estadoSectores = $tck->n_estado_sectores;
            $valid = new Validator();
            if ($valid->required(null, $request->jsonSectores)) {
                $tempOnair = new TicketOnAirModel();
                $obj = ["n_json_sectores" => $request->jsonSectores];
                if ($request->typeBlock == 1) {
                    $obj["n_sectoresbloqueados"] = $request->sectoresBloqueados;
                    $obj["n_sectoresdesbloqueados"] = DB::NULLED;
                    if ($estadoSectores != "BLOQUEADOS") {
                        $obj["d_bloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "BLOQUEADOS";
                    }
                } else
                if ($request->typeBlock == 0) {
                    $obj["n_sectoresbloqueados"] = DB::NULLED;
                    $obj["n_sectoresdesbloqueados"] = $request->sectoresDesbloqueados;
                    if ($estadoSectores != "DESBLOQUEADOS") {
                        $obj["d_desbloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "DESBLOQUEADOS";
                    }
                }
                $tempOnair->where("k_id_onair", "=", $request->idTicket)->update($obj);
            }

            //Ahora actualizamos la fecha Start de el registro 12h...
            $onAir12h = new OnAir12hModel();
            $this->insertCommentDetail($onAir12h, $tck, [
                "d_start12h" => Hash::getDateForTrack(TimerGlobal::TRACK),
                "i_hours" => 0,
                "n_comentario" => "Se inicia el proceso después de pasar por un Reinicio12h."
            ]);
//            $comentario = "Se inicia el proceso después de pasar por un Reinicio12h.";
            $this->registerReportComment($request->idTicket, $request->comentario_reinicio12h);

            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function restart24h($request) {
        try {
            $ticketModel = new TicketOnAirModel();
            $tck = $ticketModel->where("k_id_onair", "=", $request->idTicket)->first();
            if (!$tck) {
                return new Response(EMessages::ERROR, "El Ticket no existe o no es válido.");
            }
            $response = new Response(EMessages::UPDATE);
            $ticketModel->where("k_id_onair", "=", $request->idTicket)->update([
                "k_id_status_onair" => 82,
            ]);
            $ticketModel->where("k_id_onair", "=", $request->idTicket)->update([
                "i_actualEngineer" => 0,
            ]);


            //Se actualizan los sectores...
            $estadoSectores = $tck->n_estado_sectores;
            $valid = new Validator();
            if ($valid->required(null, $request->jsonSectores)) {
                $tempOnair = new TicketOnAirModel();
                $obj = ["n_json_sectores" => $request->jsonSectores];
                if ($request->typeBlock == 1) {
                    $obj["n_sectoresbloqueados"] = $request->sectoresBloqueados;
                    $obj["n_sectoresdesbloqueados"] = DB::NULLED;
                    if ($estadoSectores != "BLOQUEADOS") {
                        $obj["d_bloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "BLOQUEADOS";
                    }
                } else
                if ($request->typeBlock == 0) {
                    $obj["n_sectoresbloqueados"] = DB::NULLED;
                    $obj["n_sectoresdesbloqueados"] = $request->sectoresDesbloqueados;
                    if ($estadoSectores != "DESBLOQUEADOS") {
                        $obj["d_desbloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "DESBLOQUEADOS";
                    }
                }
                $tempOnair->where("k_id_onair", "=", $request->idTicket)->update($obj);
            }

            //Ahora actualizamos la fecha Start de el registro 12h...
            $onAir24h = new OnAir24hModel();
            $this->insertCommentDetail($onAir24h, $tck, [
                "d_start24h" => Hash::getDate(),
                "i_hours" => 0,
                "n_comentario" => "Se inicia el proceso después de pasar por un Reinicio24h."
            ]);
//            $comentario = "Se inicia el proceso después de pasar por un Reinicio12h.";
            $this->registerReportComment($request->idTicket, $request->comentario_reinicio24h);

            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function restart36h($request) {
        try {
            $ticketModel = new TicketOnAirModel();
            $tck = $ticketModel->where("k_id_onair", "=", $request->idTicket)->first();
            if (!$tck) {
                return new Response(EMessages::ERROR, "El Ticket no existe o no es válido.");
            }
            $response = new Response(EMessages::UPDATE);
            $ticketModel->where("k_id_onair", "=", $request->idTicket)->update([
                "k_id_status_onair" => 83,
            ]);
            $ticketModel->where("k_id_onair", "=", $request->idTicket)->update([
                "i_actualEngineer" => 0,
            ]);


            //Se actualizan los sectores...
            $estadoSectores = $tck->n_estado_sectores;
            $valid = new Validator();
            if ($valid->required(null, $request->jsonSectores)) {
                $tempOnair = new TicketOnAirModel();
                $obj = ["n_json_sectores" => $request->jsonSectores];
                if ($request->typeBlock == 1) {
                    $obj["n_sectoresbloqueados"] = $request->sectoresBloqueados;
                    $obj["n_sectoresdesbloqueados"] = DB::NULLED;
                    if ($estadoSectores != "BLOQUEADOS") {
                        $obj["d_bloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "BLOQUEADOS";
                    }
                } else
                if ($request->typeBlock == 0) {
                    $obj["n_sectoresbloqueados"] = DB::NULLED;
                    $obj["n_sectoresdesbloqueados"] = $request->sectoresDesbloqueados;
                    if ($estadoSectores != "DESBLOQUEADOS") {
                        $obj["d_desbloqueo"] = Hash::getDate();
                        $obj["n_estado_sectores"] = "DESBLOQUEADOS";
                    }
                }
                $tempOnair->where("k_id_onair", "=", $request->idTicket)->update($obj);
            }

            //Ahora actualizamos la fecha Start de el registro 12h...
            $onAir36h = new OnAir36hModel();
            $this->insertCommentDetail($onAir36h, $tck, [
                "d_start36h" => Hash::getDate(),
                "i_hours" => 0,
                "n_comentario" => "Se inicia el proceso después de pasar por un Reinicio36h."
            ]);
//            $comentario = "Se inicia el proceso después de pasar por un Reinicio12h.";
            $this->registerReportComment($request->idTicket, $request->comentario_reinicio36h);

            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getSectores($request) {
        try {
            $resposne = new Response(EMessages::QUERY);
            $db = new DB();
            $sql = "SELECT s.* FROM sectores s INNER JOIN sectores_on_air sa
                    inner JOIN `work` w
                    ON s.k_id_sector = sa.k_id_sector WHERE sa.k_id_tecnology = $request->idTecnologia
                    AND sa.k_id_band = $request->idBanda AND w.k_id_work = $request->idTipoTrabajo AND w.b_aplica_bloqueo = 1 group by s.k_id_sector ";
            $data = $db->select($sql)->get();
            $resposne->setData($data);
            return $resposne;
        } catch (DeplynException $exc) {
            return $ext;
        }
    }

    public function getCommentsTicket($request) {
        try {
            $response = new Response(EMessages::QUERY);
            $comments = new ReporteComentarioModel();
            $data = $comments
                    ->where("k_id_on_air", "=", $request->idTicket)
                    ->orderBy("hora_actualizacion_resucomen", "desc")
                    ->get();
//            echo $comments->getSQL();
            $response->setData($data);
            return $response;
        } catch (Exception $ex) {
            return $ex;
        }
    }

}

?>
