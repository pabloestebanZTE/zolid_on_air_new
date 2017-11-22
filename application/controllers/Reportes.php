<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

    function __construct() {
        ini_set("memory_limit",-1);
        ini_set('max_execution_time', 0);
        parent::__construct();
        $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel');
        $this->load->model('data/Dao_reporte_comentario_model');
        $this->load->model('data/Dao_ticketOnair_model');
        $this->load->model('data/Dao_station_model');
        $this->load->model('data/Dao_band_model');
        $this->load->model('data/Dao_work_model');
        $this->load->model('data/Dao_technology_model');
        $this->load->model('data/Dao_statusOnair_model');
        $this->load->model('data/Dao_precheck_model');
        $this->load->model('data/Dao_followUp12h_model');
        $this->load->model('data/Dao_followUp24h_model');
        $this->load->model('data/Dao_followUp36h_model');
        $this->load->model('data/Dao_onAir12h_model');
        $this->load->model('data/Dao_onAir24h_model');
        $this->load->model('data/Dao_onAir36h_model');
        $this->load->model('data/Dao_preparationStage_model');
        $this->load->model('data/Dao_scaledOnair_model');
        $this->load->model('data/Dao_user_model');
    }

    public function reportComments() {
/*         header('Content-Type: text/plain');
*/       $reporte = new Dao_reporte_comentario_model();
       $filename = "Reporte_Comentarios_".date("Y-m-d").".xls";
       header("Content-Disposition: attachment; filename=\"$filename\"");
       header("Content-Type: application/vnd.ms-excel; charset=utf-8");
       $respuesta = $reporte->getAll()->data;
/*       print_r($respuesta);
*/         for ($i=0; $i <count($respuesta) ; $i++) {
             $data[$i] = [
              "Id-On Air" =>utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->k_id_on_air)),
              "Nombre_Estación-EB" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->n_nombre_estacion_eb)),
              "Tecnología" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->n_tecnologia)),
              "Banda" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->n_banda)),
              "tipo De trabajo" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->n_tipo_trabajo)),
              "Estado EB-ResuComen" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->n_estado_eb_resucomen)),
              "Comentario-ResuComen" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->comentario_resucoment)),
              "Hora Actualizacion ResuComen" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->hora_actualizacion_resucomen)),
              "Usuario-ResuComen" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->usuario_resucomen)),
              "Ente-Ejecutor" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->ente_ejecutor)),
              "Tipificación-ResuComen" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->tipificacion_resucomen)),
              "NOC" => utf8_decode( str_replace(array("\n", "\r"), '', $respuesta[$i]->noc)),
             ];
         }
         $flag = false;
         foreach($data as $row) {
           if(!$flag) {
             // display field/column names as first row
             echo implode("\t", array_keys($row)) . "\r\n";
             $flag = true;
           }
           echo implode("\t", array_values($row)) . "\r\n";
         }
         exit;

/*
        $objPhpExcel = new PHPExcel();
        //Propiedades de archivo.
        $objPhpExcel->getProperties()->setCreator("ZTE");
        $objPhpExcel->getProperties()->setLastModifiedBy("ZTE");
        $objPhpExcel->getProperties()->setTitle("Reporte Comentarios");
        $objPhpExcel->getProperties()->setSubject("Reporte Comentarios - Zolid");
        $objPhpExcel->getProperties()->setDescription("Reporte Comentarios - Zolid");
        //Seleccionamos la página.
        $objPhpExcel->setActiveSheetIndex(0);
        //Aplicamos estilos a las celdas.
        $objPhpExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '85c2ff')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    )
        ));

        //Escribir cabecearas.
        $objPhpExcel->getActiveSheet()->setCellValue("A1", "Id-On Air");
        $objPhpExcel->getActiveSheet()->setCellValue("B1", "Nombre_Estación-EB");
        $objPhpExcel->getActiveSheet()->setCellValue("C1", "Tecnología");
        $objPhpExcel->getActiveSheet()->setCellValue("D1", "Banda");
        $objPhpExcel->getActiveSheet()->setCellValue("E1", "");
        $objPhpExcel->getActiveSheet()->setCellValue("F1", "Estado EB-ResuComen");
        $objPhpExcel->getActiveSheet()->setCellValue("G1", "Comentario-ResuComen");
        $objPhpExcel->getActiveSheet()->setCellValue("H1", "Hora Actualización ResuComen");
        $objPhpExcel->getActiveSheet()->setCellValue("I1", "Usuario-ResuComen");
        $objPhpExcel->getActiveSheet()->setCellValue("J1", "Ente-Ejecutor");
        $objPhpExcel->getActiveSheet()->setCellValue("K1", "Tipificación-ResuComen");
        $objPhpExcel->getActiveSheet()->setCellValue("L1", "NOC");

        //Aplicamos las dimenciones a las celdas...
        $objPhpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

        //Ahora pintamos los datos...
        for ($i = 0; $i < count($respuesta); $i++) {
            $objPhpExcel->getActiveSheet()->setCellValue("A" . ($i + 2), $respuesta[$i]->k_id_on_air);
            $objPhpExcel->getActiveSheet()->setCellValue("B" . ($i + 2), $respuesta[$i]->n_nombre_estacion_eb);
            $objPhpExcel->getActiveSheet()->setCellValue("C" . ($i + 2), $respuesta[$i]->n_tecnologia);
            $objPhpExcel->getActiveSheet()->setCellValue("D" . ($i + 2), $respuesta[$i]->n_banda);
            $objPhpExcel->getActiveSheet()->setCellValue("E" . ($i + 2), $respuesta[$i]->n_tipo_trabajo);
            $objPhpExcel->getActiveSheet()->setCellValue("F" . ($i + 2), $respuesta[$i]->n_estado_eb_resucomen);
            $objPhpExcel->getActiveSheet()->setCellValue("G" . ($i + 2), $respuesta[$i]->comentario_resucoment);
            $objPhpExcel->getActiveSheet()->setCellValue("H" . ($i + 2), $respuesta[$i]->hora_actualizacion_resucomen);
            $objPhpExcel->getActiveSheet()->setCellValue("I" . ($i + 2), $respuesta[$i]->usuario_resucomen);
            $objPhpExcel->getActiveSheet()->setCellValue("J" . ($i + 2), $respuesta[$i]->ente_ejecutor);
            $objPhpExcel->getActiveSheet()->setCellValue("K" . ($i + 2), $respuesta[$i]->tipificacion_resucomen);
            $objPhpExcel->getActiveSheet()->setCellValue("L" . ($i + 2), $respuesta[$i]->noc);
        }

        //Ponemos un nombre a la hoja.
        $objPhpExcel->getActiveSheet()->setTitle('Reporte Comentarios');
        //Hacemos la hoja activa...
        $objPhpExcel->setActiveSheetIndex(0);
        //Guardamos.
        $objWriter = new PHPExcel_Writer_Excel2007($objPhpExcel);
        $filename = 'Reporte Comentarios - (' . date("Y-m-d") . ').xlsx';
        $objWriter->save($filename);
        Redirect::to(URL::to($filename));

   */
    }

    public function reportOnair() {


               $filename = "Reporte_ONAIR_".date("Y-m-d").".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
      /*  header('Content-Type: text/plain');*/
        $ticketsOnAir = new Dao_ticketOnAir_model();
        $preparation = new Dao_preparationStage_model();
        $station = new Dao_station_model();
        $technology = new Dao_technology_model();
        $band = new Dao_band_model();
        $statusOnair = new Dao_statusOnair_model();
        $work = new Dao_work_model();
        $scaled = new Dao_scaledOnair_model();
        $precheck = new Dao_precheck_model();
        $onair12 = new Dao_onAir12h_model();
        $follow12 = new Dao_followUp12h_model();
        $onair24 = new Dao_onAir24h_model();
        $follow24 = new Dao_followUp24h_model();
        $onair36 = new Dao_onAir36h_model();
        $follow36 = new Dao_followUp36h_model();
        $userp = new Dao_user_model();
        $user = new Dao_user_model();
        //inicio llamando todos los tickets
        $res = $ticketsOnAir->getAll()->data;
        //recorro y se van asignando foraneas
        for ($i = 0; $i < count($res); $i++) {
            $res[$i]->k_id_preparation = $preparation->findByIdPreparation($res[$i]->k_id_preparation)->data; //preparation
            $res[$i]->k_id_station = $station->findById($res[$i]->k_id_station)->data; //Station
            $res[$i]->k_id_technology = $technology->findById($res[$i]->k_id_technology)->data; //technology
            $res[$i]->k_id_band = $band->findById($res[$i]->k_id_band)->data; //band
            $res[$i]->k_id_status_onair = $statusOnair->findById($res[$i]->k_id_status_onair)->data; //Status onair
            $res[$i]->k_id_work = $work->findById($res[$i]->k_id_work)->data; //work
            $res[$i]->scaled_onair = $scaled->getScaledByTicket($res[$i]->k_id_onair)->data; //scaled onair
            $res[$i]->k_id_precheck = $precheck->getPrecheckByIdPrech($res[$i]->k_id_precheck)->data; //precheck
            if ($res[$i]->k_id_precheck) {
                $res[$i]->k_id_precheck->k_id_user = $user->findBySingleId($res[$i]->k_id_precheck->k_id_user)->data;//user pr
            }
            //creacion obj onair 12
            $res[$i]->onair12 = $onair12->getOnair12ByIdOnair($res[$i]->k_id_onair)->data;//onair12
            //filtracion ronda maxima onair12
            if ($res[$i]->onair12) {
                for ($j=0; $j <count($res[$i]->onair12) ; $j++) {
                    $ElementoMax12[$j] = $res[$i]->onair12[$j]->i_round;
                }
            $res[$i]->onair12 =  $onair12->getOnair12ByIdOnairAndRound($res[$i]->k_id_onair,Max($ElementoMax12))->data;
            $res[$i]->onair12->k_id_follow_up_12h = $follow12->getfollow12ByIdFollow($res[$i]->onair12->k_id_follow_up_12h)->data;//follow12
            $res[$i]->onair12->k_id_follow_up_12h->k_id_user = $user->findBySingleId($res[$i]->onair12->k_id_follow_up_12h->k_id_user)->data;//user12
            }
            //fin obj onair12
            //creacion obj onair 24
            $res[$i]->onair24 = $onair24->getOnair24ByIdOnair($res[$i]->k_id_onair)->data;//onair24
            //filtracion ronda maxima onair24
            if ($res[$i]->onair24) {
                for ($j=0; $j <count($res[$i]->onair24) ; $j++) {
                    $ElementoMax24[$j] = $res[$i]->onair24[$j]->i_round;
                }
            $res[$i]->onair24 =  $onair24->getOnair24ByIdOnairAndRound($res[$i]->k_id_onair,Max($ElementoMax24))->data;
            $res[$i]->onair24->k_id_follow_up_24h = $follow24->getfollow24ByIdFollow($res[$i]->onair24->k_id_follow_up_24h)->data;//follow24
            $res[$i]->onair24->k_id_follow_up_24h->k_id_user = $user->findBySingleId($res[$i]->onair24->k_id_follow_up_24h->k_id_user)->data;//user24
            }
            //fin obj onair24
            //creacion obj onair 36
            $res[$i]->onair36 = $onair36->getOnair36ByIdOnair($res[$i]->k_id_onair)->data;//onair36
            //filtracion ronda maxima onair36
            if ($res[$i]->onair36) {
                for ($j=0; $j <count($res[$i]->onair36) ; $j++) {
                    $ElementoMax36[$j] = $res[$i]->onair36[$j]->i_round;
                }
            $res[$i]->onair36 =  $onair36->getOnair36ByIdOnairAndRound($res[$i]->k_id_onair,Max($ElementoMax36))->data;
            $res[$i]->onair36->k_id_follow_up_36h = $follow36->getfollow36ByIdFollow($res[$i]->onair36->k_id_follow_up_36h)->data;//follow36
            $res[$i]->onair36->k_id_follow_up_36h->k_id_user = $user->findBySingleId($res[$i]->onair36->k_id_follow_up_36h->k_id_user)->data;//user36
            }
            //fin obj onair24
        }


        for ($f=0; $f <count($res) ; $f++) {





                      if (!$res[$f]->k_id_station) {
                          $res[$f]->k_id_station->n_name_station = "";
                          if (!$res[$f]->k_id_station->k_id_city) {
                              $res[$f]->k_id_station->k_id_city->n_name_city = "";
                              if (!$res[$f]->k_id_station->k_id_city->k_id_regional) {
                                  $res[$f]->k_id_station->k_id_city->k_id_regional->n_name_regional = "";
                              }
                          }
                      }
                      if (!$res[$f]->k_id_preparation) {
                         $res[$f]->k_id_preparation->n_bcf_wbts_id = "";
                         $res[$f]->k_id_preparation->n_bts_id = "";
                         $res[$f]->k_id_preparation->d_ingreso_on_air = "";
                         $res[$f]->k_id_preparation->b_vistamm = "";
                         $res[$f]->k_id_preparation->n_enteejecutor = "";
                         $res[$f]->k_id_preparation->n_controlador = "";
                         $res[$f]->k_id_preparation->n_idcontrolador = "";
                         $res[$f]->k_id_preparation->d_correccionespendientes = "";
                         $res[$f]->k_id_preparation->n_btsipaddress = "";
                         $res[$f]->k_id_preparation->n_integrador = "";
                         $res[$f]->k_id_preparation->n_wp = "";
                         $res[$f]->k_id_preparation->n_crq = "";
                         $res[$f]->k_id_preparation->n_testgestion = "";
                         $res[$f]->k_id_preparation->n_sitiolimpio = "";
                         $res[$f]->d_fechaproduccion = "";
                         $res[$f]->k_id_preparation->n_instalacion_hw_sitio = "";
                         $res[$f]->k_id_preparation->n_cambios_config_solicitados = "";
                         $res[$f]->k_id_preparation->n_cambios_config_final = "";
                         $res[$f]->k_id_preparation->n_contratista = "";
                         $res[$f]->k_id_preparation->n_comentarioccial = "";
                         $res[$f]->k_id_preparation->n_ticketremedy = "";
                         $res[$f]->k_id_preparation->n_lac = "";
                         $res[$f]->k_id_preparation->n_rac = "";
                         $res[$f]->k_id_preparation->n_sac = "";
                         $res[$f]->k_id_preparation->n_integracion_gestion_y_trafica = "";
                         $res[$f]->k_id_preparation->puesta_servicio_sitio_nuevo_lte = "";
                         $res[$f]->k_id_preparation->n_instalacion_hw_4g_sitio = "";
                         $res[$f]->k_id_preparation->pre_launch = "";
                         $res[$f]->k_id_preparation->n_evidenciasl = "";
                         $res[$f]->k_id_preparation->n_evidenciatg = "";
                         $res[$f]->k_id_preparation->i_week = "";
                         $res[$f]->k_id_preparation->id_notificacion = "";
                         $res[$f]->k_id_preparation->id_documentacion = "";
                         $res[$f]->k_id_preparation->id_rftools = "";
                      }
                      if (!$res[$f]->k_id_precheck) {
                        $res[$f]->k_id_precheck = new \stdClass();
                        $res[$f]->k_id_precheck->d_finpre = "";
                        $res[$f]->k_id_precheck->k_id_user = new \stdClass();
                        $res[$f]->k_id_precheck->k_id_user->n_name_user = "";
                        $res[$f]->k_id_precheck->k_id_user->n_last_name_user = "";
                      }

                      if (!$res[$f]->k_id_band) {
                          $res[$f]->k_id_band->n_name_band = "";
                      }
                      if (!$res[$f]->k_id_technology) {
                          $res[$f]->k_id_technology->n_name_technology = "";
                      }
                      if (!$res[$f]->k_id_status_onair) {
                          if (!$res[$f]->k_id_status_onair['k_id_status']) {
                              $res[$f]->k_id_status_onair['k_id_status']->n_name_status = "";
                          }
                          if (!$res[$f]->k_id_status_onair['k_id_substatus']) {
                              $res[$f]->k_id_status_onair['k_id_substatus']->n_name_substatus = "";
                          }
                      }
                      if (!$res[$f]->k_id_work) {
                          $res[$f]->k_id_work->n_name_ork = "";
                      }

                      if (!$res[$f]->onair12) {
                          $res[$f]->onair12 = new \stdClass();
                          $res[$f]->onair12->k_id_follow_up_12h = new \stdClass();
                          $res[$f]->onair12->k_id_follow_up_12h->k_id_user = new \stdClass();
                          $res[$f]->onair12->k_id_follow_up_12h->k_id_user->n_name_user = "";
                          $res[$f]->onair12->k_id_follow_up_12h->k_id_user->n_last_name_user = "";
                          $res[$f]->onair12->d_fin12h = "";
                      }

                      if (!$res[$f]->onair36) {
                          $res[$f]->onair36 = new \stdClass();
                          $res[$f]->onair36->k_id_follow_up_36h = new \stdClass();
                          $res[$f]->onair36->k_id_follow_up_36h->k_id_user = new \stdClass();
                          $res[$f]->onair36->k_id_follow_up_36h->k_id_user->n_name_user = "";
                          $res[$f]->onair36->k_id_follow_up_36h->k_id_user->n_last_name_user = "";
                          $res[$f]->onair36->d_fin36h = "";
                      }

                      if (!$res[$f]->scaled_onair) {
                        $res[$f]->scaled_onair = new \stdClass();
                          $res[$f]->scaled_onair->n_atribuible_nokia = "";
                          $res[$f]->scaled_onair->d_time_escalado = "";
                          $res[$f]->scaled_onair->d_fecha_escalado = "";
                          $res[$f]->scaled_onair->i_cont_esc_imp = "";
                          $res[$f]->scaled_onair->time_esc_imp = "";
                          $res[$f]->scaled_onair->i_cont_esc_rf = "";
                          $res[$f]->scaled_onair->i_time_esc_rf = "";
                          $res[$f]->scaled_onair->cont_esc_npo = "";
                          $res[$f]->scaled_onair->i_time_esc_npo = "";
                          $res[$f]->scaled_onair->cont_esc_care = "";
                          $res[$f]->scaled_onair->i_time_esc_care = "";
                          $res[$f]->scaled_onair->i_cont_esc_gdrt = "";
                          $res[$f]->scaled_onair->i_time_esc_gdrt = "";
                          $res[$f]->scaled_onair->i_cont_esc_oym = "";
                          $res[$f]->scaled_onair->time_esc_oym = "";
                          $res[$f]->scaled_onair->cont_esc_calidad = "";
                          $res[$f]->scaled_onair->i_time_esc_calidad = "";
                          $res[$f]->scaled_onair->n_atribuible_nokia2 = "";
                          $res[$f]->scaled_onair->n_detalle_solucion = "";
                          $res[$f]->scaled_onair->n_ultimo_subestado_de_escalamiento = "";
                          $res[$f]->scaled_onair->n_tipificacion_solucion = "";
                      }

                      if (!$res[$f]->onair24) {
                        $res[$f]->onair24 = new \stdClass();
                          $res[$f]->onair24->d_fin24h = "";
                      }





             $data[$f] = [
               "Id-On Air" =>utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_onair)),
               "Nombre_Estación-EB" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_station->n_name_station)),
               "bcf_wbts_id" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_bcf_wbts_id)),
               "BTS_ID" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_bts_id)),//d
              "Tecnologia" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_technology->n_name_technology)),//e
              "Banda" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_band->n_name_band)),//f
              "Estado" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_status_onair['k_id_status']->n_name_status)),//g
              "Subestado" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_status_onair['k_id_substatus']->n_name_substatus)),//h
              "excepcion GRI" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->b_excpetion_gri)),//i
              "Fecha ingreso On Air" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->d_ingreso_on_air)),//j
              "Fechaultimarev" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->d_fecha_ultima_rev)),//k
              "tipo De trabajo" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_work->n_name_ork)),///////10)7+//l9
              "vistamm" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->b_vistamm)),//m
              "enteejecutor" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_enteejecutor)),//n
              "controlador" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_controlador)),//o
              "idcontrolador" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_idcontrolador)),//p
              "Ciudad" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_station->k_id_city->n_name_city)),//q
              "Regional" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_station->k_id_city->k_id_regional->n_name_regional)),//r
              "desbloqueo" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->d_desbloqueo)),//s
              "bloqueado" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->d_bloqueo)),//t
              "reviewedfo" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_reviewedfo)),//u
              "correccionpendientes" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->d_correccionespendientes)),//v
              "btsipaddress" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_btsipaddress)),//w
              "integrador" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_integrador)),//x
              "ingenieroprecheck" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_precheck->k_id_user->n_name_user." ".$res[$f]->k_id_precheck->k_id_user->n_last_name_user)),//y
              "ingenierofinal12horas" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->onair12->k_id_follow_up_12h->k_id_user->n_name_user." ".$res[$f]->onair12->k_id_follow_up_12h->k_id_user->n_last_name_user)),//z
              "ingenierogarantia" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->onair36->k_id_follow_up_36h->k_id_user->n_name_user."".$res[$f]->onair36->k_id_follow_up_36h->k_id_user->n_last_name_user)),//aa
              "WP" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_wp)),//ab
              "CRQ" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_crq)),//ac
              "testgestion" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_testgestion)),//ad
              "sitiolimpio" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_sitiolimpio)),//ae
              "fechaproduccion" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->d_fechaproduccion)),//af
              "Instalacion_HW_Sitio" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_instalacion_hw_sitio)),//ag
              "Cambios_Config_Solicitados" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_cambios_config_solicitados)),//ah
              "Cambios_Config_Final" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_cambios_config_final)),//ai
              "sectoresbloqueados" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_sectoresbloqueados)),//aj
              "sectoresdesbloqueados" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_sectoresdesbloqueados)),//ak
              "estadoonair" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_estadoonair)),//al
              "Atribuible_Nokia" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->n_atribuible_nokia)),//am
              "contratista" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_contratista)),//an
              "comentarioccial" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_comentarioccial)),//ao
              "ticketremedy" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_ticketremedy)),//ap
              "FinPre" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_precheck->d_finpre)),//aq
              "Fin12H" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->onair12->d_fin12h)),//ar
              "Fin48H" => utf8_decode( str_replace(array("\n", "\r"), '', " ")),//as
              "LAC" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_lac)),//at
              "RAC" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_rac)),//au
              "SAC" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_sac)),//av
              "Integracion_Gestion_y_Trafica" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_integracion_gestion_y_trafica)),//aw
              "Puesta_Servicio_Sitio_Nuevo_LTE" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->puesta_servicio_sitio_nuevo_lte)),//ax
              "Instalacion_HW_4G_Sitio" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_instalacion_hw_4g_sitio)),//ay
              "Prelaunch" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->pre_launch)),//az
              "Actualizacion_Final" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->d_actualizacion_final)),//BA
              "Asignacion_Final" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->d_asignacion_final)),//BB
              "identificador" => utf8_decode( str_replace(array("\n", "\r"), '', " ")),//BC
              "EvidenciaSL" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_evidenciasl)),//BD
              "EvidenciaTG" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->n_evidenciatg)),//BE
              "Time_Escalado" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->d_time_escalado)),//BF
              "Fecha_Escalado" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->d_fecha_escalado)),//BG
              "Cont_Esc_Imp" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_cont_esc_imp)),//BH
              "Time_Esc_Imp" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->time_esc_imp)),//BI
              "Cont_Esc_RF" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_cont_esc_rf)),//BJ
              "Time_Esc_RF" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_time_esc_rf)),//BK
              "Cont_Esc_NPO" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->cont_esc_npo)),//BL
              "Time_Esc_NPO" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_time_esc_npo)),//BM
              "Cont_Esc_Care" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->cont_esc_care)),//BN
              "Time_Esc_Care" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_time_esc_care)),//BO
              "Cont_Esc_GDRT" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_cont_esc_gdrt)),//BP
              "Time_Esc_GDRT" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_time_esc_gdrt)),//BQ
              "Cont_Esc_OyM" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_cont_esc_oym)),//BR
              "Time_Esc_OyM" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->time_esc_oym)),//BS
              "Cont_Esc_Calidad" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->cont_esc_calidad)),//BT
              "Time_Esc_Calidad" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->i_time_esc_calidad)),//BU
              "WEEK" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->i_week)),//BV
              "T_From_Notif" => utf8_decode( str_replace(array("\n", "\r"), '', " ")),//BW
              "T_From_Asign" => utf8_decode( str_replace(array("\n", "\r"), '', " ")),//BX
              "Atribuible_Nokia2" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->n_atribuible_nokia2)),//BY
              "Kpis_Degraded" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_kpis_degraded)),//BZ
              "Id_Notificacion" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->id_notificacion)),//CA
              "Id_Documentacion" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->id_documentacion)),//CB
              "ID_RFTools" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->k_id_preparation->id_rftools)),//CC
              "Tipificacion_Solucion" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->n_tipificacion_solucion)),//CD
              "KPI1" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_kpi1)),//CE
              "Valor_KPI1" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_valor_kpi1)),//CF
              "KPI2" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_kpi2)),//CG
              "Valor_KPI2" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_valor_kpi2)),//CH
              "KPI3" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_kpi3)),//CI
              "Valor_KPI3" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_valor_kpi3)),//CJ
              "KPI4" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_kpi4)),//CK
              "Valor_KPI4" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_valor_kpi4)),//CL
              "Alarma1" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_alarma1)),//CM
              "Alarma2" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_alarma2)),//CN
              "Alarma3" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_alarma3)),//CO
              "Alarma4" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_alarma4)),//CP
              "Cont_Total_Escalamiento" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_cont_total_escalamiento)),//CQ
              "Time_Total_Escalamiento" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_time_total_escalamiento)),//CR
              "OLA" => utf8_decode( str_replace(array("\n", "\r"), '', " ")),//CS
              "OLA_Excedido" => utf8_decode( str_replace(array("\n", "\r"), '', " ")),//CT
              "Detalle_Solucion" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->n_detalle_solucion)),//CU
              "Lider_Cambio" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_lider_cambio)),//CV
              "Lider_Cuadrilla" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->i_lider_cuadrilla)),//CW
              "OLA_Areas" => utf8_decode( str_replace(array("\n", "\r"), '', "")),//CX
              "OLA_Areas_Excedido" => utf8_decode( str_replace(array("\n", "\r"), '', "")),//CY
              "Ultimo Subestado De Escalamiento" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->scaled_onair->n_ultimo_subestado_de_escalamiento)),//CZ
              "Fin_24H" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->onair24->d_fin24h)),//DA
              "Fin_36H" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->onair36->d_fin36h)),//DB
              "Implementacion_Campo" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_implementacion_campo)),//DC
              "Implementacion_Remota" => utf8_decode( str_replace(array("\n", "\r"), '', " ")),//DD
              "Gestion_Power" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_gestion_power)),//DE
              "Obra_Civil" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_obra_civil)),//DF
              "On_AIR" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->on_air)),//DG
              "Fecha_RFT" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->fecha_rft)),//DH
              "Fecha_CG" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->d_fecha_cg)),//DI
              "Exclusion_Bajo_Trafico" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_exclusion_bajo_trafico)),//DJ
              "Ticket" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_ticket)),//DK
              "Estado_Ticket" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_estado_ticket)),//DL
              "SLN_Modernizacion" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_sln_modernizacion)),//DM
              "En_Prorroga" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_en_prorroga)),//DN
              "Cont_Prorrogas" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_cont_prorrogas)),//DO
              "NOC" => utf8_decode( str_replace(array("\n", "\r"), '', $res[$f]->n_noc)),//DP
             ];
         }
         $flag = false;
         foreach($data as $row) {
           if(!$flag) {
             // display field/column names as first row
             echo implode("\t", array_keys($row)) . "\r\n";
             $flag = true;
           }
           echo implode("\t", array_values($row)) . "\r\n";
         }
         exit;





/*
        $objPhpExcel = new PHPExcel();
        //Propiedades de archivo.
        $objPhpExcel->getProperties()->setCreator("ZTE");
        $objPhpExcel->getProperties()->setLastModifiedBy("ZTE");
        $objPhpExcel->getProperties()->setTitle("Reporte ONAIR");
        $objPhpExcel->getProperties()->setSubject("Reporte ONAIR - Zolid");
        $objPhpExcel->getProperties()->setDescription("Reporte ONAIR - Zolid");
        //Seleccionamos la página.
        $objPhpExcel->setActiveSheetIndex(0);
        //Aplicamos estilos a las celdas.
        $objPhpExcel->getActiveSheet()->getStyle('A1:DP1')->applyFromArray(
                array(
                    'font' => array(
                        'bold' => true
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '85c2ff')
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    )
        ));



        //Escribir cabecearas.
        $objPhpExcel->getActiveSheet()->setCellValue("A1", "Id-On Air");
        $objPhpExcel->getActiveSheet()->setCellValue("B1", "Nombre_Estación-EB");
        $objPhpExcel->getActiveSheet()->setCellValue("C1", "bcf_wbts_id");
        $objPhpExcel->getActiveSheet()->setCellValue("D1", "BTS_ID");
        $objPhpExcel->getActiveSheet()->setCellValue("E1", "Tecnologia");
        $objPhpExcel->getActiveSheet()->setCellValue("F1", "Banda");
        $objPhpExcel->getActiveSheet()->setCellValue("G1", "Estado");
        $objPhpExcel->getActiveSheet()->setCellValue("H1", "Subestado");
        $objPhpExcel->getActiveSheet()->setCellValue("I1", "excepcion GRI");
        $objPhpExcel->getActiveSheet()->setCellValue("J1", "Fecha ingreso On Air");
        $objPhpExcel->getActiveSheet()->setCellValue("K1", "Fechaultimarev");
        $objPhpExcel->getActiveSheet()->setCellValue("L1", "tipo De trabajo");
        $objPhpExcel->getActiveSheet()->setCellValue("M1", "vistamm");
        $objPhpExcel->getActiveSheet()->setCellValue("N1", "enteejecutor");
        $objPhpExcel->getActiveSheet()->setCellValue("O1", "controlador");
        $objPhpExcel->getActiveSheet()->setCellValue("P1", "idcontrolador");
        $objPhpExcel->getActiveSheet()->setCellValue("Q1", "Ciudad");
        $objPhpExcel->getActiveSheet()->setCellValue("R1", "Regional");
        $objPhpExcel->getActiveSheet()->setCellValue("S1", "desbloqueo");
        $objPhpExcel->getActiveSheet()->setCellValue("T1", "bloqueado");
        $objPhpExcel->getActiveSheet()->setCellValue("U1", "reviewedfo");
        $objPhpExcel->getActiveSheet()->setCellValue("V1", "correccionpendientes");
        $objPhpExcel->getActiveSheet()->setCellValue("W1", "btsipaddress");
        $objPhpExcel->getActiveSheet()->setCellValue("X1", "integrador");
        $objPhpExcel->getActiveSheet()->setCellValue("Y1", "ingenieroprecheck");
        $objPhpExcel->getActiveSheet()->setCellValue("Z1", "ingenierofinal12horas");
        $objPhpExcel->getActiveSheet()->setCellValue("AA1", "ingenierogarantia");
        $objPhpExcel->getActiveSheet()->setCellValue("AB1", "WP");
        $objPhpExcel->getActiveSheet()->setCellValue("AC1", "CRQ");
        $objPhpExcel->getActiveSheet()->setCellValue("AD1", "testgestion");
        $objPhpExcel->getActiveSheet()->setCellValue("AE1", "sitiolimpio");
        $objPhpExcel->getActiveSheet()->setCellValue("AF1", "fechaproduccion");
        $objPhpExcel->getActiveSheet()->setCellValue("AG1", "Instalacion_HW_Sitio");
        $objPhpExcel->getActiveSheet()->setCellValue("AH1", "Cambios_Config_Solicitados");
        $objPhpExcel->getActiveSheet()->setCellValue("AI1", "Cambios_Config_Final");
        $objPhpExcel->getActiveSheet()->setCellValue("AJ1", "sectoresbloqueados");
        $objPhpExcel->getActiveSheet()->setCellValue("AK1", "sectoresdesbloqueados");
        $objPhpExcel->getActiveSheet()->setCellValue("AL1", "estadoonair");
        $objPhpExcel->getActiveSheet()->setCellValue("AM1", "Atribuible_Nokia");
        $objPhpExcel->getActiveSheet()->setCellValue("AN1", "contratista");
        $objPhpExcel->getActiveSheet()->setCellValue("AO1", "comentarioccial");
        $objPhpExcel->getActiveSheet()->setCellValue("AP1", "ticketremedy");
        $objPhpExcel->getActiveSheet()->setCellValue("AQ1", "FinPre");
        $objPhpExcel->getActiveSheet()->setCellValue("AR1", "Fin12H");
        $objPhpExcel->getActiveSheet()->setCellValue("AS1", "Fin48H");
        $objPhpExcel->getActiveSheet()->setCellValue("AT1", "LAC");
        $objPhpExcel->getActiveSheet()->setCellValue("AU1", "RAC");
        $objPhpExcel->getActiveSheet()->setCellValue("AV1", "SAC");
        $objPhpExcel->getActiveSheet()->setCellValue("AW1", "Integracion_Gestion_y_Trafica");
        $objPhpExcel->getActiveSheet()->setCellValue("AX1", "Puesta_Servicio_Sitio_Nuevo_LTE");
        $objPhpExcel->getActiveSheet()->setCellValue("AY1", "Instalacion_HW_4G_Sitio");
        $objPhpExcel->getActiveSheet()->setCellValue("AZ1", "Prelaunch");
        $objPhpExcel->getActiveSheet()->setCellValue("BA1", "Actualizacion_Final");
        $objPhpExcel->getActiveSheet()->setCellValue("BB1", "Asignacion_Final");
        $objPhpExcel->getActiveSheet()->setCellValue("BC1", "identificador");
        $objPhpExcel->getActiveSheet()->setCellValue("BD1", "EvidenciaSL");
        $objPhpExcel->getActiveSheet()->setCellValue("BE1", "EvidenciaTG");
        $objPhpExcel->getActiveSheet()->setCellValue("BF1", "Time_Escalado");
        $objPhpExcel->getActiveSheet()->setCellValue("BG1", "Fecha_Escalado");
        $objPhpExcel->getActiveSheet()->setCellValue("BH1", "Cont_Esc_Imp");
        $objPhpExcel->getActiveSheet()->setCellValue("BI1", "Time_Esc_Imp");
        $objPhpExcel->getActiveSheet()->setCellValue("BJ1", "Cont_Esc_RF");
        $objPhpExcel->getActiveSheet()->setCellValue("BK1", "Time_Esc_RF");
        $objPhpExcel->getActiveSheet()->setCellValue("BL1", "Cont_Esc_NPO");
        $objPhpExcel->getActiveSheet()->setCellValue("BM1", "Time_Esc_NPO");
        $objPhpExcel->getActiveSheet()->setCellValue("BN1", "Cont_Esc_Care");
        $objPhpExcel->getActiveSheet()->setCellValue("BO1", "Time_Esc_Care");
        $objPhpExcel->getActiveSheet()->setCellValue("BP1", "Cont_Esc_GDRT");
        $objPhpExcel->getActiveSheet()->setCellValue("BQ1", "Time_Esc_GDRT");
        $objPhpExcel->getActiveSheet()->setCellValue("BR1", "Cont_Esc_OyM");
        $objPhpExcel->getActiveSheet()->setCellValue("BS1", "Time_Esc_OyM");
        $objPhpExcel->getActiveSheet()->setCellValue("BT1", "Cont_Esc_Calidad");
        $objPhpExcel->getActiveSheet()->setCellValue("BU1", "Time_Esc_Calidad");
        $objPhpExcel->getActiveSheet()->setCellValue("BV1", "WEEK");
        $objPhpExcel->getActiveSheet()->setCellValue("BW1", "T_From_Notif");
        $objPhpExcel->getActiveSheet()->setCellValue("BX1", "T_From_Asign");
        $objPhpExcel->getActiveSheet()->setCellValue("BY1", "Atribuible_Nokia2");
        $objPhpExcel->getActiveSheet()->setCellValue("BZ1", "Kpis_Degraded");
        $objPhpExcel->getActiveSheet()->setCellValue("CA1", "Id_Notificacion");
        $objPhpExcel->getActiveSheet()->setCellValue("CB1", "Id_Documentacion");
        $objPhpExcel->getActiveSheet()->setCellValue("CC1", "ID_RFTools");
        $objPhpExcel->getActiveSheet()->setCellValue("CD1", "Tipificacion_Solucion");
        $objPhpExcel->getActiveSheet()->setCellValue("CE1", "KPI1");
        $objPhpExcel->getActiveSheet()->setCellValue("CF1", "Valor_KPI1");
        $objPhpExcel->getActiveSheet()->setCellValue("CG1", "KPI2");
        $objPhpExcel->getActiveSheet()->setCellValue("CH1", "Valor_KPI2");
        $objPhpExcel->getActiveSheet()->setCellValue("CI1", "KPI3");
        $objPhpExcel->getActiveSheet()->setCellValue("CJ1", "Valor_KPI3");
        $objPhpExcel->getActiveSheet()->setCellValue("CK1", "KPI4");
        $objPhpExcel->getActiveSheet()->setCellValue("CL1", "Valor_KPI4");
        $objPhpExcel->getActiveSheet()->setCellValue("CM1", "Alarma1");
        $objPhpExcel->getActiveSheet()->setCellValue("CN1", "Alarma2");
        $objPhpExcel->getActiveSheet()->setCellValue("CO1", "Alarma3");
        $objPhpExcel->getActiveSheet()->setCellValue("CP1", "Alarma4");
        $objPhpExcel->getActiveSheet()->setCellValue("CQ1", "Cont_Total_Escalamiento");
        $objPhpExcel->getActiveSheet()->setCellValue("CR1", "Time_Total_Escalamiento");
        $objPhpExcel->getActiveSheet()->setCellValue("CS1", "OLA");
        $objPhpExcel->getActiveSheet()->setCellValue("CT1", "OLA_Excedido");
        $objPhpExcel->getActiveSheet()->setCellValue("CU1", "Detalle_Solucion");
        $objPhpExcel->getActiveSheet()->setCellValue("CV1", "Lider_Cambio");
        $objPhpExcel->getActiveSheet()->setCellValue("CW1", "Lider_Cuadrilla");
        $objPhpExcel->getActiveSheet()->setCellValue("CX1", "OLA_Areas");
        $objPhpExcel->getActiveSheet()->setCellValue("CY1", "OLA_Areas_Excedido");
        $objPhpExcel->getActiveSheet()->setCellValue("CZ1", "Ultimo Subestado De Escalamiento");
        $objPhpExcel->getActiveSheet()->setCellValue("DA1", "Fin_24H");
        $objPhpExcel->getActiveSheet()->setCellValue("DB1", "Fin_36H");
        $objPhpExcel->getActiveSheet()->setCellValue("DC1", "Implementacion_Campo");
        $objPhpExcel->getActiveSheet()->setCellValue("DD1", "Implementacion_Remota");
        $objPhpExcel->getActiveSheet()->setCellValue("DE1", "Gestion_Power");
        $objPhpExcel->getActiveSheet()->setCellValue("DF1", "Obra_Civil");
        $objPhpExcel->getActiveSheet()->setCellValue("DG1", "On_AIR");
        $objPhpExcel->getActiveSheet()->setCellValue("DH1", "Fecha_RFT");
        $objPhpExcel->getActiveSheet()->setCellValue("DI1", "Fecha_CG");
        $objPhpExcel->getActiveSheet()->setCellValue("DJ1", "Exclusion_Bajo_Trafico");
        $objPhpExcel->getActiveSheet()->setCellValue("DK1", "Ticket");
        $objPhpExcel->getActiveSheet()->setCellValue("DL1", "Estado_Ticket");
        $objPhpExcel->getActiveSheet()->setCellValue("DM1", "SLN_Modernizacion");
        $objPhpExcel->getActiveSheet()->setCellValue("DN1", "En_Prorroga");
        $objPhpExcel->getActiveSheet()->setCellValue("DO1", "Cont_Prorrogas");
        $objPhpExcel->getActiveSheet()->setCellValue("DP1", "NOC");

        //Aplicamos las dimenciones a las celdas...
        $objPhpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPhpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
        $objPhpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
        $objPhpExcel->getActiveSheet()->getColumnDimension('S')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('T')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('V')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('X')->setWidth(45);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(45);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(45);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(45);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(25);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(12);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(12);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(15);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(80);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(25);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CF')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CG')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CH')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CI')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CJ')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CK')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CL')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CM')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CN')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CO')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CP')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CQ')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CR')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CS')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CT')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CU')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CV')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CW')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CX')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CY')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('CZ')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DA')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DB')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DC')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DD')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DE')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DF')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DG')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DH')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DI')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DJ')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DK')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DL')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DM')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DN')->setWidth(22);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DO')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DP')->setWidth(15);





        //Ahora pintamos los datos...
        for ($r = 0; $r < count($res); $r++) {
                $objPhpExcel->getActiveSheet()->setCellValue("A" . ($r + 2), $res[$r]->k_id_onair);
                $objPhpExcel->getActiveSheet()->setCellValue("I" . ($r + 2), $res[$r]->b_excpetion_gri);
                $objPhpExcel->getActiveSheet()->setCellValue("K" . ($r + 2), $res[$r]->d_fecha_ultima_rev);
                $objPhpExcel->getActiveSheet()->setCellValue("S" . ($r + 2), $res[$r]->d_desbloqueo);
                $objPhpExcel->getActiveSheet()->setCellValue("T" . ($r + 2), $res[$r]->d_bloqueo);
                $objPhpExcel->getActiveSheet()->setCellValue("U" . ($r + 2), $res[$r]->n_reviewedfo);
                $objPhpExcel->getActiveSheet()->setCellValue("AJ" . ($r + 2), $res[$r]->n_sectoresbloqueados);
                $objPhpExcel->getActiveSheet()->setCellValue("AK" . ($r + 2), $res[$r]->n_sectoresdesbloqueados);
                $objPhpExcel->getActiveSheet()->setCellValue("AL" . ($r + 2), $res[$r]->n_estadoonair);
                $objPhpExcel->getActiveSheet()->setCellValue("AS" . ($r + 2), " ");//fin48
                $objPhpExcel->getActiveSheet()->setCellValue("BA" . ($r + 2), $res[$r]->d_actualizacion_final);
                $objPhpExcel->getActiveSheet()->setCellValue("BB" . ($r + 2), $res[$r]->d_asignacion_final);
                $objPhpExcel->getActiveSheet()->setCellValue("BC" . ($r + 2), " ");//identificador
                $objPhpExcel->getActiveSheet()->setCellValue("BW" . ($r + 2), " ");//t_from_notif
                $objPhpExcel->getActiveSheet()->setCellValue("BX" . ($r + 2), " ");//t_from_asign
                $objPhpExcel->getActiveSheet()->setCellValue("BZ" . ($r + 2), $res[$r]->n_kpis_degraded);
                $objPhpExcel->getActiveSheet()->setCellValue("CE" . ($r + 2), $res[$r]->n_kpi1);
                $objPhpExcel->getActiveSheet()->setCellValue("CF" . ($r + 2), $res[$r]->i_valor_kpi1);
                $objPhpExcel->getActiveSheet()->setCellValue("CG" . ($r + 2), $res[$r]->n_kpi2);
                $objPhpExcel->getActiveSheet()->setCellValue("CH" . ($r + 2), $res[$r]->i_valor_kpi2);
                $objPhpExcel->getActiveSheet()->setCellValue("CI" . ($r + 2), $res[$r]->n_kpi3);
                $objPhpExcel->getActiveSheet()->setCellValue("CJ" . ($r + 2), $res[$r]->i_valor_kpi3);
                $objPhpExcel->getActiveSheet()->setCellValue("CK" . ($r + 2), $res[$r]->n_kpi4);
                $objPhpExcel->getActiveSheet()->setCellValue("CL" . ($r + 2), $res[$r]->i_valor_kpi4);
                $objPhpExcel->getActiveSheet()->setCellValue("CM" . ($r + 2), $res[$r]->n_alarma1);
                $objPhpExcel->getActiveSheet()->setCellValue("CN" . ($r + 2), $res[$r]->n_alarma2);
                $objPhpExcel->getActiveSheet()->setCellValue("CO" . ($r + 2), $res[$r]->n_alarma3);
                $objPhpExcel->getActiveSheet()->setCellValue("CP" . ($r + 2), $res[$r]->n_alarma4);
                $objPhpExcel->getActiveSheet()->setCellValue("CQ" . ($r + 2), $res[$r]->i_cont_total_escalamiento);
                $objPhpExcel->getActiveSheet()->setCellValue("CR" . ($r + 2), $res[$r]->i_time_total_escalamiento);
                $objPhpExcel->getActiveSheet()->setCellValue("CS" . ($r + 2), " ");//OLA
                $objPhpExcel->getActiveSheet()->setCellValue("CT" . ($r + 2), " ");//OLA extendido
                $objPhpExcel->getActiveSheet()->setCellValue("CV" . ($r + 2), $res[$r]->i_lider_cambio);
                $objPhpExcel->getActiveSheet()->setCellValue("CW" . ($r + 2), $res[$r]->i_lider_cuadrilla);
                $objPhpExcel->getActiveSheet()->setCellValue("CX" . ($r + 2), "");//OLA_Areas
                $objPhpExcel->getActiveSheet()->setCellValue("CY" . ($r + 2), "");//OLA_Areas_Excedido
                $objPhpExcel->getActiveSheet()->setCellValue("DC" . ($r + 2), $res[$r]->n_implementacion_campo);
                $objPhpExcel->getActiveSheet()->setCellValue("DD" . ($r + 2), " ");//implementacion_remota
                $objPhpExcel->getActiveSheet()->setCellValue("DE" . ($r + 2), $res[$r]->n_gestion_power);
                $objPhpExcel->getActiveSheet()->setCellValue("DF" . ($r + 2), $res[$r]->n_obra_civil);
                $objPhpExcel->getActiveSheet()->setCellValue("DG" . ($r + 2), $res[$r]->on_air);
                $objPhpExcel->getActiveSheet()->setCellValue("DH" . ($r + 2), $res[$r]->fecha_rft);
                $objPhpExcel->getActiveSheet()->setCellValue("DI" . ($r + 2), $res[$r]->d_fecha_cg);
                $objPhpExcel->getActiveSheet()->setCellValue("DJ" . ($r + 2), $res[$r]->n_exclusion_bajo_trafico);
                $objPhpExcel->getActiveSheet()->setCellValue("DK" . ($r + 2), $res[$r]->n_ticket);
                $objPhpExcel->getActiveSheet()->setCellValue("DL" . ($r + 2), $res[$r]->n_estado_ticket);
                $objPhpExcel->getActiveSheet()->setCellValue("DM" . ($r + 2), $res[$r]->n_sln_modernizacion);
                $objPhpExcel->getActiveSheet()->setCellValue("DN" . ($r + 2), $res[$r]->n_en_prorroga);
                $objPhpExcel->getActiveSheet()->setCellValue("DO" . ($r + 2), $res[$r]->n_cont_prorrogas);
                $objPhpExcel->getActiveSheet()->setCellValue("DP" . ($r + 2), $res[$r]->n_noc);


            if ($res[$r]->k_id_station) {
                $objPhpExcel->getActiveSheet()->setCellValue("B" . ($r + 2), $res[$r]->k_id_station->n_name_station);
                if ($res[$r]->k_id_station->k_id_city) {
                    $objPhpExcel->getActiveSheet()->setCellValue("Q" . ($r + 2), $res[$r]->k_id_station->k_id_city->n_name_city);
                    if ($res[$r]->k_id_station->k_id_city->k_id_regional) {
                        $objPhpExcel->getActiveSheet()->setCellValue("R" . ($r + 2), $res[$r]->k_id_station->k_id_city->k_id_regional->n_name_regional);
                    }
                }
            }
            if ($res[$r]->k_id_preparation) {
                $objPhpExcel->getActiveSheet()->setCellValue("C" . ($r + 2), $res[$r]->k_id_preparation->n_bcf_wbts_id);
                $objPhpExcel->getActiveSheet()->setCellValue("D" . ($r + 2), $res[$r]->k_id_preparation->n_bts_id);
                $objPhpExcel->getActiveSheet()->setCellValue("J" . ($r + 2), $res[$r]->k_id_preparation->d_ingreso_on_air);
                $objPhpExcel->getActiveSheet()->setCellValue("M" . ($r + 2), $res[$r]->k_id_preparation->b_vistamm);
                $objPhpExcel->getActiveSheet()->setCellValue("N" . ($r + 2), $res[$r]->k_id_preparation->n_enteejecutor);
                $objPhpExcel->getActiveSheet()->setCellValue("O" . ($r + 2), $res[$r]->k_id_preparation->n_controlador);
                $objPhpExcel->getActiveSheet()->setCellValue("P" . ($r + 2), $res[$r]->k_id_preparation->n_idcontrolador);
                $objPhpExcel->getActiveSheet()->setCellValue("V" . ($r + 2), $res[$r]->k_id_preparation->d_correccionespendientes);
                $objPhpExcel->getActiveSheet()->setCellValue("W" . ($r + 2), $res[$r]->k_id_preparation->n_btsipaddress);
                $objPhpExcel->getActiveSheet()->setCellValue("X" . ($r + 2), $res[$r]->k_id_preparation->n_integrador);
                $objPhpExcel->getActiveSheet()->setCellValue("AB" . ($r + 2), $res[$r]->k_id_preparation->n_wp);
                $objPhpExcel->getActiveSheet()->setCellValue("AC" . ($r + 2), $res[$r]->k_id_preparation->n_crq);
                $objPhpExcel->getActiveSheet()->setCellValue("AD" . ($r + 2), $res[$r]->k_id_preparation->n_testgestion);
                $objPhpExcel->getActiveSheet()->setCellValue("AE" . ($r + 2), $res[$r]->k_id_preparation->n_sitiolimpio);
                $objPhpExcel->getActiveSheet()->setCellValue("AF" . ($r + 2), $res[$r]->d_fechaproduccion);
                $objPhpExcel->getActiveSheet()->setCellValue("AG" . ($r + 2), $res[$r]->k_id_preparation->n_instalacion_hw_sitio);
                $objPhpExcel->getActiveSheet()->setCellValue("AH" . ($r + 2), $res[$r]->k_id_preparation->n_cambios_config_solicitados);
                $objPhpExcel->getActiveSheet()->setCellValue("AI" . ($r + 2), $res[$r]->k_id_preparation->n_cambios_config_final);
                $objPhpExcel->getActiveSheet()->setCellValue("AN" . ($r + 2), $res[$r]->k_id_preparation->n_contratista);
                $objPhpExcel->getActiveSheet()->setCellValue("AO" . ($r + 2), $res[$r]->k_id_preparation->n_comentarioccial);
                $objPhpExcel->getActiveSheet()->setCellValue("AP" . ($r + 2), $res[$r]->k_id_preparation->n_ticketremedy);
                $objPhpExcel->getActiveSheet()->setCellValue("AT" . ($r + 2), $res[$r]->k_id_preparation->n_lac);
                $objPhpExcel->getActiveSheet()->setCellValue("AU" . ($r + 2), $res[$r]->k_id_preparation->n_rac);
                $objPhpExcel->getActiveSheet()->setCellValue("AV" . ($r + 2), $res[$r]->k_id_preparation->n_sac);
                $objPhpExcel->getActiveSheet()->setCellValue("AW" . ($r + 2), $res[$r]->k_id_preparation->n_integracion_gestion_y_trafica);
                $objPhpExcel->getActiveSheet()->setCellValue("AX" . ($r + 2), $res[$r]->k_id_preparation->puesta_servicio_sitio_nuevo_lte);
                $objPhpExcel->getActiveSheet()->setCellValue("AY" . ($r + 2), $res[$r]->k_id_preparation->n_instalacion_hw_4g_sitio);
                $objPhpExcel->getActiveSheet()->setCellValue("AZ" . ($r + 2), $res[$r]->k_id_preparation->pre_launch);
                $objPhpExcel->getActiveSheet()->setCellValue("BD" . ($r + 2), $res[$r]->k_id_preparation->n_evidenciasl);
                $objPhpExcel->getActiveSheet()->setCellValue("BE" . ($r + 2), $res[$r]->k_id_preparation->n_evidenciatg);
                $objPhpExcel->getActiveSheet()->setCellValue("BV" . ($r + 2), $res[$r]->k_id_preparation->i_week);
                $objPhpExcel->getActiveSheet()->setCellValue("CA" . ($r + 2), $res[$r]->k_id_preparation->id_notificacion);
                $objPhpExcel->getActiveSheet()->setCellValue("CB" . ($r + 2), $res[$r]->k_id_preparation->id_documentacion);
                $objPhpExcel->getActiveSheet()->setCellValue("CC" . ($r + 2), $res[$r]->k_id_preparation->id_rftools);
            }
            if ($res[$r]->k_id_precheck) {
                $objPhpExcel->getActiveSheet()->setCellValue("AQ" . ($r + 2), $res[$r]->k_id_precheck->d_finpre);
                if ($res[$r]->k_id_precheck->k_id_user) {
                    $objPhpExcel->getActiveSheet()->setCellValue("Y" . ($r + 2), $res[$r]->k_id_precheck->k_id_user->n_name_user." ".$res[$r]->k_id_precheck->k_id_user->n_last_name_user);
                }
            }
            if ($res[$r]->k_id_band) {
                $objPhpExcel->getActiveSheet()->setCellValue("F" . ($r + 2), $res[$r]->k_id_band->n_name_band);
            }
            if ($res[$r]->k_id_technology) {
                $objPhpExcel->getActiveSheet()->setCellValue("E" . ($r + 2), $res[$r]->k_id_technology->n_name_technology);
            }
            if ($res[$r]->k_id_status_onair) {
                if ($res[$r]->k_id_status_onair['k_id_status']) {
                    $objPhpExcel->getActiveSheet()->setCellValue("G" . ($r + 2), $res[$r]->k_id_status_onair['k_id_status']->n_name_status);
                }
                if ($res[$r]->k_id_status_onair['k_id_substatus']) {
                    $objPhpExcel->getActiveSheet()->setCellValue("H" . ($r + 2), $res[$r]->k_id_status_onair['k_id_substatus']->n_name_substatus);
                }
            }
            if ($res[$r]->k_id_work) {
                $objPhpExcel->getActiveSheet()->setCellValue("L" . ($r + 2), $res[$r]->k_id_work->n_name_ork);
            }
            if ($res[$r]->onair12) {
                if ($res[$r]->onair12->k_id_follow_up_12h) {
                    if ($res[$r]->onair12->k_id_follow_up_12h->k_id_user) {
                        $objPhpExcel->getActiveSheet()->setCellValue("Z" . ($r + 2), $res[$r]->onair12->k_id_follow_up_12h->k_id_user->n_name_user." ".$res[$r]->onair12->k_id_follow_up_12h->k_id_user->n_last_name_user);
                    }
                }
                $objPhpExcel->getActiveSheet()->setCellValue("AR" . ($r + 2), $res[$r]->onair12->d_fin12h);
            }
            if ($res[$r]->onair36) {
                if ($res[$r]->onair36->k_id_follow_up_36h) {
                    if ($res[$r]->onair36->k_id_follow_up_36h->k_id_user) {
                        $objPhpExcel->getActiveSheet()->setCellValue("AA" . ($r + 2), $res[$r]->onair36->k_id_follow_up_36h->k_id_user->n_name_user."".$res[$r]->onair36->k_id_follow_up_36h->k_id_user->n_last_name_user);
                    }
                }
                $objPhpExcel->getActiveSheet()->setCellValue("DB" . ($r + 2), $res[$r]->onair36->d_fin36h);
            }
            if ($res[$r]->scaled_onair) {
                $objPhpExcel->getActiveSheet()->setCellValue("AM" . ($r + 2), $res[$r]->scaled_onair->n_atribuible_nokia);
                $objPhpExcel->getActiveSheet()->setCellValue("BF" . ($r + 2), $res[$r]->scaled_onair->d_time_escalado);
                $objPhpExcel->getActiveSheet()->setCellValue("BG" . ($r + 2), $res[$r]->scaled_onair->d_fecha_escalado);
                $objPhpExcel->getActiveSheet()->setCellValue("BH" . ($r + 2), $res[$r]->scaled_onair->i_cont_esc_imp);
                $objPhpExcel->getActiveSheet()->setCellValue("BI" . ($r + 2), $res[$r]->scaled_onair->time_esc_imp);
                $objPhpExcel->getActiveSheet()->setCellValue("BJ" . ($r + 2), $res[$r]->scaled_onair->i_cont_esc_rf);
                $objPhpExcel->getActiveSheet()->setCellValue("BK" . ($r + 2), $res[$r]->scaled_onair->i_time_esc_rf);
                $objPhpExcel->getActiveSheet()->setCellValue("BL" . ($r + 2), $res[$r]->scaled_onair->cont_esc_npo);
                $objPhpExcel->getActiveSheet()->setCellValue("BM" . ($r + 2), $res[$r]->scaled_onair->i_time_esc_npo);
                $objPhpExcel->getActiveSheet()->setCellValue("BN" . ($r + 2), $res[$r]->scaled_onair->cont_esc_care);
                $objPhpExcel->getActiveSheet()->setCellValue("BO" . ($r + 2), $res[$r]->scaled_onair->i_time_esc_care);
                $objPhpExcel->getActiveSheet()->setCellValue("BP" . ($r + 2), $res[$r]->scaled_onair->i_cont_esc_gdrt);
                $objPhpExcel->getActiveSheet()->setCellValue("BQ" . ($r + 2), $res[$r]->scaled_onair->i_time_esc_gdrt);
                $objPhpExcel->getActiveSheet()->setCellValue("BR" . ($r + 2), $res[$r]->scaled_onair->i_cont_esc_oym);
                $objPhpExcel->getActiveSheet()->setCellValue("BS" . ($r + 2), $res[$r]->scaled_onair->time_esc_oym);
                $objPhpExcel->getActiveSheet()->setCellValue("BT" . ($r + 2), $res[$r]->scaled_onair->cont_esc_calidad);
                $objPhpExcel->getActiveSheet()->setCellValue("BU" . ($r + 2), $res[$r]->scaled_onair->i_time_esc_calidad);
                $objPhpExcel->getActiveSheet()->setCellValue("BY" . ($r + 2), $res[$r]->scaled_onair->n_atribuible_nokia2);
                $objPhpExcel->getActiveSheet()->setCellValue("CU" . ($r + 2), $res[$r]->scaled_onair->n_detalle_solucion);
                $objPhpExcel->getActiveSheet()->setCellValue("CZ" . ($r + 2), $res[$r]->scaled_onair->n_ultimo_subestado_de_escalamiento);
                $objPhpExcel->getActiveSheet()->setCellValue("CD" . ($r + 2), $res[$r]->scaled_onair->n_tipificacion_solucion);
            }
            if ($res[$r]->onair24) {
                $objPhpExcel->getActiveSheet()->setCellValue("DA" . ($r + 2), $res[$r]->onair24->d_fin24h);
            }

            $objPhpExcel->getActiveSheet()->getStyle("AO".($r + 2))->getAlignment()->setWrapText(true);
            //$objPhpExcel->getActiveSheet()->getHighestRow();
        }
        //$objPhpExcel->getActiveSheet()->getStyle('AO'.$objPhpExcel->getActiveSheet()->getHighestRow())
        //->getAlignment()->setWrapText(true);
        //Ponemos un nombre a la hoja.
        $objPhpExcel->getActiveSheet()->setTitle('Reporte ONAIR');
        //Hacemos la hoja activa...
        $objPhpExcel->setActiveSheetIndex(0);
        //Guardamos.
        $objWriter = new PHPExcel_Writer_Excel2007($objPhpExcel);
        $filename = 'Reporte ONAIR - (' . date("Y-m-d") . ').xlsx';
        $objWriter->save($filename);
        Redirect::to(URL::to($filename));
*/
    }


}
