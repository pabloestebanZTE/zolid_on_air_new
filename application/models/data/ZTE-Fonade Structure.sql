/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     25/04/2017 5:01:24 p.m.                      */
/*==============================================================*/


drop table if exists ADMIN_PVD;

drop table if exists CITY;

drop table if exists CORRECTIVE_MAINTENANCE;

drop table if exists DAMAGE;

drop table if exists DEPARTMENT;

drop table if exists EJECUTOR;

drop table if exists EQUIPMENT;

drop table if exists EQUIPMENT_CATEGORY;

drop table if exists EQUIPMENT_TYPE1;

drop table if exists EQUIPMENT_TYPE2;

drop table if exists MAINTENANCE;

drop table if exists MAINTENANCE_TYPE;

drop table if exists MC_STATUS;

drop table if exists PERMISSION;

drop table if exists PVD;

drop table if exists PVD_PLACE;

drop table if exists PVD_ZONE;

drop table if exists REGION;

drop table if exists TICKET;

drop table if exists TICKET_STATUS;

drop table if exists TYPE_USER;

drop table if exists USER;

drop table if exists USER_PERMISSION;

/*==============================================================*/
/* Table: ADMIN_PVD                                             */
/*==============================================================*/
create table ADMIN_PVD
(
   K_IDADMIN            int not null,
   N_NAME               varchar(200) not null,
   D_STARTDATE          date not null,
   D_ENDDATE            date not null,
   I_PHONE              numeric(20,0) not null,
   N_MAIL               varchar(50) not null,
   N_ENTITYCONTACT      varchar(200) not null,
   I_PHONEENTITYCONTACT numeric(20,0) not null,
   N_MAILENTITYCONTACT  varchar(100) not null,
   primary key (K_IDADMIN)
);

/*==============================================================*/
/* Table: CITY                                                  */
/*==============================================================*/
create table CITY
(
   K_IDCITY             int not null,
   K_IDDEPARTMENT       int,
   N_NAME               varchar(200) not null,
   primary key (K_IDCITY)
);

/*==============================================================*/
/* Table: CORRECTIVE_MAINTENANCE                                */
/*==============================================================*/
create table CORRECTIVE_MAINTENANCE
(
  K_IDCORRECTIVE_MAINTENANCE varchar(14) not null,
   K_IDTICKET           varchar(14),
   K_IDUSER             int,
   K_IDPVD              int,
   K_IDDAMAGE           int,
   K_IDPVDZONE          int,
   K_IDEQUIPMENT        int,
   K_IDSTATUSMC         int,
   Q_QUANTITY           int not null,
   N_DESCRIPTION        varchar(1000) not null,
   N_STUFF              varchar(1000) not null,
   D_STARTDATE          date,
   D_FINISHDATE         date,
   primary key (K_IDCORRECTIVE_MAINTENANCE)
);

/*==============================================================*/
/* Table: DAMAGE                                                */
/*==============================================================*/
create table DAMAGE
(
   K_IDDAMAGE           int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDDAMAGE)
);

/*==============================================================*/
/* Table: DEPARTMENT                                            */
/*==============================================================*/
create table DEPARTMENT
(
   K_IDDEPARTMENT       int not null,
   K_IDREGION           int,
   N_NAME               varchar(200) not null,
   primary key (K_IDDEPARTMENT)
);

/*==============================================================*/
/* Table: EJECUTOR                                              */
/*==============================================================*/
create table EJECUTOR
(
   K_IDEJECUTOR         int not null,
   N_NAME               varchar(200),
   primary key (K_IDEJECUTOR)
);

/*==============================================================*/
/* Table: EQUIPMENT                                             */
/*==============================================================*/
create table EQUIPMENT
(
   K_IDEQUIPMENT        int not null AUTO_INCREMENT,
   K_IDCATEGORYE        int,
   K_IDTYPEE2           int,
   N_NAME               varchar(200) not null,
   N_OTHERTYPE          varchar(200),
   N_SERIAL             varchar(100) not null,
   N_MANUFACTURER       varchar(100) not null,
   N_MODEL              varchar(100) not null,
   primary key (K_IDEQUIPMENT)
);

/*==============================================================*/
/* Table: EQUIPMENT_CATEGORY                                    */
/*==============================================================*/
create table EQUIPMENT_CATEGORY
(
   K_IDCATEGORYE        int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDCATEGORYE)
);

/*==============================================================*/
/* Table: EQUIPMENT_TYPE1                                       */
/*==============================================================*/
create table EQUIPMENT_TYPE1
(
   K_IDTYPEE1           int not null,
   K_IDCATEGORYE        int,
   N_NAME               varchar(200) not null,
   primary key (K_IDTYPEE1)
);

/*==============================================================*/
/* Table: EQUIPMENT_TYPE2                                       */
/*==============================================================*/
create table EQUIPMENT_TYPE2
(
   K_IDTYPEE2           int not null,
   K_IDTYPEE1           int,
   N_NAME               varchar(200) not null,
   primary key (K_IDTYPEE2)
);

/*==============================================================*/
/* Table: MAINTENANCE                                           */
/*==============================================================*/
create table MAINTENANCE
(
   K_IDMAINTENANCE      int not null AUTO_INCREMENT,
   K_IDPVD              int,
   K_IDMAINTENANCET     int,
   D_STARTDATE          date not null,
   primary key (K_IDMAINTENANCE)
);

/*==============================================================*/
/* Table: MAINTENANCE_TYPE                                      */
/*==============================================================*/
create table MAINTENANCE_TYPE
(
   K_IDMAINTENANCET     int not null,
   K_NAME               varchar(150) not null,
   primary key (K_IDMAINTENANCET)
);

/*==============================================================*/
/* Table: MC_STATUS                                             */
/*==============================================================*/
create table MC_STATUS
(
   K_IDSTATUSMC         int not null,
   N_NAME               varchar(200) not null,
   N_DESCRIPTION        varchar(300) not null,
   primary key (K_IDSTATUSMC)
);

/*==============================================================*/
/* Table: PERMISSION                                            */
/*==============================================================*/
create table PERMISSION
(
   K_IDPERMISSION       int not null,
   N_NAME               varchar(200) not null,
   N_DESCRIPTION        varchar(300) not null,
   primary key (K_IDPERMISSION)
);

/*==============================================================*/
/* Table: PVD                                                   */
/*==============================================================*/
create table PVD
(
   K_IDPVD              int not null,
   K_IDCITY             int,
   K_IDEJECUTOR         int,
   K_IDADMIN            int,
   N_NAME               varchar(200) not null,
   N_DIRECCION          varchar(200) not null,
   N_TIPOLOGIA          varchar(2) not null,
   N_FASE               varchar(2) not null,
   primary key (K_IDPVD)
);

/*==============================================================*/
/* Table: PVD_PLACE                                             */
/*==============================================================*/
create table PVD_PLACE
(
   K_IDPVD_PLACE        int not null,
   K_IDPVDZONE          int,
   K_IDPVDT             varchar(2) not null,
   primary key (K_IDPVD_PLACE),
   key AK_IDENTIFIER_1 (K_IDPVDZONE)
);

/*==============================================================*/
/* Table: PVD_ZONE                                              */
/*==============================================================*/
create table PVD_ZONE
(
   K_IDPVDZONE          int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDPVDZONE)
);

/*==============================================================*/
/* Table: REGION                                                */
/*==============================================================*/
create table REGION
(
   K_IDREGION           int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDREGION)
);

/*==============================================================*/
/* Table: TICKET                                                */
/*==============================================================*/
create table TICKET
(
   K_IDTICKET           varchar(14) not null,
   K_IDMAINTENANCE      int,
   K_IDSTATUSTICKET     int,
   D_STARTDATE          date,
   D_FINISHDATE         date,
   I_DURATION           numeric(2,0),
   D_STARTDATEAA        date,
   D_STARTDATEIT        date,
   D_FINISHDATEAA       date,
   D_FINISHDATEIT       date,
   N_COLOR              varchar(20),
   primary key (K_IDTICKET)
);


/*==============================================================*/
/* Table: TICKET_OTHERS                                         */
/*==============================================================*/
create table ticket_others
(
   K_IDTICKETOTHERS     varchar(14) not null,
   D_STARTDATE          date,
   D_FINISHDATE         date,
   I_DURATION           numeric(2,0),
   K_IDPVD              int,
   K_IDTICKET           int,
   N_OBSERVATION_F      varchar(500),
   primary key (K_IDTICKETOTHERS)
);


/*==============================================================*/
/* Table: TICKET_OTHER_STATUS                                         */
/*==============================================================*/
create table ticket_other_status
(
   K_IDSTATUSTICKETO     int not null,
   N_NAME               varchar(200) not null,
   N_DESCRIPTION        varchar(300) not null,
   primary key (K_IDSTATUSTICKETO)
);

/*==============================================================*/
/* Table: TICKET_STATUS                                         */
/*==============================================================*/
create table TICKET_STATUS
(
   K_IDSTATUSTICKET     int not null,
   N_NAME               varchar(200) not null,
   N_DESCRIPTION        varchar(300) not null,
   primary key (K_IDSTATUSTICKET)
);

/*==============================================================*/
/* Table: TICKET_USER                                           */
/*==============================================================*/
create table TICKET_USER
(
   K_IDTICKET           varchar(14) not null,
   K_IDUSER             int not null,
   N_TYPE               varchar(5) not null,
   Q_ESTADIA            int,
   Q_ALMUERZOS          int,
   N_OBSERVATION_F      varchar(500),
   primary key (K_IDTICKET, K_IDUSER)
);

create table ticketo_user
(
   K_IDTICKETO          varchar(14) not null,
   K_IDUSER             int not null,
   primary key (K_IDTICKETO, K_IDUSER)
);

/*==============================================================*/
/* Table: TYPE_USER                                             */
/*==============================================================*/
create table TYPE_USER
(
   K_IDTYPEUSER         int not null,
   N_DESCRIPTION        varchar(300) not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDTYPEUSER)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   K_IDUSER             int not null,
   K_IDTYPEUSER         int,
   N_PASSWORD           varchar(15) not null,
   N_LASTNAME           varchar(80) not null,
   N_NAME               varchar(200) not null,
   N_PROFILEPICTURE     varchar(100),
   primary key (K_IDUSER)
);

/*==============================================================*/
/* Table: USER_PERMISSION                                       */
/*==============================================================*/
create table USER_PERMISSION
(
   K_IDTYPEUSER         int not null,
   K_IDPERMISSION       int not null,
   primary key (K_IDTYPEUSER, K_IDPERMISSION)
);


/*==============================================================*/
/* Table: Phase                                                  */
/*==============================================================*/
create table phase
(
   K_IDPHASE             int not null,
   N_NAME               varchar(200) not null,
   primary key (K_IDPHASE)
);


/*==============================================================*/
/* Table: TYPOLOGY                                              */
/*==============================================================*/
create table typology
(
   K_IDTYPOLOGY             int not null,
   N_NAME                   varchar(200) not null,
   primary key (K_IDTYPOLOGY)
);


/*==============================================================*/
/* Table: TYPOLOGY                                              */
/*==============================================================*/
create table equipment_generic
(
   K_IDEQUIPMENT_GENERIC             int not null,
   N_NAME                   varchar(500) not null,
   primary key (K_IDEQUIPMENT_GENERIC)
);

/*==============================================================*/
/* Table: equipment_type                                        */
/*==============================================================*/
create table equipment_type
(
   K_IDEQUIPMENTTYPE        int not null,
   N_NAME                   varchar(500) not null,
   K_IDTYPOLOGY             int not null,
   K_IDPHASE                int not null,
   I_QUANTITY               int not null,
   K_IDEQUIPMENT_GENERIC    int not null,
   primary key (K_IDEQUIPMENTTYPE)
);


/*==============================================================*/
/* Table: Manufacturer                                          */
/*==============================================================*/
create table manufacturer
(
   K_IDMANUFACTURER                int not null,
   N_NAME                          varchar(200) not null,
   primary key (K_IDMANUFACTURER)
);

/*==============================================================*/
/* Table: Model                                          */
/*==============================================================*/
create table model
(
   K_IDMODEL                int not null,
   N_NAME                   varchar(500) not null,
   K_IDMANUFACTURER         int not null,
   K_IDSTUFF_CATEGORY       int not null,
   primary key (K_IDMODEL)
);

/*==============================================================*/
/* Table: item_checklist                                        */
/*==============================================================*/
create table item_checklist
(
   K_IDITEM_CHECKLIST       int not null,
   N_NAME                   varchar(500) not null,
   primary key (K_IDITEM_CHECKLIST)
);


/*==============================================================*/
/* Table: stuff_category                                        */
/*==============================================================*/
create table stuff_category
(
   K_IDSTUFF_CATEGORY           int not null,
   N_NAME                       varchar(500) not null,
   K_IDEQUIPMENT_GENERIC        int not null,
   V_PRICE_R4                   double(12,2),
   V_PRICE_R1                   double(12,2),
   primary key (K_IDSTUFF_CATEGORY)
);

/*==============================================================*/
/* Table: checklist                                             */
/*==============================================================*/
create table checklist
(
   K_IDCHECKLIST            int not null,
   K_IDEQUIPMENT_GENERIC    int not null,
   K_IDITEM_CHECKLIST       int not null,
   primary key (K_IDCHECKLIST)
);

/*==============================================================*/
/* Table: stuff                                                  */
/*==============================================================*/
create table stuff
(
   K_IDSTUFF                int not null,
   N_NAME                   varchar(200),
   K_IDMODEL                int,
   N_SERIAL                 varchar(200),
   N_PLACAINVENTARIO        varchar(200),
   N_PARTE                  varchar(200),
   N_ESTADO                 varchar(200),
   K_IDPVD_PLACE            int,
   K_IDSTUFF_CATEGORY       int not null,
   K_IDPVD                  int not null,
   Q_PROGRESS               int not null,
   primary key (K_IDSTUFF)
);


/*==============================================================*/
/* Table: ticket_corrective_maintenance                         */
/*==============================================================*/
create table ticket_corrective_maintenance
(
   K_IDTICKET_CORRECTIVE    varchar(20) not null,
   N_DAMAGED_ELEMENTS       varchar(800),
   N_REFERENCE_D_ELEMENTS   varchar(800),
   N_FAILURE_DESCRIPTION    varchar(800),
   N_TEST                   varchar(800),
   N_NEW_ELEMENTS           varchar(800),
   N_FAILURE_CLASSIFICATION varchar(800),
   N_CCC                    varchar(50),
   K_IDSTUFF                int not null,
   primary key (K_IDTICKET_CORRECTIVE)
);

/*==============================================================*/
/* Table: software_inventory                                    */
/*==============================================================*/
create table software_inventory
(
   K_SOFTWARE_INVENTORY           int not null AUTO_INCREMENT,
   N_OPERATIVE_SYSTEM             varchar(50),
   N_OFFICE_VERSION               varchar(50),
   N_ANTIVIRUS_VERSION            varchar(50),
   N_BROWSER_VERSION              varchar(50),
   N_SIMONTIC_VERSION             varchar(50),
   N_MAGIC_VERSION                varchar(50),
   N_SAC_VERSION                  varchar(50),
   N_SEMILLA_VERSION              varchar(50),
   N_JAWS_VERSION                 varchar(50),
   K_IDSTUFF                      int not null,
   primary key (K_SOFTWARE_INVENTORY)
);

create table ticket_ccc
(
   K_IDTICKET_CCC                 int not null,
   K_IDPVD                        int not null,
   N_DESCRIPTION                  varchar(500),
   N_ESTADO                       varchar(20),
   N_OBSERVATION                  varchar(500),
   primary key (K_IDTICKET_CCC)
);

alter table equipment_type add constraint FK_PHASE_ET foreign key (K_IDPHASE)
      references phase (K_IDPHASE) on delete restrict on update restrict;

alter table equipment_type add constraint FK_TYPOLOGY_ET foreign key (K_IDTYPOLOGY)
      references typology (K_IDTYPOLOGY) on delete restrict on update restrict;

alter table equipment_type add constraint FK_EG_ET foreign key (K_IDEQUIPMENT_GENERIC)
      references equipment_generic (K_IDEQUIPMENT_GENERIC) on delete restrict on update restrict;

alter table stuff_category add constraint FK_SC_EG foreign key (K_IDEQUIPMENT_GENERIC)
      references equipment_generic (K_IDEQUIPMENT_GENERIC) on delete restrict on update restrict;

alter table checklist add constraint FK_CH_SC foreign key (K_IDEQUIPMENT_GENERIC)
      references equipment_generic (K_IDEQUIPMENT_GENERIC) on delete restrict on update restrict;

alter table checklist add constraint FK_CH_ITCH foreign key (K_IDITEM_CHECKLIST)
      references item_checklist (K_IDITEM_CHECKLIST) on delete restrict on update restrict;

alter table model add constraint FK_MODEL_MANUFACTURER foreign key (K_IDMANUFACTURER)
      references manufacturer (K_IDMANUFACTURER) on delete restrict on update restrict;

alter table model add constraint FK_MODEL_SC foreign key (K_IDSTUFF_CATEGORY)
      references stuff_category (K_IDSTUFF_CATEGORY) on delete restrict on update restrict;

alter table stuff add constraint FK_STUFF_MODEL foreign key (K_IDMODEL)
      references  model (K_IDMODEL) on delete restrict on update restrict;

alter table stuff add constraint FK_STUFF_ET foreign key (K_IDSTUFF_CATEGORY)
      references stuff_category (K_IDSTUFF_CATEGORY) on delete restrict on update restrict;

alter table stuff add constraint FK_STUFF_PVD foreign key (K_IDPVD)
      references pvd (K_IDPVD) on delete restrict on update restrict;

alter table stuff add constraint FK_STUFF_ZONE foreign key (K_IDPVD_PLACE)
      references PVD_PLACE (K_IDPVD_PLACE) on delete restrict on update restrict;

alter table ticket_corrective_maintenance add constraint FK_STUFF_TCM foreign key (K_IDSTUFF)
      references stuff (K_IDSTUFF) on delete restrict on update restrict;

alter table software_inventory add constraint FK_STUFF_SI foreign key (K_IDSTUFF)
      references stuff (K_IDSTUFF) on delete restrict on update restrict;

alter table ticket_ccc add constraint FK_CCC_PVD foreign key (K_IDPVD)
      references pvd (K_IDPVD) on delete restrict on update restrict;

alter table CITY add constraint FK_DEPARTMENT_CITY foreign key (K_IDDEPARTMENT)
      references DEPARTMENT (K_IDDEPARTMENT) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_DAMAGE_MC foreign key (K_IDDAMAGE)
      references DAMAGE (K_IDDAMAGE) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_EQUIPMENT_MC foreign key (K_IDEQUIPMENT)
      references EQUIPMENT (K_IDEQUIPMENT) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_PVDZ_MC foreign key (K_IDPVDZONE)
      references PVD_ZONE (K_IDPVDZONE) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_PVD_MC foreign key (K_IDPVD)
      references PVD (K_IDPVD) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_STATUS_MC foreign key (K_IDSTATUSMC)
      references MC_STATUS (K_IDSTATUSMC) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_TICKET_MC foreign key (K_IDTICKET)
      references TICKET (K_IDTICKET) on delete restrict on update restrict;

alter table CORRECTIVE_MAINTENANCE add constraint FK_USER_MC foreign key (K_IDUSER)
      references USER (K_IDUSER) on delete restrict on update restrict;

alter table DEPARTMENT add constraint FK_REGION_DEPARTMENT foreign key (K_IDREGION)
      references REGION (K_IDREGION) on delete restrict on update restrict;

alter table EQUIPMENT add constraint FK_CATEGORY_EQUIPMENT foreign key (K_IDCATEGORYE)
      references EQUIPMENT_CATEGORY (K_IDCATEGORYE) on delete restrict on update restrict;

alter table EQUIPMENT add constraint FK_ET2_EQUIPMENT foreign key (K_IDTYPEE2)
      references EQUIPMENT_TYPE2 (K_IDTYPEE2) on delete restrict on update restrict;

alter table EQUIPMENT_TYPE1 add constraint FK_CETEGORY_TYPEE foreign key (K_IDCATEGORYE)
      references EQUIPMENT_CATEGORY (K_IDCATEGORYE) on delete restrict on update restrict;

alter table EQUIPMENT_TYPE2 add constraint FK_ET1_ET2 foreign key (K_IDTYPEE1)
      references EQUIPMENT_TYPE1 (K_IDTYPEE1) on delete restrict on update restrict;

alter table MAINTENANCE add constraint FK_PVD_MAINTENANCE foreign key (K_IDPVD)
      references PVD (K_IDPVD) on delete restrict on update restrict;

alter table MAINTENANCE add constraint FK_TYPE_MAINTENANCE foreign key (K_IDMAINTENANCET)
      references MAINTENANCE_TYPE (K_IDMAINTENANCET) on delete restrict on update restrict;

alter table PVD add constraint FK_CITY_PVD foreign key (K_IDCITY)
      references CITY (K_IDCITY) on delete restrict on update restrict;

alter table PVD add constraint FK_EJECUTOR_PVD foreign key (K_IDEJECUTOR)
      references EJECUTOR (K_IDEJECUTOR) on delete restrict on update restrict;

alter table PVD add constraint FK_PVD_ADMIN_ foreign key (K_IDADMIN)
      references ADMIN_PVD (K_IDADMIN) on delete restrict on update restrict;

alter table PVD_PLACE add constraint FK_PLACE_ZONE foreign key (K_IDPVDZONE)
      references PVD_ZONE (K_IDPVDZONE) on delete restrict on update restrict;

alter table TICKET add constraint FK_MAINTENANCE_TICKET foreign key (K_IDMAINTENANCE)
      references MAINTENANCE (K_IDMAINTENANCE) on delete restrict on update restrict;

alter table TICKET add constraint FK_TICKET_STATUS foreign key (K_IDSTATUSTICKET)
      references TICKET_STATUS (K_IDSTATUSTICKET) on delete restrict on update restrict;

alter table ticket_others add constraint FK_TICKETO_TYPE foreign key (K_IDTICKETT)
      references ticket_other_status (K_IDSTATUSTICKETO) on delete restrict on update restrict;

alter table ticket_others add constraint FK_TICKETO_PVD foreign key (K_IDPVD)
      references pvd (K_IDPVD) on delete restrict on update restrict;

alter table ticketo_user add constraint FK_TOUSER_TICKETO foreign key (K_IDTICKETO)
      references ticket_others (K_IDTICKETOTHERS) on delete restrict on update restrict;

alter table ticketo_user add constraint FK_TOUSER_USER foreign key (K_IDUSER)
            references user (K_IDUSER) on delete restrict on update restrict;

alter table TICKET_USER add constraint FK_TICKET_USER2 foreign key (K_IDUSER)
            references USER (K_IDUSER) on delete restrict on update restrict;

alter table TICKET_USER add constraint FK_TICKET_USER foreign key (K_IDTICKET)
      references TICKET (K_IDTICKET) on delete restrict on update restrict;

alter table TICKET_USER add constraint FK_TICKET_USER2 foreign key (K_IDUSER)
      references USER (K_IDUSER) on delete restrict on update restrict;

alter table USER add constraint FK_USER_TYPE foreign key (K_IDTYPEUSER)
      references TYPE_USER (K_IDTYPEUSER) on delete restrict on update restrict;

alter table USER_PERMISSION add constraint FK_USER_PERMISSION foreign key (K_IDTYPEUSER)
      references TYPE_USER (K_IDTYPEUSER) on delete restrict on update restrict;

alter table USER_PERMISSION add constraint FK_USER_PERMISSION2 foreign key (K_IDPERMISSION)
      references PERMISSION (K_IDPERMISSION) on delete restrict on update restrict;

ALTER TABLE ticket MODIFY K_IDTICKET varchar(20) not null;
ALTER TABLE ticket_user MODIFY K_IDTICKET varchar(20) not null;
ALTER TABLE corrective_maintenance MODIFY K_IDTICKET varchar(20) not null;
ALTER TABLE ticket add K_OBSERVATION_I varchar(500);
ALTER TABLE ticket_user add Q_ESTADIA int;
ALTER TABLE ticket_user add Q_ALMUERZOS int;
ALTER TABLE kpi add N_ESTANDARES varchar(20);
ALTER TABLE ticket_user add N_OBSERVATION_F varchar(200);
ALTER TABLE stuff add N_PLACAINVENTARIO varchar(200);
ALTER TABLE stuff add N_PARTE varchar(200);
ALTER TABLE stuff add Q_PROGRESS int not null;

ALTER TABLE software_inventory add N_JAWS_VERSION  varchar(50) not null;
ALTER TABLE ticket_corrective_maintenance add N_CCC  varchar(50) not null;

ALTER TABLE stuff add K_IDSTUFF int not null AUTO_INCREMENT;
