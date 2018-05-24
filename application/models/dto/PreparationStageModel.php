<?php

class PreparationStageModel extends Model {

    protected $k_id_preparation;
    protected $n_bcf_wbts_id;
    protected $n_bts_id;
    protected $d_ingreso_on_air;
    protected $b_vistamm;
    protected $n_enteejecutor;
    protected $n_controlador;
    protected $n_idcontrolador;
    protected $d_correccionespendientes;
    protected $n_btsipaddress;
    protected $n_integrador;
    protected $n_wp;
    protected $n_crq;
    protected $n_testgestion;
    protected $n_sitiolimpio;
    protected $n_instalacion_hw_sitio;
    protected $n_cambios_config_solicitados;
    protected $n_cambios_config_final;
    protected $n_contratista;
    protected $n_comentarioccial;
    protected $n_ticketremedy;
    protected $n_lac;
    protected $n_rac;
    protected $n_sac;
    protected $n_integracion_gestion_y_trafica;
    protected $puesta_servicio_sitio_nuevo_lte;
    protected $n_instalacion_hw_4g_sitio;
    protected $pre_launch;
    protected $n_evidenciasl;
    protected $idenciasl;
    protected $i_week;
    protected $id_notificacion;
    protected $id_documentacion;
    protected $id_rftools;
    protected $n_evidenciatg;
    protected $n_comentario_doc;
    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "preparation_stage";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdPreparation($k_id_preparation) {
        $this->k_id_preparation = $k_id_preparation;
    }

    public function getKIdPreparation() {
        return $this->k_id_preparation;
    }

    public function setNBcfWbtsId($n_bcf_wbts_id) {
        $this->n_bcf_wbts_id = $n_bcf_wbts_id;
    }

    public function getNBcfWbtsId() {
        return $this->n_bcf_wbts_id;
    }

    public function setNBtsId($n_bts_id) {
        $this->n_bts_id = $n_bts_id;
    }

    public function getNBtsId() {
        return $this->n_bts_id;
    }

    public function setDIngresoOnAir($d_ingreso_on_air) {
        $this->d_ingreso_on_air = $d_ingreso_on_air;
    }

    public function getDIngresoOnAir() {
        return $this->d_ingreso_on_air;
    }

    public function setBVistamm($b_vistamm) {
        $this->b_vistamm = $b_vistamm;
    }

    public function getBVistamm() {
        return $this->b_vistamm;
    }

    public function setNEnteejecutor($n_enteejecutor) {
        $this->n_enteejecutor = $n_enteejecutor;
    }

    public function getNEnteejecutor() {
        return $this->n_enteejecutor;
    }

    public function setNControlador($n_controlador) {
        $this->n_controlador = $n_controlador;
    }

    public function getNControlador() {
        return $this->n_controlador;
    }

    public function setNIdcontrolador($n_idcontrolador) {
        $this->n_idcontrolador = $n_idcontrolador;
    }

    public function getNIdcontrolador() {
        return $this->n_idcontrolador;
    }

    public function setDCorreccionespendientes($d_correccionespendientes) {
        $this->d_correccionespendientes = $d_correccionespendientes;
    }

    public function getDCorreccionespendientes() {
        return $this->d_correccionespendientes;
    }

    public function setNBtsipaddress($n_btsipaddress) {
        $this->n_btsipaddress = $n_btsipaddress;
    }

    public function getNBtsipaddress() {
        return $this->n_btsipaddress;
    }

    public function setNIntegrador($n_integrador) {
        $this->n_integrador = $n_integrador;
    }

    public function getNIntegrador() {
        return $this->n_integrador;
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

    public function setNTestgestion($n_testgestion) {
        $this->n_testgestion = $n_testgestion;
    }

    public function getNTestgestion() {
        return $this->n_testgestion;
    }

    public function setNSitiolimpio($n_sitiolimpio) {
        $this->n_sitiolimpio = $n_sitiolimpio;
    }

    public function getNSitiolimpio() {
        return $this->n_sitiolimpio;
    }

    public function setNInstalacionHwSitio($n_instalacion_hw_sitio) {
        $this->n_instalacion_hw_sitio = $n_instalacion_hw_sitio;
    }

    public function getNInstalacionHwSitio() {
        return $this->n_instalacion_hw_sitio;
    }

    public function setNCambiosConfigSolicitados($n_cambios_config_solicitados) {
        $this->n_cambios_config_solicitados = $n_cambios_config_solicitados;
    }

    public function getNCambiosConfigSolicitados() {
        return $this->n_cambios_config_solicitados;
    }

    public function setNCambiosConfigFinal($n_cambios_config_final) {
        $this->n_cambios_config_final = $n_cambios_config_final;
    }

    public function getNCambiosConfigFinal() {
        return $this->n_cambios_config_final;
    }

    public function setNContratista($n_contratista__) {
        $this->n_contratista = $n_contratista__;
    }

    public function getNContratista() {
        return $this->n_contratista;
    }

    public function setNComentarioccial($n_comentarioccial__) {
        $this->n_comentarioccial = $n_comentarioccial__;
    }

    public function getNComentarioccial() {
        return $this->n_comentarioccial;
    }

    public function setNTicketremedy($n_ticketremedy) {
        $this->n_ticketremedy = $n_ticketremedy;
    }

    public function getNTicketremedy() {
        return $this->n_ticketremedy;
    }

    public function setNLac($n_lac) {
        $this->n_lac = $n_lac;
    }

    public function getNLac() {
        return $this->n_lac;
    }

    public function setNRac($n_rac) {
        $this->n_rac = $n_rac;
    }

    public function getNRac() {
        return $this->n_rac;
    }

    public function setNSac($n_sac) {
        $this->n_sac = $n_sac;
    }

    public function getNSac() {
        return $this->n_sac;
    }

    public function setNIntegracionGestionYTrafica($n_integracion_gestion_y_trafica) {
        $this->n_integracion_gestion_y_trafica = $n_integracion_gestion_y_trafica;
    }

    public function getNIntegracionGestionYTrafica() {
        return $this->n_integracion_gestion_y_trafica;
    }

    public function setPuestaServicioSitioNuevoLte($puesta_servicio_sitio_nuevo_lte) {
        $this->puesta_servicio_sitio_nuevo_lte = $puesta_servicio_sitio_nuevo_lte;
    }

    public function getPuestaServicioSitioNuevoLte() {
        return $this->puesta_servicio_sitio_nuevo_lte;
    }

    public function setNInstalacionHw4gSitio($n_instalacion_hw_4g_sitio) {
        $this->n_instalacion_hw_4g_sitio = $n_instalacion_hw_4g_sitio;
    }

    public function getNInstalacionHw4gSitio() {
        return $this->n_instalacion_hw_4g_sitio;
    }

    public function setPreLaunch($pre_launch) {
        $this->pre_launch = $pre_launch;
    }

    public function getPreLaunch() {
        return $this->pre_launch;
    }

    public function setNEvidenciasl($n_evidenciasl) {
        $this->n_evidenciasl = $n_evidenciasl;
    }

    public function getNEvidenciasl() {
        return $this->n_evidenciasl;
    }

    public function setIdenciasl($idenciasl) {
        $this->idenciasl = $idenciasl;
    }

    public function getIdenciasl() {
        return $this->idenciasl;
    }

    public function setIWeek($i_week) {
        $this->i_week = $i_week;
    }

    public function getIWeek() {
        return $this->i_week;
    }

    public function setIdNotificacion($id_notificacion) {
        $this->id_notificacion = $id_notificacion;
    }

    public function getIdNotificacion() {
        return $this->id_notificacion;
    }

    public function setIdDocumentacion($id_documentacion) {
        $this->id_documentacion = $id_documentacion;
    }

    public function getIdDocumentacion() {
        return $this->id_documentacion;
    }

    public function setIdRftools($id_rftools) {
        $this->id_rftools = $id_rftools;
    }

    public function getIdRftools() {
        return $this->id_rftools;
    }

    public function setNEvidenciatg($n_evidenciatg__) {
        $this->n_evidenciatg__ = $n_evidenciatg__;
    }

    public function getNEvidenciatg() {
        return $this->n_evidenciatg__;
    }

    public function setNComentarioDoc($n_comentario_doc) {
        $this->n_comentario_doc = $n_comentario_doc;
    }

    public function getNComentarioDoc() {
        return $this->n_comentario_doc;
    }

}
