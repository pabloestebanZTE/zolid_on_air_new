<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_followUp24h_model extends CI_Model{

        public function __construct(){
          $this->load->model('dto/FollowUp24hModel');
        }

        public function getAll(){
          try {
            $follow24 = new FollowUp24hModel();
            $datos = $follow24->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (DeplynException $ex) {
            return $ex;
          }
        }

        public function getfollow24ById($idUser){
          try {
            $follow24 = new FollowUp24hModel();
            $datos = $follow24->where("k_id_user","=",$idUser)
                          ->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (DeplynException $ex) {
            return $ex;
          }
        }

        public function getfollow24ByIdFollow($id){
          try {
            $follow24 = new FollowUp24hModel();
            $datos = $follow24->where("k_id_follow_up_24h","=",$id)
                          ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (DeplynException $ex) {
            return $ex;
          }
        }

        public function update24FollowUp($request){
          try {
              $folloUp24 = new FollowUp24hModel();
              $datos = $folloUp24->where("k_id_follow_up_24h", "=", $request->k_id_follow_up_24h)
                      ->update($request->all());
              $response = new Response(EMessages::SUCCESS);
              $response->setData($datos);
              return $response;
          } catch (DeplynException $ex) {
              return $ex;
          }
        }

        public function insert24hFollowUp($request){
          try {
              $follow = new FollowUp24hModel();
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
