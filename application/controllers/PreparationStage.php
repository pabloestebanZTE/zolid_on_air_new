<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TicketOnair extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_preparationStage_model');
    }

    public function getPreparationStage($id){
      $preparation = new dao_preparationStage_model();

      $res = $preparation->findByIdPreparation($id);
      print_r($res);

    }

}
