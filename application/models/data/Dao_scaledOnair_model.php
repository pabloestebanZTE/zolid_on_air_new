<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_scaledOnair_model extends CI_Model{

        public function __construct(){
          $this->load->model('dto/ScaledOnAirModel');
        }

        public function getAll(){
          try {
            $scaledOnair = new ScaledOnAirMOdel();
            $datos = $scaledOnair->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (ZolidException $ex) {
            return $ex;
          }
        }

        public function getScaledByTicket($ticket){
          try {
            $scaledOnair = new ScaledOnAirMOdel();
            $datos = $scaledOnair->where("k_id_onair","=",$ticket)
                          ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (ZolidException $ex) {
            return $ex;
          }
        }

        public function insertScaling($request){
          print_r($request);
          try {
            $scaledOnair = new ScaledOnAirMOdel();
            $datos = $scaledOnair->insert($request->all());
            print_r($scaledOnair->getsql());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (ZolidException $ex) {
            return $ex;
          }
        }




    }
?>
