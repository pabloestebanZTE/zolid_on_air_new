<?php

class ScaledOnAirModel extends Model {

    protected $k_id_scaled_on_air;
    protected $k_id_onair;
    protected $k_id_sacled;
    protected $d_time_escalado;
    protected $d_fecha_escalado;
    protected $i_cont_esc_imp;
    protected $time_esc_imp;
    protected $i_cont_esc_rf;
    protected $i_time_esc_rf;
    protected $cont_esc_npo;
    protected $i_time_esc_npo;
    protected $cont_esc_care;
    protected $i_time_esc_care;
    protected $i_cont_esc_gdrt;
    protected $i_time_esc_gdrt;
    protected $i_cont_esc_oym;
    protected $time_esc_oym;
    protected $cont_esc_calidad;
    protected $i_time_esc_calidad;
    protected $n_tipificacion_solucion;
    protected $n_detalle_solucion;
    protected $n_ultimo_subestado_de_escalamiento;
    protected $n_round;
    protected $n_atribuible_nokia2;
    protected $n_atribuible_nokia;
    protected $n_comentario_esc;
    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "scaled_on_air";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdScaledOnAir($k_id_scaled_on_air) {
        $this->k_id_scaled_on_air = $k_id_scaled_on_air;
    }

    public function getKIdScaledOnAir() {
        return $this->k_id_scaled_on_air;
    }

    public function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }

    public function getKIdOnair() {
        return $this->k_id_onair;
    }

    public function setKIdSacled($k_id_sacled) {
        $this->k_id_sacled = $k_id_sacled;
    }

    public function getKIdSacled() {
        return $this->k_id_sacled;
    }

    public function setDTimeEscalado($d_time_escalado) {
        $this->d_time_escalado = $d_time_escalado;
    }

    public function getDTimeEscalado() {
        return $this->d_time_escalado;
    }

    public function setDFechaEscalado($d_fecha_escalado) {
        $this->d_fecha_escalado = $d_fecha_escalado;
    }

    public function getDFechaEscalado() {
        return $this->d_fecha_escalado;
    }

    public function setIContEscImp($i_cont_esc_imp) {
        $this->i_cont_esc_imp = $i_cont_esc_imp;
    }

    public function getIContEscImp() {
        return $this->i_cont_esc_imp;
    }

    public function setTimeEscImp($time_esc_imp) {
        $this->time_esc_imp = $time_esc_imp;
    }

    public function getTimeEscImp() {
        return $this->time_esc_imp;
    }

    public function setIContEscRf($i_cont_esc_rf) {
        $this->i_cont_esc_rf = $i_cont_esc_rf;
    }

    public function getIContEscRf() {
        return $this->i_cont_esc_rf;
    }

    public function setITimeEscRf($i_time_esc_rf) {
        $this->i_time_esc_rf = $i_time_esc_rf;
    }

    public function getITimeEscRf() {
        return $this->i_time_esc_rf;
    }

    public function setContEscNpo($cont_esc_npo) {
        $this->cont_esc_npo = $cont_esc_npo;
    }

    public function getContEscNpo() {
        return $this->cont_esc_npo;
    }

    public function setITimeEscNpo($i_time_esc_npo) {
        $this->i_time_esc_npo = $i_time_esc_npo;
    }

    public function getITimeEscNpo() {
        return $this->i_time_esc_npo;
    }

    public function setContEscCare($cont_esc_care) {
        $this->cont_esc_care = $cont_esc_care;
    }

    public function getContEscCare() {
        return $this->cont_esc_care;
    }

    public function setITimeEscCare($i_time_esc_care) {
        $this->i_time_esc_care = $i_time_esc_care;
    }

    public function getITimeEscCare() {
        return $this->i_time_esc_care;
    }

    public function setIContEscGdrt($i_cont_esc_gdrt) {
        $this->i_cont_esc_gdrt = $i_cont_esc_gdrt;
    }

    public function getIContEscGdrt() {
        return $this->i_cont_esc_gdrt;
    }

    public function setITimeEscGdrt($i_time_esc_gdrt) {
        $this->i_time_esc_gdrt = $i_time_esc_gdrt;
    }

    public function getITimeEscGdrt() {
        return $this->i_time_esc_gdrt;
    }

    public function setIContEscOym($i_cont_esc_oym) {
        $this->i_cont_esc_oym = $i_cont_esc_oym;
    }

    public function getIContEscOym() {
        return $this->i_cont_esc_oym;
    }

    public function setTimeEscOym($time_esc_oym) {
        $this->time_esc_oym = $time_esc_oym;
    }

    public function getTimeEscOym() {
        return $this->time_esc_oym;
    }

    public function setContEscCalidad($cont_esc_calidad) {
        $this->cont_esc_calidad = $cont_esc_calidad;
    }

    public function getContEscCalidad() {
        return $this->cont_esc_calidad;
    }

    public function setITimeEscCalidad($i_time_esc_calidad) {
        $this->i_time_esc_calidad = $i_time_esc_calidad;
    }

    public function getITimeEscCalidad() {
        return $this->i_time_esc_calidad;
    }

    public function setNTipificacionSolucion($n_tipificacion_solucion) {
        $this->n_tipificacion_solucion = $n_tipificacion_solucion;
    }

    public function getNTipificacionSolucion() {
        return $this->n_tipificacion_solucion;
    }

    public function setNDetalleSolucion($n_detalle_solucion) {
        $this->n_detalle_solucion = $n_detalle_solucion;
    }

    public function getNDetalleSolucion() {
        return $this->n_detalle_solucion;
    }

    public function setNUltimoSubestadoDeEscalamiento($n_ultimo_subestado_de_escalamiento) {
        $this->n_ultimo_subestado_de_escalamiento = $n_ultimo_subestado_de_escalamiento;
    }

    public function getNUltimoSubestadoDeEscalamiento() {
        return $this->n_ultimo_subestado_de_escalamiento;
    }

    public function setNRound($n_round) {
        $this->n_round = $n_round;
    }

    public function getNRound() {
        return $this->n_round;
    }

    public function setNAtribuibleNokia($n_atribuible_nokia) {
        $this->n_atribuible_nokia = $n_atribuible_nokia;
    }

    public function getNAtribuibleNokia() {
        return $this->n_atribuible_nokia;
    }

    public function setNAtribuibleNokia2($n_atribuible_nokia2) {
        $this->n_atribuible_nokia2 = $n_atribuible_nokia2;
    }

    public function getNAtribuibleNokia2() {
        return $this->n_atribuible_nokia2;
    }

    public function setnComentarioEsc($n_comentario_esc) {
        $this->n_comentario_esc = $n_comentario_esc;
    }

    public function getnComentarioEsc() {
        return $this->n_comentario_esc;
    }

}
