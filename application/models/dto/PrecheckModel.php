<?php

class PrecheckModel extends Model {

    protected $k_id_precheck;
    protected $k_id_user;
    protected $d_finpre;
    protected $n_comentario_ing;
    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "precheck";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdPrecheck($k_id_precheck) {
        $this->k_id_precheck = $k_id_precheck;
    }

    public function getKIdPrecheck() {
        return $this->k_id_precheck;
    }

    public function setKIdUser($k_id_user) {
        $this->k_id_user = $k_id_user;
    }

    public function getKIdUser() {
        return $this->k_id_user;
    }

    public function setDFinpre($d_finpre) {
        $this->d_finpre = $d_finpre;
    }

    public function getDFinpre() {
        return $this->d_finpre;
    }
    public function setNComentarioIng($n_comentario_ing) {
        $this->n_comentario_ing = $n_comentario_ing;
    }

    public function getNComentarioIng() {
        return $this->n_comentario_ing;
    }

}
