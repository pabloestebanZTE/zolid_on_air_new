<?php

class KpiSummaryModel extends Model {

    protected $k_kpi_summary;
    protected $e_type;
    protected $on_time;
    protected $d_start;
    protected $d_exec;
    protected $d_end;
    protected $k_id_executor;
    protected $d_created_at;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "kpi_summary";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKKpiSummary($k_kpi_summary) {
        $this->k_kpi_summary = $k_kpi_summary;
    }
    public function getKKpiSummary() {
        return $this->k_kpi_summary;
    }
    public function setEType($e_type) {
        $this->e_type = $e_type;
    }
    public function getEType() {
        return $this->e_type;
    }
    public function setOnTime($on_time) {
        $this->on_time = $on_time;
    }
    public function getOnTime() {
        return $this->on_time;
    }
    public function setDStart($d_start) {
        $this->d_start = $d_start;
    }
    public function getDStart() {
        return $this->d_start;
    }
    public function setDExec($d_exec) {
        $this->d_exec = $d_exec;
    }
    public function getDExec() {
        return $this->d_exec;
    }
    public function setDEnd($d_end) {
        $this->d_end = $d_end;
    }
    public function getDEnd() {
        return $this->d_end;
    }
    public function setKIdExecutor($k_id_executor) {
        $this->k_id_executor = $k_id_executor;
    }
    public function getKIdExecutor() {
        return $this->k_id_executor;
    }
    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }
    public function getDCreatedAt() {
        return $this->d_created_at;
    }


}

