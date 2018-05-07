<?php

class QualityReportModel extends Model {

    protected $k_id_quality_report;
    protected $k_id_onair;
    protected $n_usuario_encargado;
    protected $n_hallazgo;
    protected $n_observaciones;
    protected $n_checklist;
    protected $n_precheck;
    protected $n_kpis;
    protected $n_alarma;
    protected $n_evidencia_sectores_dbl;
    protected $n_vista_mm;
    protected $n_alamas_activas;
    protected $n_rx_signal_level;
    protected $n_coordenadas;
    protected $n_matriz_de_alarmas;
    protected $n_log_prueba_de_alarmas;
    protected $n_alarmas_ext;
    protected $n_power_zte;
    protected $n_maximo;
    protected $n_rf;
    protected $n_calidad_gestion_sectores;
    protected $n_tareas_remedy;
    protected $n_calidad_gestion;
    protected $n_observaciones_final;
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





    function setNChecklist($n_checklist) {
        $this->n_checklist = $n_checklist;
    }

    function getNChecklist() {
        return $this->n_checklist;
    }

    function setNPrecheck($n_precheck) {
        $this->n_precheck = $n_precheck;
    }

    function getNPrecheck() {
        return $this->n_precheck;
    }

    function setNKpis($n_kpis) {
        $this->n_kpis = $n_kpis;
    }

    function getNKpis() {
        return $this->n_kpis;
    }

    function setNAlarma($n_alarma) {
        $this->n_alarma = $n_alarma;
    }

    function getNAlarma() {
        return $this->n_alarma;
    }

    function setNEvidenciaSectoresDbl($n_evidencia_sectores_dbl) {
        $this->n_evidencia_sectores_dbl = $n_evidencia_sectores_dbl;
    }

    function getNEvidenciaSectoresDbl() {
        return $this->n_evidencia_sectores_dbl;
    }

    function setNVistaMm($n_vista_mm) {
        $this->n_vista_mm = $n_vista_mm;
    }

    function getNVistaMm() {
        return $this->n_vista_mm;
    }

    function setNAlamasActivas($n_alamas_activas) {
        $this->n_alamas_activas = $n_alamas_activas;
    }

    function getNAlamasActivas() {
        return $this->n_alamas_activas;
    }

    function setNRxSignalLevel($n_rx_signal_level) {
        $this->n_alamas_activas = $n_rx_signal_level;
    }

    function getNRxSignalLevel() {
        return $this->n_rx_signal_level;
    }

    function setNCoordenadas($n_coordenadas) {
        $this->n_coordenadas = $n_coordenadas;
    }

    function getNCoordenadas() {
        return $this->n_coordenadas;
    }

    function setNMatrizDeAlarmas($n_matriz_de_alarmas) {
        $this->n_matriz_de_alarmas = $n_matriz_de_alarmas;
    }

    function getNMatrizDeAlarmas() {
        return $this->n_matriz_de_alarmas;
    }

    function setNLogPruebaDeAlarmas($n_log_prueba_de_alarmas) {
        $this->n_log_prueba_de_alarmas = $n_log_prueba_de_alarmas;
    }

    function getNLogPruebaDeAlarmas() {
        return $this->n_log_prueba_de_alarmas;
    }

    function setNAlarmasExt($n_alarmas_ext) {
        $this->n_alarmas_ext = $n_alarmas_ext;
    }

    function getNAlarmasExt() {
        return $this->n_alarmas_ext;
    }

    function setNPowerZte($n_power_zte) {
        $this->n_power_zte = $n_power_zte;
    }

    function getNPowerZte() {
        return $this->n_power_zte;
    }

    function setNMaximo($n_maximo) {
        $this->n_maximo = $n_maximo;
    }

    function getNMaximo() {
        return $this->n_maximo;
    }

    function setNRf($n_rf) {
        $this->n_rf = $n_rf;
    }

    function getNRf() {
        return $this->$n_rf;
    }

    function setNCalidadGestionSectores($n_calidad_gestion_sectores) {
        $this->n_calidad_gestion_sectores = $n_calidad_gestion_sectores;
    }

    function getNCalidadGestionSectores() {
        return $this->n_calidad_gestion_sectores;
    }

    function setNTareasRemedy($n_tareas_remedy) {
        $this->n_tareas_remedy = $n_tareas_remedy;
    }

    function getNTareasRemedy() {
        return $this->n_tareas_remedy;
    }

    function setNCalidadGestion($n_calidad_gestion) {
        $this->n_calidad_gestion = $n_calidad_gestion;
    }

    function getNCalidadGestion() {
        return $this->n_calidad_gestion;
    }

    function setNObservacionesFinal($n_observaciones_final) {
        $this->n_observaciones_final = $n_observaciones_final;
    }

    function getNObservacionesFinal() {
        return $this->n_observaciones_final;
    }

}
