<?php

class OnAir36hModel extends Model {

    protected $k_id_36h_real;
    protected $k_id_follow_up_36h;
    protected $k_id_onair;
    protected $d_start36h;
    protected $d_fin36h;
    protected $n_comentario;
    protected $i_timestamp;
    protected $i_round;
    protected $d_created_at;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "on_air_36h";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKId36hReal($k_id_36h_real) {
        $this->k_id_36h_real = $k_id_36h_real;
    }
    public function getKId36hReal() {
        return $this->k_id_36h_real;
    }
    public function setKIdFollowUp36h($k_id_follow_up_36h) {
        $this->k_id_follow_up_36h = $k_id_follow_up_36h;
    }
    public function getKIdFollowUp36h() {
        return $this->k_id_follow_up_36h;
    }
    public function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }
    public function getKIdOnair() {
        return $this->k_id_onair;
    }
    public function setDStart36h($d_start36h) {
        $this->d_start36h = $d_start36h;
    }
    public function getDStart36h() {
        return $this->d_start36h;
    }
    public function setDFin36h($d_fin36h) {
        $this->d_fin36h = $d_fin36h;
    }
    public function getDFin36h() {
        return $this->d_fin36h;
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
    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }
    public function getDCreatedAt() {
        return $this->d_created_at;
    }


}

