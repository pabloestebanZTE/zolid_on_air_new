<?php

/*
 * Controlador para cosas genéricas del sistema...
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Utils extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function pr() {
        $s = new StationModel();
        echo $s->getLastId("k_id_station");
    }

    public function getTicketsByStations() {
        $response = new Response(EMessages::QUERY);
        $request = $this->request;
        $idStation = $request->idStation;
        //Consultamos los tickets en esta estación...
        $data = (new TicketOnAirModel())->where("k_id_station", "=", $idStation)->get();
        $this->getFKRegisters($data);
        $response->setData($data);
        $this->json($response);
    }

    public function getRelatedTicketsByIdTicked() {
        $response = new Response(EMessages::QUERY);
        $request = $this->request;
        $idTicket = $request->idTicket;
        //Consultamos los tickets relacionados...
        $db = new DB();
        $data = $db->select("select tck.* from ticket_on_air tck inner join related_tickets rt on rt.k_id_ticket2 = tck.k_id_onair or rt.k_id_ticket2 = tck.k_id_onair where rt.k_id_ticket1 = $idTicket")->get();
        $this->getFKRegisters($data);
        $response->setData($data);
        $this->json($response);
    }

    //<editor-fold defaultstate="collapsed" desc="getFKRegisters()" >
    public function getFKRegisters(&$res, $flag = null) {
//        $ticketsOnAir = new Dao_ticketOnair_model();
        $station = new Dao_station_model();
        $band = new Dao_band_model();
        $work = new Dao_work_model();
        $technology = new Dao_technology_model();
        $statusOnair = new Dao_statusOnair_model();
        $stage = new Dao_preparationStage_model();
        $assign = new Dao_user_model();
        for ($j = 0; $j < count($res); $j++) {
//            if ($flag == true) {
//                $daoAutoRecord = new Dao_autorecord_model();
//                $daoAutoRecord->record($res[$j]);
//            }
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

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="Other modules" >
    public function getCurrentTimeStamp() {
        $x = date("Y-m-d H:i:s");
        $this->json(Hash::getTimeStamp($x));
    }

    public function getCurrentDate() {
        $x = date("Y-m-d H:i:s");
        $this->json($x);
    }

    public function prueba() {
        echo date("d", Hash::getTime());
//        $date = Hash::getTimeStamp(Hash::getDate());
//        echo date("Y-m-d H:i:s", $date / 1000);
    }

    public function getActualDate() {
        $x = date("Y-m-d H:i:s");
        $response = new Response(EMessages::CORRECT);
        $response->setData($x);
        $this->json($response);
    }

    public function existSession() {
        $response = new Response(EMessages::SESSION_ACTIVE);
        if (!Auth::check()) {
            $response = new Response(EMessages::SESSION_INACTIVE);
        }
        $this->json($response);
    }

    public function time() {
        $x = date("Y-m-d H:i:s");
        $this->json($x);
    }

    public function getChecklist() {
        $checklistModel = new ChecklistModel();
        //Consultamos la lista de documentos para el checklist.
        $db = new DB();
        $list = $db->select("SELECT c.*, docs_acs.n_nombre as nombre_documento FROM checklist c INNER JOIN documentos_acs docs_acs "
                        . "ON c.k_id_documento = docs_acs.k_id_documento WHERE c.k_id_technology = " . $this->request->idTecnologia . " "
                        . "AND c.k_id_work = " . $this->request->idTipoTrabajo)->get();
//        $list = $checklistModel->where("k_id_technology", "=", $this->request->idTecnologia)
//                        ->where("k_id_work", "=", $this->request->idTipoTrabajo)->get();
        $response = new Response(EMessages::QUERY);
        $response->setData($list);
        $this->json($response);
    }

    public function bandsByTech() {
        $db = new DB();
        $data = $db->select("SELECT b.* FROM band b INNER JOIN ref_tech_band rtb "
                        . "ON b.k_id_band = rtb.k_id_band "
                        . "WHERE rtb.k_id_technology = "
                        . $this->request->id_technology)->get();
        $response = new Response(EMessages::QUERY);
        $response->setData($data);
        $this->json($response);
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getDatePHPExcel($sheet, $colum)" >
    private function getDatePHPExcel($sheet, $colum) {
        $cell = $sheet->getCell($colum);
        $validator = new Validator();
        $date = DB::NULLED;
        if ($validator->required("", $cell->getValue())) {
            $date = $cell->getValue();
            $date = date("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($date));
            $date = Hash::addHours($date, 5);
        }
        return $date;
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="uploadfile()" >
    public function uploadfile() {
        $request = $this->request;
        $storage = new Storage();
        //Se activa la asignación de un prefijo para nuestro archivo...
        $storage->setPrefix(true);
        //Seteamos las extenciones válidas...
        $storage->setValidExtensions("xlsx", "xls");
        //Subimos el archivo...
        $storage->process($request);
        //Obtenemos el log de los archivos subidos...
        $files = $storage->getFiles();
        $response = null;
        if (count($files) > 0) {
            $project = $files[0];
            $response = new Response(EMessages::SUCCESS, "Se ha subido el archivo correctamente", $project);
        } else {
            $response = new Response(EMessages::ERROR_ACTION, "No se pudo subir el archivo.");
        }
        $this->json($response);
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getPreparationStage" >
    private function getPreparationStage(&$sheet, &$obj, $row) {
        $obj->k_id_preparation = (new ObjUtil([
            "n_bcf_wbts_id" => $sheet->getCell('C' . $row)->getValue(),
            "n_bts_id" => $sheet->getCell('D' . $row)->getValue(),
            "d_ingreso_on_air" => $this->getDatePHPExcel($sheet, "J" . $row),
            "d_correccionespendientes" => $this->getDatePHPExcel($sheet, "V" . $row),
            "d_actualizacion_final" => $this->getDatePHPExcel($sheet, "BA" . $row),
            "n_enteejecutor" => $sheet->getCell('N' . $row)->getValue(),
            "n_controlador" => $sheet->getCell('O' . $row)->getValue(),
            "n_idcontrolador" => $sheet->getCell('P' . $row)->getValue(),
            "n_btsipaddress" => $sheet->getCell('W' . $row)->getValue(),
            "n_integrador" => $sheet->getCell('X' . $row)->getValue(),
            "n_wp" => $sheet->getCell('AB' . $row)->getValue(),
            "n_crq" => $sheet->getCell('AC' . $row)->getValue(),
            "n_testgestion" => $sheet->getCell('AD' . $row)->getValue(),
            "n_sitiolimpio" => $sheet->getCell('AE' . $row)->getValue(),
            "n_instalacion_hw_sitio" => $sheet->getCell('AG' . $row)->getValue(),
            "n_cambios_config_solicitados" => $sheet->getCell('AH' . $row)->getValue(),
            "n_cambios_config_final" => $sheet->getCell('AI' . $row)->getValue(),
            "n_contratista" => $sheet->getCell('AN' . $row)->getValue(),
            "n_comentarioccial" => $sheet->getCell('AO' . $row)->getValue(),
            "n_ticketremedy" => $sheet->getCell('AP' . $row)->getValue(),
            "n_lac" => $sheet->getCell('AT' . $row)->getValue(),
            "n_rac" => $sheet->getCell('AU' . $row)->getValue(),
            "n_sac" => $sheet->getCell('AV' . $row)->getValue(),
            "n_integracion_gestion_y_trafica" => $sheet->getCell('AW' . $row)->getValue(),
            "puesta_servicio_sitio_nuevo_lte" => $sheet->getCell('AX' . $row)->getValue(),
            "n_instalacion_hw_4g_sitio" => $sheet->getCell('AY' . $row)->getValue(),
            "pre_launch" => $sheet->getCell('AZ' . $row)->getValue(),
            "n_evidenciasl" => $sheet->getCell('BD' . $row)->getValue(),
            "n_evidenciatg" => $sheet->getCell('BE' . $row)->getValue(),
            "i_week" => $sheet->getCell('BV' . $row)->getValue(),
            "id_rftools" => $sheet->getCell('CC' . $row)->getValue(),
            "id_documentacion" => $sheet->getCell('CB' . $row)->getValue(),
                ]))->all();
    }

    //</editor-fold>

    private function getUserByName($userName) {
        //Ojo! se crean algunos indices en la tabla, para ajustar los campos usados en este MATCH de MySQL ejecutar la siguiente consulta:
        //ALTER TABLE user ADD FULLTEXT(n_name_user, n_last_name_user);
        return (new DB())->select('SELECT * FROM (SELECT * , MATCH (user.n_name_user, user.n_last_name_user) AGAINST (\'%' . $userName . '%\') AS puntuacion FROM user WHERE MATCH (user.n_name_user, user.n_last_name_user) AGAINST (\'%' . $userName . '%\') AND n_role_user IS NOT NULL AND n_role_user = "Ingeniero" ORDER BY puntuacion DESC LIMIT 15) q1 WHERE puntuacion >= 4')->first();
    }

    //<editor-fold defaultstate="collapsed" desc="getPrecheck(&$sheet, &$obj)" >
    private function getPrecheck(&$sheet, &$obj, $row) {
        $userName = $sheet->getCell('Y' . $row)->getValue();
        $user = $this->getUserByName($userName);
        $user = (($user) ? $user->k_id_user : DB::NULLED);
        $validator = new Validator();
        $date = $validator->required("", $sheet->getCell('AQ' . $row)->getValue());
        if (!$date) {
            $date = DB::NULLED;
        } else {
            $date = $this->getDatePHPExcel($sheet, "AQ" . $row);
        }

        if ($date == DB::NULLED && $user == DB::NULLED) {
            $obj->k_id_precheck = DB::NULLED;
            return;
        }

        $precheckModel = new PrecheckModel();
        $precheckModel->setDFinpre($date);
        $precheckModel->setKIdUser($user);
        //::Pendiente n_comentario_ing.
        $idPrecheck = $precheckModel->save()->data;
//        echo "ESTE EL ID ($idPrecheck) DEL PRECHECK PARA $obj->k_id_onair<br/>";

        $obj->k_id_precheck = $idPrecheck;
        $obj->i_precheck_realizado = 1;
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getScaledOnAir(&$sheet, &$obj)" >
    private function getScaledOnAir(&$sheet, &$obj, $row) {
        $dateScaled = $sheet->getCell('BF' . $row)->getValue();
        $validator = new Validator($dateScaled);
        if ($validator->required("", $dateScaled)) {
            $obj->scaled_on_air = (new ObjUtil([
                "d_fecha_escalado" => $this->getDatePHPExcel($sheet, "BG" . $row),
                "time_esc_imp" => $sheet->getCell('BI' . $row)->getValue(),
                "cont_esc_npo" => $sheet->getCell('BL' . $row)->getValue(),
                "cont_esc_care" => $sheet->getCell('BN' . $row)->getValue(),
                "time_esc_oym" => $sheet->getCell('BS' . $row)->getValue(),
                "cont_esc_calidad" => $sheet->getCell('BT' . $row)->getValue(),
                "n_atribuible_nokia2" => $sheet->getCell('BY' . $row)->getValue(),
                "n_tipificacion_solucion" => $sheet->getCell('CD' . $row)->getValue(),
                "n_ultimo_subestado_de_escalamiento" => $sheet->getCell('CZ' . $row)->getValue(),
                "i_cont_esc_imp" => $sheet->getCell('BH' . $row)->getValue(),
                "i_cont_esc_rf" => $sheet->getCell('BJ' . $row)->getValue(),
                "i_time_esc_rf" => $sheet->getCell('BK' . $row)->getValue(),
                "i_time_esc_npo" => $sheet->getCell('BM' . $row)->getValue(),
                "i_time_esc_care" => $sheet->getCell('BO' . $row)->getValue(),
                "i_cont_esc_gdrt" => $sheet->getCell('BP' . $row)->getValue(),
                "i_time_esc_gdrt" => $sheet->getCell('BQ' . $row)->getValue(),
                "i_cont_esc_oym" => $sheet->getCell('BR' . $row)->getValue(),
                "i_time_esc_calidad" => $sheet->getCell('BU' . $row)->getValue(),
                "n_detalle_solucion" => $sheet->getCell('CU' . $row)->getValue(),
                    ]))->all();
        }
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getParamsOnAir(&$sheet, &$obj, &$inconsistencies, &$cellInconsistencies)" >
    private function getParamsOnAir(&$sheet, &$obj, &$inconsistencies, &$cellInconsistencies, $row) {
        //Obtenemos y consultamos la estación...
        $stationName = $sheet->getCell('B' . $row)->getValue();
        $obj->k_id_station = (new StationModel())->where("n_name_station", "=", $stationName)->orWhere("n_name_station", "LIKE", "%" . $stationName . "%")->first();
        //Si no existe...
        if (!$obj->k_id_station) {
            //Consultamos la región...
            $nameRegion = $sheet->getCell('R' . $row)->getValue();
            $region = (new RegionalModel())->where("n_name_regional", "=", $nameRegion)->orWhere("n_name_regional", "LIKE", "%$nameRegion%")->first();
            //Si no existe la región la creamos...
            if (!$region) {
                $region = (new RegionalModel())->insert([
                    "n_name_regional" => $nameRegion,
                ]);
                $region = $region->data;
            } else {
                $region = $region->k_id_regional;
            }
            //Consultamos la ciudad...
            $nameCity = $sheet->getCell('Q' . $row)->getValue();
            $city = (new CityModel())->where("n_name_city", "=", $nameCity)->orWhere("n_name_city", "LIKE", "%$nameCity%")->first();
            //Si no existe la ciudad, la creamos...
            if (!$city) {
                $city = (new CityModel())->insert([
                    "n_name_city" => $nameCity,
                    "k_id_regional" => $regional
                ]);
                $city = $city->data;
            } else {
                $city = $city->k_id_city;
            }

            //Creamos la nueva estación...
            $stationModel = new StationModel();
            $stationModel->setKIdStation($stationModel->getLastId("k_id_station"));
            $stationModel->setKIdCity($city);
            $stationModel->setNNameStation($stationName);
            $stationModel->save();
//            echo $stationModel->getSQL();
//            INSERT INTO station (`k_id_station`, `k_id_city`, `n_name_station`) VALUES (NULL, "18", "ANT.Jardin Parque")
        }

        //Obtenemos la tecnología.
        $technology = $sheet->getCell('E' . $row)->getValue();
        $obj->k_id_technology = (new TechnologyModel())->where("n_name_technology", "=", $technology)->orWhere("n_name_technology", "LIKE", "%$technology%")->first();

        if (!$obj->k_id_technology) {
            $inconsistencies++;
            $cellInconsistencies[] = "E";
        }

        //Obtenemos la banda...
        $band = $sheet->getCell('F' . $row)->getValue();
        $obj->k_id_band = (new BandModel())->where("n_name_band", "=", $band)->orWhere("n_name_band", "LIKE", "%$band%")->first();

        if (!$obj->k_id_band) {
            $inconsistencies++;
            $cellInconsistencies[] = "F";
        }

        //Obtenemos el estado...
        $status = $sheet->getCell('G' . $row)->getValue();
        $obj->k_id_status = (new StatusModel())->where("n_name_status", "=", $status)->orWhere("n_name_status", "LIKE", "%$status%")->first();
//                    $obj->k_id_status = $status;

        if (!$obj->k_id_status) {
            $inconsistencies++;
            $cellInconsistencies[] = "G";
        }

        //Obtenemos el subestado...
        $subStatus = $sheet->getCell('H' . $row)->getValue();
        $obj->k_id_substatus = (new SubstatusModel())->where("n_name_substatus", "=", $subStatus)->orWhere("n_name_substatus", "LIKE", $subStatus)->first();

        if (!$obj->k_id_substatus) {
            $inconsistencies++;
            $cellInconsistencies[] = "H";
        }


        //Obtenemos el tipo de trabajo...
        $work = $sheet->getCell('L' . $row)->getValue();
        $obj->k_id_work = (new WorkModel())->where("n_name_ork", "=", $work)->orWhere("n_name_ork", "LIKE", "%$work%")->first();
        if (!$obj->k_id_work) {
            $inconsistencies++;
            $cellInconsistencies[] = "L";
        }

        $objTck = $obj;
        $objTck->k_id_band = ($objTck->k_id_band) ? $objTck->k_id_band->k_id_band : DB::NULLED;
        $objTck->k_id_status = ($objTck->k_id_status) ? $objTck->k_id_status->k_id_status : DB::NULLED;
        $objTck->k_id_substatus = ($objTck->k_id_substatus) ? $objTck->k_id_substatus->k_id_substatus : DB::NULLED;
        //Consultamos el estado...
        $status_on_air = (new StatusOnairModel())->where("k_id_status", "=", $objTck->k_id_status);
        //Se hace un pequeño ajuste en la consulta, ya que existen algunas incoherencias en la data y la bd.
        if ($obj->k_id_substatus) {
            $status_on_air = $status_on_air->where("k_id_substatus", "=", $objTck->k_id_substatus)->first();
        } else {
            $status_on_air = $status_on_air->first();
        }
        if ($status_on_air) {
            $objTck->k_id_status_onair = $status_on_air->k_id_status_onair;
        } else {
            $objTck->k_id_status_onair = DB::NULLED;
        }

        switch ($objTck->k_id_status_onair) {
            case ConstStates::PRECHECK:
            case ConstStates::REINICIO_PRECHECK:
            case ConstStates::REINICIO_12H:
            case ConstStates::SEGUIMIENTO_12H:
            case ConstStates::SEGUIMIENTO_24H:
            case ConstStates::SEGUIMIENTO_36H:
                $objTck->i_actualEngineer = 0;
                break;
        }


        //Obtenemos los campos comunes...
        $obj->k_id_onair = $sheet->getCell('A' . $row)->getValue();
        $obj->b_excpetion_gri = $sheet->getCell('I' . $row)->getValue();
        $obj->d_fecha_ultima_rev = $this->getDatePHPExcel($sheet, "K" . $row);
        $obj->b_vistamm = $sheet->getCell('M' . $row)->getValue();
        $obj->d_bloqueo = $this->getDatePHPExcel($sheet, "T" . $row);
        $obj->d_desbloqueo = $this->getDatePHPExcel($sheet, "S" . $row);
        $obj->d_fechaproduccion = $this->getDatePHPExcel($sheet, "AF" . $row);
        $obj->n_sectoresbloqueados = $sheet->getCell('AJ' . $row)->getValue();
        $obj->n_sectoresdesbloqueados = $sheet->getCell('AK' . $row)->getValue();
        $obj->n_estadoonair = $sheet->getCell('AL' . $row)->getValue();
        $obj->n_atribuible_nokia = $sheet->getCell('AM' . $row)->getValue();
        $obj->d_asignacion_final = $this->getDatePHPExcel($sheet, 'BB' . $row);
        $obj->n_kpi1 = $sheet->getCell('CE' . $row)->getValue();
        $obj->n_kpi2 = $sheet->getCell('CG' . $row)->getValue();
        $obj->n_kpi3 = $sheet->getCell('CI' . $row)->getValue();
        $obj->n_kpi4 = $sheet->getCell('CK' . $row)->getValue();
        $obj->n_alarma1 = $sheet->getCell('CM' . $row)->getValue();
        $obj->n_alarma2 = $sheet->getCell('CN' . $row)->getValue();
        $obj->n_alarma3 = $sheet->getCell('CO' . $row)->getValue();
        $obj->n_alarma4 = $sheet->getCell('CP' . $row)->getValue();
        $obj->i_cont_total_escalamiento = $sheet->getCell('CQ' . $row)->getValue();
        $obj->i_time_total_escalamiento = $sheet->getCell('CR' . $row)->getValue();
        $obj->n_ola = $sheet->getCell('CS' . $row)->getValue();
        $obj->n_ola_excedido = $sheet->getCell('CT' . $row)->getValue();
        $obj->i_lider_cambio = $sheet->getCell('CV' . $row)->getValue();
        $obj->i_lider_cuadrilla = $sheet->getCell('CW' . $row)->getValue();
        $obj->n_ola_areas = $sheet->getCell('CX' . $row)->getValue();
        $obj->n_ola_areas_excedido = $sheet->getCell('CY' . $row)->getValue();
        $obj->n_implementacion_campo = $sheet->getCell('DC' . $row)->getValue();
        $obj->n_implementacion_remota = $sheet->getCell('DD' . $row)->getValue();
        $obj->n_gestion_power = $sheet->getCell('DE' . $row)->getValue();
        $obj->n_obra_civil = $sheet->getCell('DF' . $row)->getValue();
        $obj->on_air = $sheet->getCell('DG' . $row)->getValue();
        $obj->d_fecha_cg = $this->getDatePHPExcel($sheet, 'DH' . $row);
        $obj->n_exclusion_bajo_trafico = $sheet->getCell('DJ' . $row)->getValue();
        $obj->n_ticket = $sheet->getCell('DK' . $row)->getValue();
        $obj->n_estado_ticket = $sheet->getCell('DL' . $row)->getValue();
        $obj->n_sln_modernizacion = $sheet->getCell('DM' . $row)->getValue();
        $obj->n_en_prorroga = $sheet->getCell('DN' . $row)->getValue();
        $obj->n_cont_prorrogas = $sheet->getCell('DO' . $row)->getValue();
        $obj->n_noc = $sheet->getCell('DP' . $row)->getValue();
        $obj->fecha_rft = $this->getDatePHPExcel($sheet, 'DH' . $row);
        $obj->d_t_from_notif = (new Validator())->required("", $sheet->getCell('BW' . $row)->getValue()) ? $this->getDatePHPExcel($sheet, 'BV' . $row) : DB::NULLED;
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="get12H(&$sheet, &$obj, $row)" >
    private function get12H(&$sheet, &$obj, $row) {
        //Iniciamos la creación del 12h...
        $onAir12hModel = new OnAir12hModel();
        $validator = new Validator();
        $date = $sheet->getCell('AR' . $row)->getValue();
        if ($validator->required("", $date)) {
            $date = $this->getDatePHPExcel($sheet, "AR" . $row);
            $onAir12hModel->setDStart12h(Hash::subtractHours($date, 1));
            $onAir12hModel->setDFin12h($date);
            $onAir12hModel->setITimestamp(0);
            $onAir12hModel->setIRound(0);
            $onAir12hModel->setIPercent(0);
            $onAir12hModel->setIState(0);
            $onAir12hModel->setIHours(0);
            $obj->onAir12h = $onAir12hModel;
        }
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="get24H(&$sheet, &$obj, $row)" >
    private function get24H(&$sheet, &$obj, $row) {
        //INiciamos la creación del 24h...
        $onAir24hModel = new OnAir24hModel();
        $validator = new Validator();
        $date = $sheet->getCell('DA' . $row)->getValue();
        if ($validator->required("", $date)) {
            $date = $this->getDatePHPExcel($sheet, "DA" . $row);
            $onAir24hModel->setDStart24h(Hash::subtractHours($date, 1));
            $onAir24hModel->setDFin24h($date);
            $onAir24hModel->setITimestamp(0);
            $onAir24hModel->setIRound(0);
            $onAir24hModel->setIPercent(0);
            $onAir24hModel->setIState(0);
            $onAir24hModel->setIHours(0);
//            $follow24hModel = new FollowUp24hModel();
//            $userName = $sheet->getCell('' . $row)->getValue();
//            if ($userName) {
//                $user = $this->getUserByName($userName);
//                $follow24hModel->setKIdUser($user->k_id_user);
//                $follow24hModel->setNRound(0);
//                $idFollow = $follow24hModel->save();
//                $onAir24hModel->setKIdFollowUp24h($idFollow);
//            }
            //Se deja solo instanciado para la inserción, así una vez insertado el ticket instanciamos el id de dicho ticket sobre este objeto.
            $obj->onAir24h = $onAir24hModel;
        }
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="get36H(&$sheet, &$obj, $row)" >
    private function get36H(&$sheet, &$obj, $row) {
        //Iniciamos la creación del 12h...
        $onAir36hModel = new OnAir36hModel();
        $validator = new Validator();
        $date = $sheet->getCell('DB' . $row)->getValue();
        if ($validator->required('', $date)) {
            $date = $this->getDatePHPExcel($sheet, "DB" . $row);
            $onAir36hModel->setDStart36h(Hash::subtractHours($date, 1));
            $onAir36hModel->setDFin36h($date);
            $onAir36hModel->setITimestamp(0);
            $onAir36hModel->setIRound(0);
            $onAir36hModel->setIPercent(0);
            $onAir36hModel->setIState(0);
            $onAir36hModel->setIHours(0);
//            $follow36HModel = new FollowUp36hModel();
//            $userName = $sheet->getCell('Y' . $row)->getValue();
//            if ($userName) {
//                $user = $this->getUserByName($userName);
//                $follow36HModel->setKIdUser($user->k_id_user);
//                $follow36HModel->setNRound(0);
//                $idFollow = $follow36HModel->save();
//                $onAir36hModel->setKIdFollowUp36h($idFollow);
//            }
            //Se deja solo instanciado para la inserción, así una vez insertado el ticket instanciamos el id de dicho ticket sobre este objeto.
            $obj->onAir12h = $onAir36hModel;
        }
    }

    //</editor-fold>

    private function getSectores(&$sheet, &$obj) {
        //En esta función se comprobarán los sectores del ticket...
    }
    
    public function printInconsistences($inconsistences){
        
    }

    //<editor-fold defaultstate="collapsed" desc="processAndInsertComments" >
    public function processAndInsertComments() {
        $request = $this->request;
        $file = $request->file;
        //Verificamos si existe el archivo...
        if (file_exists($file)) {
            //Se procesa el archivo de comentarios...
            set_time_limit(-1);
            ini_set('memory_limit', '1500M');
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/Settings.php';
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '15MB');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel');

            try {
                $validator = new Validator();
                $inputFileType = PHPExcel_IOFactory::identify($file);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($file);

                //Obtenemos la página.
                $sheet = $objPHPExcel->getSheet(1);
                //$highestRow = $sheet->calculateWorksheetDimension();
                //Obtenemos el highestRow...
                $highestRow = 0;
                $row = 2;
                $idTicket = 0;
                $imported = 0;
                $inconsistencies = 0;
                $cellInconsistencies = [];
                while ($validator->required("", $sheet->getCell('A' . $row)->getValue())) {
                    sleep(1);
                    $imported = 0;
                    $inconsistencies = 0;
                    $cellInconsistencies = [];
                    $obj = new ObjUtil([
                        "k_id_on_air" => $sheet->getCell('A' . $row)->getValue(),
                        "n_nombre_estacion_eb" => $sheet->getCell('B' . $row)->getValue(),
                        "n_tecnologia" => $sheet->getCell('C' . $row)->getValue(),
                        "n_banda" => $sheet->getCell('D' . $row)->getValue(),
                        "n_tipo_trabajo" => $sheet->getCell('E' . $row)->getValue(),
                        "n_estado_eb_resucomen" => $sheet->getCell('F' . $row)->getValue() . " - " . $sheet->getCell('G' . $row)->getValue(),
                        "comentario_resucoment" => $sheet->getCell('H' . $row)->getValue(),
                        "hora_actualizacion_resucomen" => $this->getDatePHPExcel($sheet, 'I' . $row),
                        "usuario_resucomen" => $sheet->getCell('J' . $row)->getValue(),
                        "ente_ejecutor" => $sheet->getCell('K' . $row)->getValue(),
                        "tipificacion_resucomen" => $sheet->getCell('L' . $row)->getValue(),
                        "noc" => $sheet->getCell('M' . $row)->getValue(),
                    ]);

                    //Comprobamos si existe el ticket...
                    if ($obj->k_id_on_air) {
                        if ((new TicketOnAirModel())->where("k_id_onair", "=", $obj->k_id_on_air)->exist()) {
                            //Se inserta el comentario...
                            $reportCommentsModel = new ReporteComentarioModel();
                            $reportCommentsModel->insert($obj->all());
                        } else {
                            //Se marca la celda como no existe el ticket...
                        }
                    }
                    if (($row % 30) == 0) {
                        sleep(3);
                    }
                    $row++;
                }

                return true;
            } catch (DeplynException $ex) {
                return false;
            }
        } else {
            return false;
        }
    }

    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="processData()" >
    public function processData() {
        $request = $this->request;
        $response = new Response(EMessages::SUCCESS);
        $file = $request->file;

        //Verificamos si el archivo existe...
        if (file_exists($file)) {
            //Iniciamos el procedimiento de carga de datos...
            set_time_limit(-1);
            ini_set('memory_limit', '1500M');
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/Settings.php';
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '15MB');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel');

            try {
                $validator = new Validator();
                $inputFileType = PHPExcel_IOFactory::identify($file);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($file);

                //Obtenemos la página.
                $sheet = $objPHPExcel->getSheet(0);
                //$highestRow = $sheet->calculateWorksheetDimension();
                //Obtenemos el highestRow...
                $highestRow = 0;
                $row = 2;
                $idTicket = 0;
                $imported = 0;
                $inconsistencies = 0;
                $inconsistenciesFull = [];
                $cellInconsistencies = [];
                while ($sheet->getCell('A' . $row)->getValue() > 0) {
                    $imported = 0;
                    $inconsistencies = 0;
                    $cellInconsistencies = [];
                    //Comprobamos que el NOC no sea de Nokia, ya que realmente no pertenece a la data del proyecto...
                    $noc = $sheet->getCell('DP' . $row)->getValue();
//                    if ($noc != "Nokia") {
                    if (true) {
                        $highestRow++;
                        $obj = new ObjUtil([]);
                        $imported = 0;
                        $inconsistencies = 0;
                        $cellInconsistencies = [];

                        $this->getParamsOnAir($sheet, $obj, $inconsistencies, $cellInconsistencies, $row);
                        //Obtenemos el preparation_stage.
                        $this->getPreparationStage($sheet, $obj, $row);

                        //Obtenemos toda la información del onAir...
                        $this->getPrecheck($sheet, $obj, $row);
                        $this->get12H($sheet, $obj, $row);
                        $this->get24H($sheet, $obj, $row);
                        $this->get36H($sheet, $obj, $row);
                        $this->getScaledOnAir($sheet, $obj, $row);
                        $obj->row = $row;

                        if ($obj->k_id_status_onair == ConstStates::STAND_BY_SEGUIMIENTO_FO || $obj->k_id_status_onair == ConstStates::STAND_BY_PRODUCCION) {
                            $inconsistencies++;
                        }

                        if ($inconsistencies == 0) {
                            //Iniciamos la inserción del nuevo registro OnAir...
                            $imported++;
                            $idTicket = $this->insertTicket($obj);
                        } else {
                            //La idea es pintar la fila que no se pudo pintar y las celdas que probocaron el error...
                        }
                    }

                    if (($row % 30) == 0) {
                        sleep(3);
                    }
                    $row++;
                    if (count($cellInconsistencies) > 0) {
                        $inconsistenciesFull[] = $cellInconsistencies;
                    }
                }
                //Se procesan los comentarios...
                $this->processAndInsertComments();

                $response->setData([
                    "id" => $idTicket,
                    "imported" => $imported,
                    "inconsistencies" => $inconsistencies,
                    "inconsistenciesFull" => $inconsistenciesFull,
                    "data" => $this->objs
                ]);
            } catch (DeplynException $ex) {
                $response = new Response(EMessages::ERROR, "Error al procesar el archivo.");
            }
        } else {
            $response = new Response(EMessages::ERROR, "No se encontró el archivo " . $file);
        }

        $this->json($response);
    }

    //</editor-fold>

    private $objs = [];

    //<editor-fold defaultstate="collapsed" desc="insertTicket() -- Para PHPExcel" >
    private function insertTicket($obj) {
//        echo "PASO POR INSERT";
        $this->objs[] = $obj->all();
//        return $this->objs;
        //Obtenemos el preparation_stage;
        try {
            $validator = new Validator();
            if ($obj->k_id_status_onair == DB::NULLED) {
                return 0;
            }
            $preparation_stage = $obj->k_id_preparation;
            $ps = new PreparationStageModel();
            //Insertamos el preparation_stage
            $idPS = $ps->insert($preparation_stage);

            $tck = new TicketOnAirModel();

            //Insertamos el ticket...

            $objTck = $obj;
            $objTck->k_id_preparation = ($idPS) ? $idPS->data : DB::NULLED;
            $objTck->k_id_technology = ($objTck->k_id_technology) ? $objTck->k_id_technology->k_id_technology : DB::NULLED;
            $objTck->k_id_work = ($objTck->k_id_work) ? $objTck->k_id_work->k_id_work : DB::NULLED;
            $objTck->k_id_station = ($objTck->k_id_station) ? $objTck->k_id_station->k_id_station : DB::NULLED;

            $idTick = 0;
            $idTick = $tck->insert($objTck->all())->data;

            //Insertamos los seguimientos...
            if ($objTck->onAir12h) {
                $objTck->onAir12h->setKIdOnair($idTick);
                $objTck->onAir12h->save();
            }
            if ($objTck->onAir24h) {
                $objTck->onAir24h->setKIdOnair($idTick);
                $objTck->onAir24h->save();
            }
            if ($objTck->onAir36h) {
                $objTck->onAir36h->setKIdOnair($idTick);
                $objTck->onAir36h->save();
            }
            return $idTick;
        } catch (DeplynException $exc) {
            return $exc;
        }
    }

    //</editor-fold>
}
