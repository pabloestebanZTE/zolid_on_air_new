<?php

class OnAir24hModel extends Model {

    protected $k_id_24h_real;
    protected $k_id_onair;
    protected $d_start24h;
    protected $d_start_temp;
    protected $k_id_follow_up_24h;
    protected $d_fin24h;
    protected $n_comentario;
    protected $i_timestamp;
    protected $i_percent;
    protected $i_round;
    protected $i_state;
    protected $i_hours;
    protected $d_created_at;
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "on_air24h";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKId24hReal($k_id_24h_real) {
        $this->k_id_24h_real = $k_id_24h_real;
    }

    public function getKId24hReal() {
        return $this->k_id_24h_real;
    }

    public function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }

    public function getKIdOnair() {
        return $this->k_id_onair;
    }

    public function setDStart24h($d_start24h) {
        $this->d_start24h = $d_start24h;
    }

    public function getDStart24h() {
        return $this->d_start24h;
    }

    public function setDStartTemp($d_start_temp) {
        $this->d_start_temp = $d_start_temp;
    }

    public function getDStartTemp() {
        return $this->d_start_temp;
    }

    public function setKIdFollowUp24h($k_id_follow_up_24h) {
        $this->k_id_follow_up_24h = $k_id_follow_up_24h;
    }

    public function getKIdFollowUp24h() {
        return $this->k_id_follow_up_24h;
    }

    public function setDFin24h($d_fin24h) {
        $this->d_fin24h = $d_fin24h;
    }

    public function getDFin24h() {
        return $this->d_fin24h;
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

    public function setIPercent($i_percent) {
        $this->i_percent = $i_percent;
    }

    public function getIPercent() {
        return $this->i_percent;
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

    public function setIHours($i_hours) {
        $this->i_hours = $i_hours;
    }

    public function getIHours() {
        return $this->i_hours;
    }

    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }

    public function getDCreatedAt() {
        return $this->d_created_at;
    }

    public function getLastDetail($tck, $round) {
        $onAir24HModel = new OnAir24hModel();
        $obj = $onAir24HModel
                ->where("k_id_onair", "=", $tck->k_id_onair)
                ->where("i_round", "=", $round)
                ->orderBy("d_start24h", "DESC")
                ->first();
        return $obj;
    }

}
