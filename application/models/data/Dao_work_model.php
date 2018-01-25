<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_work_model extends CI_Model{

        public function __construct(){
          $this->load->model('dto/WorkModel');
        }
        public function getAll(){
          try {
            $work = new WorkModel();
            $datos = $work->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (DeplynException $ex) {
            return $ex;
          }
        }

        public function findById($id){
          try {
            $work = new WorkModel();
            $datos = $work->where("k_id_work","=",$id)
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
