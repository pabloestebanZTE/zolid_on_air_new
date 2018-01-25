<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_tiket_remedy_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/TiketRemedyModel');
    }

    public function insertTiketRemedy($request) {
        try {
            $tr = new TiketRemedyModel();
            $datos = $tr->insert($request->all());
//            echo $tr->getSQL();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
}

?>
