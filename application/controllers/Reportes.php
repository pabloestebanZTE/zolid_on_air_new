<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_reporte_comentario_model');

    }

    public function reportComments(){
    	$reporte = new Dao_reporte_comentario_model();
    	$filename = "Reporte Comentarios.xls";
       /* header('Content-Type: text/plain');*/
    	header("Content-Disposition: attachment; filename=\"$filename\"");
     	header("Content-Type: application/vnd.ms-excel");

     	$respuesta = $reporte->getAll()->data;
        for ($i=0; $i <count($respuesta) ; $i++) { 
            $data[$i] = ["estacion" =>$respuesta[$i]->estacion, "bcf_wbts_id" => $respuesta[$i]->bcf_wbts_id, "bts_id" => $respuesta[$i]->bts_id, "tecnologia" => $respuesta[$i]->tecnologia, "bandas" => $respuesta[$i]->bandas, "estado" => $respuesta[$i]->estado, "subestado" => $respuesta[$i]->subestado, "excepciongri" => $respuesta[$i]->excepciongri, "fechanotificacion" => $respuesta[$i]->fechanotificacion, "onair" => $respuesta[$i]->onair, "tipotrabajo" => $respuesta[$i]->tipotrabajo, "fechaproduccion" => $respuesta[$i]->fechaproduccion, "sectoresbloqueados" => $respuesta[$i]->sectoresbloqueados, "sectoresdesbloqueados" => $respuesta[$i]->sectoresdesbloqueados, 
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
    }



}