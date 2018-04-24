<?php

class QualityReportModel extends Model {

    protected $k_id_quality_report;
    protected $k_id_onair;
    protected $n_usuario_encargado;
    protected $n_hallazgo;
    protected $n_observaciones;
    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "quality_report";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    function getKIdQualityReport() {
        return $this->k_id_quality_report;
    }

    function getKIdOnair() {
        return $this->k_id_onair;
    }

    function getNUsuarioEncargado() {
        return $this->n_usuario_encargado;
    }

    function getNHallazgo() {
        return $this->n_hallazgo;
    }

    function getNObservaciones() {
        return $this->n_observaciones;
    }

    function setKIdQualityReport($k_id_quality_report) {
        $this->k_id_quality_report = $k_id_quality_report;
    }

    function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }

    function setNUsuarioEncargado($n_usuario_encargado) {
        $this->n_usuario_encargado = $n_usuario_encargado;
    }

    function setNHallazgo($n_hallazgo) {
        $this->n_hallazgo = $n_hallazgo;
    }

    function setNObservaciones($n_observaciones) {
        $this->n_observaciones = $n_observaciones;
    }



}
