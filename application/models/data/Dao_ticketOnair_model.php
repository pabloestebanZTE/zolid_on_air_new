<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_ticketOnair_model extends CI_Model {

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
        $this->load->model('bin/ConstStates');
        $this->load->model('bin/SubstatusModel');
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

    public function registerReportComment($idTicket, $comment = null) {
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
                    "usuario_resucomen" => (Auth::check()) ? Auth::user()->n_name_user . " " . Auth::user()->n_last_name_user : "Indefinido ",
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
        } catch (ZolidException $ex) {
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
            $this->registerReportComment($datos->data, $request->n_comentario_doc);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAll() {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->orderBy("k_id_onair", "DESC")->get();
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
                // $objStatusOnair = [
                //     "k_id_status" => $request->ticket_on_air->k_id_status_onair->k_id_status,
                //     "k_id_substatus" => $request->ticket_on_air->k_id_status_onair->k_id_substatus
                // ];
                $idStatusOnair = 0;
                $idPreparation = 0;
                //ACTUALIZANDO STATUS_ONAIR
//                if ($status_onair) {
//                    //SE REALIZA LA ACTUALIZACIÓN DEL STATUS_ONAIR...
////                    $idStatusOnair = $status_onair->k_id_status_onair;
////                    DB::table("status_on_air")
////                            ->where("k_id_status_onair", "=", $tempTicketOnAir->k_id_status_onair)
////                            ->update($objStatusOnair);
//                } else {
//                    //SE INSERTA EL STATUS_ONAIR...
//                    $idStatusOnair = DB::table("status_on_air")
//                            ->insert($objStatusOnair);
//                }
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
                DB::table("ticket_on_air")
                        ->where("k_id_onair", "=", $request->ticket_on_air->id_onair)
                        ->update([
                            "d_bloqueo" => $request->ticket_on_air->d_bloqueo,
                            "d_desbloqueo" => $request->ticket_on_air->d_desbloqueo,
                            "n_sectoresbloqueados" => $request->ticket_on_air->n_sectoresbloqueados,
                            "n_sectoresdesbloqueados" => $request->ticket_on_air->n_sectoresdesbloqueados,
                            "n_json_sectores" => $request->ticket_on_air->n_json_sectores,
                            "fecha_rft" => $request->ticket_on_air->fecha_rft,
                            "d_fecha_cg" => $request->ticket_on_air->d_fecha_cg,
                            "n_exclusion_bajo_trafico" => $request->ticket_on_air->n_exclusion_bajo_trafico,
                ]);
//                $res = $ticketOnAir->where("k_id_onair", "=", $request->ticket_on_air->id_onair)
//                        ->update($request->ticket_on_air->all());
//                DB::runSQL($ticketOnAir->getSQL());
                $response = new Response(EMessages::UPDATE);
                $response->setData($ticketOnAir->getSQL());
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

    function updatePrecheckOnair($request, $id) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $request->k_id_status_onair = $id;
            $datos = $ticketOnAir->where("k_id_onair", "=", $request->k_id_ticket)
                    ->update($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            $response->setMessage("Se ha actualizado el precheck correctamente");
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
                    default :
                        $actual_status = $status_onair->k_id_substatus;
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
                return new Response(EMessages::EMPTY_MSG, "Aún no se ha hecho precheck para este proceso.");
            }
        } catch (ZolidException $ex) {

            return $ex;
        }
    }

    function updateTicketScaling($request) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $request->i_actualEngineer = 0;
            $datos = $ticketOnAir->where("k_id_onair", "=", $request->k_id_onair)
                    ->update($request->all());
//            echo $ticketOnAir->getSQL();
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

    function updateStatusTicket($id, $value, $request = null) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            if ($request == null) {
                $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                        ->update(["k_id_status_onair" => $value]);
            } else {
                $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                        ->update([
                    "k_id_status_onair" => $value,
                    "d_fechaproduccion" => Hash::getDate(),
                    "n_estadoonair" => "ON_AIR"
                ]);
            }
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    function updateEngTicket($id, $value) {
        try {
            $ticketOnAir = new TicketOnAirModel();
            $datos = $ticketOnAir->where("k_id_onair", "=", $id)
                    ->update(["i_actualEngineer" => $value]);

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

    private function getListTicket($request, $condition) {
        try {
            //CONSULTAMOS LA LISTA DE REGISTROS PENDIENTES...
            $db = new DB();
            $pending = null;
            $sql = "";
            $sqlCount = "";
            if ($request->search->value) {
                $request->searchValue = $request->search->value;
                $sql = "SELECT tk.* FROM ticket_on_air tk
                        INNER JOIN technology t ON t.k_id_technology = tk.k_id_technology
                        INNER JOIN `status` s
                        INNER JOIN substatus sb
                        INNER JOIN status_on_air sa ON
                        sa.k_id_status_onair = tk.k_id_status_onair
                        AND sa.k_id_status = s.k_id_status
                        AND sb.k_id_substatus = sa.k_id_substatus
                        INNER JOIN band bd ON bd.k_id_band = tk.k_id_band
                        INNER JOIN station st ON st.k_id_station = tk.k_id_station
                        INNER JOIN `work` w ON w.k_id_work = tk.k_id_work
                        WHERE
                        (t.n_name_technology LIKE '%$request->searchValue%'
                        OR s.n_name_status LIKE '%$request->searchValue%'
                        OR sb.n_name_substatus LIKE '%$request->searchValue%'
                        OR bd.n_name_band LIKE '%$request->searchValue%'
                        OR st.n_name_station LIKE '%$request->searchValue%'
                        OR w.n_name_ork LIKE '%$request->searchValue%')
                        AND $condition
                        group by tk.k_id_onair
                        order by d_fecha_ultima_rev desc limit $request->start, $request->length";

                $sqlCount = "SELECT count(tk.k_id_onair) as count FROM ticket_on_air tk
                        INNER JOIN technology t ON t.k_id_technology = tk.k_id_technology
                         INNER JOIN `status` s
                        INNER JOIN substatus sb
                        INNER JOIN status_on_air sa ON
                        sa.k_id_status_onair = tk.k_id_status_onair
                        AND sa.k_id_status = s.k_id_status
                        AND sb.k_id_substatus = sa.k_id_substatus
                        INNER JOIN band bd ON bd.k_id_band = tk.k_id_band
                        INNER JOIN station st ON st.k_id_station = tk.k_id_station
                        INNER JOIN `work` w ON w.k_id_work = tk.k_id_work
                        WHERE
                        (t.n_name_technology LIKE '%$request->searchValue%'
                        OR s.n_name_status LIKE '%$request->searchValue%'
                        OR sb.n_name_substatus LIKE '%$request->searchValue%'
                        OR bd.n_name_band LIKE '%$request->searchValue%'
                        OR st.n_name_station LIKE '%$request->searchValue%'
                        OR w.n_name_ork LIKE '%$request->searchValue%')
                        AND $condition
                        group by tk.k_id_onair
                        order by d_fecha_ultima_rev desc";
            } else {
                $sql = "select * from ticket_on_air tk "
                        . "inner join status_on_air sa on sa.k_id_status_onair = tk.k_id_status_onair
                                    inner join `status` s on s.k_id_status = sa.k_id_status "
                        . "where $condition "
                        . "order by d_created_at desc limit $request->start, $request->length";
                $sqlCount = "select count(k_id_onair) as count from ticket_on_air tk "
                        . "inner join status_on_air sa on sa.k_id_status_onair = tk.k_id_status_onair
                                    inner join `status` s on s.k_id_status = sa.k_id_status "
                        . "where $condition "
                        . "order by d_fecha_ultima_rev desc";
            }

//            echo $sql;

            $pending = $db->select($sql)->get();

            $db = new DB();
            $count = $db->select($sqlCount)->first();
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
        } catch (ZolidException $exc) {
            return $exc;
        }
    }

    //Coordinador...
    public function getPendingList($request) {
        return $this->getListTicket($request, "(sa.k_id_status <> 1 and sa.k_id_status <> 3 and sa.k_id_status <> 4 and sa.k_id_status <> 5 and sa.k_id_status <> 6 and sa.k_id_status <> 7 and sa.k_id_status <> 8) AND i_actualEngineer = 0");
    }

    public function getAssignList($request) {
        return $this->getListTicket($request, "i_actualEngineer != 0");
    }

    //Fin Coordinador...
    //Documentador...
    public function getPriorityList($request) {
        return $this->getListTicket($request, "i_priority = '1'");
    }

    public function getTracingList($request) {
        return $this->getListTicket($request, "s.n_name_status LIKE '%Seguimiento%'");
    }

    public function getRestartList($request) {
        return $this->getListTicket($request, "s.n_name_status LIKE '%Escalado%'");
    }

    //Fin documentador...

    public function getAllTickets($request) {
        return $this->getListTicket($request, "1 = 1");
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
        } catch (ZolidException $exc) {
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
                $ticketModel->where("k_id_onair", "=", $id)->update([
                    "i_actualEngineer" => 0
                ]);
                $this->registerReportComment($ticket->k_id_onair, $comment);
            } else {
                $response = new Response(EMessages::EMPTY_MSG, "No se encontró el proceso.");
            }
            $this->registerReportComment($id, $comment);
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
                //SE ACTUALIZA LA FECHA FINAL DE UNA FASE (12h,24h,36h)...
                //Comprobamos sobre cual estado se encuentra el proceso....
                $status_onair = DB::table("status_on_air")
                        ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
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
                    //Después de comprobar sobre cual estado se encuentra y
                    //obtener el modelo necesario simplemente actualizamos la fecha final
                    //de ese proceso
                    $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                            ->where("i_round", "=", $ticket->n_round)->update([
                        $d_fin => date("Y-m-d H:i:s"),
                    ]);
                }


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
                /* $status_onair = DB::table("status_on_air")
                  ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
                  ->update([
                  "k_id_substatus" => $idStatus
                  ]); */
                //Luego actualizamos o insertamos el nuevo registro de la siguiente fase.
                $temp = $detailModel->where("k_id_onair", "=", $ticket->k_id_onair)
                        ->where("i_round", "=", $ticket->n_round)
                        ->first();

                $commentEdit = null;
                $tempComment = [
                    "comment" => $comment,
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
                } else {
                    $commentEdit = [$tempComment];
                }


                //Se comprueba si existe, para actualizar...
                if ($temp) {
                    $detailModel->where("k_id_onair", "=", $ticket->k_id_onair)
                            ->where("i_round", "=", $ticket->n_round)
                            ->update([
                                "i_state" => 0,
                                "n_comentario" => json_encode($commentEdit, true),
                                $dateField => Hash::getDate()
                    ]);
                } else {
                    //Se comprueba si no existe para insertarlo.
                    $detailModel->insert([
                        "k_id_onair" => $ticket->k_id_onair,
                        "i_state" => 0,
                        "n_comentario" => json_encode($commentEdit, true),
                        "i_round" => $ticket->n_round,
                        $dateField => Hash::getDate()
                    ]);
                }
                if ($idStatus == ConstStates::SEGUIMIENTO_12H) {
                    $follow = new FollowUp12hModel();
                    $onair = new OnAir12hModel();
                    $request->n_round = $ticket->n_round;
                    $datos = $follow->insert($request->all());
                    $response = new Response(EMessages::SUCCESS);
                    $response->setData($datos);
                    $datos = $onair->where("k_id_onair", "=", $ticket->k_id_onair)->where("i_round", "=", $ticket->n_round)
                            ->update(["k_id_follow_up_12h" => $response->data->data]);
                    $this->updateEngTicket($ticket->k_id_onair, 0);
                    $this->updateStatusTicket($ticket->k_id_onair, 81);
                }

                if ($idStatus == ConstStates::SEGUIMIENTO_24H) {
                    $follow = new FollowUp24hModel();
                    $onair = new OnAir24hModel();
                    $request->n_round = $ticket->n_round;
                    $datos = $follow->insert($request->all());
                    $response = new Response(EMessages::SUCCESS);
                    $response->setData($datos);
                    $datos = $onair->where("k_id_onair", "=", $ticket->k_id_onair)->where("i_round", "=", $ticket->n_round)
                            ->update(["k_id_follow_up_24h" => $response->data->data]);
                    $this->updateEngTicket($ticket->k_id_onair, 0);
                    $this->updateStatusTicket($ticket->k_id_onair, 82);
                }

                if ($idStatus == ConstStates::SEGUIMIENTO_36H) {
                    $follow = new FollowUp36hModel();
                    $onair = new OnAir36hModel();
                    $request->n_round = $ticket->n_round;
                    $datos = $follow->insert($request->all());
                    $response = new Response(EMessages::SUCCESS);
                    $response->setData($datos);
                    $datos = $onair->where("k_id_onair", "=", $ticket->k_id_onair)->where("i_round", "=", $ticket->n_round)
                            ->update(["k_id_follow_up_36h" => $response->data->data]);
                    $this->updateEngTicket($ticket->k_id_onair, 0);
                    $this->updateStatusTicket($ticket->k_id_onair, 83);
                }
                $this->registerReportComment($ticket->k_id_onair, $comment);
            } else {
                $response = new Response(EMessages::EMPTY_MSG, "No se encontró el proceso.");
            }
            return $response;
        } catch (ZolidException $ex) {
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
        } catch (ZolidException $ex) {
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
                case ConstStates::SEGUIMIENTO_12H:
                    $followIdField = "k_id_follow_up_12h";
                    $followModel = new FollowUp12hModel();
                    break;
                case ConstStates::SEGUIMIENTO_24H:
                    $followIdField = "k_id_follow_up_24h";
                    $followModel = new FollowUp24hModel();
                    break;
                case ConstStates::SEGUIMIENTO_36H:
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
            $d_fin = null;
            switch ($status_onair->k_id_substatus) {
                case ConstStates::SEGUIMIENTO_12H:
                    $actual_status = "12h";
                    $stepIdField = "k_id_12h_real";
                    $stepModel = new OnAir12hModel();
                    $k_id_follow = "k_id_follow_up_12h";
                    $d_fin = "d_fin12h";
                    break;
                case ConstStates::SEGUIMIENTO_24H:
                    $actual_status = "24h";
                    $stepIdField = "k_id_24h_real";
                    $stepModel = new OnAir24hModel();
                    $k_id_follow = "k_id_follow_up_24h";
                    $d_fin = "d_fin24h";
                    break;
                case ConstStates::SEGUIMIENTO_36H:
                    $actual_status = "36h";
                    $stepIdField = "k_id_36h_real";
                    $k_id_follow = "k_id_follow_up_36h";
                    $stepModel = new OnAir36hModel();
                    $d_fin = "d_fin36h";
                    break;
            }
            if ($stepModel) {
                $obj = new ObjUtil([
                    "stepModel" => $stepModel,
                    "stepIdField" => $stepIdField,
                    "d_fin" => $d_fin,
                    "k_id_follow" => $k_id_follow
                ]);
                return $obj;
            }
        } else {
            return null;
        }
    }

    public function toProduction($request) {
        try {
            $response = new Response(EMessages::INSERT);
            //Variables...
            $id = $request->idProceso;
            $idStatus = $request->idStatus;
            $comment = $request->comment;
            $ticketModel = new TicketOnAirModel();
            $ticket = $ticketModel->where("k_id_onair", "=", $id)->first();

            if ($ticket) {
                //Detectar el estado actual...
                //SE AGREGA EL COMENTARIO A LA FASE (12h,24h,36h)...
                //Comprobamos sobre cual estado se encuentra el proceso....
                $status_onair = DB::table("status_on_air")
                        ->where("k_id_status_onair", "=", $ticket->k_id_status_onair)
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
                    if ($stepModel) {
                        //Después de comprobar sobre cual estado se encuentra y
                        //obtener el modelo necesario simplemente actualizamos la fecha final
                        //de ese proceso
                        $temp = $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                                        ->where("i_round", "=", $ticket->n_round)->first();

                        $commentEdit = null;
                        $tempComment = [
                            "comment" => $comment,
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
                        $stepModel->where("k_id_onair", "=", $ticket->k_id_onair)
                                ->where("i_round", "=", $ticket->n_round)->update([
                            $d_fin => Hash::getDate(),
                            "n_comentario" => json_encode($commentEdit, true)
                        ]);
                    }
                }

                //Se actualiza el estado a producción y se establece la fecha en la que inició la producción...
                $ticketModel->where("k_id_onair", "=", $id)->update([
                    "k_id_status_onair" => $idStatus,
                    "d_fechaproduccion" => Hash::getDate(),
                    "n_estadoonair" => "ON_AIR",
                    "i_actualEngineer" => 0
                ]);
                $this->registerReportComment($ticket->k_id_onair, $comment);
            } else {
                $response = new Response(EMessages::EMPTY_MSG, "No se encontró el proceso.");
            }
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function updateTicketDetails($request) {
        try {
            $response = new Response(EMessages::UPDATE);
            $model = new TicketOnAirModel();
            $ticket = $model->where("k_id_onair", "=", $request->idOnAir)->first();
            if ($ticket) {
                $model2 = new PreparationStageModel();
                $model2->where("k_id_preparation", "=", $ticket->k_id_preparation)->update([
                    "n_wp" => $request->k_id_preparation->n_wp,
                    "n_bcf_wbts_id" => $request->k_id_preparation->n_bcf_wbts_id,
                    "n_enteejecutor" => $request->k_id_preparation->n_enteejecutor,
                ]);
                return $response;
            } else {
                return new Response(EMessages::ERROR, "El ticket no existe.");
            }
        } catch (ZolidException $ex) {
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
            if ($json->actual_status == "precheck") {
                //Lo ponemos en seguimiento precheck...
                $ticketModel = new TicketOnAirModel();
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update([
                            "k_id_status_onair" => $json->k_id_status_onair,
                            "d_precheck_init" => $date,
                ]);
                $comment = "Se detiene el Stand By --- $request->comment";
                $this->registerReportComment($tck->k_id_onair, $comment);
            } else if ($json->actual_status == "12h") {
                //Lo ponemos en seguimiento 12h...
                $ticketModel = new TicketOnAirModel();
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update([
                            "k_id_status_onair" => $json->k_id_status_onair,
                ]);
                //Actualizmos el detalle de 12h...
                $comment = "Se detiene el Stand By --- $request->comment";
                $seguimientoModel = new OnAir12hModel();
                $this->insertCommentDetail($seguimientoModel, $tck, [
                    "n_comentario" => $comment,
                    "d_start12h" => $date,
                ]);
                $this->registerReportComment($tck->k_id_onair, $comment);
            } else if ($json->actual_status == "24h") {
                //Lo ponemos en seguimiento 12h...
                $ticketModel = new TicketOnAirModel();
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update([
                            "k_id_status_onair" => $json->k_id_status_onair,
                ]);
                //Actualizmos el detalle de 12h...
                $comment = "Se detiene el Stand By --- $request->comment";
                $seguimientoModel = new OnAir24hModel();
                $this->insertCommentDetail($seguimientoModel, $tck, [
                    "n_comentario" => $comment,
                    "d_start12h" => $date,
                ]);
                $this->registerReportComment($tck->k_id_onair, $comment);
            } else if ($json->actual_status == "36h") {
                //Lo ponemos en seguimiento 12h...
                $ticketModel = new TicketOnAirModel();
                $ticketModel->where("k_id_onair", "=", $tck->k_id_onair)
                        ->update([
                            "k_id_status_onair" => $json->k_id_status_onair,
                ]);
                //Actualizmos el detalle de 12h...
                $comment = "Se detiene el Stand By --- $request->comment";
                $seguimientoModel = new OnAir36hModel();
                $this->insertCommentDetail($seguimientoModel, $tck, [
                    "n_comentario" => $comment,
                    "d_start12h" => $date,
                ]);
                $this->registerReportComment($tck->k_id_onair, $comment);
            }
            return new Response(EMessages::CORRECT, "Se ha detenido correctamente el Stand By.");
        } else {
            return new Response(EMessages::ERROR, "El ticket no se encuentra en Stand By.");
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


        $comment = "Se escala a StandBy --- $request->comment";
//
//        //Se deja el proceso en stand by...
//        //Empezamos guardando toda la configuración del estado actual del proceso, tiempos, etc, etc...
//        //DETECTAMOS EL SEGUIMIENTO ACTUAL...
        $status_onair = DB::table("status_on_air")
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
                "i_actualEngineer" => 0
            ]);
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
            //Ahora actualizamos la fecha Start de el registro 12h...
            $onAir12h = new OnAir12hModel();

            $this->insertCommentDetail($onAir12h, $tck, [
                "d_start12h" => Hash::getDate(),
                "i_hours" => 0,
                "n_comentario" => "Se inicia el proceso después de pasar por un Reinicio12h."
            ]);
            $comentario = "Se inicia el proceso después de pasar por un Reinicio12h.";
            $this->registerReportComment($request->idTicket, $comentario);

            return $response;
        } catch (ZolidException $ex) {
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
        } catch (ZolidException $exc) {
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
