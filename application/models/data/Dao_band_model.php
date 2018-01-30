<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_band_model extends CI_Model{

      public function __construct(){
         $this->load->model('dto/BandModel');
      }
      public function getAll(){
        try {
          $band = new BandModel();
          $datos = $band->get();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }

      public function findById($id){
        try {
          $band = new BandModel();
          $datos = $band->where("k_id_band","=",$id)
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
