<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_reporte_comentario_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/ReporteComentarioModel');
    }

    public function getAll() {
        try {
            $reporte = new ReporteComentarioModel();
            $datos = $reporte->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

}

?>
