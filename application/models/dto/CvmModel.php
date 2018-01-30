<?php

class CvmModel extends Model {

    protected $k_id_cvm;
    protected $k_id_vm;
    protected $n_ret;
    protected $n_ampliacion_dualbeam;
    protected $n_sectores_dualbeam;
    protected $n_tipo_solucion;
    protected $i_telefono_lider_cambio;
    protected $n_estado_vm_cierre;
    protected $n_sub_estado;
    protected $n_iniciar_vm_encontro;
    protected $n_falla_final;
    protected $n_tipo_falla_final;
    protected $b_vistamm;
    protected $n_estado_notificacion;
    protected $i_ingeniero_cierre;
    protected $d_hora_atencion_cierre;
    protected $d_hora_cierre_confirmado;
    protected $n_comentarios_cierre;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "cvm";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdCvm($k_id_cvm) {
        $this->k_id_cvm = $k_id_cvm;
    }
    public function getKIdCvm() {
        return $this->k_id_cvm;
    }
    public function setKIdVm($k_id_vm) {
        $this->k_id_vm = $k_id_vm;
    }
    public function getKIdVm() {
        return $this->k_id_vm;
    }
    public function setNRet($n_ret) {
        $this->n_ret = $n_ret;
    }
    public function getNRet() {
        return $this->n_ret;
    }
    public function setNAmpliacionDualbeam($n_ampliacion_dualbeam) {
        $this->n_ampliacion_dualbeam = $n_ampliacion_dualbeam;
    }
    public function getNAmpliacionDualbeam() {
        return $this->n_ampliacion_dualbeam;
    }
    public function setNSectoresDualbeam($n_sectores_dualbeam) {
        $this->n_sectores_dualbeam = $n_sectores_dualbeam;
    }
    public function getNSectoresDualbeam() {
        return $this->n_sectores_dualbeam;
    }
    public function setNTipoSolucion($n_tipo_solucion) {
        $this->n_tipo_solucion = $n_tipo_solucion;
    }
    public function getNTipoSolucion() {
        return $this->n_tipo_solucion;
    }
    public function setITelefonoLiderCambio($i_telefono_lider_cambio) {
        $this->i_telefono_lider_cambio = $i_telefono_lider_cambio;
    }
    public function getITelefonoLiderCambio() {
        return $this->i_telefono_lider_cambio;
    }
    public function setNEstadoVmCierre($n_estado_vm_cierre) {
        $this->n_estado_vm_cierre = $n_estado_vm_cierre;
    }
    public function getNEstadoVmCierre() {
        return $this->n_estado_vm_cierre;
    }
    public function setNSubEstado($n_sub_estado) {
        $this->n_sub_estado = $n_sub_estado;
    }
    public function getNSubEstado() {
        return $this->n_sub_estado;
    }
    public function setNIniciarVmEncontro($n_iniciar_vm_encontro) {
        $this->n_iniciar_vm_encontro = $n_iniciar_vm_encontro;
    }
    public function getNIniciarVmEncontro() {
        return $this->n_iniciar_vm_encontro;
    }
    public function setNFallaFinal($n_falla_final) {
        $this->n_falla_final = $n_falla_final;
    }
    public function getNFallaFinal() {
        return $this->n_falla_final;
    }
    public function setNTipoFallaFinal($n_tipo_falla_final) {
        $this->n_tipo_falla_final = $n_tipo_falla_final;
    }
    public function getNTipoFallaFinal() {
        return $this->n_tipo_falla_final;
    }
    public function setBVistamm($b_vistamm) {
        $this->b_vistamm = $b_vistamm;
    }
    public function getBVistamm() {
        return $this->b_vistamm;
    }
    public function setNEstadoNotificacion($n_estado_notificacion) {
        $this->n_estado_notificacion = $n_estado_notificacion;
    }
    public function getNEstadoNotificacion() {
        return $this->n_estado_notificacion;
    }
    public function setIIngenieroCierre($i_ingeniero_cierre) {
        $this->i_ingeniero_cierre = $i_ingeniero_cierre;
    }
    public function getIIngenieroCierre() {
        return $this->i_ingeniero_cierre;
    }
    public function setDHoraAtencionCierre($d_hora_atencion_cierre) {
        $this->d_hora_atencion_cierre = $d_hora_atencion_cierre;
    }
    public function getDHoraAtencionCierre() {
        return $this->d_hora_atencion_cierre;
    }
    public function setDHoraCierreConfirmado($d_hora_cierre_confirmado) {
        $this->d_hora_cierre_confirmado = $d_hora_cierre_confirmado;
    }
    public function getDHoraCierreConfirmado() {
        return $this->d_hora_cierre_confirmado;
    }
    public function setNComentariosCierre($n_comentarios_cierre) {
        $this->n_comentarios_cierre = $n_comentarios_cierre;
    }
    public function getNComentariosCierre() {
        return $this->n_comentarios_cierre;
    }


}

