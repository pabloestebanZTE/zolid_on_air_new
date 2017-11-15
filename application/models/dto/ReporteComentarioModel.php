<?php

class ReporteComentarioModel extends Model {

    protected $k_id_reporte;
    protected $estacion;
    protected $bcf_wbts_id;
    protected $bts_id;
    protected $tecnologia;
    protected $bandas;
    protected $estado;
    protected $subestado;
    protected $excepciongri;
    protected $fechanotificacion;
    protected $onair;
    protected $tipotrabajo;
    protected $fechaproduccion;
    protected $sectoresbloqueados;
    protected $sectoresdesbloqueados;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "reporte_comentario";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdReporte($k_id_reporte) {
        $this->k_id_reporte = $k_id_reporte;
    }
    public function getKIdReporte() {
        return $this->k_id_reporte;
    }
    public function setEstacion($estacion) {
        $this->estacion = $estacion;
    }
    public function getEstacion() {
        return $this->estacion;
    }
    public function setBcfWbtsId($bcf_wbts_id) {
        $this->bcf_wbts_id = $bcf_wbts_id;
    }
    public function getBcfWbtsId() {
        return $this->bcf_wbts_id;
    }
    public function setBtsId($bts_id) {
        $this->bts_id = $bts_id;
    }
    public function getBtsId() {
        return $this->bts_id;
    }
    public function setTecnologia($tecnologia) {
        $this->tecnologia = $tecnologia;
    }
    public function getTecnologia() {
        return $this->tecnologia;
    }
    public function setBandas($bandas) {
        $this->bandas = $bandas;
    }
    public function getBandas() {
        return $this->bandas;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function setSubestado($subestado) {
        $this->subestado = $subestado;
    }
    public function getSubestado() {
        return $this->subestado;
    }
    public function setExcepciongri($excepciongri) {
        $this->excepciongri = $excepciongri;
    }
    public function getExcepciongri() {
        return $this->excepciongri;
    }
    public function setFechanotificacion($fechanotificacion) {
        $this->fechanotificacion = $fechanotificacion;
    }
    public function getFechanotificacion() {
        return $this->fechanotificacion;
    }
    public function setOnair($onair) {
        $this->onair = $onair;
    }
    public function getOnair() {
        return $this->onair;
    }
    public function setTipotrabajo($tipotrabajo) {
        $this->tipotrabajo = $tipotrabajo;
    }
    public function getTipotrabajo() {
        return $this->tipotrabajo;
    }
    public function setFechaproduccion($fechaproduccion) {
        $this->fechaproduccion = $fechaproduccion;
    }
    public function getFechaproduccion() {
        return $this->fechaproduccion;
    }
    public function setSectoresbloqueados($sectoresbloqueados) {
        $this->sectoresbloqueados = $sectoresbloqueados;
    }
    public function getSectoresbloqueados() {
        return $this->sectoresbloqueados;
    }
    public function setSectoresdesbloqueados($sectoresdesbloqueados) {
        $this->sectoresdesbloqueados = $sectoresdesbloqueados;
    }
    public function getSectoresdesbloqueados() {
        return $this->sectoresdesbloqueados;
    }


}

