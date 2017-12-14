<?php

/*
 * Controlador para cosas genéricas del sistema...
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Utils extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/TimerGlobal');
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
        $date = Hash::getTimeStamp(Hash::getDate());
        echo date("Y-m-d H:i:s", $date / 1000);
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

    public function nextDate() {
        $date = Hash::getDate();
        $timer = new TimerGlobal();
        $obj = $timer->getObjectModel();
        $obj->d_precheck_start = $date;
        $timer->nextDate($obj, "d_precheck_start", 3);
        echo Hash::timeStampToDate($obj->next_date);
    }

}
