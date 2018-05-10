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
            $datos = $work->orderBy("n_name_ork","ASC")->get();
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

        public function insertWork($request) {
          try {
              $db = new DB();
              $ult = $db->select('SELECT MAX(k_id_work) AS max FROM work;')->first();

              $request->k_id_work = $ult->max+1;

              $work = new WorkModel();
              $datos = $work->insert($request->all());
  //            echo $work->getSQL();
              $response = new Response(EMessages::SUCCESS);
              $response->setData($datos);
              return $response;
          } catch (DeplynException $ex) {
              return $ex;
          }
       }

       public function updateWork($data){
        $this->db->where('k_id_work', $data['k_id_work'] );
        $this->db->update('work', $data);

       }

       /* public function datosEspecificos($algo){
          $query = $this->db->query("SELECT n_name_ork, b_aplica_bloqueo, n_abreviacion FROM on_air.work; ")
          return $query result();

        }*/

    }
?>
