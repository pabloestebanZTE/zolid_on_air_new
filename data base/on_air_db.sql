create database on_air;
use on_air;


/*==============================================================*/
/* dbms name:      mysql 5.0                                    */
/* created on:     10/28/2017 12:45:07 pm                       */
/*==============================================================*/


drop table if exists band;

drop table if exists city;

drop table if exists follow_up_12h;

drop table if exists follow_up_24h;

drop table if exists follow_up_36h;

drop table if exists on_air24h;

drop table if exists on_air_12h;

drop table if exists on_air_36h;

drop table if exists precheck;

drop table if exists preparation_stage;

drop table if exists regional;

drop table if exists scaled;

drop table if exists scaled_on_air;

drop table if exists station;

drop table if exists status;

drop table if exists status_on_air;

drop table if exists substatus;

drop table if exists technology;

drop table if exists ticket_on_air;

drop table if exists user;

drop table if exists work;

/*==============================================================*/
/* table: band                                                  */
/*==============================================================*/
create table band
(
   k_id_band            int not null,
   n_name_band          varchar(50) not null,
   primary key (k_id_band)
);

/*==============================================================*/
/* table: city                                                  */
/*==============================================================*/
create table city
(
   k_id_city            int not null,
   k_id_regional        int,
   n_name_city          varchar(100) not null,
   primary key (k_id_city)
);

/*==============================================================*/
/* table: follow_up_12h                                         */
/*==============================================================*/
create table follow_up_12h
(
   k_id_follow_up_12h   int not null AUTO_INCREMENT,
   k_id_user            int,
   primary key (k_id_follow_up_12h)
);

/*==============================================================*/
/* table: follow_up_24h                                         */
/*==============================================================*/
create table follow_up_24h
(
   k_id_follow_up_24h   int not null AUTO_INCREMENT,
   k_id_user            int,
   primary key (k_id_follow_up_24h)
);

/*==============================================================*/
/* table: follow_up_36h                                         */
/*==============================================================*/
create table follow_up_36h
(
   k_id_follow_up_36h   int not null AUTO_INCREMENT,
   k_id_user            int,
   primary key (k_id_follow_up_36h)
);

/*==============================================================*/
/* table: on_air24h                                             */
/*==============================================================*/
create table on_air24h
(
   k_id_24h_real        int not null AUTO_INCREMENT,
   k_id_onair           int,
   k_id_follow_up_24h   int,
   d_fin24h             datetime,
   primary key (k_id_24h_real)
);

/*==============================================================*/
/* table: on_air_12h                                            */
/*==============================================================*/
create table on_air_12h
(
   k_id_12h_real        int not null AUTO_INCREMENT,
   k_id_follow_up_12h   int,
   k_id_onair           int,
   d_fin12h             date,
   primary key (k_id_12h_real)
);

/*==============================================================*/
/* table: on_air_36h                                            */
/*==============================================================*/
create table on_air_36h
(
   k_id_36h_real        int not null AUTO_INCREMENT,
   k_id_follow_up_36h   int,
   k_id_onair           int,
   d_fin36h             datetime,
   primary key (k_id_36h_real)
);

/*==============================================================*/
/* table: precheck                                              */
/*==============================================================*/
create table precheck
(
   k_id_precheck        int not null AUTO_INCREMENT,
   k_id_user            int,
   d_finpre             datetime,
   primary key (k_id_precheck)
);

/*==============================================================*/
/* table: preparation_stage                                     */
/*==============================================================*/
create table preparation_stage
(
   k_id_preparation     int not null AUTO_INCREMENT,
   n_bcf_wbts_id        varchar(100),
   n_bts_id             varchar(100),
   d_ingreso_on_air     datetime,
   b_vistamm            boolean,
   n_enteejecutor       varchar(100),
   n_controlador        varchar(100),
   n_idcontrolador      varchar(100),
   d_correccionespendientes datetime,
   n_btsipaddress       varchar(100),
   n_integrador         varchar(100),
   n_wp                 varchar(100),
   n_crq                varchar(100),
   n_testgestion        varchar(100),
   n_sitiolimpio        varchar(100),
   n_instalacion_hw_sitio varchar(100),
   n_cambios_config_solicitados varchar(100),
   n_cambios_config_final varchar(100),
   n_contratista      varchar(100),
   n_comentarioccial  varchar(100),
   n_ticketremedy     varchar(100),
   n_lac                varchar(100),
   n_rac                varchar(100),
   n_sac                varchar(100),
   n_integracion_gestion_y_trafica varchar(100),
   puesta_servicio_sitio_nuevo_lte varchar(100),
   n_instalacion_hw_4g_sitio varchar(100),
   pre_launch           varchar(100),
   n_evidenciasl      varchar(100),
   idenciasl          varchar(100),
   i_week               int,
   id_notificacion    varchar(100),
   id_documentacion   varchar(100),
   id_rftools         varchar(100),
   primary key (k_id_preparation)
);

/*==============================================================*/
/* table: regional                                              */
/*==============================================================*/
create table regional
(
   k_id_regional        int not null,
   n_name_regional      varchar(100) not null,
   primary key (k_id_regional)
);

/*==============================================================*/
/* table: scaled                                                */
/*==============================================================*/
create table scaled
(
   k_id_sacled          int not null AUTO_INCREMENT,
   primary key (k_id_sacled)
);

/*==============================================================*/
/* table: scaled_on_air                                         */
/*==============================================================*/
create table scaled_on_air
(
   k_id_scaled_on_air   int not null AUTO_INCREMENT,
   k_id_onair           int,
   k_id_sacled          int,
   d_time_escalado    datetime,
   d_fecha_escalado     datetime,
   i_cont_esc_imp       int,
   time_esc_imp         int,
   i_cont_esc_rf      int,
   i_time_esc_rf       int,
   cont_esc_npo       int,
   i_time_esc_npo      int,
   cont_esc_care      int,
   i_time_esc_care    int,
   i_cont_esc_gdrt    int,
   i_time_esc_gdrt    int,
   i_cont_esc_oym     int,
   time_esc_oym       int,
   cont_esc_calidad   int,
   i_time_esc_calidad int,
   n_tipificacion_solucion varchar(100),
   n_detalle_solucion   varchar(300),
   n_ultimo_subestado_de_escalamiento varchar(100),
   primary key (k_id_scaled_on_air)
);

/*==============================================================*/
/* table: station                                               */
/*==============================================================*/
create table station
(
   k_id_station         int not null,
   k_id_city            int,
   n_name_station       varchar(100) not null,
   primary key (k_id_station)
);

/*==============================================================*/
/* table: status                                                */
/*==============================================================*/
create table status
(
   k_id_status          int not null,
   n_name_status        varchar(100) not null,
   primary key (k_id_status)
);

/*==============================================================*/
/* table: status_on_air                                         */
/*==============================================================*/
create table status_on_air
(
   k_id_status_onair    int not null,
   k_id_substatus       int,
   k_id_status          int,
   primary key (k_id_status_onair)
);

/*==============================================================*/
/* table: substatus                                             */
/*==============================================================*/
create table substatus
(
   k_id_substatus       int not null,
   n_name_substatus     varchar(100) not null,
   primary key (k_id_substatus)
);

/*==============================================================*/
/* table: technology                                            */
/*==============================================================*/
create table technology
(
   k_id_technology      int not null,
   n_name_technology    varchar(50) not null,
   primary key (k_id_technology)
);

/*==============================================================*/
/* table: ticket_on_air                                         */
/*==============================================================*/
create table ticket_on_air
(
   k_id_onair           int not null AUTO_INCREMENT,
   k_id_status_onair    int,
   k_id_work            int,
   k_id_preparation     int,
   k_id_station         int,
   k_id_technology      int,
   k_id_band            int,
   k_id_precheck        int,
   b_excpetion_gri      bool,
   d_fecha_ultima_rev   datetime,
   d_desbloqueo         datetime,
   d_bloqueo            datetime,
   n_reviewedfo         varchar(100),
   d_fechaproduccion    datetime,
   n_sectoresbloqueados varchar(100),
   n_sectoresdesbloqueados varchar(100),
   n_estadoonair        varchar(100),
   n_atribuible_nokia varchar(100),
   n_kpis_degraded    varchar(10),
   n_atribuible_nokia2  varchar(100),
   n_kpi1               varchar(100),
   n_kpi2               varchar(100),
   n_kpi3               varchar(100),
   n_kpi4               varchar(100),
   i_valor_kpi1         int,
   i_valor_kpi2         int,
   i_valor_kpi3         int,
   i_valor_kpi4         int,
   n_alarma1            varchar(20),
   n_alarma2            varchar(20),
   n_alarma3            varchar(20),
   n_alarma4            varchar(20),
   i_cont_total_escalamiento int,
   i_time_total_escalamiento int,
   i_lider_cambio       int,
   i_lider_cuadrilla    int,
   n_implementacion_campo varchar(20),
   n_doc              varchar(20),
   n_gestion_power    varchar(20),
   n_obra_civil       varchar(20),
   on_air             varchar(20),
   fecha_rft          datetime,
   d_fecha_cg           datetime,
   n_exclusion_bajo_trafico varchar(100),
   n_ticket           varchar(100),
   n_estado_ticket    varchar(100),
   n_sln_modernizacion varchar(100),
   n_en_prorroga      varchar(100),
   n_cont_prorrogas   int,
   n_noc                varchar(100),
   primary key (k_id_onair)
);

/*==============================================================*/
/* table: user                                                  */
/*==============================================================*/
-- Volcando estructura para tabla on_air.user
CREATE TABLE IF NOT EXISTS `user` (
  `k_id_user` int(11) NOT NULL,
  `n_name_user` varchar(150) NOT NULL,
  `n_last_name_user` varchar(150) NOT NULL,
  `n_username_user` varchar(100) NOT NULL,
  `n_mail_user` varchar(100) DEFAULT NULL,
  `i_phone_user` int(11) DEFAULT NULL,
  `i_cellphone_user` int(11) DEFAULT NULL,
  `n_password` varchar(30) DEFAULT NULL,
  `n_role_user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`k_id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* table: work                                                  */
/*==============================================================*/
create table work
(
   k_id_work            int not null,
   n_name_ork           varchar(200) not null,
   primary key (k_id_work)
);

alter table city add constraint fk_city_reg foreign key (k_id_regional)
      references regional (k_id_regional) on delete restrict on update restrict;

alter table follow_up_12h add constraint fk_12h_user foreign key (k_id_user)
      references user (k_id_user) on delete restrict on update restrict;

alter table follow_up_24h add constraint fk_24h_user foreign key (k_id_user)
      references user (k_id_user) on delete restrict on update restrict;

alter table follow_up_36h add constraint fk_36h_user foreign key (k_id_user)
      references user (k_id_user) on delete restrict on update restrict;

alter table on_air24h add constraint fk_follow_24h foreign key (k_id_follow_up_24h)
      references follow_up_24h (k_id_follow_up_24h) on delete restrict on update restrict;

alter table on_air24h add constraint fk_on_air_24h foreign key (k_id_onair)
      references ticket_on_air (k_id_onair) on delete restrict on update restrict;

alter table on_air_12h add constraint fk_follow_12h foreign key (k_id_follow_up_12h)
      references follow_up_12h (k_id_follow_up_12h) on delete restrict on update restrict;

alter table on_air_12h add constraint fk_on_air_12h foreign key (k_id_onair)
      references ticket_on_air (k_id_onair) on delete restrict on update restrict;

alter table on_air_36h add constraint fk_follow_36 foreign key (k_id_follow_up_36h)
      references follow_up_36h (k_id_follow_up_36h) on delete restrict on update restrict;

alter table on_air_36h add constraint fk_on_air_36h foreign key (k_id_onair)
      references ticket_on_air (k_id_onair) on delete restrict on update restrict;

alter table precheck add constraint fk_precheck_user foreign key (k_id_user)
      references user (k_id_user) on delete restrict on update restrict;

alter table scaled_on_air add constraint fk_on_air_scaled foreign key (k_id_onair)
      references ticket_on_air (k_id_onair) on delete restrict on update restrict;

alter table scaled_on_air add constraint fk_scaled_real foreign key (k_id_sacled)
      references scaled (k_id_sacled) on delete restrict on update restrict;

alter table station add constraint fk_station_city foreign key (k_id_city)
      references city (k_id_city) on delete restrict on update restrict;

alter table status_on_air add constraint fk_status_onair foreign key (k_id_substatus)
      references substatus (k_id_substatus) on delete restrict on update restrict;

alter table status_on_air add constraint fk_substatus_onair foreign key (k_id_status)
      references status (k_id_status) on delete restrict on update restrict;

alter table ticket_on_air add constraint fk_on_air_band foreign key (k_id_band)
      references band (k_id_band) on delete restrict on update restrict;

alter table ticket_on_air add constraint fk_on_air_precheck foreign key (k_id_precheck)
      references precheck (k_id_precheck) on delete restrict on update restrict;

alter table ticket_on_air add constraint fk_on_air_prep_stage foreign key (k_id_preparation)
      references preparation_stage (k_id_preparation) on delete restrict on update restrict;

alter table ticket_on_air add constraint fk_on_air_station foreign key (k_id_station)
      references station (k_id_station) on delete restrict on update restrict;

alter table ticket_on_air add constraint fk_on_air_status foreign key (k_id_status_onair)
      references status_on_air (k_id_status_onair) on delete restrict on update restrict;

alter table ticket_on_air add constraint fk_on_air_technology foreign key (k_id_technology)
      references technology (k_id_technology) on delete restrict on update restrict;

alter table ticket_on_air add constraint fk_on_air_work foreign key (k_id_work)
      references work (k_id_work) on delete restrict on update restrict;
