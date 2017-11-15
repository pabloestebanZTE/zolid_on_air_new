<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

    function __construct() {
        parent::__construct();
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

    public function reportComments(){
    	$reporte = new Dao_reporte_comentario_model();
    	$filename = "Reporte Comentarios.xls";
       /* header('Content-Type: text/plain');*/
    	header("Content-Disposition: attachment; filename=\"$filename\"");
     	header("Content-Type: application/vnd.ms-excel");

     	$respuesta = $reporte->getAll()->data;
        for ($i=0; $i <count($respuesta) ; $i++) { 
            $data[$i] = ["estacion" =>$respuesta[$i]->estacion, "bcf_wbts_id" => $respuesta[$i]->bcf_wbts_id, "bts_id" => $respuesta[$i]->bts_id, "tecnologia" => $respuesta[$i]->tecnologia, "bandas" => $respuesta[$i]->bandas, "estado" => $respuesta[$i]->estado, "subestado" => $respuesta[$i]->subestado, "excepciongri" => $respuesta[$i]->excepciongri, "fechanotificacion" => $respuesta[$i]->fechanotificacion, "onair" => $respuesta[$i]->onair, "tipotrabajo" => $respuesta[$i]->tipotrabajo, "fechaproduccion" => $respuesta[$i]->fechaproduccion, "sectoresbloqueados" => $respuesta[$i]->sectoresbloqueados, "sectoresdesbloqueados" => $respuesta[$i]->sectoresdesbloqueados];            
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
    }

    public function reportOnair(){
      header('Content-Type: text/plain');
      $ticketsOnAir = new dao_ticketOnAir_model();
      $preparation = new dao_preparationStage_model();
      $station = new dao_station_model();
      $technology = new dao_technology_model();
      $band = new dao_band_model();
      $statusOnair = new dao_statusOnair_model();
      $work = new dao_work_model();
      $scaled = new dao_scaledOnair_model();
      $precheck = new dao_precheck_model();
      //inicio llamando todos los tickets
      $res = $ticketsOnAir->getAll()->data;
      //recorro y se van asignando foraneas
      for ($i=0; $i <count($res) ; $i++) { 
        $res[$i]->k_id_preparation = $preparation->findByIdPreparation($res[$i]->k_id_preparation)->data; //preparation
        $res[$i]->k_id_station = $station->findById($res[$i]->k_id_station)->data; //Station
        $res[$i]->k_id_technology = $technology->findById($res[$i]->k_id_technology)->data; //technology
        $res[$i]->k_id_band = $band->findById($res[$i]->k_id_band)->data; //band
        $res[$i]->k_id_status_onair = $statusOnair->findById($res[$i]->k_id_status_onair)->data; //Status onair
        $res[$i]->k_id_work = $work->findById($res[$i]->k_id_work)->data; //work
        $res[$i]->scaled_onair = $scaled->getScaledByTicket($res[$i]->k_id_onair)->data;//scaled onair
        $res[$i]->k_id_precheck = $precheck->getPrecheckByIdPrech($res[$i]->k_id_precheck)->data;//precheck

      }
      print_r($res);

      for ($i=0; $i <count($res) ; $i++) { 
         $data[$i] = [
            "Nombre_Estación-EB" =>$res[$i]->k_id_station->n_name_station,
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
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados, 
            "controlador" => $res[$i]->sectoresdesbloqueados,
            ]; 
      }
    }




}