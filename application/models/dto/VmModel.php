<?php

class VmModel extends Model {

    protected $k_id_vm;
    protected $k_id_station;
    protected $k_id_technology;
    protected $k_id_band;
    protected $k_id_work;
    protected $d_fecha_solicitud;
    protected $n_hora_solicitud;
    protected $i_id_site_access;
    protected $n_enteejecutor;
    protected $n_persona_solicita;
    protected $n_nombre_grupo_skype;
    protected $n_regional_skype;
    protected $n_hora_apertura_grupo;
    protected $n_incidente;
    protected $i_ingeniero_creador_grupo;
    protected $n_estado_vm;
    protected $n_motivo_estado;
    protected $i_ingeniero_control;
    protected $n_hora_revision;
    protected $n_comentario_punto_control;
    protected $i_ingeniero_apertura;
    protected $i_ingeniero_punto_control;
    protected $i_ingeniero_cierre;
    protected $n_fase_ventana;
    protected $n_asignado;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "vm";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdVm($k_id_vm) {
        $this->k_id_vm = $k_id_vm;
    }
    public function getKIdVm() {
        return $this->k_id_vm;
    }
    public function setKIdStation($k_id_station) {
        $this->k_id_station = $k_id_station;
    }
    public function getKIdStation() {
        return $this->k_id_station;
    }
    public function setKIdTechnology($k_id_technology) {
        $this->k_id_technology = $k_id_technology;
    }
    public function getKIdTechnology() {
        return $this->k_id_technology;
    }
    public function setKIdBand($k_id_band) {
        $this->k_id_band = $k_id_band;
    }
    public function getKIdBand() {
        return $this->k_id_band;
    }
    public function setKIdWork($k_id_work) {
        $this->k_id_work = $k_id_work;
    }
    public function getKIdWork() {
        return $this->k_id_work;
    }
    public function setDFechaSolicitud($d_fecha_solicitud) {
        $this->d_fecha_solicitud = $d_fecha_solicitud;
    }
    public function getDFechaSolicitud() {
        return $this->d_fecha_solicitud;
    }
    public function setNHoraSolicitud($n_hora_solicitud) {
        $this->n_hora_solicitud = $n_hora_solicitud;
    }
    public function getNHoraSolicitud() {
        return $this->n_hora_solicitud;
    }
    public function setIIdSiteAccess($i_id_site_access) {
        $this->i_id_site_access = $i_id_site_access;
    }
    public function getIIdSiteAccess() {
        return $this->i_id_site_access;
    }
    public function setNEnteejecutor($n_enteejecutor) {
        $this->n_enteejecutor = $n_enteejecutor;
    }
    public function getNEnteejecutor() {
        return $this->n_enteejecutor;
    }
    public function setNPersonaSolicita($n_persona_solicita) {
        $this->n_persona_solicita = $n_persona_solicita;
    }
    public function getNPersonaSolicita() {
        return $this->n_persona_solicita;
    }
    public function setNNombreGrupoSkype($n_nombre_grupo_skype) {
        $this->n_nombre_grupo_skype = $n_nombre_grupo_skype;
    }
    public function getNNombreGrupoSkype() {
        return $this->n_nombre_grupo_skype;
    }
    public function setNRegionalSkype($n_regional_skype) {
        $this->n_regional_skype = $n_regional_skype;
    }
    public function getNRegionalSkype() {
        return $this->n_regional_skype;
    }
    public function setNHoraAperturaGrupo($n_hora_apertura_grupo) {
        $this->n_hora_apertura_grupo = $n_hora_apertura_grupo;
    }
    public function getNHoraAperturaGrupo() {
        return $this->n_hora_apertura_grupo;
    }
    public function setNIncidente($n_incidente) {
        $this->n_incidente = $n_incidente;
    }
    public function getNIncidente() {
        return $this->n_incidente;
    }
    public function setIIngenieroCreadorGrupo($i_ingeniero_creador_grupo) {
        $this->i_ingeniero_creador_grupo = $i_ingeniero_creador_grupo;
    }
    public function getIIngenieroCreadorGrupo() {
        return $this->i_ingeniero_creador_grupo;
    }
    public function setNEstadoVm($n_estado_vm) {
        $this->n_estado_vm = $n_estado_vm;
    }
    public function getNEstadoVm() {
        return $this->n_estado_vm;
    }
    public function setNMotivoEstado($n_motivo_estado) {
        $this->n_motivo_estado = $n_motivo_estado;
    }
    public function getNMotivoEstado() {
        return $this->n_motivo_estado;
    }
    public function setIIngenieroControl($i_ingeniero_control) {
        $this->i_ingeniero_control = $i_ingeniero_control;
    }
    public function getIIngenieroControl() {
        return $this->i_ingeniero_control;
    }
    public function setNHoraRevision($n_hora_revision) {
        $this->n_hora_revision = $n_hora_revision;
    }
    public function getNHoraRevision() {
        return $this->n_hora_revision;
    }
    public function setNComentarioPuntoControl($n_comentario_punto_control) {
        $this->n_comentario_punto_control = $n_comentario_punto_control;
    }
    public function getNComentarioPuntoControl() {
        return $this->n_comentario_punto_control;
    }
    public function setIIngenieroApertura($i_ingeniero_apertura) {
        $this->i_ingeniero_apertura = $i_ingeniero_apertura;
    }
    public function getIIngenieroApertura() {
        return $this->i_ingeniero_apertura;
    }
    public function setIIngenieroPuntoControl($i_ingeniero_punto_control) {
        $this->i_ingeniero_punto_control = $i_ingeniero_punto_control;
    }
    public function getIIngenieroPuntoControl() {
        return $this->i_ingeniero_punto_control;
    }
    public function setIIngenieroCierre($i_ingeniero_cierre) {
        $this->i_ingeniero_cierre = $i_ingeniero_cierre;
    }
    public function getIIngenieroCierre() {
        return $this->i_ingeniero_cierre;
    }
    public function setNFaseVentana($n_fase_ventana) {
        $this->n_fase_ventana = $n_fase_ventana;
    }
    public function getNFaseVentana() {
        return $this->n_fase_ventana;
    }
    public function setNAsignado($n_asignado) {
        $this->n_asignado = $n_asignado;
    }
    public function getNAsignado() {
        return $this->n_asignado;
    }


}

