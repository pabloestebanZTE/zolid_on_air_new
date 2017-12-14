<?php

class KpiSummaryOnairModel extends Model {

    protected $k_id_kpi_summary_onair;
    protected $k_id_onair;
    protected $n_round;
    protected $k_id_summary_precheck;
    protected $k_id_summary_12h;
    protected $k_id_summary_24h;
    protected $k_id_summary_36h;
    protected $d_created_at;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "kpi_summary_onair";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdKpiSummaryOnair($k_id_kpi_summary_onair) {
        $this->k_id_kpi_summary_onair = $k_id_kpi_summary_onair;
    }
    public function getKIdKpiSummaryOnair() {
        return $this->k_id_kpi_summary_onair;
    }
    public function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }
    public function getKIdOnair() {
        return $this->k_id_onair;
    }
    public function setNRound($n_round) {
        $this->n_round = $n_round;
    }
    public function getNRound() {
        return $this->n_round;
    }
    public function setKIdSummaryPrecheck($k_id_summary_precheck) {
        $this->k_id_summary_precheck = $k_id_summary_precheck;
    }
    public function getKIdSummaryPrecheck() {
        return $this->k_id_summary_precheck;
    }
    public function setKIdSummary12h($k_id_summary_12h) {
        $this->k_id_summary_12h = $k_id_summary_12h;
    }
    public function getKIdSummary12h() {
        return $this->k_id_summary_12h;
    }
    public function setKIdSummary24h($k_id_summary_24h) {
        $this->k_id_summary_24h = $k_id_summary_24h;
    }
    public function getKIdSummary24h() {
        return $this->k_id_summary_24h;
    }
    public function setKIdSummary36h($k_id_summary_36h) {
        $this->k_id_summary_36h = $k_id_summary_36h;
    }
    public function getKIdSummary36h() {
        return $this->k_id_summary_36h;
    }
    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }
    public function getDCreatedAt() {
        return $this->d_created_at;
    }


}

