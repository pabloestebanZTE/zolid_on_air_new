<?php
		defined('BASEPATH') OR exit('No direct script access allowed');
		//Crear una clase
		class Editartodosparametros extends CI_Controller {
				function __construct () {
				parent:: __construct();
		//Se carga el model que trae los datos de db
				$this->load->model('data/Dao_work_model');
				$this->load->model('data/Dao_technology_model');
				$this->load->model('data/Dao_band_model');
				$this->load->model('data/Dao_user_model');
			}
		
		//Esta funcion carga la vista de edicion
		public function cargarVista () {
			//la respuesta trae los datos llamados por el modal
			$respuesta['work']= $this->Dao_work_model->getAll()->data;
			$respuesta['tecnologia'] = $this->Dao_technology_model->getAll()->data;
			$respuesta['Band'] = $this->Dao_band_model->getAll()->data;
			$respuesta['user'] = $this->Dao_user_model->getAll()->data;
		//Carga la funcion
			$this->load->view('editarParametros', $respuesta);
		}
		public function newWork(){
				// insertar work
				$work = new Dao_work_model();
				$res = $work->insertWork($this->request);
				//print_r($this->request);
				$this->locationCargarVista();
	
		}
		private function locationCargarVista(){
			$location = "location: ". URL::base() ."/Editartodosparametros/cargarVista";
			header($location);
			}
		public function newTech(){
			//insert technology
			$tech = new Dao_technology_model();
			$res = $tech->insertTech($this->request);
			$this->locationCargarVista();
			/*print_r($request);*/
			
		}
		public function newBand(){
			//insert technology
				$tech = new Dao_band_model();
			$res = $tech->insertBand($this->request);
			$this->locationCargarVista();
			/*print_r($request);*/
		}
		public function newUser(){
			//insert User
			$user = new Dao_user_model();
			$res = $user->insertUser($this->request);
			$this->locationCargarVista();
			/*print_r($request);*/
		}
		public function updateBand(){

			$data = array(
				'k_id_band' => $this->input->post('id') , 
				'n_name_band' => $this->input->post('n_name_band') 
			);

			$this->Dao_band_model->updateBand($data);
			/*print_r($_POST);*/
			$this->locationCargarVista();
		}

}
?>