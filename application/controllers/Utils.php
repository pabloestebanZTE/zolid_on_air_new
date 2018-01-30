<?php

/*
 * Controlador para cosas genéricas del sistema...
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Utils extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

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

    private function getDatePHPExcel($sheet, $colum) {

//        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
//        $objPHPExcel = $objReader->load($file);
//        //Obtenemos las dimenciones de la página.
//        $sheet = $objPHPExcel->getSheet(0);

        $cell = $sheet->getCell($colum);
        $date = $cell->getValue();
        if (PHPExcel_Shared_Date::isDateTime($cell)) {
            $date = date("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($date));
            $date = Hash::addHours($date, 5);
        }
        return $date;
    }

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

    private function getPreparationStage(&$sheet, &$obj) {
        $obj->k_id_preparation = (new ObjUtil([
            "n_bcf_wbts_id" => $sheet->getCell('B' . $row)->getValue(),
            "n_bts_id" => $sheet->getCell('C' . $row)->getValue(),
            "d_ingreso_on_air" => $this->getDatePHPExcel($sheet, "I" . $row),
            "d_correccionespendientes" => $this->getDatePHPExcel($sheet, "U" . $row),
            "d_actualizacion_final" => $this->getDatePHPExcel($sheet, "AZ" . $row),
            "n_enteejecutor" => $sheet->getCell('M' . $row)->getValue(),
            "n_controlador" => $sheet->getCell('N' . $row)->getValue(),
            "n_idcontrolador" => $sheet->getCell('O' . $row)->getValue(),
            "n_btsipaddress" => $sheet->getCell('V' . $row)->getValue(),
            "n_integrador" => $sheet->getCell('W' . $row)->getValue(),
            "n_wp" => $sheet->getCell('AA' . $row)->getValue(),
            "n_crq" => $sheet->getCell('AB' . $row)->getValue(),
            "n_testgestion" => $sheet->getCell('AC' . $row)->getValue(),
            "n_sitiolimpio" => $sheet->getCell('AD' . $row)->getValue(),
            "n_instalacion_hw_sitio" => $sheet->getCell('AF' . $row)->getValue(),
            "n_cambios_config_solicitados" => $sheet->getCell('AG' . $row)->getValue(),
            "n_cambios_config_final" => $sheet->getCell('AH' . $row)->getValue(),
            "n_contratista" => $sheet->getCell('AM' . $row)->getValue(),
            "n_comentarioccial" => $sheet->getCell('AN' . $row)->getValue(),
            "n_ticketremedy" => $sheet->getCell('AO' . $row)->getValue(),
            "n_lac" => $sheet->getCell('AS' . $row)->getValue(),
            "n_rac" => $sheet->getCell('AT' . $row)->getValue(),
            "n_sac" => $sheet->getCell('AU' . $row)->getValue(),
            "n_integracion_gestion_y_trafica" => $sheet->getCell('AV' . $row)->getValue(),
            "puesta_servicio_sitio_nuevo_lte" => $sheet->getCell('AW' . $row)->getValue(),
            "n_instalacion_hw_4g_sitio" => $sheet->getCell('AX' . $row)->getValue(),
            "pre_launch" => $sheet->getCell('AY' . $row)->getValue(),
            "n_evidenciasl" => $sheet->getCell('BC' . $row)->getValue(),
            "n_evidenciatg" => $sheet->getCell('BD' . $row)->getValue(),
            "i_week" => $sheet->getCell('BU' . $row)->getValue(),
            "id_rftools" => $sheet->getCell('CB' . $row)->getValue(),
                ]))->all();
    }

    private function getUserByName($userName) {
        //Ojo! se crean algunos indices en la tabla, para ajustar los campos usados en este MATCH de MySQL ejecutar la siguiente consulta:
        //ALTER TABLE user ADD FULLTEXT(n_name_user, n_last_name_user);
        return DB::select('SELECT * FROM (SELECT * , MATCH (user.n_name_user, user.n_last_name_user) AGAINST (\'%' . $userName . '%\') AS puntuacion FROM user WHERE MATCH (user.n_name_user, user.n_last_name_user) AGAINST (\'%' . $userName . '%\') AND n_role_user IS NOT NULL AND n_role_user = "Ingeniero" ORDER BY puntuacion DESC LIMIT 15) q1 WHERE puntuacion >= 4')->first();
    }

    private function getPrecheck(&$sheet, &$obj) {
        $userName = $sheet->getCell('AP' . $row)->getValue();
        $user = $this->getUserByName($userName);
        if ($user) {
            $obj->k_id_precheck = (new ObjUtil([
                "d_finpre" => $this->getDatePHPExcel($sheet, "AP" . $row),
                "k_id_user" => $user->k_id_user
                    ]))->all();
        }
    }

    private function getScaledOnAir(&$sheet, &$obj) {
        $obj->scaled_on_air = (new ObjUtil([
            "d_fecha_escalado" => $this->getDatePHPExcel($sheet, "BF" . $row),
            "time_esc_imp" => $sheet->getCell('BH' . $row)->getValue(),
            "cont_esc_npo" => $sheet->getCell('BK' . $row)->getValue(),
            "cont_esc_care" => $sheet->getCell('BM' . $row)->getValue(),
            "time_esc_oym" => $sheet->getCell('BR' . $row)->getValue(),
            "cont_esc_calidad" => $sheet->getCell('BS' . $row)->getValue(),
            "n_atribuible_nokia2" => $sheet->getCell('BX' . $row)->getValue(),
            "n_tipificacion_solucion" => $sheet->getCell('CC' . $row)->getValue(),
            "n_ultimo_subestado_de_escalamiento" => $sheet->getCell('CC' . $row)->getValue(),
            "i_time_esc_rf" => $sheet->getCell('BI' . $row)->getValue(),
            "i_cont_esc_imp" => $sheet->getCell('BG' . $row)->getValue(),
            "i_time_esc_rf" => $sheet->getCell('BJ' . $row)->getValue(),
            "i_time_esc_npo" => $sheet->getCell('BL' . $row)->getValue(),
            "i_time_esc_care" => $sheet->getCell('BN' . $row)->getValue(),
            "i_cont_esc_gdrt" => $sheet->getCell('BO' . $row)->getValue(),
            "i_time_esc_gdrt" => $sheet->getCell('BP' . $row)->getValue(),
            "i_cont_esc_oym" => $sheet->getCell('BQ' . $row)->getValue(),
            "i_time_esc_calidad" => $sheet->getCell('BT' . $row)->getValue(),
                ]))->all();
    }

    private function getParamsOnAir(&$sheet, &$obj, &$inconsistencies, &$cellInconsistencies) {
        //Obtenemos y consultamos la estación...
        $station = $sheet->getCell('A' . $row)->getValue();
        $obj->k_id_station = (new StationModel())->where("n_name_station", "=", $station)->orWhere("n_name_station", "LIKE", "%" . $station . "%")->first();
        if (!$obj->k_id_station) {
            //En efecto insertariamos la nueva estación.
            $inconsistencies++;
            $cellInconsistencies[] = "A";
        }

        //Obtenemos la tecnología.
        $technology = $sheet->getCell('D' . $row)->getValue();
        $obj->k_id_technology = (new TechnologyModel())->where("n_name_technology", "=", $technology)->orWhere("n_name_technology", "LIKE", "%$technology%")->first();

        if (!$obj->k_id_technology) {
            $inconsistencies++;
            $cellInconsistencies[] = "D";
        }

        //Obtenemos la banda...
        $band = $sheet->getCell('E' . $row)->getValue();
        $obj->k_id_band = (new BandModel())->where("n_name_band", "=", $band)->orWhere("n_name_band", "LIKE", "%$band%")->first();

        if (!$obj->k_id_band) {
            $inconsistencies++;
            $cellInconsistencies[] = "E";
        }

        //Obtenemos el estado...
        $status = $sheet->getCell('F' . $row)->getValue();
        $obj->k_id_status = (new StatusModel())->where("n_name_status", "=", $status)->orWhere("n_name_status", "LIKE", "%$status%")->first();
//                    $obj->k_id_status = $status;

        if (!$obj->k_id_status) {
            $inconsistencies++;
            $cellInconsistencies[] = "F";
        }

        //Obtenemos el subestado...
        $subStatus = $sheet->getCell('G' . $row)->getValue();
        $obj->k_id_substatus = (new SubstatusModel())->where("n_name_substatus", "=", $subStatus)->orWhere("n_name_substatus", "LIKE", $subStatus)->first();

        if (!$obj->k_id_substatus) {
            $inconsistencies++;
            $cellInconsistencies[] = "G";
        }


        //Obtenemos el tipo de trabajo...
        $work = $sheet->getCell('K' . $row)->getValue();
        $obj->k_id_work = (new WorkModel())->where("n_name_ork", "=", $work)->orWhere("n_name_ork", "LIKE", "%$work%")->first();
        if (!$obj->k_id_work) {
            $inconsistencies++;
            $cellInconsistencies[] = "K";
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

        //Obtenemos los campos comunes...
        $obj->b_excpetion_gri = $sheet->getCell('H' . $row)->getValue();
        $obj->d_fecha_ultima_rev = $this->getDatePHPExcel($sheet, "J" . $row);
        $obj->b_vistamm = $sheet->getCell('L' . $row)->getValue();
        $obj->d_bloqueo = $this->getDatePHPExcel($sheet, "S" . $row);
        $obj->d_desbloqueo = $this->getDatePHPExcel($sheet, "R" . $row);
        $obj->d_fechaproduccion = $this->getDatePHPExcel($sheet, "AE" . $row);
        $obj->n_sectoresbloqueados = $sheet->getCell('AI' . $row)->getValue();
        $obj->n_sectoresdesbloqueados = $sheet->getCell('AJ' . $row)->getValue();
        $obj->n_estadoonair = $sheet->getCell('AK' . $row)->getValue();
        $obj->n_atribuible_nokia = $sheet->getCell('AL' . $row)->getValue();
        $obj->d_asignacion_final = $sheet->getCell('BA' . $row)->getValue();
        $obj->n_kpi1 = $sheet->getCell('CE' . $row)->getValue();
        $obj->n_kpi2 = $sheet->getCell('CF' . $row)->getValue();
        $obj->n_kpi3 = $sheet->getCell('CH' . $row)->getValue();
        $obj->n_kpi4 = $sheet->getCell('CJ' . $row)->getValue();
        $obj->n_alarma1 = $sheet->getCell('CL' . $row)->getValue();
        $obj->n_alarma2 = $sheet->getCell('CM' . $row)->getValue();
        $obj->n_alarma3 = $sheet->getCell('CN' . $row)->getValue();
        $obj->n_alarma4 = $sheet->getCell('CO' . $row)->getValue();
        $obj->i_cont_total_escalamiento = $sheet->getCell('CP' . $row)->getValue();
        $obj->i_time_total_escalamiento = $sheet->getCell('CQ' . $row)->getValue();
        $obj->n_ola = $sheet->getCell('CR' . $row)->getValue();
        $obj->n_ola_excedido = $sheet->getCell('CS' . $row)->getValue();
        $obj->i_lider_cambio = $sheet->getCell('CU' . $row)->getValue();
        $obj->i_lider_cuadrilla = $sheet->getCell('CV' . $row)->getValue();
        $obj->n_ola_areas = $sheet->getCell('CW' . $row)->getValue();
        $obj->n_ola_areas_excedido = $sheet->getCell('CX' . $row)->getValue();
        $obj->n_implementacion_campo = $sheet->getCell('DB' . $row)->getValue();
        $obj->n_implementacion_remota = $sheet->getCell('DC' . $row)->getValue();
        $obj->n_gestion_power = $sheet->getCell('DD' . $row)->getValue();
        $obj->n_obra_civil = $sheet->getCell('DE' . $row)->getValue();
        $obj->on_air = $sheet->getCell('DF' . $row)->getValue();
        $obj->d_fecha_cg = $sheet->getCell('DH' . $row)->getValue();
        $obj->n_exclusion_bajo_trafico = $sheet->getCell('DI' . $row)->getValue();
        $obj->n_ticket = $sheet->getCell('DJ' . $row)->getValue();
        $obj->n_estado_ticket = $sheet->getCell('DK' . $row)->getValue();
        $obj->n_sln_modernizacion = $sheet->getCell('DL' . $row)->getValue();
        $obj->n_en_prorroga = $sheet->getCell('DM' . $row)->getValue();
        $obj->n_cont_prorrogas = $sheet->getCell('DN' . $row)->getValue();
        $obj->n_noc = $sheet->getCell('DO' . $row)->getValue();
    }

    private function get12H(&$sheet, &$obj, $row) {
        //Iniciamos la creación del 12h...
        $onAir12hModel = new OnAir12hModel();
        $validator = new Validator();
        $value = $sheet->getCell('AQ' . $row)->getValue();
        if ($validator->required("", $value)) {
            $onAir12hModel->setDStart12h(Hash::subtractHours($value, 1));
            $onAir12hModel->setDFin12h($value);
            $follow12HModel = new FollowUp12hModel();
            $userName = $sheet->getCell('Y' . $row)->getValue();
            if ($userName) {
                $user = $this->getUserByName($userName);
                $follow12HModel->setKIdUser($user->k_id_user);
                $follow12HModel->setNRound(0);
                $follow12HModel->save();
                $onAir12hModel->setKIdFollowUp12h($idFollow);
            }
            //Se deja hasta aquí, para que el proceso que invocó esta función ejecute el insert de este modelo cuando le pase el id del ticket insertado...
            $obj->onAir12h = $onAir12hModel;
        }
    }

    private function get24H(&$sheet, &$obj) {
        
    }

    private function get36H(&$sheet, &$obj) {
        
    }

    private function getSectores(&$sheet, &$obj) {
        //En esta función se comprobarán los sectores del ticket...
    }

    public function processData() {
        $request = $this->request;
        $response = new Response(EMessages::SUCCESS);
        $file = $request->file;

        //Verificamos si el archivo existe...
        if (file_exists($file)) {
            //Iniciamos el procedimiento de carga de datos...
            set_time_limit(-1);
            ini_set('memory_limit', '1024M');
            $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel');

            try {
                $validator = new Validator();
                $inputFileType = PHPExcel_IOFactory::identify($file);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($file);

                //Obtenemos la página.
                $sheet = $objPHPExcel->getSheet(0);
                //$highestRow = $sheet->calculateWorksheetDimension();
                //Obtenemos el highestRow...
                $highestRow = 0;
                $row = 2;
                while ($validator->required("", $sheet->getCell('A' . $row)->getValue())) {
                    $highestRow++;
                    $obj = new ObjUtil([]);
                    $imported = 0;
                    $inconsistencies = 0;
                    $cellInconsistencies = [];

                    $this->getParamsOnAir($sheet, $obj, $inconsistencies, $cellInconsistencies);
                    //Obtenemos el preparation_stage.
                    $this->getPreparationStage($sheet, $obj);

                    //Aquí verificamos en que estado está el ticket para tomar alcunas desciciones...
                    switch ($obj->k_id_status_onair) {
                        case ConstStates::PRECHECK:
                            //Si está en precheck debería resolver quíen está a cargo...
                            $this->getPrecheck($sheet, $obj);
                        case ConstStates::REINICIO_PRECHECK:
                            break;
                        case ConstStates::REINICIO_12H:
                            //Si está en reinicio debería resolver quíen está a cargo, si hay registros de 12h, 24h,36 etc.
                            break;
                        case ConstStates::SEGUIMIENTO_12H:
                            //Si está en 12, debe resolver quién hizo el precheck y resolver cuanto tiempo lleva en seguimiento 12h.

                            break;
                        case ConstStates::SEGUIMIENTO_24H:
                            //Si está en 24, debe resolver quién hizo el 12h y resolver cuanto tiempo lleva en seguimiento 24h y si está asignado.
                            break;
                        case ConstStates::SEGUIMIENTO_36H:
                            //Si está en 36h, debe resolver quién hizo el 12h,24h y resolver cuanto tiempo lleva en seguimiento 36h y si está asignado.
                            break;
                        case ConstStates::PRODUCCION:
                            $this->getPrecheck($sheet, $obj);
                            $this->get12H($sheet, $obj, $row);
                            $this->get24H($sheet, $obj, $row);
                            $this->get36H($sheet, $obj, $row);
                            break;
                    }


                    //Obtenemos el precheck...
//                    $this->getPrecheck();
                    //Obtenemos el posible escalamiento.
//                    $this->getScaledOnAir($sheet, $obj);


                    $obj->row = $row;

                    if ($inconsistencies == 0) {
                        //Iniciamos la inserción del nuevo registro OnAir...
                        $imported++;
                    } else {
                        //La idea es pintar la fila que no se pudo pintar y las celdas que probocaron el error...
                    }
                    $idTicket = 0;
                    $idTicket = $this->insertTicket($obj);
                    $row++;
                }
                $response->setData(["data" => $obj->all(), "id" => $idTicket]);
            } catch (DeplynException $ex) {
                $response = new Response(EMessages::ERROR, "Error al procesar el archivo.");
            }
        } else {
            $response = new Response(EMessages::ERROR, "No se encontró el archivo " . $file);
        }

        $this->json($response);
    }

    private function insertTicket($obj) {
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

            $objTck->k_id_preparation = ($idPS) ? $idPS->data : DB::NULLED;
            $objTck->k_id_technology = ($objTck->k_id_technology) ? $objTck->k_id_technology->k_id_technology : DB::NULLED;
            $objTck->k_id_work = ($objTck->k_id_work) ? $objTck->k_id_work->k_id_work : DB::NULLED;
            $objTck->k_id_station = ($objTck->k_id_station) ? $objTck->k_id_station->k_id_station : DB::NULLED;

            //Dejamos el precheck en estand by por ahora...
            $objTck->k_id_precheck = DB::NULLED;
            $idTick = 0;
//            var_dump($objTck->all());
            $idTick = $tck->insert($objTck->all());
//            echo $tck->getSQL();
            return $idTick;
//            return $idTick;
        } catch (DeplynException $exc) {
            return $exc;
        }
    }

}
