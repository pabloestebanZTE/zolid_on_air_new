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
        $this->load->model('data/Dao_reporte_comentario_model');
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

    //
    public function c_calendar(){
        // $data = $this->Dao_reporte_comentario_model->getCronograma();
        $this->load->view('calendar');
    }

    //
    public function c_cronograma(){
        $mes = $this->input->post('mes');
        $data = $this->Dao_reporte_comentario_model->getCronogramaPorMes($mes)->data;
        echo json_encode($data);
    }

    //actualizar eventos del cronograma
    public function c_updateCrono(){
        $response = $this->Dao_reporte_comentario_model->d_updateCrono($this->request);
        $this->json($response);
    }

    //trae todos los eventos de cronograma
    public function getAllEventsCron(){
        $data = $this->Dao_reporte_comentario_model->getAllCron()->data;
        echo json_encode($data);
    }

}
