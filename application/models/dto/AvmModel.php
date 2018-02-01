<?php

class AvmModel extends Model {

    protected $k_id_avm;
    protected $k_id_vm;
    protected $k_tecnologia_afectada;
    protected $k_banda_afectada;
    protected $i_ingeniero_apertura;
    protected $d_inicio_programado_sa;
    protected $d_fin_programado_sa;
    protected $n_persona_solicita_vmlc;
    protected $n_enteejecutor;
    protected $n_fm_nokia;
    protected $n_fm_claro;
    protected $i_telefono_fm;
    protected $n_wp;
    protected $n_crq;
    protected $n_id_rftools;
    protected $n_bsc_name;
    protected $n_rnc_name;
    protected $n_servidor_mss;
    protected $n_regional_cluster;
    protected $n_integrador_backoffice;
    protected $n_lider_cuadrilla_vm;
    protected $i_telefono_lider_cuadrilla;
    protected $b_vistamm;
    protected $n_hora_atencion_vm;
    protected $n_hora_inicio_real_vm;
    protected $n_contratista;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "avm";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdAvm($k_id_avm) {
        $this->k_id_avm = $k_id_avm;
    }
    public function getKIdAvm() {
        return $this->k_id_avm;
    }
    public function setKIdVm($k_id_vm) {
        $this->k_id_vm = $k_id_vm;
    }
    public function getKIdVm() {
        return $this->k_id_vm;
    }
    public function setKTecnologiaAfectada($k_tecnologia_afectada) {
        $this->k_tecnologia_afectada = $k_tecnologia_afectada;
    }
    public function getKTecnologiaAfectada() {
        return $this->k_tecnologia_afectada;
    }
    public function setKBandaAfectada($k_banda_afectada) {
        $this->k_banda_afectada = $k_banda_afectada;
    }
    public function getKBandaAfectada() {
        return $this->k_banda_afectada;
    }
    public function setIIngenieroApertura($i_ingeniero_apertura) {
        $this->i_ingeniero_apertura = $i_ingeniero_apertura;
    }
    public function getIIngenieroApertura() {
        return $this->i_ingeniero_apertura;
    }
    public function setDInicioProgramadoSa($d_inicio_programado_sa) {
        $this->d_inicio_programado_sa = $d_inicio_programado_sa;
    }
    public function getDInicioProgramadoSa() {
        return $this->d_inicio_programado_sa;
    }
    public function setDFinProgramadoSa($d_fin_programado_sa) {
        $this->d_fin_programado_sa = $d_fin_programado_sa;
    }
    public function getDFinProgramadoSa() {
        return $this->d_fin_programado_sa;
    }
    public function setNPersonaSolicitaVmlc($n_persona_solicita_vmlc) {
        $this->n_persona_solicita_vmlc = $n_persona_solicita_vmlc;
    }
    public function getNPersonaSolicitaVmlc() {
        return $this->n_persona_solicita_vmlc;
    }
    public function setNEnteejecutor($n_enteejecutor) {
        $this->n_enteejecutor = $n_enteejecutor;
    }
    public function getNEnteejecutor() {
        return $this->n_enteejecutor;
    }
    public function setNFmNokia($n_fm_nokia) {
        $this->n_fm_nokia = $n_fm_nokia;
    }
    public function getNFmNokia() {
        return $this->n_fm_nokia;
    }
    public function setNFmClaro($n_fm_claro) {
        $this->n_fm_claro = $n_fm_claro;
    }
    public function getNFmClaro() {
        return $this->n_fm_claro;
    }
    public function setITelefonoFm($i_telefono_fm) {
        $this->i_telefono_fm = $i_telefono_fm;
    }
    public function getITelefonoFm() {
        return $this->i_telefono_fm;
    }
    public function setNWp($n_wp) {
        $this->n_wp = $n_wp;
    }
    public function getNWp() {
        return $this->n_wp;
    }
    public function setNCrq($n_crq) {
        $this->n_crq = $n_crq;
    }
    public function getNCrq() {
        return $this->n_crq;
    }
    public function setNIdRftools($n_id_rftools) {
        $this->n_id_rftools = $n_id_rftools;
    }
    public function getNIdRftools() {
        return $this->n_id_rftools;
    }
    public function setNBscName($n_bsc_name) {
        $this->n_bsc_name = $n_bsc_name;
    }
    public function getNBscName() {
        return $this->n_bsc_name;
    }
    public function setNRncName($n_rnc_name) {
        $this->n_rnc_name = $n_rnc_name;
    }
    public function getNRncName() {
        return $this->n_rnc_name;
    }
    public function setNServidorMss($n_servidor_mss) {
        $this->n_servidor_mss = $n_servidor_mss;
    }
    public function getNServidorMss() {
        return $this->n_servidor_mss;
    }
    public function setNRegionalCluster($n_regional_cluster) {
        $this->n_regional_cluster = $n_regional_cluster;
    }
    public function getNRegionalCluster() {
        return $this->n_regional_cluster;
    }
    public function setNIntegradorBackoffice($n_integrador_backoffice) {
        $this->n_integrador_backoffice = $n_integrador_backoffice;
    }
    public function getNIntegradorBackoffice() {
        return $this->n_integrador_backoffice;
    }
    public function setNLiderCuadrillaVm($n_lider_cuadrilla_vm) {
        $this->n_lider_cuadrilla_vm = $n_lider_cuadrilla_vm;
    }
    public function getNLiderCuadrillaVm() {
        return $this->n_lider_cuadrilla_vm;
    }
    public function setITelefonoLiderCuadrilla($i_telefono_lider_cuadrilla) {
        $this->i_telefono_lider_cuadrilla = $i_telefono_lider_cuadrilla;
    }
    public function getITelefonoLiderCuadrilla() {
        return $this->i_telefono_lider_cuadrilla;
    }
    public function setBVistamm($b_vistamm) {
        $this->b_vistamm = $b_vistamm;
    }
    public function getBVistamm() {
        return $this->b_vistamm;
    }
    public function setNHoraAtencionVm($n_hora_atencion_vm) {
        $this->n_hora_atencion_vm = $n_hora_atencion_vm;
    }
    public function getNHoraAtencionVm() {
        return $this->n_hora_atencion_vm;
    }
    public function setNHoraInicioRealVm($n_hora_inicio_real_vm) {
        $this->n_hora_inicio_real_vm = $n_hora_inicio_real_vm;
    }
    public function getNHoraInicioRealVm() {
        return $this->n_hora_inicio_real_vm;
    }
    public function setNContratista($n_contratista) {
        $this->n_contratista = $n_contratista;
    }
    public function getNContratista() {
        return $this->n_contratista;
    }


}

