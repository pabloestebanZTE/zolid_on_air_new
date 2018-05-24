<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_followUp36h_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/FollowUp36hModel');
    }

    public function getAll() {
        try {
            $follow36 = new FollowUp36hModel();
            $datos = $follow36->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getfollow36ById($idUser) {
        try {
            $follow36 = new FollowUp36hModel();
            $datos = $follow36->where("k_id_user", "=", $idUser)
                    ->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }


    public function getfollow36ByIdFollow($id) {
        try {
            $follow36 = new FollowUp36hModel();
            $datos = $follow36->where("k_id_follow_up_36h", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function update36FollowUp($request) {
        try {
            $folloUp36 = new FollowUp36hModel();
            $datos = $folloUp36->where("k_id_follow_up_36h", "=", $request->k_id_follow_up_36h)
                    ->update($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function insert36hFollowUp($request) {
        try {
            $follow = new FollowUp36hModel();
            $datos = $follow->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

}

?>
