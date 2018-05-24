<?php

class KpiAcsModel extends Model {

    protected $k_id_kpi_acs;
    protected $k_id_user;
    protected $k_id_vm;
    protected $d_create_at;
    protected $n_type;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "kpi_acs";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdKpiAcs($k_id_kpi_acs) {
        $this->k_id_kpi_acs = $k_id_kpi_acs;
    }
    public function getKIdKpiAcs() {
        return $this->k_id_kpi_acs;
    }
    public function setKIdUser($k_id_user) {
        $this->k_id_user = $k_id_user;
    }
    public function getKIdUser() {
        return $this->k_id_user;
    }
    public function setKIdVm($k_id_vm) {
        $this->k_id_vm = $k_id_vm;
    }
    public function getKIdVm() {
        return $this->k_id_vm;
    }
    public function setDCreateAt($d_create_at) {
        $this->d_create_at = $d_create_at;
    }
    public function getDCreateAt() {
        return $this->d_create_at;
    }
    public function setNType($n_type) {
        $this->n_type = $n_type;
    }
    public function getNType() {
        return $this->n_type;
    }


}

