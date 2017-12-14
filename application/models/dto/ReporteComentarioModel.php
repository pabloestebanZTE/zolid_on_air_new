<?php

class ReporteComentarioModel extends Model {

    protected $k_id_on_air;
    protected $n_nombre_estacion_eb;
    protected $n_tecnologia;
    protected $n_banda;
    protected $n_tipo_trabajo;
    protected $n_estado_eb_resucomen;
    protected $comentario_resucoment;
    protected $hora_actualizacion_resucomen;
    protected $usuario_resucomen;
    protected $ente_ejecutor;
    protected $tipificacion_resucomen;
    protected $noc;
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "reporte_comentario";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdOnAir($k_id_on_air) {
        $this->k_id_on_air = $k_id_on_air;
    }

    public function getKIdOnAir() {
        return $this->k_id_on_air;
    }

    public function setNNombreEstacionEb($n_nombre_estacion_eb) {
        $this->n_nombre_estacion_eb = $n_nombre_estacion_eb;
    }

    public function getNNombreEstacionEb() {
        return $this->n_nombre_estacion_eb;
    }

    public function setNTecnologia($n_tecnologia) {
        $this->n_tecnologia = $n_tecnologia;
    }

    public function getNTecnologia() {
        return $this->n_tecnologia;
    }

    public function setNBanda($n_banda) {
        $this->n_banda = $n_banda;
    }

    public function getNBanda() {
        return $this->n_banda;
    }

    public function setNTipoTrabajo($n_tipo_trabajo) {
        $this->n_tipo_trabajo = $n_tipo_trabajo;
    }

    public function getNTipoTrabajo() {
        return $this->n_tipo_trabajo;
    }

    public function setNEstadoEbResucomen($n_estado_eb_resucomen) {
        $this->n_estado_eb_resucomen = $n_estado_eb_resucomen;
    }

    public function getNEstadoEbResucomen() {
        return $this->n_estado_eb_resucomen;
    }

    public function setComentarioResucoment($comentario_resucoment) {
        $this->comentario_resucoment = $comentario_resucoment;
    }

    public function getComentarioResucoment() {
        return $this->comentario_resucoment;
    }

    public function setHoraActualizacionResucomen($hora_actualizacion_resucomen) {
        $this->hora_actualizacion_resucomen = $hora_actualizacion_resucomen;
    }

    public function getHoraActualizacionResucomen() {
        return $this->hora_actualizacion_resucomen;
    }

    public function setUsuarioResucomen($usuario_resucomen) {
        $this->usuario_resucomen = $usuario_resucomen;
    }

    public function getUsuarioResucomen() {
        return $this->usuario_resucomen;
    }

    public function setEnteEjecutor($ente_ejecutor) {
        $this->ente_ejecutor = $ente_ejecutor;
    }

    public function getEnteEjecutor() {
        return $this->ente_ejecutor;
    }

    public function setTipificacionResucomen($tipificacion_resucomen) {
        $this->tipificacion_resucomen = $tipificacion_resucomen;
    }

    public function getTipificacionResucomen() {
        return $this->tipificacion_resucomen;
    }

    public function setNoc($noc) {
        $this->noc = $noc;
    }

    public function getNoc() {
        return $this->noc;
    }
}
