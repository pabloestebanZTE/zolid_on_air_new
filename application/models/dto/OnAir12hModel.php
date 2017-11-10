<?php

class OnAir12hModel extends Model {

    protected $k_id_12h_real;
    protected $k_id_follow_up_12h;
    protected $k_id_onair;
    protected $d_start12h;
    protected $d_fin12h;
    protected $n_comentario;
    protected $i_timestamp;
    protected $i_percent;
    protected $i_round;
    protected $i_state;
    protected $d_created_at;
    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "on_air_12h";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKId12hReal($k_id_12h_real) {
        $this->k_id_12h_real = $k_id_12h_real;
    }

    public function getKId12hReal() {
        return $this->k_id_12h_real;
    }

    public function setKIdFollowUp12h($k_id_follow_up_12h) {
        $this->k_id_follow_up_12h = $k_id_follow_up_12h;
    }

    public function getKIdFollowUp12h() {
        return $this->k_id_follow_up_12h;
    }

    public function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }

    public function getKIdOnair() {
        return $this->k_id_onair;
    }

    public function setDStart12h($d_start12h) {
        $this->d_start12h = $d_start12h;
    }

    public function getDStart12h() {
        return $this->d_start12h;
    }

    public function setDFin12h($d_fin12h) {
        $this->d_fin12h = $d_fin12h;
    }

    public function getDFin12h() {
        return $this->d_fin12h;
    }

    public function setNComentario($n_comentario) {
        $this->n_comentario = $n_comentario;
    }

    public function getNComentario() {
        return $this->n_comentario;
    }

    public function setITimestamp($i_timestamp) {
        $this->i_timestamp = $i_timestamp;
    }

    public function getITimestamp() {
        return $this->i_timestamp;
    }

    public function setIRound($i_round) {
        $this->i_round = $i_round;
    }

    public function getIRound() {
        return $this->i_round;
    }

    public function setIState($i_state) {
        $this->i_state = $i_state;
    }

    public function getIState() {
        return $this->i_state;
    }

    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }

    public function getDCreatedAt() {
        return $this->d_created_at;
    }

    public function getLastDetail($tck) {
        $onAir12HModel = new OnAir12hModel();
        $obj = $onAir12HModel->where("k_id_onair", "=", $tck->k_id_onair)
                ->where("i_round", "=", $tck->n_round)
                ->orderBy("d_start12h", "DESC")
                ->first();
        return $obj;
    }

    public function updateTimeStamp($tck) {
        $model = new OnAir12hModel();
        $timestamp = 0;
        $percent = 0;
        $obj = $model->getLastDetail($tck, $tck->n_round);
        if (!$obj) {
            return 0;
        }

        if ($obj->i_state == 0) {
            //Calculamos el tiempo en formato timestamp y actualizamos
            //el tiempo restante para desarrollar la actividad...
            $time = Hash::getTimeStamp($obj->d_start12h);
            $today = Hash::getTimeStamp(date("Y-m-d H:i:s"));
            $timeFinal = $time + ((1000 * 60) * 60) * 12;
            //Milisegundos entre la fecha y hoy (tiempo que falta)...
            $timestamp = ($timeFinal - $today);
            $state = 0;

            //Obtenemos el porcentaje...
            $percent = round((($today - $time) / ($timeFinal - $time)) * 100);


            //Si el timestamp es menor o igual a 0, empiezan a correr las 3 horas...
            if ($timestamp <= 0) {
                $state = 1;
                $timestamp = $today + ((1000 * 60) * 60) * 12;
            }
            $model = new OnAir12hModel();
            $model->where("k_id_12h_real", "=", $obj->k_id_12h_real)->update([
                "i_timestamp" => $timestamp,
                "i_state" => $state //Cuando cambia a uno, es por que empiezan a correr las 3 horas...
            ]);
        } else {
            //3horas...
            $timestamp = $obj->i_timestamp;
        }

        $obj->i_timestamp = $timestamp;
        $obj->i_percent = $percent;
        return $obj;
    }

}
