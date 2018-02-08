<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_station_model extends CI_Model {

    public function __construct() {
//           $this->load->model('dto/StationModel');
//           $this->load->model('dto/CityModel');
//           $this->load->model('dto/RegionalModel');
    }

    public function getAll() {
        try {
            $station = new StationModel();
            $datos = $station->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findById($id) {
        try {
            $station = new StationModel();
            $city = new CityModel();
            $regionalModel = new RegionalModel();
            $datos = $station->where("k_id_station", "=", $id)
                    ->first();
            //Consltamos la ciudad...
            if ($datos) {
                $cityObj = $city->where("k_id_city", "=", $datos->k_id_city)
                        ->first();
                if ($cityObj) {
                    $datos->k_id_city = $cityObj;
                    //Consultamos la regional.
                    $regionalObj = $regionalModel->where("k_id_regional", "=", $datos->k_id_city->k_id_regional)->first();
                    if ($regionalObj) {
                        $datos->k_id_city->k_id_regional = $regionalObj;
                    }
                }
            } else {
                echo "ID no encontrado:" . $id;
            }
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getAllCities() {
        try {
            $datos = DB::table("city")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getAllRegions() {
        try {
            $datos = DB::table("regional")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findRegionalById($id) {
        try {
            $datos = DB::table("regional")->where("k_id_regional", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findCityById($id) {
        try {
            $datos = DB::table("city")->where("k_id_city", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function insertStation($request) {
        try {
            $station = new StationModel();
            $datos = $station->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getLastId() {
        try {
            $station = new StationModel();
            $datos = $station->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

}

?>
