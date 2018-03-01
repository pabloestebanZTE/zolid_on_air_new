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
        $this->load->model('data/Dao_evaluador_model');
        $this->load->model('data/Dao_kpi_model');
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
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $answer['user'] = Auth::user();
        if (Auth::isEvaluador()) {
            $daoEvaluador = new Dao_evaluador_model();
            $answer["stadistics"] = $daoEvaluador->getAllStadistics()->data;
        }
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
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        if (Auth::isEvaluador()) {
            $daoEvaluador = new Dao_evaluador_model();
            $this->load->view('principal', ["stadistics" => $daoEvaluador->getAllStadistics()->data]);
        } else {
            $this->load->view('principal');
        }
    }

    public function documenterStrartView($answer) {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $this->load->view('documenterStrart', $answer);
    }

    public function trackingDetails() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $kpiDao = new Dao_kpi_model();
        //Se registra el KPI.
        $kpiDao->record($this->request->id);

        //Se valida si los botones estarán bloqueados para el usuario logueado...
        $block = null;
        if (Auth::isIngeniero()) {
            //Verificamos si el ticket actual está asignado al usuario actualmente logueado...
            $ticketModel = new TicketOnAirModel();
            $ticket = $ticketModel->where("k_id_onair", "=", $this->request->id)->first();
            if ($ticket->i_actualEngineer != Auth::user()->k_id_user) {
                $block = "true";
            } else {
                $block = "false";
            }
        } else {
            $block = "true";
        }
        if (Auth::isCoordinador()) {
            $block = "false";
        }
        $this->load->view('trackingdetails', ["block" => $block]);
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
//        $res->scaledOnair = $scaledOnair->getScaledByTicketRound($res->k_id_onair, $res->n_round)->data; //scaledOnair nuevo elemento
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

        //Se consulta el último escalamiento...

        if ($res->n_round > 1) {
            //Se fija a la ronda anterior para traer el escalamiento anterior...
            $res->n_round = $res->n_round - 1;
        }
        $scalingModel = new ScaledOnAirModel();
        $scaling = $scalingModel->where("k_id_onair", "=", $ticket)
                ->where("n_round", "=", $res->n_round)
                ->orderBy("n_round", "desc")
                ->first();
        if (!$scaling) {
            $scaling = (new ObjUtil([
                "d_time_escalado" => 0,
                "i_cont_esc_imp" => 0,
                "i_cont_esc_rf" => 0,
                "cont_esc_npo" => 0,
                "cont_esc_care" => 0,
                "i_cont_esc_oym" => 0,
                "i_cont_esc_gdrt" => 0,
                "cont_esc_calidad" => 0,
                "time_esc_imp" => 0,
                "i_time_esc_rf" => 0,
                "i_time_esc_npo" => 0,
                "i_time_esc_care" => 0,
                "i_cont_esc_oym" => 0,
                "time_esc_oym" => 0,
                "i_time_esc_gdrt" => 0,
                "i_time_esc_calidad" => 0,
                    ]))->all();
        } else {
            $scaling->n_comentario_esc = null;
        }
        $answer['items'] = json_encode($res);
        $answer['scaling'] = json_encode($scaling);
        $this->load->view('scaling', $answer);
    }

    public function coordinadordetails() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
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
        $res['crq'] = $crq->getAllCRQ();

        for ($i = 0; $i < count($res['statusOnAir']->data); $i++) {
            for ($j = 0; $j < count($res['status']->data); $j++) {
                if ($res['statusOnAir']->data[$i]->k_id_status == $res['status']->data[$j]->k_id_status) {
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
        if (!Auth::check()) {
            return Redirect::to(URL::base());
        }
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
        $answer['users'] = json_encode($users->getAllEngineers());
        $answer['status'] = $status->getAllStatus();
        $answer['substatus'] = $status->getAllSubstatus();
        $answer['statusOnAir'] = $status->getAll();
        $answer['tck'] = $response->data;
        if ($response->data->data_standby) {
            $json = json_decode($response->data->data_standby, true);
            $answer["stateStandBy"] = $json["k_id_status_onair"];
            $date = (Hash::getTimeStamp(Hash::getDate()) - $json["time_elapsed"]);
            $date = Hash::timeStampToDate($date);
            $timerGlobal = new TimerGlobal();
            $tck = (new TicketOnAirModel())->where("k_id_onair", "=", $response->data->k_id_onair)->first();
            $tck->k_id_status_onair = $json["k_id_status_onair"];
            $valuesTime = $timerGlobal->updateTimeStamp($tck, $date);
            $answer["valuesTime"] = json_encode($valuesTime, true);
        }
        $this->toAssign($answer);
    }

    public function doPrecheck() {
        if (!Auth::check()) {
            Redirect::to(URL::to("/"));
        }
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
        if (!$response->data->k_id_precheck) {
            $this->request->d_precheck_init = Hash::getDate();
            $this->request->d_finpre = Hash::getDate();
            $this->request->k_id_user = 1000;
            $response2 = $precheck->insertPrecheck($this->request);
            $this->request->k_id_precheck = $response2->data->data;
            $this->request->k_id_ticket = $id;
            $this->request->i_actualEngineer = $this->request->k_id_user;
            $this->request->i_precheck_realizado = 1;
            $response3 = $ticketOnAir->updatePrecheckOnair($this->request, $response->data->k_id_status_onair['k_id_status_onair']);
            $response->data->k_id_precheck = $precheck->getPrecheckByIdPrech($this->request->k_id_precheck)->data;
        }
        if ($response->data->k_id_precheck->k_id_user) {
            $response->data->k_id_precheck->k_id_user = $users->findBySingleId($response->data->k_id_precheck->k_id_user)->data;
        }
        //Se corre el parche para corregir los errores...
        $parche = new Dao_autorecord_model();
        $parche->corregirSectores($response->data);

        $ticketObj = (new TicketOnAirModel())->where("k_id_onair", "=", $response->data->k_id_onair)->first();

        $response->data->n_json_sectores = $ticketObj->n_json_sectores;
        $response->data->n_sectoresbloqueados = $ticketObj->n_sectoresbloqueados;
        $response->data->n_sectoresdesbloqueados = $ticketObj->n_sectoresdesbloqueados;

        $answer['ticket'] = json_encode($response->data);

        $answer['statusOnAir'] = json_encode($status->getAll()->data);
        $answer['status'] = json_encode($status->getAllStatus()->data);
        $answer['substatus'] = json_encode($status->getAllSubstatus()->data);

        $this->precheck($answer);
    }

    public function getAllTickets() {
        $this->load->view('getAllTickets');
    }

}

?>
