<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_followUp12h_model extends CI_Model{

        public function __construct(){
          $this->load->model('dto/FollowUp12hModel');
        }

        public function getAll(){
          try {
            $follow12 = new FollowUp12hModel();
            $datos = $follow12->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (ZolidException $ex) {
            return $ex;
          }
        }

        public function getfollow12ById($idUser){
          try {
            $follow12 = new FollowUp12hModel();
            $datos = $follow12->where("k_id_user","=",$idUser)
                          ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (ZolidException $ex) {
            return $ex;
          }
        }

        public function getfollow12ByIdFollow($id){
          try {
            $follow12 = new FollowUp12hModel();
            $datos = $follow12->where("k_id_follow_up_12h","=",$id)
                          ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (ZolidException $ex) {
            return $ex;
          }
        }


    }
?>
