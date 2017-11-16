<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('bin/PHPExcel-1.8/Classes/PHPExcel');
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
        $reporte = new Dao_reporte_comentario_model();
        $respuesta = $reporte->getAll()->data;
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
        $objPhpExcel->getActiveSheet()->setCellValue("E1", "Tipo de Trabajo");
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
            $objPhpExcel->getActiveSheet()->setCellValue("G" . ($i + 2), $respuesta[$i]->comentario_resucomen);
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
    }

    public function reportOnair() {
        header('Content-Type: text/plain');
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
            $res[$i]->onair12 = $onair12->getOnair12ByIdOnair($res[$i]->k_id_onair)->data;//onair12
            if ($res[$i]) {
                for ($j=0; $j <count($res[$i]) ; $j++) { 
                    //tengo que hacer comparacion ronda mas alta
                }
            }



        }
        print_r($res);

        /*for ($i = 0; $i < count($res); $i++) {
            $data[$i] = [
                "Nombre_Estación-EB" => $res[$i]->k_id_station->n_name_station,
                "bcf_wbts_id" => $res[$i]->k_id_preparation->n_bcf_wbts_id,
                "BTS_ID" => $res[$i]->bts_id,
                "Tecnologia" => $res[$i]->tecnologia,
                "Banda" => $res[$i]->bandas,
                "Estado" => $res[$i]->estado,
                "Subestado" => $res[$i]->subestado,
                "excepcion GRI" => $res[$i]->excepciongri,
                "Fecha ingreso On Air" => $res[$i]->fechanotificacion,
                "Fechaultimarev" => $res[$i]->onair,
                "tipo DE trabajo" => $res[$i]->tipotrabajo,
                "vistamm" => $res[$i]->fechaproduccion,
                "enteejecutor" => $res[$i]->sectoresbloqueados,
                "controlador" => $res[$i]->sectoresdesbloqueados,
                "idcontrolador" => $res[$i]->sectoresdesbloqueados,
                "Ciudad" => $res[$i]->sectoresdesbloqueados,
                "Regional" => $res[$i]->sectoresdesbloqueados,
                "desbloqueo" => $res[$i]->sectoresdesbloqueados,
                "bloqueado" => $res[$i]->sectoresdesbloqueados,
                "reviewedfo" => $res[$i]->sectoresdesbloqueados,
                "correccionpendientes" => $res[$i]->sectoresdesbloqueados,
                "btsipaddress" => $res[$i]->sectoresdesbloqueados,
                "integrador" => $res[$i]->sectoresdesbloqueados,
                "ingenieroprecheck" => $res[$i]->sectoresdesbloqueados,
                "ingenierofinal12horas" => $res[$i]->sectoresdesbloqueados,
                "ingenierogarantia" => $res[$i]->sectoresdesbloqueados,
                "WP" => $res[$i]->sectoresdesbloqueados,
                "CRQ" => $res[$i]->sectoresdesbloqueados,
                "testgestion" => $res[$i]->sectoresdesbloqueados,
                "sitiolimpio" => $res[$i]->sectoresdesbloqueados,
                "fechaproduccion" => $res[$i]->sectoresdesbloqueados,
                "Instalacion_HW_Sitio" => $res[$i]->sectoresdesbloqueados,
                "Cambios_Config_Solicitados" => $res[$i]->sectoresdesbloqueados,
                "Cambios_Config_Final" => $res[$i]->sectoresdesbloqueados,
                "sectoresbloqueados" => $res[$i]->sectoresdesbloqueados,
                "sectoresdesbloqueados" => $res[$i]->sectoresdesbloqueados,
                "estadoonair" => $res[$i]->sectoresdesbloqueados,
                "Atribuible_Nokia" => $res[$i]->sectoresdesbloqueados,
                "contratista" => $res[$i]->sectoresdesbloqueados,
                "comentarioccial" => $res[$i]->sectoresdesbloqueados,
                "ticketremedy" => $res[$i]->sectoresdesbloqueados,
                "FinPre" => $res[$i]->sectoresdesbloqueados,
                "Fin12H" => $res[$i]->sectoresdesbloqueados,
                "Fin48H" => $res[$i]->sectoresdesbloqueados,
                "LAC" => $res[$i]->sectoresdesbloqueados,
                "RAC" => $res[$i]->sectoresdesbloqueados,
                "SAC" => $res[$i]->sectoresdesbloqueados,
                "Integracion_Gestion_y_Trafica" => $res[$i]->sectoresdesbloqueados,
                "Puesta_Servicio_Sitio_Nuevo_LTE" => $res[$i]->sectoresdesbloqueados,
                "Instalacion_HW_4G_Sitio" => $res[$i]->sectoresdesbloqueados,
                "Prelaunch" => $res[$i]->sectoresdesbloqueados,
                "Actualizacion_Final" => $res[$i]->sectoresdesbloqueados,
                "Asignacion_Final" => $res[$i]->sectoresdesbloqueados,
                "identificador" => $res[$i]->sectoresdesbloqueados,
                "EvidenciaSL" => $res[$i]->sectoresdesbloqueados,
                "EvidenciaTG" => $res[$i]->sectoresdesbloqueados,
                "Time_Escalado" => $res[$i]->sectoresdesbloqueados,
                "Fecha_Escalado" => $res[$i]->sectoresdesbloqueados,
                "Cont_Esc_Imp" => $res[$i]->sectoresdesbloqueados,
                "Time_Esc_Imp" => $res[$i]->sectoresdesbloqueados,
                "Cont_Esc_RF" => $res[$i]->sectoresdesbloqueados,
                "Time_Esc_RF" => $res[$i]->sectoresdesbloqueados,
                "Cont_Esc_NPO" => $res[$i]->sectoresdesbloqueados,
                "Time_Esc_NPO" => $res[$i]->sectoresdesbloqueados,
                "Cont_Esc_Care" => $res[$i]->sectoresdesbloqueados,
                "Time_Esc_Care" => $res[$i]->sectoresdesbloqueados,
                "Cont_Esc_GDRT" => $res[$i]->sectoresdesbloqueados,
                "Time_Esc_GDRT" => $res[$i]->sectoresdesbloqueados,
                "Cont_Esc_OyM" => $res[$i]->sectoresdesbloqueados,
                "Time_Esc_OyM" => $res[$i]->sectoresdesbloqueados,
                "Cont_Esc_Calidad" => $res[$i]->sectoresdesbloqueados,
                "Time_Esc_Calidad" => $res[$i]->sectoresdesbloqueados,
                "WEEK" => $res[$i]->sectoresdesbloqueados,
                "T_From_Notif" => $res[$i]->sectoresdesbloqueados,
                "T_From_Asign" => $res[$i]->sectoresdesbloqueados,
                "Atribuible_Nokia2" => $res[$i]->sectoresdesbloqueados,
                "Kpis_Degraded" => $res[$i]->sectoresdesbloqueados,
                "Id_Notificacion" => $res[$i]->sectoresdesbloqueados,
                "Id_Documentacion" => $res[$i]->sectoresdesbloqueados,
                "ID_RFTools" => $res[$i]->sectoresdesbloqueados,
                "Tipificacion_Solucion" => $res[$i]->sectoresdesbloqueados,
                "KPI1" => $res[$i]->sectoresdesbloqueados,
                "Valor_KPI1" => $res[$i]->sectoresdesbloqueados,
                "KPI2" => $res[$i]->sectoresdesbloqueados,
                "Valor_KPI2" => $res[$i]->sectoresdesbloqueados,
                "KPI3" => $res[$i]->sectoresdesbloqueados,
                "Valor_KPI3" => $res[$i]->sectoresdesbloqueados,
                "KPI4" => $res[$i]->sectoresdesbloqueados,
                "Valor_KPI4" => $res[$i]->sectoresdesbloqueados,
                "Alarma1" => $res[$i]->sectoresdesbloqueados,
                "Alarma2" => $res[$i]->sectoresdesbloqueados,
                "Alarma3" => $res[$i]->sectoresdesbloqueados,
                "Alarma4" => $res[$i]->sectoresdesbloqueados,
                "Cont_Total_Escalamiento" => $res[$i]->sectoresdesbloqueados,
                "Time_Total_Escalamiento" => $res[$i]->sectoresdesbloqueados,
                "OLA" => $res[$i]->sectoresdesbloqueados,
                "OLA_Excedido" => $res[$i]->sectoresdesbloqueados,
                "Detalle_Solucion" => $res[$i]->sectoresdesbloqueados,
                "Lider_Cambio" => $res[$i]->sectoresdesbloqueados,
                "Lider_Cuadrilla" => $res[$i]->sectoresdesbloqueados,
                "OLA_Areas" => $res[$i]->sectoresdesbloqueados,
                "OLA_Areas_Excedido" => $res[$i]->sectoresdesbloqueados,
                "Ultimo Subestado De Escalamiento" => $res[$i]->sectoresdesbloqueados,
                "Fin_24H" => $res[$i]->sectoresdesbloqueados,
                "Fin_36H" => $res[$i]->sectoresdesbloqueados,
                "Implementacion_Campo" => $res[$i]->sectoresdesbloqueados,
                "Implementacion_Remota" => $res[$i]->sectoresdesbloqueados,
                "Gestion_Power" => $res[$i]->sectoresdesbloqueados,
                "Obra_Civil" => $res[$i]->sectoresdesbloqueados,
                "On_AIR" => $res[$i]->sectoresdesbloqueados,
                "Fecha_RFT" => $res[$i]->sectoresdesbloqueados,
                "Fecha_CG" => $res[$i]->sectoresdesbloqueados,
                "Exclusion_Bajo_Trafico" => $res[$i]->sectoresdesbloqueados,
                "Ticket" => $res[$i]->sectoresdesbloqueados,
                "Estado_Ticket" => $res[$i]->sectoresdesbloqueados,
                "SLN_Modernizacion" => $res[$i]->sectoresdesbloqueados,
                "En_Prorroga" => $res[$i]->sectoresdesbloqueados,
                "Cont_Prorrogas" => $res[$i]->sectoresdesbloqueados,
                "NOC" => $res[$i]->sectoresdesbloqueados,
            ];
        }*/
    }

}
