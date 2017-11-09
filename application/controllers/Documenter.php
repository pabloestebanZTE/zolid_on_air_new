<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documenter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ticketOnair_model');
        $this->load->model('data/Dao_preparationStage_model');
    }

    public function documenterFields(){
      // header('Content-Type: text/plain');
      $ticketOnair = new dao_ticketOnAir_model();
      $preparation = new dao_preparationStage_model();
      $ticket = $this->request->id;
      $res = $ticketOnair->findByIdOnAir($ticket)->data;
      if($res != ""){
      $res->k_id_preparation = $preparation->findByIdPreparation($res->k_id_preparation)->data;
      }
      $answer['fields'] = json_encode($res);
      $this->load->view('documenterPrincipal', $answer);
    }

    public function updateDetails(){
      $ticket = new dao_ticketOnAir_model();
      $preparation = new dao_preparationStage_model();
      $response = $ticket->updatePrecheckOnair($this->request);
      $this->request->k_id_preparation = $this->request->k_id_prep;
      $response = $preparation->updatePreparationStage($this->request);
      $this->json($response);
    }



}
