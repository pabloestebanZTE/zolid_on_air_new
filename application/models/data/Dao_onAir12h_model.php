<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_onAir12h_model extends CI_Model{

      public function __construct(){
        $this->load->model('dto/OnAir12hModel');
      }

      public function getAll(){
        try {
          $onair12 = new OnAir12hModel();
          $datos = $onair12->get();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }

      public function getUserByOnair12($id){
        try {
          $onair12 = new OnAir12hModel();
          $datos = $onair12->where("k_id_user","=",$id)
                        ->first();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;

        } catch (DeplynException $ex) {
          return $ex;
        }
      }

        public function getOnair12ByFollow($id){
          try {
            $onair12 = new OnAir12hModel();
            $datos = $onair12->where("k_id_follow_up_12h","=",$id)
                          ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (DeplynException $ex) {
            return $ex;
          }
        }

        public function getOnair12ByIdOnair($id){
          try {
            $onair12 = new OnAir12hModel();
            $datos = $onair12->where("k_id_onair","=",$id)
                          ->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (DeplynException $ex) {
            return $ex;
          }
        }

        public function insertOnAir12($request){
          try {
              $follow = new OnAir12hModel();
              $datos = $follow->insert($request->all());
              $response = new Response(EMessages::SUCCESS);
              $response->setData($datos);
              return $response;
          } catch (DeplynException $ex) {
              return $ex;
          }
        }

        public function getOnair12ByIdOnairAndRound($id, $round){
        try {
          $onair12 = new OnAir12hModel();
          $datos = $onair12->where("k_id_onair","=",$id)->where("i_round","=",$round)
                        ->first();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }
  }
?>
