<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_onAir36h_model extends CI_Model{

      public function __construct(){
        $this->load->model('dto/OnAir36hModel');
      }

      public function getAll(){
        try {
          $onair36 = new OnAir36hModel();
          $datos = $onair36->get();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }

      public function getUserByOnair36($idUser){
        try {
          $onair36 = new OnAir36hModel();
          $datos = $onair36->where("k_id_user","=",$idUser)
                        ->first();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;

        } catch (DeplynException $ex) {
          return $ex;
        }

      }

      public function getOnair36ByFollow($id){
        try {
          $onair36 = new OnAir36hModel();
          $datos = $onair36->where("k_id_follow_up_36h","=",$id)
                        ->first();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }

      public function getOnair36ByIdOnair($id){
        try {
          $onair36 = new OnAir36hModel();
          $datos = $onair36->where("k_id_onair","=",$id)
                        ->get();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }

      public function getOnair36ByIdOnairAndRound($id, $round){
        try {
          $onair36 = new OnAir36hModel();
          $datos = $onair36->where("k_id_onair","=",$id)->where("i_round","=",$round)
                        ->first();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }
      public function insertOnAir36($request){
        try {
            $follow = new OnAir36hModel();
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
