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

}
