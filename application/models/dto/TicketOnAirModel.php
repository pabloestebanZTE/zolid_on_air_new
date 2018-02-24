<?php

class TicketOnAirModel extends Model {

    protected $k_id_onair;
    protected $k_id_status_onair;
    protected $k_id_work;
    protected $k_id_preparation;
    protected $k_id_station;
    protected $k_id_technology;
    protected $k_id_band;
    protected $k_id_precheck;
    protected $b_excpetion_gri;
    protected $d_fecha_ultima_rev;
    protected $d_desbloqueo;
    protected $d_bloqueo;
    protected $n_reviewedfo;
    protected $d_fechaproduccion;
    protected $n_estado_sectores;
    protected $n_sectoresbloqueados;
    protected $n_sectoresdesbloqueados;
    protected $n_json_sectores;
    protected $n_estadoonair;
    protected $n_atribuible_nokia;
    protected $n_kpis_degraded;
    protected $n_atribuible_nokia2;
    protected $n_kpi1;
    protected $n_kpi2;
    protected $n_kpi3;
    protected $n_kpi4;
    protected $i_valor_kpi1;
    protected $i_valor_kpi2;
    protected $i_valor_kpi3;
    protected $i_valor_kpi4;
    protected $n_alarma1;
    protected $n_alarma2;
    protected $n_alarma3;
    protected $n_alarma4;
    protected $i_cont_total_escalamiento;
    protected $i_time_total_escalamiento;
    protected $i_lider_cambio;
    protected $i_lider_cuadrilla;
    protected $n_implementacion_campo;
    protected $n_doc;
    protected $n_gestion_power;
    protected $n_obra_civil;
    protected $on_air;
    protected $fecha_rft;
    protected $d_fecha_cg;
    protected $n_exclusion_bajo_trafico;
    protected $n_ticket;
    protected $n_estado_ticket;
    protected $n_sln_modernizacion;
    protected $n_en_prorroga;
    protected $n_cont_prorrogas;
    protected $n_noc;
    protected $n_round;
    protected $d_finish;
    protected $d_temporal;
    protected $d_actualizacion_final;
    protected $d_asignacion_final;
    protected $i_precheck_realizado;
    protected $n_comentario_coor;
    protected $i_actualEngineer;
    protected $i_priority;
    protected $d_precheck_init;
    protected $i_prorroga_hours;
    protected $d_created_at;
    protected $n_implementacion_remota;
    protected $data_standby;
    protected $d_t_from_notif;
    protected $d_t_from_asign;
    protected $n_ola;
    protected $n_ola_excedido;
    protected $k_id_solicitante_reinicio;
    protected $n_ola_areas;
    protected $n_ola_areas_excedido;
    protected $n_comentario_sectores;
    protected $n_responsable_ticket;
    protected $n_persona_solicita_notificacion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "ticket_on_air";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdOnair($k_id_onair) {
        $this->k_id_onair = $k_id_onair;
    }
    public function getKIdOnair() {
        return $this->k_id_onair;
    }
    public function setKIdStatusOnair($k_id_status_onair) {
        $this->k_id_status_onair = $k_id_status_onair;
    }
    public function getKIdStatusOnair() {
        return $this->k_id_status_onair;
    }
    public function setKIdWork($k_id_work) {
        $this->k_id_work = $k_id_work;
    }
    public function getKIdWork() {
        return $this->k_id_work;
    }
    public function setKIdPreparation($k_id_preparation) {
        $this->k_id_preparation = $k_id_preparation;
    }
    public function getKIdPreparation() {
        return $this->k_id_preparation;
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
    public function setKIdPrecheck($k_id_precheck) {
        $this->k_id_precheck = $k_id_precheck;
    }
    public function getKIdPrecheck() {
        return $this->k_id_precheck;
    }
    public function setBExcpetionGri($b_excpetion_gri) {
        $this->b_excpetion_gri = $b_excpetion_gri;
    }
    public function getBExcpetionGri() {
        return $this->b_excpetion_gri;
    }
    public function setDFechaUltimaRev($d_fecha_ultima_rev) {
        $this->d_fecha_ultima_rev = $d_fecha_ultima_rev;
    }
    public function getDFechaUltimaRev() {
        return $this->d_fecha_ultima_rev;
    }
    public function setDDesbloqueo($d_desbloqueo) {
        $this->d_desbloqueo = $d_desbloqueo;
    }
    public function getDDesbloqueo() {
        return $this->d_desbloqueo;
    }
    public function setDBloqueo($d_bloqueo) {
        $this->d_bloqueo = $d_bloqueo;
    }
    public function getDBloqueo() {
        return $this->d_bloqueo;
    }
    public function setNReviewedfo($n_reviewedfo) {
        $this->n_reviewedfo = $n_reviewedfo;
    }
    public function getNReviewedfo() {
        return $this->n_reviewedfo;
    }
    public function setDFechaproduccion($d_fechaproduccion) {
        $this->d_fechaproduccion = $d_fechaproduccion;
    }
    public function getDFechaproduccion() {
        return $this->d_fechaproduccion;
    }
    public function setNEstadoSectores($n_estado_sectores) {
        $this->n_estado_sectores = $n_estado_sectores;
    }
    public function getNEstadoSectores() {
        return $this->n_estado_sectores;
    }
    public function setNSectoresbloqueados($n_sectoresbloqueados) {
        $this->n_sectoresbloqueados = $n_sectoresbloqueados;
    }
    public function getNSectoresbloqueados() {
        return $this->n_sectoresbloqueados;
    }
    public function setNSectoresdesbloqueados($n_sectoresdesbloqueados) {
        $this->n_sectoresdesbloqueados = $n_sectoresdesbloqueados;
    }
    public function getNSectoresdesbloqueados() {
        return $this->n_sectoresdesbloqueados;
    }
    public function setNJsonSectores($n_json_sectores) {
        $this->n_json_sectores = $n_json_sectores;
    }
    public function getNJsonSectores() {
        return $this->n_json_sectores;
    }
    public function setNEstadoonair($n_estadoonair) {
        $this->n_estadoonair = $n_estadoonair;
    }
    public function getNEstadoonair() {
        return $this->n_estadoonair;
    }
    public function setNAtribuibleNokia($n_atribuible_nokia) {
        $this->n_atribuible_nokia = $n_atribuible_nokia;
    }
    public function getNAtribuibleNokia() {
        return $this->n_atribuible_nokia;
    }
    public function setNKpisDegraded($n_kpis_degraded) {
        $this->n_kpis_degraded = $n_kpis_degraded;
    }
    public function getNKpisDegraded() {
        return $this->n_kpis_degraded;
    }
    public function setNAtribuibleNokia2($n_atribuible_nokia2) {
        $this->n_atribuible_nokia2 = $n_atribuible_nokia2;
    }
    public function getNAtribuibleNokia2() {
        return $this->n_atribuible_nokia2;
    }
    public function setNKpi1($n_kpi1) {
        $this->n_kpi1 = $n_kpi1;
    }
    public function getNKpi1() {
        return $this->n_kpi1;
    }
    public function setNKpi2($n_kpi2) {
        $this->n_kpi2 = $n_kpi2;
    }
    public function getNKpi2() {
        return $this->n_kpi2;
    }
    public function setNKpi3($n_kpi3) {
        $this->n_kpi3 = $n_kpi3;
    }
    public function getNKpi3() {
        return $this->n_kpi3;
    }
    public function setNKpi4($n_kpi4) {
        $this->n_kpi4 = $n_kpi4;
    }
    public function getNKpi4() {
        return $this->n_kpi4;
    }
    public function setIValorKpi1($i_valor_kpi1) {
        $this->i_valor_kpi1 = $i_valor_kpi1;
    }
    public function getIValorKpi1() {
        return $this->i_valor_kpi1;
    }
    public function setIValorKpi2($i_valor_kpi2) {
        $this->i_valor_kpi2 = $i_valor_kpi2;
    }
    public function getIValorKpi2() {
        return $this->i_valor_kpi2;
    }
    public function setIValorKpi3($i_valor_kpi3) {
        $this->i_valor_kpi3 = $i_valor_kpi3;
    }
    public function getIValorKpi3() {
        return $this->i_valor_kpi3;
    }
    public function setIValorKpi4($i_valor_kpi4) {
        $this->i_valor_kpi4 = $i_valor_kpi4;
    }
    public function getIValorKpi4() {
        return $this->i_valor_kpi4;
    }
    public function setNAlarma1($n_alarma1) {
        $this->n_alarma1 = $n_alarma1;
    }
    public function getNAlarma1() {
        return $this->n_alarma1;
    }
    public function setNAlarma2($n_alarma2) {
        $this->n_alarma2 = $n_alarma2;
    }
    public function getNAlarma2() {
        return $this->n_alarma2;
    }
    public function setNAlarma3($n_alarma3) {
        $this->n_alarma3 = $n_alarma3;
    }
    public function getNAlarma3() {
        return $this->n_alarma3;
    }
    public function setNAlarma4($n_alarma4) {
        $this->n_alarma4 = $n_alarma4;
    }
    public function getNAlarma4() {
        return $this->n_alarma4;
    }
    public function setIContTotalEscalamiento($i_cont_total_escalamiento) {
        $this->i_cont_total_escalamiento = $i_cont_total_escalamiento;
    }
    public function getIContTotalEscalamiento() {
        return $this->i_cont_total_escalamiento;
    }
    public function setITimeTotalEscalamiento($i_time_total_escalamiento) {
        $this->i_time_total_escalamiento = $i_time_total_escalamiento;
    }
    public function getITimeTotalEscalamiento() {
        return $this->i_time_total_escalamiento;
    }
    public function setILiderCambio($i_lider_cambio) {
        $this->i_lider_cambio = $i_lider_cambio;
    }
    public function getILiderCambio() {
        return $this->i_lider_cambio;
    }
    public function setILiderCuadrilla($i_lider_cuadrilla) {
        $this->i_lider_cuadrilla = $i_lider_cuadrilla;
    }
    public function getILiderCuadrilla() {
        return $this->i_lider_cuadrilla;
    }
    public function setNImplementacionCampo($n_implementacion_campo) {
        $this->n_implementacion_campo = $n_implementacion_campo;
    }
    public function getNImplementacionCampo() {
        return $this->n_implementacion_campo;
    }
    public function setNDoc($n_doc) {
        $this->n_doc = $n_doc;
    }
    public function getNDoc() {
        return $this->n_doc;
    }
    public function setNGestionPower($n_gestion_power) {
        $this->n_gestion_power = $n_gestion_power;
    }
    public function getNGestionPower() {
        return $this->n_gestion_power;
    }
    public function setNObraCivil($n_obra_civil) {
        $this->n_obra_civil = $n_obra_civil;
    }
    public function getNObraCivil() {
        return $this->n_obra_civil;
    }
    public function setOnAir($on_air) {
        $this->on_air = $on_air;
    }
    public function getOnAir() {
        return $this->on_air;
    }
    public function setFechaRft($fecha_rft) {
        $this->fecha_rft = $fecha_rft;
    }
    public function getFechaRft() {
        return $this->fecha_rft;
    }
    public function setDFechaCg($d_fecha_cg) {
        $this->d_fecha_cg = $d_fecha_cg;
    }
    public function getDFechaCg() {
        return $this->d_fecha_cg;
    }
    public function setNExclusionBajoTrafico($n_exclusion_bajo_trafico) {
        $this->n_exclusion_bajo_trafico = $n_exclusion_bajo_trafico;
    }
    public function getNExclusionBajoTrafico() {
        return $this->n_exclusion_bajo_trafico;
    }
    public function setNTicket($n_ticket) {
        $this->n_ticket = $n_ticket;
    }
    public function getNTicket() {
        return $this->n_ticket;
    }
    public function setNEstadoTicket($n_estado_ticket) {
        $this->n_estado_ticket = $n_estado_ticket;
    }
    public function getNEstadoTicket() {
        return $this->n_estado_ticket;
    }
    public function setNSlnModernizacion($n_sln_modernizacion) {
        $this->n_sln_modernizacion = $n_sln_modernizacion;
    }
    public function getNSlnModernizacion() {
        return $this->n_sln_modernizacion;
    }
    public function setNEnProrroga($n_en_prorroga) {
        $this->n_en_prorroga = $n_en_prorroga;
    }
    public function getNEnProrroga() {
        return $this->n_en_prorroga;
    }
    public function setNContProrrogas($n_cont_prorrogas) {
        $this->n_cont_prorrogas = $n_cont_prorrogas;
    }
    public function getNContProrrogas() {
        return $this->n_cont_prorrogas;
    }
    public function setNNoc($n_noc) {
        $this->n_noc = $n_noc;
    }
    public function getNNoc() {
        return $this->n_noc;
    }
    public function setNRound($n_round) {
        $this->n_round = $n_round;
    }
    public function getNRound() {
        return $this->n_round;
    }
    public function setDFinish($d_finish) {
        $this->d_finish = $d_finish;
    }
    public function getDFinish() {
        return $this->d_finish;
    }
    public function setDTemporal($d_temporal) {
        $this->d_temporal = $d_temporal;
    }
    public function getDTemporal() {
        return $this->d_temporal;
    }
    public function setDActualizacionFinal($d_actualizacion_final) {
        $this->d_actualizacion_final = $d_actualizacion_final;
    }
    public function getDActualizacionFinal() {
        return $this->d_actualizacion_final;
    }
    public function setDAsignacionFinal($d_asignacion_final) {
        $this->d_asignacion_final = $d_asignacion_final;
    }
    public function getDAsignacionFinal() {
        return $this->d_asignacion_final;
    }
    public function setIPrecheckRealizado($i_precheck_realizado) {
        $this->i_precheck_realizado = $i_precheck_realizado;
    }
    public function getIPrecheckRealizado() {
        return $this->i_precheck_realizado;
    }
    public function setNComentarioCoor($n_comentario_coor) {
        $this->n_comentario_coor = $n_comentario_coor;
    }
    public function getNComentarioCoor() {
        return $this->n_comentario_coor;
    }
    public function setIActualEngineer($i_actualEngineer) {
        $this->i_actualEngineer = $i_actualEngineer;
    }
    public function getIActualEngineer() {
        return $this->i_actualEngineer;
    }
    public function setIPriority($i_priority) {
        $this->i_priority = $i_priority;
    }
    public function getIPriority() {
        return $this->i_priority;
    }
    public function setDPrecheckInit($d_precheck_init) {
        $this->d_precheck_init = $d_precheck_init;
    }
    public function getDPrecheckInit() {
        return $this->d_precheck_init;
    }
    public function setIProrrogaHours($i_prorroga_hours) {
        $this->i_prorroga_hours = $i_prorroga_hours;
    }
    public function getIProrrogaHours() {
        return $this->i_prorroga_hours;
    }
    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }
    public function getDCreatedAt() {
        return $this->d_created_at;
    }
    public function setNImplementacionRemota($n_implementacion_remota) {
        $this->n_implementacion_remota = $n_implementacion_remota;
    }
    public function getNImplementacionRemota() {
        return $this->n_implementacion_remota;
    }
    public function setDataStandby($data_standby) {
        $this->data_standby = $data_standby;
    }
    public function getDataStandby() {
        return $this->data_standby;
    }
    public function setDTFromNotif($d_t_from_notif) {
        $this->d_t_from_notif = $d_t_from_notif;
    }
    public function getDTFromNotif() {
        return $this->d_t_from_notif;
    }
    public function setDTFromAsign($d_t_from_asign) {
        $this->d_t_from_asign = $d_t_from_asign;
    }
    public function getDTFromAsign() {
        return $this->d_t_from_asign;
    }
    public function setNOla($n_ola) {
        $this->n_ola = $n_ola;
    }
    public function getNOla() {
        return $this->n_ola;
    }
    public function setNOlaExcedido($n_ola_excedido) {
        $this->n_ola_excedido = $n_ola_excedido;
    }
    public function getNOlaExcedido() {
        return $this->n_ola_excedido;
    }
    public function setKIdSolicitanteReinicio($k_id_solicitante_reinicio) {
        $this->k_id_solicitante_reinicio = $k_id_solicitante_reinicio;
    }
    public function getKIdSolicitanteReinicio() {
        return $this->k_id_solicitante_reinicio;
    }
    public function setNOlaAreas($n_ola_areas) {
        $this->n_ola_areas = $n_ola_areas;
    }
    public function getNOlaAreas() {
        return $this->n_ola_areas;
    }
    public function setNOlaAreasExcedido($n_ola_areas_excedido) {
        $this->n_ola_areas_excedido = $n_ola_areas_excedido;
    }
    public function getNOlaAreasExcedido() {
        return $this->n_ola_areas_excedido;
    }
    public function setNComentarioSectores($n_comentario_sectores) {
        $this->n_comentario_sectores = $n_comentario_sectores;
    }
    public function getNComentarioSectores() {
        return $this->n_comentario_sectores;
    }
    public function setNResponsableTicket($n_responsable_ticket) {
        $this->n_responsable_ticket = $n_responsable_ticket;
    }
    public function getNResponsableTicket() {
        return $this->n_responsable_ticket;
    }
    public function setNPersonaSolicitaNotificacion($n_persona_solicita_notificacion) {
        $this->n_persona_solicita_notificacion = $n_persona_solicita_notificacion;
    }
    public function getNPersonaSolicitaNotificacion() {
        return $this->n_persona_solicita_notificacion;
    }


}

