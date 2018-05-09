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

    //Llama todos los datos de rtabla cronograma
    public function getCronogramaPorMes($mes){
        try {
            $db = new DB();
            $cronograma = $db->select("
                SELECT 
                cro.k_id_cronograma AS id, 
                cro.d_crono_date AS start, 
                cro.k_id_crono_estado AS estado, 
                cro.k_id_crono_reporte AS id_reporte, 
                cr.n_name_report AS reporte
                FROM 
                cronograma_reportes cro
                INNER JOIN crono_reporte cr
                on cro.k_id_crono_reporte = cr.k_id_crono_reporte
                where
                cro.d_crono_date between '2018-". $mes ."-01 00:00:00' and last_day('2018-".$mes."-13 00:00:00')
            ")->get();
            $response = new Response(EMessages::QUERY);
            $response->setData($cronograma);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
        
    }

    //llama todos los reportes de cronograma con sus id
    public function getAllReports(){
        try {
            $reporte = new CronoReporteModel();
            $datos = $reporte->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    // actuyaliza eventos del cronograma
    public function d_updateCrono($request){
        try{
        $response = new Response(EMessages::UPDATE);
        $crono = new CronogramaReportesModel();
        
        $crono->where("k_id_cronograma","=",$request->k_id_cronograma)
             ->update($request->all());
            $response->setData($crono);
            return $response;
      }catch(DeplynException $ex){
        return $ex;
      }
    }

    // trae todos los eventos
    public function getAllCron(){
        try {
            $db = new DB();
            $cronograma = $db->select("
                SELECT 
                cro.k_id_cronograma AS id, 
                cro.d_crono_date AS start, 
                CASE
                WHEN k_id_crono_estado = 1 THEN  '#337ab7'
                WHEN k_id_crono_estado = 2 THEN '#008000'
                ELSE '#e6bb17'
                END as color,
                cro.k_id_crono_estado AS estado, 
                cro.k_id_crono_reporte AS id_reporte, 
                cr.n_name_report AS title
                FROM 
                cronograma_reportes cro
                INNER JOIN crono_reporte cr
                on cro.k_id_crono_reporte = cr.k_id_crono_reporte
            ")->get();
            $response = new Response(EMessages::QUERY);
            $response->setData($cronograma);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function findReportCommentsByIdOnAir($id) {
        try {
            $reporte = new ReporteComentarioModel();
            $datos = $reporte->where("k_id_on_air", "=", $id)
                    ->get();
//            echo $reporte->getSQL();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    // actualiza reporte comentario, hay que pasarle un array cuyos keys sean = a las columnas de reporte comentario
    public function updateComments($data){
        $this->db->where('k_id_primary', $data['k_id_primary']);
        $this->db->update('reporte_comentario',$data);
        $error = $this->db->error();
        if ($error['message']) {
          return $error;
        }else{
            return "ok";
        }
    }

    // insert EN EL REPORTE COMENTARIOS
    public function insertComments($data){

        $this->db->insert('reporte_comentario',$data);
        $error = $this->db->error();
        if ($error['message']) {
          return $error;
        }else{
            return "ok";
        }
    }

    // elimina un aid de la tabla comentarios
    public function deleteComments($id){
        $this->db->where('k_id_primary',$id);
        $this->db->delete('reporte_comentario');
        $error = $this->db->error();
        if ($error['message']) {
          return $error;
        }else{
            return "ok";
        }
    }

}

?>
