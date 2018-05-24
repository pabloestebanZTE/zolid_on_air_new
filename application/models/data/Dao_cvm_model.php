<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_cvm_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/CvmModel');
    }

    public function insertCvm($request) {
        try {
            $cvm = new CvmModel();
            $datos = $cvm->insert($request->all());
//            echo $cvm->getSQL();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
}

?>
