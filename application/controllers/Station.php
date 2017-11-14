<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Station extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_station_model');
    }

    public function createCity(){
      $station = new dao_station_model();
      $response = $station->getLastId($this->request);
      $this->request->k_id_station = $response->data[count($response->data)-1]->k_id_station+1;
      $this->request->k_id_city = $this->request->city_id;
      $this->request->n_name_station = $this->request->n_name_city;
      $response = $station->insertStation($this->request);
      $this->json($response);
    }
}
