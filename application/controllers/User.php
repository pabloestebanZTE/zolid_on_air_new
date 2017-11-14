<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ticketOnair_model');
        $this->load->model('data/Dao_user_model');
        $this->load->model('data/Dao_station_model');
        $this->load->model('data/Dao_band_model');
        $this->load->model('data/Dao_work_model');
        $this->load->model('data/Dao_technology_model');
        $this->load->model('data/Dao_preparationStage_model');
        $this->load->model('data/Dao_precheck_model');
        $this->load->model('data/Dao_statusOnair_model');
        $this->load->model('data/Dao_scaledOnair_model');
    }

    private function validUser($request) {
        return Auth::attempt([
                    "n_mail_user" => $request->username,
                    "n_password" => $request->password,
                    "OR" => [
                        "n_username_user" => $request->username
                    ]
        ]);
    }

    public function time() {
        $x = date("Y-m-d h:i:sa");
        echo $x . "<br/>";
        echo Hash::getTimeStamp($x);
    }

    public function loginUser() {
        if (!Auth::check()) {
            $res = $this->validUser($this->request);
        } else {
            $res = true;
        }
        //Comprobamos si el Auth ha encontrado válida las credenciales consultadas...
        if ($res) {
            //Se actualiza la forma de validar los roles...
            //Podemos acceder directamente al método que comprobará un rol en especifico.
            if (Auth::isCoordinador()) {

            }
            if (Auth::isDocumentador()) {

            }
            //O también podemos detectar si el rol es uno personalizado...
            if (Auth::isRole("Ingeniero")) {

            }
            Redirect::redirect(URL::to("User/principal"));
        } else {
            $answer['error'] = "error";
            $this->load->view('login', $answer);
        }
    }

    public function principal() {
        $answer['user'] = Auth::user();
        $this->load->view('principal', $answer);
    }

    public function logout() {
        Auth::logout();
        Redirect::to(URL::to("welcome/index"));
    }

    public function comprobarSesion() {
        //Comprobar si existe una sesión...
        if (Auth::check()) {
            $this->json(new Response(EMessages::SESSION_ACTIVE));
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
        }
    }

    public function principalView() {
        $this->load->view('principal');
    }

    public function documenterStrartView($answer) {
        $this->load->view('documenterStrart', $answer);
    }

    public function trackingDetails() {
        $this->load->view('trackingdetails');
    }

    public function toAssign($ticket) {
        $this->load->view('toAssign', $ticket);
    }

    public function documenterPrincipalView($answer) {
        $this->load->view('documenterPrincipal', $answer);
    }

    public function precheck($answer) {
        $this->load->view('precheck', $answer);
    }

    public function scaling() {
        $ticketOnair = new dao_ticketOnAir_model();
        $scaledOnair = new dao_scaledOnair_model();
        $status = new dao_statusOnair_model();

        $ticket = $this->request->id;
        $res = $ticketOnair->findByIdOnAir($ticket)->data;
        $res->scaledOnair = $scaledOnair->getScaledByTicketRound($res->k_id_onair, $res->n_round)->data; //scaledOnair nuevo elemento
        $res->statusOnAir = $status->getAll();
        $res->status = $status->getAllStatus();
        $res->substatus = $status->getAllSubstatus();
        for ($i = 0; $i < count($res->statusOnAir->data); $i++) {
            for ($j = 0; $j < count($res->status->data); $j++) {
                if ($res->statusOnAir->data[$i]->k_id_status == $res->status->data[$j]->k_id_status) {
                    $res->statusOnAir->data[$i]->n_name_status = $res->status->data[$j]->n_name_status;
                }
            }
            for ($j = 0; $j < count($res->substatus->data); $j++) {
                if ($res->statusOnAir->data[$i]->k_id_substatus == $res->substatus->data[$j]->k_id_substatus) {
                    $res->statusOnAir->data[$i]->n_name_substatus = $res->substatus->data[$j]->n_name_substatus;
                }
            }
        }

        $answer['items'] = json_encode($res);
        $this->load->view('scaling', $answer);
    }

    public function coordinadordetails() {
        $this->load->view('coordinadordetails');
    }

    public function createTicketOnair() {
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $status = new dao_statusOnair_model();
        $crq = new dao_preparationStage_model();

        $res['stations'] = $station->getAll();
        $res['cities'] = $station->getAllCities();
        $res['regions'] = $station->getAllRegions();
        $res['bands'] = $band->getAll();
        $res['works'] = $work->getAll();
        $res['technologies'] = $technology->getAll();
        $res['statusOnAir'] = $status->getAll();
        $res['status'] = $status->getAllStatus();
        $res['substatus'] = $status->getAllSubstatus();
        /*$res['crq'] = $crq->*/
        for($i = 0; $i < count($res['statusOnAir']->data); $i++){
          for($j = 0; $j < count($res['status']->data); $j++){
            if($res['statusOnAir']->data[$i]->k_id_status == $res['status']->data[$j]->k_id_status){
              $res['statusOnAir']->data[$i]->n_name_status = $res['status']->data[$j]->n_name_status;
            }
          }
            for ($j = 0; $j < count($res['substatus']->data); $j++) {
                if ($res['statusOnAir']->data[$i]->k_id_substatus == $res['substatus']->data[$j]->k_id_substatus) {
                    $res['statusOnAir']->data[$i]->n_name_substatus = $res['substatus']->data[$j]->n_name_substatus;
                }
            }
        }
        $answer['respuesta'] = json_encode($res);
        $this->documenterStrartView($answer);
    }

    public function assignEngineer() {
        // header('Content-Type: text/plain');
        $id = $this->request->idOnair;
        $ticketOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $users = new Dao_user_model();
        $PS = new dao_preparationStage_model();
        $status = new dao_statusOnair_model();
        $response = $ticketOnAir->findByIdOnAir($id);
        $response->data->k_id_preparation = $PS->findByIdPreparation($response->data->k_id_preparation)->data;
        $response->data->k_id_station = $station->findById($response->data->k_id_station)->data;
        $response->data->k_id_band = $band->findById($response->data->k_id_band)->data;
        $response->data->k_id_technology = $technology->findById($response->data->k_id_technology)->data;
        $response->data->k_id_work = $work->findById($response->data->k_id_work)->data;
        $response->data->k_id_status_onair = $status->findById($response->data->k_id_status_onair)->data;
        $answer['ticket'] = json_encode($response->data);
        $answer['users'] = json_encode($users->getAll());
        $answer['status'] = $status->getAllStatus();
        $answer['substatus'] = $status->getAllSubstatus();
        $answer['statusOnAir'] = $status->getAll();
        $this->toAssign($answer);
    }

    public function doPrecheck() {
        $id = $this->request->idOnair;
        $ticketOnAir = new dao_ticketOnAir_model();
        $station = new dao_station_model();
        $band = new dao_band_model();
        $work = new dao_work_model();
        $technology = new dao_technology_model();
        $precheck = new dao_precheck_model();
        $users = new Dao_user_model();
        $PS = new dao_preparationStage_model();
        $status = new dao_statusOnair_model();
        $response = $ticketOnAir->findByIdOnAir($id);
        $response->data->k_id_preparation = $PS->findByIdPreparation($response->data->k_id_preparation)->data;
        $response->data->k_id_station = $station->findById($response->data->k_id_station)->data;
        $response->data->k_id_band = $band->findById($response->data->k_id_band)->data;
        $response->data->k_id_technology = $technology->findById($response->data->k_id_technology)->data;
        $response->data->k_id_work = $work->findById($response->data->k_id_work)->data;
        $response->data->k_id_status_onair = $status->findById($response->data->k_id_status_onair)->data;
        $response->data->k_id_precheck = $precheck->getPrecheckByIdPrech($response->data->k_id_precheck)->data;
        $response->data->k_id_precheck->k_id_user = $users->findBySingleId($response->data->k_id_precheck->k_id_user)->data;
        $answer['ticket'] = json_encode($response->data);
        $answer['substatus'] = $status->getAllSubstatus();
        $answer['status'] = $status->getAllStatus();
        $this->precheck($answer);
    }

}

?>
