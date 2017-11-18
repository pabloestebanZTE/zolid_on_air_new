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
    }

    public function reportOnair() {
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
        $objPhpExcel->getActiveSheet()->getStyle('A1:DO')->applyFromArray(
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
        $objPhpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('S')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('V')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DA')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DB')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DC')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DD')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DE')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DF')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DG')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DH')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DI')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DJ')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DK')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DL')->setWidth(40);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DM')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DN')->setWidth(20);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DO')->setWidth(30);
        $objPhpExcel->getActiveSheet()->getColumnDimension('DP')->setWidth(30);
           

        //Ahora pintamos los datos...
        for ($i = 0; $i < count($res); $i++) {
            $objPhpExcel->getActiveSheet()->setCellValue("A" . ($i + 2), $res[$i]->k_id_onair);
            $objPhpExcel->getActiveSheet()->setCellValue("B" . ($i + 2), $res[$i]->k_id_station->n_name_station);
            $objPhpExcel->getActiveSheet()->setCellValue("C" . ($i + 2), $res[$i]->k_id_preparation->n_bcf_wbts_id);
            $objPhpExcel->getActiveSheet()->setCellValue("D" . ($i + 2), $res[$i]->k_id_preparation->n_bts_id);
            $objPhpExcel->getActiveSheet()->setCellValue("E" . ($i + 2), $res[$i]->k_id_technology->n_name_technology);
            $objPhpExcel->getActiveSheet()->setCellValue("F" . ($i + 2), $res[$i]->k_id_band->n_name_band);
            $objPhpExcel->getActiveSheet()->setCellValue("G" . ($i + 2), $res[$i]->k_id_status_onair->k_id_status->n_name_status);
            $objPhpExcel->getActiveSheet()->setCellValue("H" . ($i + 2), $res[$i]->k_id_status_onair->k_id_substatus->n_name_substatus);
            $objPhpExcel->getActiveSheet()->setCellValue("I" . ($i + 2), $res[$i]->b_excpetion_gri);
            $objPhpExcel->getActiveSheet()->setCellValue("J" . ($i + 2), $res[$i]->k_id_preparation->d_ingreso_on_air);
            $objPhpExcel->getActiveSheet()->setCellValue("K" . ($i + 2), $res[$i]->d_fecha_ultima_rev);
            $objPhpExcel->getActiveSheet()->setCellValue("L" . ($i + 2), $res[$i]->k_id_work->n_name_ork);
            $objPhpExcel->getActiveSheet()->setCellValue("M" . ($i + 2), $res[$i]->k_id_preparation->b_vistamm);
            $objPhpExcel->getActiveSheet()->setCellValue("N" . ($i + 2), $res[$i]->k_id_preparation->n_enteejecutor);
            $objPhpExcel->getActiveSheet()->setCellValue("O" . ($i + 2), $res[$i]->k_id_preparation->n_controlador);
            $objPhpExcel->getActiveSheet()->setCellValue("P" . ($i + 2), $res[$i]->k_id_preparation->n_idcontrolador);
            $objPhpExcel->getActiveSheet()->setCellValue("Q" . ($i + 2), $res[$i]->k_id_station->k_id_city->n_name_city);
            $objPhpExcel->getActiveSheet()->setCellValue("R" . ($i + 2), $res[$i]->k_id_station->k_id_city->k_id_regional->n_name_regional);
            $objPhpExcel->getActiveSheet()->setCellValue("S" . ($i + 2), $res[$i]->d_desbloqueo);
            $objPhpExcel->getActiveSheet()->setCellValue("T" . ($i + 2), $res[$i]->d_bloqueo);
            $objPhpExcel->getActiveSheet()->setCellValue("U" . ($i + 2), $res[$i]->n_reviewedfo);
            $objPhpExcel->getActiveSheet()->setCellValue("V" . ($i + 2), $res[$i]->k_id_preparation->d_correccionespendientes);
            $objPhpExcel->getActiveSheet()->setCellValue("W" . ($i + 2), $res[$i]->k_id_preparation->n_btsipaddress);
            $objPhpExcel->getActiveSheet()->setCellValue("X" . ($i + 2), $res[$i]->k_id_preparation->n_integrador);
            $objPhpExcel->getActiveSheet()->setCellValue("Y" . ($i + 2), $res[$i]->k_id_precheck->k_id_user->n_name_user);
            $objPhpExcel->getActiveSheet()->setCellValue("Z" . ($i + 2), $res[$i]->onair12->k_id_follow_up_12h->k_id_user->n_name_user);
            $objPhpExcel->getActiveSheet()->setCellValue("AA" . ($i + 2), $res[$i]->onair36->k_id_follow_up_36h->k_id_user->n_name_user);
            $objPhpExcel->getActiveSheet()->setCellValue("AB" . ($i + 2), $res[$i]->k_id_preparation->n_wp);
            $objPhpExcel->getActiveSheet()->setCellValue("AC" . ($i + 2), $res[$i]->k_id_preparation->n_crq);
            $objPhpExcel->getActiveSheet()->setCellValue("AD" . ($i + 2), $res[$i]->k_id_preparation->n_testgestion);
            $objPhpExcel->getActiveSheet()->setCellValue("AE" . ($i + 2), $res[$i]->k_id_preparation->n_sitiolimpio);
            $objPhpExcel->getActiveSheet()->setCellValue("AF" . ($i + 2), $res[$i]->d_fechaproduccion);
            $objPhpExcel->getActiveSheet()->setCellValue("AG" . ($i + 2), $res[$i]->k_id_preparation->n_instalacion_hw_sitio);
            $objPhpExcel->getActiveSheet()->setCellValue("AH" . ($i + 2), $res[$i]->k_id_preparation->n_cambios_config_solicitados);
            $objPhpExcel->getActiveSheet()->setCellValue("AI" . ($i + 2), $res[$i]->k_id_preparation->n_cambios_config_final);
            $objPhpExcel->getActiveSheet()->setCellValue("AJ" . ($i + 2), $res[$i]->n_sectoresbloqueados);
            $objPhpExcel->getActiveSheet()->setCellValue("AK" . ($i + 2), $res[$i]->n_sectoresdesbloqueados);
            $objPhpExcel->getActiveSheet()->setCellValue("AL" . ($i + 2), $res[$i]->n_estadoonair);
            $objPhpExcel->getActiveSheet()->setCellValue("AM" . ($i + 2), $res[$i]->scaled_onair->n_atribuible_nokia);
            $objPhpExcel->getActiveSheet()->setCellValue("AN" . ($i + 2), $res[$i]->k_id_preparation->n_contratista);
            $objPhpExcel->getActiveSheet()->setCellValue("AO" . ($i + 2), $res[$i]->k_id_preparation->n_comentarioccial);
            $objPhpExcel->getActiveSheet()->setCellValue("AP" . ($i + 2), $res[$i]->k_id_preparation->n_ticketremedy);
            $objPhpExcel->getActiveSheet()->setCellValue("AQ" . ($i + 2), $res[$i]->k_id_precheck->d_finpre);
            $objPhpExcel->getActiveSheet()->setCellValue("AR" . ($i + 2), $res[$i]->onair12->d_fin12h);
            $objPhpExcel->getActiveSheet()->setCellValue("AS" . ($i + 2), " ");//fin48
            $objPhpExcel->getActiveSheet()->setCellValue("AT" . ($i + 2), $res[$i]->k_id_preparation->n_lac);
            $objPhpExcel->getActiveSheet()->setCellValue("AU" . ($i + 2), $res[$i]->k_id_preparation->n_rac);
            $objPhpExcel->getActiveSheet()->setCellValue("AV" . ($i + 2), $res[$i]->k_id_preparation->n_sac);
            $objPhpExcel->getActiveSheet()->setCellValue("AW" . ($i + 2), $res[$i]->k_id_preparation->n_integracion_gestion_y_trafica);
            $objPhpExcel->getActiveSheet()->setCellValue("AX" . ($i + 2), $res[$i]->k_id_preparation->puesta_servicio_sitio_nuevo_lte);
            $objPhpExcel->getActiveSheet()->setCellValue("AY" . ($i + 2), $res[$i]->k_id_preparation->n_instalacion_hw_4g_sitio);
            $objPhpExcel->getActiveSheet()->setCellValue("AZ" . ($i + 2), $res[$i]->k_id_preparation->pre_launch);
            $objPhpExcel->getActiveSheet()->setCellValue("BA" . ($i + 2), $res[$i]->d_actualizacion_final);
            $objPhpExcel->getActiveSheet()->setCellValue("BB" . ($i + 2), $res[$i]->d_asignacion_final);
            $objPhpExcel->getActiveSheet()->setCellValue("BC" . ($i + 2), " ");//identificador
            $objPhpExcel->getActiveSheet()->setCellValue("BD" . ($i + 2), $res[$i]->k_id_preparation->n_evidenciasl);
            $objPhpExcel->getActiveSheet()->setCellValue("BE" . ($i + 2), $res[$i]->k_id_preparation->n_evidenciatg);
            $objPhpExcel->getActiveSheet()->setCellValue("BF" . ($i + 2), $res[$i]->scaled_onair->d_time_escalado);
            $objPhpExcel->getActiveSheet()->setCellValue("BG" . ($i + 2), $res[$i]->scaled_onair->d_fecha_escalado);
            $objPhpExcel->getActiveSheet()->setCellValue("BH" . ($i + 2), $res[$i]->scaled_onair->i_cont_esc_imp);
            $objPhpExcel->getActiveSheet()->setCellValue("BI" . ($i + 2), $res[$i]->scaled_onair->time_esc_imp);
            $objPhpExcel->getActiveSheet()->setCellValue("BJ" . ($i + 2), $res[$i]->scaled_onair->i_cont_esc_rf);
            $objPhpExcel->getActiveSheet()->setCellValue("BK" . ($i + 2), $res[$i]->scaled_onair->i_time_esc_rf);
            $objPhpExcel->getActiveSheet()->setCellValue("BL" . ($i + 2), $res[$i]->scaled_onair->cont_esc_npo);
            $objPhpExcel->getActiveSheet()->setCellValue("BM" . ($i + 2), $res[$i]->scaled_onair->i_time_esc_npo);
            $objPhpExcel->getActiveSheet()->setCellValue("BN" . ($i + 2), $res[$i]->scaled_onair->cont_esc_care);
            $objPhpExcel->getActiveSheet()->setCellValue("BO" . ($i + 2), $res[$i]->scaled_onair->i_time_esc_care);
            $objPhpExcel->getActiveSheet()->setCellValue("BP" . ($i + 2), $res[$i]->scaled_onair->i_cont_esc_gdrt);
            $objPhpExcel->getActiveSheet()->setCellValue("BQ" . ($i + 2), $res[$i]->scaled_onair->i_time_esc_gdrt);
            $objPhpExcel->getActiveSheet()->setCellValue("BR" . ($i + 2), $res[$i]->scaled_onair->i_cont_esc_oym);
            $objPhpExcel->getActiveSheet()->setCellValue("BS" . ($i + 2), $res[$i]->scaled_onair->time_esc_oym);
            $objPhpExcel->getActiveSheet()->setCellValue("BT" . ($i + 2), $res[$i]->scaled_onair->cont_esc_calidad);
            $objPhpExcel->getActiveSheet()->setCellValue("BU" . ($i + 2), $res[$i]->scaled_onair->i_time_esc_calidad);
            $objPhpExcel->getActiveSheet()->setCellValue("BV" . ($i + 2), $res[$i]->k_id_preparation->i_week);
            $objPhpExcel->getActiveSheet()->setCellValue("BW" . ($i + 2), " ");//t_from_notif
            $objPhpExcel->getActiveSheet()->setCellValue("BX" . ($i + 2), " ");//t_from_asign
            $objPhpExcel->getActiveSheet()->setCellValue("BY" . ($i + 2), $res[$i]->scaled_onair->n_atribuible_nokia2); 
            $objPhpExcel->getActiveSheet()->setCellValue("BZ" . ($i + 2), $res[$i]->n_kpis_degraded); 
            $objPhpExcel->getActiveSheet()->setCellValue("CA" . ($i + 2), $res[$i]->k_id_preparation->id_notificacion);
            $objPhpExcel->getActiveSheet()->setCellValue("CB" . ($i + 2), $res[$i]->k_id_preparation->id_documentacion);
            $objPhpExcel->getActiveSheet()->setCellValue("CC" . ($i + 2), $res[$i]->k_id_preparation->id_rftools);
            $objPhpExcel->getActiveSheet()->setCellValue("CD" . ($i + 2), $res[$i]->scaled_onair->n_tipificacion_solucion);
            $objPhpExcel->getActiveSheet()->setCellValue("CE" . ($i + 2), $res[$i]->n_kpi1);
            $objPhpExcel->getActiveSheet()->setCellValue("CF" . ($i + 2), $res[$i]->i_valor_kpi1);
            $objPhpExcel->getActiveSheet()->setCellValue("CG" . ($i + 2), $res[$i]->n_kpi2);
            $objPhpExcel->getActiveSheet()->setCellValue("CH" . ($i + 2), $res[$i]->i_valor_kpi2);
            $objPhpExcel->getActiveSheet()->setCellValue("CI" . ($i + 2), $res[$i]->n_kpi3);
            $objPhpExcel->getActiveSheet()->setCellValue("CJ" . ($i + 2), $res[$i]->i_valor_kpi3);
            $objPhpExcel->getActiveSheet()->setCellValue("CK" . ($i + 2), $res[$i]->n_kpi4);
            $objPhpExcel->getActiveSheet()->setCellValue("CL" . ($i + 2), $res[$i]->i_valor_kpi4);
            $objPhpExcel->getActiveSheet()->setCellValue("CM" . ($i + 2), $res[$i]->n_alarma1);
            $objPhpExcel->getActiveSheet()->setCellValue("CN" . ($i + 2), $res[$i]->n_alarma2);
            $objPhpExcel->getActiveSheet()->setCellValue("CO" . ($i + 2), $res[$i]->n_alarma3);
            $objPhpExcel->getActiveSheet()->setCellValue("CP" . ($i + 2), $res[$i]->n_alarma4);
            $objPhpExcel->getActiveSheet()->setCellValue("CQ" . ($i + 2), $res[$i]->i_cont_total_escalamiento);
            $objPhpExcel->getActiveSheet()->setCellValue("CR" . ($i + 2), $res[$i]->i_time_total_escalamiento);
            $objPhpExcel->getActiveSheet()->setCellValue("CS" . ($i + 2), " ");//OLA
            $objPhpExcel->getActiveSheet()->setCellValue("CT" . ($i + 2), " ");//OLA extendido
            $objPhpExcel->getActiveSheet()->setCellValue("CU" . ($i + 2), $res[$i]->scaled_onair->n_detalle_solucion);
            $objPhpExcel->getActiveSheet()->setCellValue("CV" . ($i + 2), $res[$i]->i_lider_cambio);
            $objPhpExcel->getActiveSheet()->setCellValue("CW" . ($i + 2), $res[$i]->i_lider_cuadrilla);
            $objPhpExcel->getActiveSheet()->setCellValue("CX" . ($i + 2), "");//OLA_Areas
            $objPhpExcel->getActiveSheet()->setCellValue("CY" . ($i + 2), "");//OLA_Areas_Excedido
            $objPhpExcel->getActiveSheet()->setCellValue("CZ" . ($i + 2), $res[$i]->scaled_onair->n_ultimo_subestado_de_escalamiento);
            $objPhpExcel->getActiveSheet()->setCellValue("DA" . ($i + 2), $res[$i]->onair24->d_fin24h);
            $objPhpExcel->getActiveSheet()->setCellValue("DB" . ($i + 2), $res[$i]->onair36->d_fin36h);
            $objPhpExcel->getActiveSheet()->setCellValue("DC" . ($i + 2), $res[$i]->n_implementacion_campo);
            $objPhpExcel->getActiveSheet()->setCellValue("DD" . ($i + 2), " ");//implementacion_remota
            $objPhpExcel->getActiveSheet()->setCellValue("DE" . ($i + 2), $res[$i]->n_gestion_power);
            $objPhpExcel->getActiveSheet()->setCellValue("DF" . ($i + 2), $res[$i]->n_obra_civil);
            $objPhpExcel->getActiveSheet()->setCellValue("DG" . ($i + 2), $res[$i]->on_air);
            $objPhpExcel->getActiveSheet()->setCellValue("DH" . ($i + 2), $res[$i]->fecha_rft);
            $objPhpExcel->getActiveSheet()->setCellValue("DI" . ($i + 2), $res[$i]->d_fecha_cg);
            $objPhpExcel->getActiveSheet()->setCellValue("DJ" . ($i + 2), $res[$i]->n_exclusion_bajo_trafico);
            $objPhpExcel->getActiveSheet()->setCellValue("DK" . ($i + 2), $res[$i]->n_ticket);
            $objPhpExcel->getActiveSheet()->setCellValue("DL" . ($i + 2), $res[$i]->n_estado_ticket);
            $objPhpExcel->getActiveSheet()->setCellValue("DM" . ($i + 2), $res[$i]->n_sln_modernizacion);
            $objPhpExcel->getActiveSheet()->setCellValue("DN" . ($i + 2), $res[$i]->n_en_prorroga);
            $objPhpExcel->getActiveSheet()->setCellValue("DO" . ($i + 2), $res[$i]->n_cont_prorrogas);
            $objPhpExcel->getActiveSheet()->setCellValue("DP" . ($i + 2), $res[$i]->n_noc);    
        }
        //Ponemos un nombre a la hoja.
        $objPhpExcel->getActiveSheet()->setTitle('Reporte ONAIR');
        //Hacemos la hoja activa...
        $objPhpExcel->setActiveSheetIndex(0);
        //Guardamos.
        $objWriter = new PHPExcel_Writer_Excel2007($objPhpExcel);
        $filename = 'Reporte ONAIR - (' . date("Y-m-d") . ').xlsx';
        $objWriter->save($filename);
        Redirect::to(URL::to($filename));

    }


}
