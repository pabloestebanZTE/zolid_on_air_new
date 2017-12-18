/*==============================================================*/
/* dbms name:      mysql 5.0                                    */
/* created on:     14/12/2017 2:44:04 p. m.                     */
/*==============================================================*/


drop table if exists avm;

drop table if exists checklist;

drop table if exists checklist_vm;

drop table if exists cvm;

drop table if exists vm;


/*==============================================================*/
/* table: avm                                                   */
/*==============================================================*/
create table avm
(
   k_id_avm             int(11) not null auto_increment,
   k_id_vm              int(11) default null,
   k_tecnologia_afectada int(11) default null,
   k_banda_afectada     int(11) default null,
   i_ingeniero_apertura int(11) default null,
   d_inicio_programado_sa datetime default null,
   d_fin_programado_sa  datetime default null,
   n_persona_solicita_vmlc varchar(100) default null,
   n_enteejecutor       varchar(100) default null,
   n_fm_nokia           varchar(100) default null,
   n_fm_claro           varchar(100) default null,
   i_telefono_fm        int(11) default null,
   n_wp                 varchar(100) default null,
   n_crq                varchar(100) default null,
   n_id_rftools         varchar(100) default null,
   n_bsc_name           varchar(100) default null,
   n_rnc_name           varchar(100) default null,
   n_servidor_mss       varchar(100) default null,
   n_regional_cluster   varchar(100) default null,
   n_integrador_backoffice varchar(100) default null,
   n_lider_cuadrilla_vm varchar(100) default null,
   i_telefono_lider_cuadrilla int(11) default null,
   b_vistamm            varchar(100) default null,
   n_hora_atencion_vm   varchar(100) default null,
   n_hora_inicio_real_vm varchar(100) default null,
   n_contratista         varchar(500) default null,
   primary key (k_id_avm)
);

/*==============================================================*/
/* table: checklist                                             */
/*==============================================================*/
create table checklist
(
   k_id_checklist       int(11) not null auto_increment,
   n_nombre             varchar(100) default null,
   k_id_technology      int(11) default null,
   k_id_work            int(11) default null,
   primary key (k_id_checklist)
);

/*==============================================================*/
/* table: checklist_vm                                          */
/*==============================================================*/
create table checklist_vm
(
   k_id_checklist_vm    int(11) not null auto_increment,
   k_id_vm              int(11) default null,
   k_id_checklist       int(11) default null,
   n_estado             varchar(100) default null,
   primary key (k_id_checklist_vm)
);

/*==============================================================*/
/* table: cvm                                                   */
/*==============================================================*/
create table cvm
(
   k_id_cvm             int(11) not null auto_increment,
   k_id_vm              int(11) default null,
   n_ret                varchar(100) default null,
   n_ampliacion_dualbeam varchar(100) default null,
   n_sectores_dualbeam  varchar(100) default null,
   n_tipo_solucion      varchar(100) default null,
   i_telefono_lider_cambio int(11) default null,
   n_estado_vm_cierre   varchar(100) default null,
   n_sub_estado         varchar(100) default null,
   n_iniciar_vm_encontro varchar(100) default null,
   n_falla_final        varchar(100) default null,
   n_tipo_falla_final   varchar(100) default null,
   b_vistamm            varchar(100) default null,
   n_estado_notificacion varchar(100) default null,
   i_ingeniero_cierre   int(11) default null,
   d_hora_atencion_cierre varchar(100) default null,
   d_hora_cierre_confirmado varchar(100) default null,
   n_comentarios_cierre varchar(500) default null,
   primary key (k_id_cvm)
);

/*==============================================================*/
/* table: vm                                                    */
/*==============================================================*/
create table vm
(
   k_id_vm              int(11) not null auto_increment,
   k_id_station         int(11) default null,
   k_id_technology      int(11) default null,
   k_id_band            int(11) default null,
   k_id_work            int(11) default null,
   d_fecha_solicitud    datetime default null,
   i_id_site_access     int(11) default null,
   n_enteejecutor       varchar(100) default null,
   n_persona_solicita   varchar(100) default null,
   n_nombre_grupo_skype varchar(100) default null,
   n_regional_skype     varchar(100) default null,
   n_hora_apertura_grupo varchar(100) default null,
   n_incidente          varchar(100) default null,
   i_ingeniero_creador_grupo int(11) default null,
   n_estado_vm          varchar(100) default null,
   n_motivo_estado      varchar(100) default null,
   i_ingeniero_control  int(11) default null,
   n_hora_revision      varchar(100) default null,
   n_comentario_punto_control varchar(500) default null,
   primary key (k_id_vm)
);

alter table avm add constraint fk_avm_vm foreign key (k_id_vm)
      references vm (k_id_vm) on delete restrict on update restrict;

alter table avm add constraint fk_avm_technology foreign key (k_tecnologia_afectada)
      references technology (k_id_technology) on delete restrict on update restrict;

alter table avm add constraint fk_avm_band foreign key (k_banda_afectada)
      references band (k_id_band) on delete restrict on update restrict;
      
alter table checklist add constraint fk_ch_technology foreign key (k_id_technology)
      references technology (k_id_technology) on delete restrict on update restrict;

alter table checklist add constraint fk_ch_work foreign key (k_id_work)
      references work (k_id_work) on delete restrict on update restrict;

alter table checklist_vm add constraint fk_chvm_checklist foreign key (k_id_checklist)
      references checklist (k_id_checklist) on delete restrict on update restrict;

alter table checklist_vm add constraint fk_chvm_vm foreign key (k_id_vm)
      references vm (k_id_vm) on delete restrict on update restrict;

alter table cvm add constraint fk_cvm_vm foreign key (k_id_vm)
      references vm (k_id_vm) on delete restrict on update restrict;

alter table vm add constraint fk_vm_station foreign key (k_id_station)
      references station (k_id_station) on delete restrict on update restrict;

alter table vm add constraint fk_vm_technology foreign key (k_id_technology)
      references technology (k_id_technology) on delete restrict on update restrict;

alter table vm add constraint fk_vm_band foreign key (k_id_band)
      references band (k_id_band) on delete restrict on update restrict;

alter table vm add constraint fk_vm_work foreign key (k_id_work)
      references work (k_id_work) on delete restrict on update restrict;