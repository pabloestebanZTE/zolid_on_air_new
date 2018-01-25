<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_precheck_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/TicketOnAirModel');
        $this->load->model('dto/PrecheckModel');
    }

    public function getAll() {
        try {
            $precheck = new PrecheckModel();
            $datos = $precheck->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getUserByprecheck($idUser) {
        try {
            $precheck = new PrecheckModel();
            $datos = $precheck->where("k_id_user", "=", $idUser)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getPrecheckByIdPrech($id) {
        try {
            $precheck = new PrecheckModel();
            $datos = $precheck->where("k_id_precheck", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getPrecheckById($idUser) {
        try {
            $precheck = new PrecheckModel();
            $datos = $precheck->where("k_id_user", "=", $idUser)
                    ->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getPrecheckByIdUser() {
        try {
            //Consultamos la lista de registros pendientes...
            $db = new DB();
            $pending = $db->select("select * from ticket_on_air where k_id_precheck is NULL")->get();
            $assing = $db->select("select * from ticket_on_air where k_id_precheck is not NULL")->get();
            //Consultamos la lista de registros asignados...
            $data = [
                "pendingList" => $pending,
                "assingList" => $assing
            ];
            $response = new Response(EMessages::QUERY);
            $response->setData($data);
            return $response;
        } catch (DeplynException $exc) {
            return $exc;
        }
    }

    public function insertPrecheck($request){
      try {
        $precheck = new PrecheckModel();
        $datos = $precheck->insert($request->all());
//        print_r($precheck->getSQL());
        $response = new Response(EMessages::SUCCESS);
        $response->setData($datos);
        $response->setMessage("Se ha insertado el precheck correctamente");
        return $response;
      } catch (DeplynException $ex) {
        return $ex;
      }
    }

    public function updatePrecheckCom($request){
      try {
        $precheck = new PrecheckModel();
        $datos = $precheck->where("k_id_precheck","=",$request->k_id_precheck)
                          ->update($request->all());
        $response = new Response(EMessages::SUCCESS);
        $response->setData($datos);
        return $response;
      } catch (DeplynException $ex) {
        return $ex;
      }
    }

}

?>
