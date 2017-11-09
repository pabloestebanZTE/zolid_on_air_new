<?php

class OnAir12hModel extends Model {

    protected $k_id_12h_real;
    protected $k_id_follow_up_12h;
    protected $k_id_onair;
    protected $d_start12h;
    protected $d_fin12h;
    protected $n_comentario;
    protected $i_timestamp;
    protected $i_round;
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
    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }
    public function getDCreatedAt() {
        return $this->d_created_at;
    }


}

