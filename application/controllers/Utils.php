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
    //<editor-fold defaultstate="collapsed" desc="getPreparationStage()" >
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

    public function printInconsistences($inconsistences) {
        
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
            if (intval(phpversion()) <= 5) {
                PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            }
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

                    if (($row % 50) == 0) {
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

    //<editor-fold defaultstate="collapsed" desc="Se crea el objeto de PHPExcel, para escribir los posibles errores que se presenten en el archivo..." >
    public function createErrorsFileExcel() {
        $objPHPWriter = new PHPExcel();
        //Propiedades del archivo...
        $objPHPWriter->getProperties()->setCreator("ZTE");
        $objPHPWriter->getProperties()->setLastModifiedBy("ZTE");
        $objPHPWriter->getProperties()->setTitle("Reporte Comentarios");
        $objPHPWriter->getProperties()->setSubject("Reporte Comentarios - Zolid");
        $objPHPWriter->getProperties()->setDescription("Reporte Comentarios - Zolid");
        //Seleccionamos la página.
        $objPHPWriter->setActiveSheetIndex(0);
        $objPHPWriter->getActiveSheet()->setCellValue("A1", "Id-On Air");
        $objPHPWriter->getActiveSheet()->setCellValue("B1", "Nombre_Estación-EB");
        $objPHPWriter->getActiveSheet()->setCellValue("C1", "bcf_wbts_id");
        $objPHPWriter->getActiveSheet()->setCellValue("D1", "BTS_ID");
        $objPHPWriter->getActiveSheet()->setCellValue("E1", "Tecnologia");
        $objPHPWriter->getActiveSheet()->setCellValue("F1", "Banda");
        $objPHPWriter->getActiveSheet()->setCellValue("G1", "Estado");
        $objPHPWriter->getActiveSheet()->setCellValue("H1", "Subestado");
        $objPHPWriter->getActiveSheet()->setCellValue("I1", "excepcion GRI");
        $objPHPWriter->getActiveSheet()->setCellValue("J1", "Fecha ingreso On Air");
        $objPHPWriter->getActiveSheet()->setCellValue("K1", "Fechaultimarev");
        $objPHPWriter->getActiveSheet()->setCellValue("L1", "tipo De trabajo");
        $objPHPWriter->getActiveSheet()->setCellValue("M1", "vistamm");
        $objPHPWriter->getActiveSheet()->setCellValue("N1", "enteejecutor");
        $objPHPWriter->getActiveSheet()->setCellValue("O1", "controlador");
        $objPHPWriter->getActiveSheet()->setCellValue("P1", "idcontrolador");
        $objPHPWriter->getActiveSheet()->setCellValue("Q1", "Ciudad");
        $objPHPWriter->getActiveSheet()->setCellValue("R1", "Regional");
        $objPHPWriter->getActiveSheet()->setCellValue("S1", "desbloqueo");
        $objPHPWriter->getActiveSheet()->setCellValue("T1", "bloqueado");
        $objPHPWriter->getActiveSheet()->setCellValue("U1", "reviewedfo");
        $objPHPWriter->getActiveSheet()->setCellValue("V1", "correccionpendientes");
        $objPHPWriter->getActiveSheet()->setCellValue("W1", "btsipaddress");
        $objPHPWriter->getActiveSheet()->setCellValue("X1", "integrador");
        $objPHPWriter->getActiveSheet()->setCellValue("Y1", "ingenieroprecheck");
        $objPHPWriter->getActiveSheet()->setCellValue("Z1", "ingenierofinal12horas");
        $objPHPWriter->getActiveSheet()->setCellValue("AA1", "ingenierogarantia");
        $objPHPWriter->getActiveSheet()->setCellValue("AB1", "WP");
        $objPHPWriter->getActiveSheet()->setCellValue("AC1", "CRQ");
        $objPHPWriter->getActiveSheet()->setCellValue("AD1", "testgestion");
        $objPHPWriter->getActiveSheet()->setCellValue("AE1", "sitiolimpio");
        $objPHPWriter->getActiveSheet()->setCellValue("AF1", "fechaproduccion");
        $objPHPWriter->getActiveSheet()->setCellValue("AG1", "Instalacion_HW_Sitio");
        $objPHPWriter->getActiveSheet()->setCellValue("AH1", "Cambios_Config_Solicitados");
        $objPHPWriter->getActiveSheet()->setCellValue("AI1", "Cambios_Config_Final");
        $objPHPWriter->getActiveSheet()->setCellValue("AJ1", "sectoresbloqueados");
        $objPHPWriter->getActiveSheet()->setCellValue("AK1", "sectoresdesbloqueados");
        $objPHPWriter->getActiveSheet()->setCellValue("AL1", "estadoonair");
        $objPHPWriter->getActiveSheet()->setCellValue("AM1", "Atribuible_Nokia");
        $objPHPWriter->getActiveSheet()->setCellValue("AN1", "contratista");
        $objPHPWriter->getActiveSheet()->setCellValue("AO1", "comentarioccial");
        $objPHPWriter->getActiveSheet()->setCellValue("AP1", "ticketremedy");
        $objPHPWriter->getActiveSheet()->setCellValue("AQ1", "FinPre");
        $objPHPWriter->getActiveSheet()->setCellValue("AR1", "Fin12H");
        $objPHPWriter->getActiveSheet()->setCellValue("AS1", "Fin48H");
        $objPHPWriter->getActiveSheet()->setCellValue("AT1", "LAC");
        $objPHPWriter->getActiveSheet()->setCellValue("AU1", "RAC");
        $objPHPWriter->getActiveSheet()->setCellValue("AV1", "SAC");
        $objPHPWriter->getActiveSheet()->setCellValue("AW1", "Integracion_Gestion_y_Trafica");
        $objPHPWriter->getActiveSheet()->setCellValue("AX1", "Puesta_Servicio_Sitio_Nuevo_LTE");
        $objPHPWriter->getActiveSheet()->setCellValue("AY1", "Instalacion_HW_4G_Sitio");
        $objPHPWriter->getActiveSheet()->setCellValue("AZ1", "Prelaunch");
        $objPHPWriter->getActiveSheet()->setCellValue("BA1", "Actualizacion_Final");
        $objPHPWriter->getActiveSheet()->setCellValue("BB1", "Asignacion_Final");
        $objPHPWriter->getActiveSheet()->setCellValue("BC1", "identificador");
        $objPHPWriter->getActiveSheet()->setCellValue("BD1", "EvidenciaSL");
        $objPHPWriter->getActiveSheet()->setCellValue("BE1", "EvidenciaTG");
        $objPHPWriter->getActiveSheet()->setCellValue("BF1", "Time_Escalado");
        $objPHPWriter->getActiveSheet()->setCellValue("BG1", "Fecha_Escalado");
        $objPHPWriter->getActiveSheet()->setCellValue("BH1", "Cont_Esc_Imp");
        $objPHPWriter->getActiveSheet()->setCellValue("BI1", "Time_Esc_Imp");
        $objPHPWriter->getActiveSheet()->setCellValue("BJ1", "Cont_Esc_RF");
        $objPHPWriter->getActiveSheet()->setCellValue("BK1", "Time_Esc_RF");
        $objPHPWriter->getActiveSheet()->setCellValue("BL1", "Cont_Esc_NPO");
        $objPHPWriter->getActiveSheet()->setCellValue("BM1", "Time_Esc_NPO");
        $objPHPWriter->getActiveSheet()->setCellValue("BN1", "Cont_Esc_Care");
        $objPHPWriter->getActiveSheet()->setCellValue("BO1", "Time_Esc_Care");
        $objPHPWriter->getActiveSheet()->setCellValue("BP1", "Cont_Esc_GDRT");
        $objPHPWriter->getActiveSheet()->setCellValue("BQ1", "Time_Esc_GDRT");
        $objPHPWriter->getActiveSheet()->setCellValue("BR1", "Cont_Esc_OyM");
        $objPHPWriter->getActiveSheet()->setCellValue("BS1", "Time_Esc_OyM");
        $objPHPWriter->getActiveSheet()->setCellValue("BT1", "Cont_Esc_Calidad");
        $objPHPWriter->getActiveSheet()->setCellValue("BU1", "Time_Esc_Calidad");
        $objPHPWriter->getActiveSheet()->setCellValue("BV1", "WEEK");
        $objPHPWriter->getActiveSheet()->setCellValue("BW1", "T_From_Notif");
        $objPHPWriter->getActiveSheet()->setCellValue("BX1", "T_From_Asign");
        $objPHPWriter->getActiveSheet()->setCellValue("BY1", "Atribuible_Nokia2");
        $objPHPWriter->getActiveSheet()->setCellValue("BZ1", "Kpis_Degraded");
        $objPHPWriter->getActiveSheet()->setCellValue("CA1", "Id_Notificacion");
        $objPHPWriter->getActiveSheet()->setCellValue("CB1", "Id_Documentacion");
        $objPHPWriter->getActiveSheet()->setCellValue("CC1", "ID_RFTools");
        $objPHPWriter->getActiveSheet()->setCellValue("CD1", "Tipificacion_Solucion");
        $objPHPWriter->getActiveSheet()->setCellValue("CE1", "KPI1");
        $objPHPWriter->getActiveSheet()->setCellValue("CF1", "Valor_KPI1");
        $objPHPWriter->getActiveSheet()->setCellValue("CG1", "KPI2");
        $objPHPWriter->getActiveSheet()->setCellValue("CH1", "Valor_KPI2");
        $objPHPWriter->getActiveSheet()->setCellValue("CI1", "KPI3");
        $objPHPWriter->getActiveSheet()->setCellValue("CJ1", "Valor_KPI3");
        $objPHPWriter->getActiveSheet()->setCellValue("CK1", "KPI4");
        $objPHPWriter->getActiveSheet()->setCellValue("CL1", "Valor_KPI4");
        $objPHPWriter->getActiveSheet()->setCellValue("CM1", "Alarma1");
        $objPHPWriter->getActiveSheet()->setCellValue("CN1", "Alarma2");
        $objPHPWriter->getActiveSheet()->setCellValue("CO1", "Alarma3");
        $objPHPWriter->getActiveSheet()->setCellValue("CP1", "Alarma4");
        $objPHPWriter->getActiveSheet()->setCellValue("CQ1", "Cont_Total_Escalamiento");
        $objPHPWriter->getActiveSheet()->setCellValue("CR1", "Time_Total_Escalamiento");
        $objPHPWriter->getActiveSheet()->setCellValue("CS1", "OLA");
        $objPHPWriter->getActiveSheet()->setCellValue("CT1", "OLA_Excedido");
        $objPHPWriter->getActiveSheet()->setCellValue("CU1", "Detalle_Solucion");
        $objPHPWriter->getActiveSheet()->setCellValue("CV1", "Lider_Cambio");
        $objPHPWriter->getActiveSheet()->setCellValue("CW1", "Lider_Cuadrilla");
        $objPHPWriter->getActiveSheet()->setCellValue("CX1", "OLA_Areas");
        $objPHPWriter->getActiveSheet()->setCellValue("CY1", "OLA_Areas_Excedido");
        $objPHPWriter->getActiveSheet()->setCellValue("CZ1", "Ultimo Subestado De Escalamiento");
        $objPHPWriter->getActiveSheet()->setCellValue("DA1", "Fin_24H");
        $objPHPWriter->getActiveSheet()->setCellValue("DB1", "Fin_36H");
        $objPHPWriter->getActiveSheet()->setCellValue("DC1", "Implementacion_Campo");
        $objPHPWriter->getActiveSheet()->setCellValue("DD1", "Implementacion_Remota");
        $objPHPWriter->getActiveSheet()->setCellValue("DE1", "Gestion_Power");
        $objPHPWriter->getActiveSheet()->setCellValue("DF1", "Obra_Civil");
        $objPHPWriter->getActiveSheet()->setCellValue("DG1", "On_AIR");
        $objPHPWriter->getActiveSheet()->setCellValue("DH1", "Fecha_RFT");
        $objPHPWriter->getActiveSheet()->setCellValue("DI1", "Fecha_CG");
        $objPHPWriter->getActiveSheet()->setCellValue("DJ1", "Exclusion_Bajo_Trafico");
        $objPHPWriter->getActiveSheet()->setCellValue("DK1", "Ticket");
        $objPHPWriter->getActiveSheet()->setCellValue("DL1", "Estado_Ticket");
        $objPHPWriter->getActiveSheet()->setCellValue("DM1", "SLN_Modernizacion");
        $objPHPWriter->getActiveSheet()->setCellValue("DN1", "En_Prorroga");
        $objPHPWriter->getActiveSheet()->setCellValue("DO1", "Cont_Prorrogas");
        $objPHPWriter->getActiveSheet()->setCellValue("DP1", "NOC");

        //Aplicamos las dimenciones a las celdas...
        $objPHPWriter->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPWriter->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPHPWriter->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('G')->setWidth(35);
        $objPHPWriter->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('J')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('K')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('L')->setWidth(40);
        $objPHPWriter->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('O')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('R')->setWidth(25);
        $objPHPWriter->getActiveSheet()->getColumnDimension('S')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('T')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('U')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('V')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('W')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('X')->setWidth(45);
        $objPHPWriter->getActiveSheet()->getColumnDimension('Y')->setWidth(45);
        $objPHPWriter->getActiveSheet()->getColumnDimension('Z')->setWidth(45);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AA')->setWidth(45);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AC')->setWidth(25);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AD')->setWidth(12);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AE')->setWidth(12);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AF')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AG')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AH')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AI')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AJ')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AK')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AL')->setWidth(15);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AM')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AN')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AO')->setWidth(80);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AP')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AQ')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AR')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AS')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AT')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AU')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AV')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AW')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AX')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AY')->setWidth(25);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AZ')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BA')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BB')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BC')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BD')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BE')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BF')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BG')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BH')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BI')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BJ')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BK')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BL')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BM')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BN')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BO')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BP')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BQ')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BR')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BS')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BT')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BU')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BV')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BW')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BX')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BY')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('BZ')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('AZ')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CA')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CB')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CC')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CD')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CE')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CF')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CG')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CH')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CI')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CJ')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CK')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CL')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CM')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CN')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CO')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CP')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CQ')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CR')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CS')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CT')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CU')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CV')->setWidth(40);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CW')->setWidth(40);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CX')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CY')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('CZ')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DA')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DB')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DC')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DD')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DE')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DF')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DG')->setWidth(30);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DH')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DI')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DJ')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DK')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DL')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DM')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DN')->setWidth(22);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DO')->setWidth(20);
        $objPHPWriter->getActiveSheet()->getColumnDimension('DP')->setWidth(15);
        return $objPHPWriter;
    }

    //</editor-fold>
    //
    //<editor-fold defaultstate="collapsed" desc="Pintar Linea en el archivo execel de errores de salida" >
    public function printLineError(&$objPHPWriter, $row, $obj) {
        $objPhpExcel->getActiveSheet()->setCellValue("A" . ($row + 2), $obj->k_id_onair);
        $objPhpExcel->getActiveSheet()->setCellValue("I" . ($row + 2), $obj->b_excpetion_gri);
        $objPhpExcel->getActiveSheet()->setCellValue("K" . ($row + 2), $obj->d_fecha_ultima_rev);
        $objPhpExcel->getActiveSheet()->setCellValue("S" . ($row + 2), $obj->d_desbloqueo);
        $objPhpExcel->getActiveSheet()->setCellValue("T" . ($row + 2), $obj->d_bloqueo);
        $objPhpExcel->getActiveSheet()->setCellValue("U" . ($row + 2), $obj->n_reviewedfo);
        $objPhpExcel->getActiveSheet()->setCellValue("AJ" . ($row + 2), $obj->n_sectoresbloqueados);
        $objPhpExcel->getActiveSheet()->setCellValue("AK" . ($row + 2), $obj->n_sectoresdesbloqueados);
        $objPhpExcel->getActiveSheet()->setCellValue("AL" . ($row + 2), $obj->n_estadoonair);
        $objPhpExcel->getActiveSheet()->setCellValue("AS" . ($row + 2), " "); //fin48
        $objPhpExcel->getActiveSheet()->setCellValue("BA" . ($row + 2), $obj->d_actualizacion_final);
        $objPhpExcel->getActiveSheet()->setCellValue("BB" . ($row + 2), $obj->d_asignacion_final);
        $objPhpExcel->getActiveSheet()->setCellValue("BC" . ($row + 2), " "); //identificador
        $objPhpExcel->getActiveSheet()->setCellValue("BW" . ($row + 2), " "); //t_from_notif
        $objPhpExcel->getActiveSheet()->setCellValue("BX" . ($row + 2), " "); //t_from_asign
        $objPhpExcel->getActiveSheet()->setCellValue("BZ" . ($row + 2), $obj->n_kpis_degraded);
        $objPhpExcel->getActiveSheet()->setCellValue("CE" . ($row + 2), $obj->n_kpi1);
        $objPhpExcel->getActiveSheet()->setCellValue("CF" . ($row + 2), $obj->i_valor_kpi1);
        $objPhpExcel->getActiveSheet()->setCellValue("CG" . ($row + 2), $obj->n_kpi2);
        $objPhpExcel->getActiveSheet()->setCellValue("CH" . ($row + 2), $obj->i_valor_kpi2);
        $objPhpExcel->getActiveSheet()->setCellValue("CI" . ($row + 2), $obj->n_kpi3);
        $objPhpExcel->getActiveSheet()->setCellValue("CJ" . ($row + 2), $obj->i_valor_kpi3);
        $objPhpExcel->getActiveSheet()->setCellValue("CK" . ($row + 2), $obj->n_kpi4);
        $objPhpExcel->getActiveSheet()->setCellValue("CL" . ($row + 2), $obj->i_valor_kpi4);
        $objPhpExcel->getActiveSheet()->setCellValue("CM" . ($row + 2), $obj->n_alarma1);
        $objPhpExcel->getActiveSheet()->setCellValue("CN" . ($row + 2), $obj->n_alarma2);
        $objPhpExcel->getActiveSheet()->setCellValue("CO" . ($row + 2), $obj->n_alarma3);
        $objPhpExcel->getActiveSheet()->setCellValue("CP" . ($row + 2), $obj->n_alarma4);
        $objPhpExcel->getActiveSheet()->setCellValue("CQ" . ($row + 2), $obj->i_cont_total_escalamiento);
        $objPhpExcel->getActiveSheet()->setCellValue("CR" . ($row + 2), $obj->i_time_total_escalamiento);
        $objPhpExcel->getActiveSheet()->setCellValue("CS" . ($row + 2), " "); //OLA
        $objPhpExcel->getActiveSheet()->setCellValue("CT" . ($row + 2), " "); //OLA extendido
        $objPhpExcel->getActiveSheet()->setCellValue("CV" . ($row + 2), $obj->i_lider_cambio);
        $objPhpExcel->getActiveSheet()->setCellValue("CW" . ($row + 2), $obj->i_lider_cuadrilla);
        $objPhpExcel->getActiveSheet()->setCellValue("CX" . ($row + 2), ""); //OLA_Areas
        $objPhpExcel->getActiveSheet()->setCellValue("CY" . ($row + 2), ""); //OLA_Areas_Excedido
        $objPhpExcel->getActiveSheet()->setCellValue("DC" . ($row + 2), $obj->n_implementacion_campo);
        $objPhpExcel->getActiveSheet()->setCellValue("DD" . ($row + 2), " "); //implementacion_remota
        $objPhpExcel->getActiveSheet()->setCellValue("DE" . ($row + 2), $obj->n_gestion_power);
        $objPhpExcel->getActiveSheet()->setCellValue("DF" . ($row + 2), $obj->n_obra_civil);
        $objPhpExcel->getActiveSheet()->setCellValue("DG" . ($row + 2), $obj->on_air);
        $objPhpExcel->getActiveSheet()->setCellValue("DH" . ($row + 2), $obj->fecha_rft);
        $objPhpExcel->getActiveSheet()->setCellValue("DI" . ($row + 2), $obj->d_fecha_cg);
        $objPhpExcel->getActiveSheet()->setCellValue("DJ" . ($row + 2), $obj->n_exclusion_bajo_trafico);
        $objPhpExcel->getActiveSheet()->setCellValue("DK" . ($row + 2), $obj->n_ticket);
        $objPhpExcel->getActiveSheet()->setCellValue("DL" . ($row + 2), $obj->n_estado_ticket);
        $objPhpExcel->getActiveSheet()->setCellValue("DM" . ($row + 2), $obj->n_sln_modernizacion);
        $objPhpExcel->getActiveSheet()->setCellValue("DN" . ($row + 2), $obj->n_en_prorroga);
        $objPhpExcel->getActiveSheet()->setCellValue("DO" . ($row + 2), $obj->n_cont_prorrogas);
        $objPhpExcel->getActiveSheet()->setCellValue("DP" . ($row + 2), $obj->n_noc);


        if ($obj->k_id_station) {
            $objPhpExcel->getActiveSheet()->setCellValue("B" . ($row + 2), $obj->k_id_station->n_name_station);
            if ($obj->k_id_station->k_id_city) {
                $objPhpExcel->getActiveSheet()->setCellValue("Q" . ($row + 2), $obj->k_id_station->k_id_city->n_name_city);
                if ($obj->k_id_station->k_id_city->k_id_regional) {
                    $objPhpExcel->getActiveSheet()->setCellValue("R" . ($row + 2), $obj->k_id_station->k_id_city->k_id_regional->n_name_regional);
                }
            }
        }
        if ($obj->k_id_preparation) {
            $objPhpExcel->getActiveSheet()->setCellValue("C" . ($row + 2), $obj->k_id_preparation->n_bcf_wbts_id);
            $objPhpExcel->getActiveSheet()->setCellValue("D" . ($row + 2), $obj->k_id_preparation->n_bts_id);
            $objPhpExcel->getActiveSheet()->setCellValue("J" . ($row + 2), $obj->k_id_preparation->d_ingreso_on_air);
            $objPhpExcel->getActiveSheet()->setCellValue("M" . ($row + 2), $obj->k_id_preparation->b_vistamm);
            $objPhpExcel->getActiveSheet()->setCellValue("N" . ($row + 2), $obj->k_id_preparation->n_enteejecutor);
            $objPhpExcel->getActiveSheet()->setCellValue("O" . ($row + 2), $obj->k_id_preparation->n_controlador);
            $objPhpExcel->getActiveSheet()->setCellValue("P" . ($row + 2), $obj->k_id_preparation->n_idcontrolador);
            $objPhpExcel->getActiveSheet()->setCellValue("V" . ($row + 2), $obj->k_id_preparation->d_correccionespendientes);
            $objPhpExcel->getActiveSheet()->setCellValue("W" . ($row + 2), $obj->k_id_preparation->n_btsipaddress);
            $objPhpExcel->getActiveSheet()->setCellValue("X" . ($row + 2), $obj->k_id_preparation->n_integrador);
            $objPhpExcel->getActiveSheet()->setCellValue("AB" . ($row + 2), $obj->k_id_preparation->n_wp);
            $objPhpExcel->getActiveSheet()->setCellValue("AC" . ($row + 2), $obj->k_id_preparation->n_crq);
            $objPhpExcel->getActiveSheet()->setCellValue("AD" . ($row + 2), $obj->k_id_preparation->n_testgestion);
            $objPhpExcel->getActiveSheet()->setCellValue("AE" . ($row + 2), $obj->k_id_preparation->n_sitiolimpio);
            $objPhpExcel->getActiveSheet()->setCellValue("AF" . ($row + 2), $obj->d_fechaproduccion);
            $objPhpExcel->getActiveSheet()->setCellValue("AG" . ($row + 2), $obj->k_id_preparation->n_instalacion_hw_sitio);
            $objPhpExcel->getActiveSheet()->setCellValue("AH" . ($row + 2), $obj->k_id_preparation->n_cambios_config_solicitados);
            $objPhpExcel->getActiveSheet()->setCellValue("AI" . ($row + 2), $obj->k_id_preparation->n_cambios_config_final);
            $objPhpExcel->getActiveSheet()->setCellValue("AN" . ($row + 2), $obj->k_id_preparation->n_contratista);
            $objPhpExcel->getActiveSheet()->setCellValue("AO" . ($row + 2), $obj->k_id_preparation->n_comentarioccial);
            $objPhpExcel->getActiveSheet()->setCellValue("AP" . ($row + 2), $obj->k_id_preparation->n_ticketremedy);
            $objPhpExcel->getActiveSheet()->setCellValue("AT" . ($row + 2), $obj->k_id_preparation->n_lac);
            $objPhpExcel->getActiveSheet()->setCellValue("AU" . ($row + 2), $obj->k_id_preparation->n_rac);
            $objPhpExcel->getActiveSheet()->setCellValue("AV" . ($row + 2), $obj->k_id_preparation->n_sac);
            $objPhpExcel->getActiveSheet()->setCellValue("AW" . ($row + 2), $obj->k_id_preparation->n_integracion_gestion_y_trafica);
            $objPhpExcel->getActiveSheet()->setCellValue("AX" . ($row + 2), $obj->k_id_preparation->puesta_servicio_sitio_nuevo_lte);
            $objPhpExcel->getActiveSheet()->setCellValue("AY" . ($row + 2), $obj->k_id_preparation->n_instalacion_hw_4g_sitio);
            $objPhpExcel->getActiveSheet()->setCellValue("AZ" . ($row + 2), $obj->k_id_preparation->pre_launch);
            $objPhpExcel->getActiveSheet()->setCellValue("BD" . ($row + 2), $obj->k_id_preparation->n_evidenciasl);
            $objPhpExcel->getActiveSheet()->setCellValue("BE" . ($row + 2), $obj->k_id_preparation->n_evidenciatg);
            $objPhpExcel->getActiveSheet()->setCellValue("BV" . ($row + 2), $obj->k_id_preparation->i_week);
            $objPhpExcel->getActiveSheet()->setCellValue("CA" . ($row + 2), $obj->k_id_preparation->id_notificacion);
            $objPhpExcel->getActiveSheet()->setCellValue("CB" . ($row + 2), $obj->k_id_preparation->id_documentacion);
            $objPhpExcel->getActiveSheet()->setCellValue("CC" . ($row + 2), $obj->k_id_preparation->id_rftools);
        }
        if ($obj->k_id_precheck) {
            $objPhpExcel->getActiveSheet()->setCellValue("AQ" . ($row + 2), $obj->k_id_precheck->d_finpre);
            if ($obj->k_id_precheck->k_id_user) {
                $objPhpExcel->getActiveSheet()->setCellValue("Y" . ($row + 2), $obj->k_id_precheck->k_id_user->n_name_user . " " . $obj->k_id_precheck->k_id_user->n_last_name_user);
            }
        }
        if ($obj->k_id_band) {
            $objPhpExcel->getActiveSheet()->setCellValue("F" . ($row + 2), $obj->k_id_band->n_name_band);
        }
        if ($obj->k_id_technology) {
            $objPhpExcel->getActiveSheet()->setCellValue("E" . ($row + 2), $obj->k_id_technology->n_name_technology);
        }
        if ($obj->k_id_status_onair) {
            if ($obj->k_id_status_onair['k_id_status']) {
                $objPhpExcel->getActiveSheet()->setCellValue("G" . ($row + 2), $obj->k_id_status_onair['k_id_status']->n_name_status);
            }
            if ($obj->k_id_status_onair['k_id_substatus']) {
                $objPhpExcel->getActiveSheet()->setCellValue("H" . ($row + 2), $obj->k_id_status_onair['k_id_substatus']->n_name_substatus);
            }
        }
        if ($obj->k_id_work) {
            $objPhpExcel->getActiveSheet()->setCellValue("L" . ($row + 2), $obj->k_id_work->n_name_ork);
        }
        if ($obj->onair12) {
            if ($obj->onair12->k_id_follow_up_12h) {
                if ($obj->onair12->k_id_follow_up_12h->k_id_user) {
                    $objPhpExcel->getActiveSheet()->setCellValue("Z" . ($row + 2), $obj->onair12->k_id_follow_up_12h->k_id_user->n_name_user . " " . $obj->onair12->k_id_follow_up_12h->k_id_user->n_last_name_user);
                }
            }
            $objPhpExcel->getActiveSheet()->setCellValue("AR" . ($row + 2), $obj->onair12->d_fin12h);
        }
        if ($obj->onair36) {
            if ($obj->onair36->k_id_follow_up_36h) {
                if ($obj->onair36->k_id_follow_up_36h->k_id_user) {
                    $objPhpExcel->getActiveSheet()->setCellValue("AA" . ($row + 2), $obj->onair36->k_id_follow_up_36h->k_id_user->n_name_user . "" . $obj->onair36->k_id_follow_up_36h->k_id_user->n_last_name_user);
                }
            }
            $objPhpExcel->getActiveSheet()->setCellValue("DB" . ($row + 2), $obj->onair36->d_fin36h);
        }
        if ($obj->scaled_onair) {
            $objPhpExcel->getActiveSheet()->setCellValue("AM" . ($row + 2), $obj->scaled_onair->n_atribuible_nokia);
            $objPhpExcel->getActiveSheet()->setCellValue("BF" . ($row + 2), $obj->scaled_onair->d_time_escalado);
            $objPhpExcel->getActiveSheet()->setCellValue("BG" . ($row + 2), $obj->scaled_onair->d_fecha_escalado);
            $objPhpExcel->getActiveSheet()->setCellValue("BH" . ($row + 2), $obj->scaled_onair->i_cont_esc_imp);
            $objPhpExcel->getActiveSheet()->setCellValue("BI" . ($row + 2), $obj->scaled_onair->time_esc_imp);
            $objPhpExcel->getActiveSheet()->setCellValue("BJ" . ($row + 2), $obj->scaled_onair->i_cont_esc_rf);
            $objPhpExcel->getActiveSheet()->setCellValue("BK" . ($row + 2), $obj->scaled_onair->i_time_esc_rf);
            $objPhpExcel->getActiveSheet()->setCellValue("BL" . ($row + 2), $obj->scaled_onair->cont_esc_npo);
            $objPhpExcel->getActiveSheet()->setCellValue("BM" . ($row + 2), $obj->scaled_onair->i_time_esc_npo);
            $objPhpExcel->getActiveSheet()->setCellValue("BN" . ($row + 2), $obj->scaled_onair->cont_esc_care);
            $objPhpExcel->getActiveSheet()->setCellValue("BO" . ($row + 2), $obj->scaled_onair->i_time_esc_care);
            $objPhpExcel->getActiveSheet()->setCellValue("BP" . ($row + 2), $obj->scaled_onair->i_cont_esc_gdrt);
            $objPhpExcel->getActiveSheet()->setCellValue("BQ" . ($row + 2), $obj->scaled_onair->i_time_esc_gdrt);
            $objPhpExcel->getActiveSheet()->setCellValue("BR" . ($row + 2), $obj->scaled_onair->i_cont_esc_oym);
            $objPhpExcel->getActiveSheet()->setCellValue("BS" . ($row + 2), $obj->scaled_onair->time_esc_oym);
            $objPhpExcel->getActiveSheet()->setCellValue("BT" . ($row + 2), $obj->scaled_onair->cont_esc_calidad);
            $objPhpExcel->getActiveSheet()->setCellValue("BU" . ($row + 2), $obj->scaled_onair->i_time_esc_calidad);
            $objPhpExcel->getActiveSheet()->setCellValue("BY" . ($row + 2), $obj->scaled_onair->n_atribuible_nokia2);
            $objPhpExcel->getActiveSheet()->setCellValue("CU" . ($row + 2), $obj->scaled_onair->n_detalle_solucion);
            $objPhpExcel->getActiveSheet()->setCellValue("CZ" . ($row + 2), $obj->scaled_onair->n_ultimo_subestado_de_escalamiento);
            $objPhpExcel->getActiveSheet()->setCellValue("CD" . ($row + 2), $obj->scaled_onair->n_tipificacion_solucion);
        }
        if ($obj->onair24) {
            $objPhpExcel->getActiveSheet()->setCellValue("DA" . ($row + 2), $obj->onair24->d_fin24h);
        }

        $objPhpExcel->getActiveSheet()->getStyle("AO" . ($row + 2))->getAlignment()->setWrapText(true);
        //$objPhpExcel->getActiveSheet()->getHighestRow();
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
            if (intval(phpversion()) <= 5) {
                PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            }
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

                //Inicializamos un objeto de PHPExcel para escritura...
                $objPHPWriter = $this->createErrorsFileExcel();
                $rowWriter = 1;

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
                            $this->printLineError($objPHPWriter, $rowWriter, $obj);
                            $rowWriter++;
                        }
                    }
                    if (($row % 50) == 0) {
                        sleep(3);
                    }

                    $row++;
                    if (count($cellInconsistencies) > 0) {
                        $inconsistenciesFull[] = $cellInconsistencies;
                    }
                }
                //Se procesan los comentarios...
                $this->processAndInsertComments();

                $filename = null;

                if (count($inconsistenciesFull) > 0) {
                    //Ponemos un nombre a la hoja.
                    $objPHPWriter->getActiveSheet()->setTitle("Reporte Errores de importación OnAir");
                    //Hacemos la hoja activa...
                    $objPHPWriter->setActiveSheetIndex(0);
                    //Guardamos.
                    $objWriter = new PHPExcel_Writer_Excel2007($objPHPWriter);
                    $filename = 'Reporte errores de importación OnAir.xlsx';
                    $objWriter->save($filename);
                }

                $response->setData([
                    "id" => $idTicket,
                    "imported" => $imported,
                    "inconsistencies" => $inconsistencies,
                    "inconsistenciesFull" => $inconsistenciesFull,
                    "data" => $this->objs,
                    "errors_filename" => $filename
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
//        $this->objs[] = $obj->all();
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


    private function getUserByName($userName) {
        //Ojo! se crean algunos indices en la tabla, para ajustar los campos usados en este MATCH de MySQL ejecutar la siguiente consulta:
        //ALTER TABLE user ADD FULLTEXT(n_name_user, n_last_name_user);
        return (new DB())->select('SELECT * FROM (SELECT * , MATCH (user.n_name_user, user.n_last_name_user) AGAINST (\'%' . $userName . '%\') AS puntuacion FROM user WHERE MATCH (user.n_name_user, user.n_last_name_user) AGAINST (\'%' . $userName . '%\') AND n_role_user IS NOT NULL AND n_role_user = "Ingeniero" ORDER BY puntuacion DESC LIMIT 15) q1 WHERE puntuacion >= 4')->first();
    }

}
