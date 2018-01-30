<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_technology_model extends CI_Model{

      public function __construct(){
         $this->load->model('dto/TechnologyModel');
      }
      public function getAll(){
        try {
          $technology = new technologyModel();
          $datos = $technology->get();
          $response = new Response(EMessages::SUCCESS);
          $response->setData($datos);
          return $response;
        } catch (DeplynException $ex) {
          return $ex;
        }
      }

      public function findById($id){
        try {
          $technology = new technologyModel();
          $datos = $technology->where("k_id_technology","=",$id)
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
