<?php

class TiketRemedyModel extends Model {

    protected $k_id_tiket_remedy;
    protected $k_id_vm;
    protected $n_numero_incidente;
    protected $n_estado_ticket;
    protected $i_ingeniero_apertura_ticket;
    protected $n_tipo_afectacion;
    protected $n_grupo_soporte;
    protected $d_inicio_afectacion;
    protected $n_responsable_oym;
    protected $n_responsable_ticket;
    protected $n_summary_remedy;
    protected $n_fm_claro;
    protected $n_fm_nokia;
    protected $n_comentario_ticket;
    protected $i_ingeniero_cierre_ticket;
    protected $d_fin_afectacion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "tiket_remedy";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdTiketRemedy($k_id_tiket_remedy) {
        $this->k_id_tiket_remedy = $k_id_tiket_remedy;
    }
    public function getKIdTiketRemedy() {
        return $this->k_id_tiket_remedy;
    }
    public function setKIdVm($k_id_vm) {
        $this->k_id_vm = $k_id_vm;
    }
    public function getKIdVm() {
        return $this->k_id_vm;
    }
    public function setNNumeroIncidente($n_numero_incidente) {
        $this->n_numero_incidente = $n_numero_incidente;
    }
    public function getNNumeroIncidente() {
        return $this->n_numero_incidente;
    }
    public function setNEstadoTicket($n_estado_ticket) {
        $this->n_estado_ticket = $n_estado_ticket;
    }
    public function getNEstadoTicket() {
        return $this->n_estado_ticket;
    }
    public function setIIngenieroAperturaTicket($i_ingeniero_apertura_ticket) {
        $this->i_ingeniero_apertura_ticket = $i_ingeniero_apertura_ticket;
    }
    public function getIIngenieroAperturaTicket() {
        return $this->i_ingeniero_apertura_ticket;
    }
    public function setNTipoAfectacion($n_tipo_afectacion) {
        $this->n_tipo_afectacion = $n_tipo_afectacion;
    }
    public function getNTipoAfectacion() {
        return $this->n_tipo_afectacion;
    }
    public function setNGrupoSoporte($n_grupo_soporte) {
        $this->n_grupo_soporte = $n_grupo_soporte;
    }
    public function getNGrupoSoporte() {
        return $this->n_grupo_soporte;
    }
    public function setDInicioAfectacion($d_inicio_afectacion) {
        $this->d_inicio_afectacion = $d_inicio_afectacion;
    }
    public function getDInicioAfectacion() {
        return $this->d_inicio_afectacion;
    }
    public function setNResponsableOym($n_responsable_oym) {
        $this->n_responsable_oym = $n_responsable_oym;
    }
    public function getNResponsableOym() {
        return $this->n_responsable_oym;
    }
    public function setNResponsableTicket($n_responsable_ticket) {
        $this->n_responsable_ticket = $n_responsable_ticket;
    }
    public function getNResponsableTicket() {
        return $this->n_responsable_ticket;
    }
    public function setNSummaryRemedy($n_summary_remedy) {
        $this->n_summary_remedy = $n_summary_remedy;
    }
    public function getNSummaryRemedy() {
        return $this->n_summary_remedy;
    }
    public function setNFmClaro($n_fm_claro) {
        $this->n_fm_claro = $n_fm_claro;
    }
    public function getNFmClaro() {
        return $this->n_fm_claro;
    }
    public function setNFmNokia($n_fm_nokia) {
        $this->n_fm_nokia = $n_fm_nokia;
    }
    public function getNFmNokia() {
        return $this->n_fm_nokia;
    }
    public function setNComentarioTicket($n_comentario_ticket) {
        $this->n_comentario_ticket = $n_comentario_ticket;
    }
    public function getNComentarioTicket() {
        return $this->n_comentario_ticket;
    }
    public function setIIngenieroCierreTicket($i_ingeniero_cierre_ticket) {
        $this->i_ingeniero_cierre_ticket = $i_ingeniero_cierre_ticket;
    }
    public function getIIngenieroCierreTicket() {
        return $this->i_ingeniero_cierre_ticket;
    }
    public function setDFinAfectacion($d_fin_afectacion) {
        $this->d_fin_afectacion = $d_fin_afectacion;
    }
    public function getDFinAfectacion() {
        return $this->d_fin_afectacion;
    }


}

