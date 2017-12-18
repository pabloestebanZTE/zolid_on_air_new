<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluador extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dto/UserModel');
        $this->load->model('data/Dao_evaluador_model');
    }

    public function getUsers() {
        $response = new Response(EMessages::QUERY);
        $userModel = new UserModel();
        $data = $userModel->isNotNull("n_role_user")->get();
        $response->setData($data);
        $this->json($response);
    }

    public function evaluacionPorUsuario() {
        $userModel = new UserModel();
        $user = $userModel->where("k_id_user", "=", $this->request->id)->first();
        $daoEvaluador = new Dao_evaluador_model();
        $stadistics = $daoEvaluador->getStadisticsByUser($user)->data;
        $this->load->view('evaluacionPorUsuario', ["user" => $user, "stadistics" => $stadistics]);
    }

    public function getAllStadistics() {
        $daoEvaluador = new Dao_evaluador_model();
        $data = $daoEvaluador->getAllStadistics();
        $this->json($data);
    }

}
