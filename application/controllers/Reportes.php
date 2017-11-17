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
                print_r(Max($ElementoMax12));
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
                print_r(Max($ElementoMax24));
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
                print_r(Max($ElementoMax36));
            $res[$i]->onair36 =  $onair36->getOnair36ByIdOnairAndRound($res[$i]->k_id_onair,Max($ElementoMax36))->data;
            $res[$i]->onair36->k_id_follow_up_36h = $follow36->getfollow36ByIdFollow($res[$i]->onair36->k_id_follow_up_36h)->data;//follow36
            $res[$i]->onair36->k_id_follow_up_36h->k_id_user = $user->findBySingleId($res[$i]->onair36->k_id_follow_up_36h->k_id_user)->data;//user36
            }
            //fin obj onair24 
        }
        print_r($res);

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
            $objPhpExcel->getActiveSheet()->setCellValue("A" . ($i + 2), $res[$i]->$res[$i]->k_id_onair);
            $objPhpExcel->getActiveSheet()->setCellValue("B" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("C" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("D" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("E" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("F" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("G" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("H" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("I" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("J" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("K" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("L" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("M" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("N" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("O" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("P" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("Q" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("R" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("S" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("T" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("U" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("V" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("W" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("X" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("Y" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("Z" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AA" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AB" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AC" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AD" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AE" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AF" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AG" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AH" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AI" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AJ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AK" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AL" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AM" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AN" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AO" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AP" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AQ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AR" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AS" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AT" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AU" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AV" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AW" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AX" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AY" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("AZ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BA" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BB" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BC" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BD" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BE" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BF" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BG" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BH" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BI" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BJ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BK" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BL" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BM" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BN" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BO" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BP" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BQ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BR" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BS" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BT" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BU" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BV" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BW" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BX" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("BY" . ($i + 2), $res[$i]->); 
            $objPhpExcel->getActiveSheet()->setCellValue("BZ" . ($i + 2), $res[$i]->); 
            $objPhpExcel->getActiveSheet()->setCellValue("CA" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CB" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CC" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CD" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CE" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CF" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CG" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CH" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CI" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CJ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CK" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CL" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CM" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CN" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CO" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CP" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CQ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CR" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CS" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CT" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CU" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CV" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CW" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CX" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CY" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("CZ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DA" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DB" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DC" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DD" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DE" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DF" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DG" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DH" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DI" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DJ" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DK" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DL" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DM" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DN" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DO" . ($i + 2), $res[$i]->);
            $objPhpExcel->getActiveSheet()->setCellValue("DP" . ($i + 2), $res[$i]->);
            
            
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

        
        for ($i = 0; $i < count($res); $i++) {
            $data[$i] = [
                "" => $res[$i]->k_id_station->n_name_station,
                "bcf_wbts_id" => $res[$i]->k_id_preparation->n_bcf_wbts_id,
                "BTS_ID" => $res[$i]->bts_id,
                "Tecnologia" => $res[$i]->tecnologia,
                "Banda" => $res[$i]->bandas,
                "Estado" => $res[$i]->estado,
                "Subestado" => $res[$i]->subestado,
                "excepcion GRI" => $res[$i]->excepciongri,
                "Fecha ingreso On Air" => $res[$i]->fechanotificacion,
                "Fechaultimarev" => $res[$i]->onair,
                "" => $res[$i]->tipotrabajo,
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
        }
    }

}
