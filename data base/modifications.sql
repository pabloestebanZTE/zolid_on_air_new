ALTER TABLE user add n_mail_user varchar(100);
ALTER TABLE user add i_phone_user integer;
ALTER TABLE user add i_cellphone_user integer;
ALTER TABLE user add n_password varchar(30);
ALTER TABLE user add n_role_user varchar(100);

ALTER TABLE ticket_on_air add n_round integer;
ALTER TABLE ticket_on_air add d_finish datetime;
ALTER TABLE ticket_on_air add d_temporal datetime;
ALTER TABLE follow_up_12h add n_round integer;
ALTER TABLE follow_up_24h add n_round integer;
ALTER TABLE follow_up_36h add n_round integer;
ALTER TABLE scaled_on_air add n_round integer;

ALTER TABLE ticket_on_air add d_actualizacion_final datetime;
ALTER TABLE ticket_on_air add d_asignacion_final datetime;

ALTER TABLE on_air_12h add n_comentario varchar(1000);
ALTER TABLE on_air24h add n_comentario varchar(1000);
ALTER TABLE on_air_36h add n_comentario varchar(1000);

ALTER TABLE preparation_stage add n_evidenciatg varchar(100);
ALTER TABLE ticket_on_air modify i_lider_cambio varchar(100);
ALTER TABLE ticket_on_air modify i_lider_cuadrilla varchar(100);

ALTER TABLE `on_air_12h`
	ADD COLUMN `d_start12h` TIMESTAMP NULL DEFAULT NULL AFTER `k_id_onair`,
	CHANGE COLUMN `n_comentario` `n_comentario` VARCHAR(1000) NULL DEFAULT NULL AFTER `d_fin12h`,
	ADD COLUMN `i_timestamp` BIGINT NOT NULL DEFAULT '0' AFTER `n_comentario`,
	ADD COLUMN `i_round` INT NOT NULL DEFAULT '0' AFTER `i_timestamp`,
	ADD COLUMN `d_created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `i_round`;

ALTER TABLE `on_air24h`
	ADD COLUMN `d_start24h` TIMESTAMP NULL DEFAULT NULL AFTER `k_id_onair`,
	CHANGE COLUMN `n_comentario` `n_comentario` VARCHAR(1000) NULL DEFAULT NULL AFTER `d_fin24h`,
	ADD COLUMN `i_timestamp` BIGINT NOT NULL DEFAULT '0' AFTER `n_comentario`,
	ADD COLUMN `i_round` INT NOT NULL DEFAULT '0' AFTER `i_timestamp`,
	ADD COLUMN `d_created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `i_round`;

ALTER TABLE `on_air_36h`
	ADD COLUMN `d_start36h` TIMESTAMP NULL DEFAULT NULL AFTER `k_id_onair`,
	CHANGE COLUMN `n_comentario` `n_comentario` VARCHAR(1000) NULL DEFAULT NULL AFTER `d_fin36h`,
	ADD COLUMN `i_timestamp` BIGINT NOT NULL DEFAULT '0' AFTER `n_comentario`,
	ADD COLUMN `i_round` INT NOT NULL DEFAULT '0' AFTER `i_timestamp`,
	ADD COLUMN `d_created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `i_round`;

	ALTER TABLE ticket_on_air add i_precheck_realizado integer;
	ALTER TABLE scaled_on_air add n_atribuible_nokia varchar(100);
	ALTER TABLE scaled_on_air add n_atribuible_nokia2 varchar(100);

-- SE AGREGA UN CAMPO A LAS TABALS DE DETALLES
ALTER TABLE `on_air_12h`
	ADD COLUMN `i_state` TINYINT(1) NOT NULL DEFAULT b'0' AFTER `i_round`;

ALTER TABLE `on_air24h`
	ADD COLUMN `i_state` TINYINT(1) NOT NULL DEFAULT b'0' AFTER `i_round`;

ALTER TABLE `on_air_36h`
	ADD COLUMN `i_state` TINYINT(1) NOT NULL DEFAULT b'0' AFTER `i_round`;

ALTER TABLE `on_air_12h`
	ADD COLUMN `i_percent` TINYINT(1) NOT NULL DEFAULT '0' AFTER `i_round`;

ALTER TABLE `on_air24h`
	ADD COLUMN `i_percent` TINYINT(1) NOT NULL DEFAULT '0' AFTER `i_round`;

ALTER TABLE `on_air_36h`
	ADD COLUMN `i_percent` TINYINT(1) NOT NULL DEFAULT '0' AFTER `i_round`;

ALTER TABLE preparation_stage add n_comentario_doc varchar(1000);
ALTER TABLE ticket_on_air add n_comentario_coor varchar(1000);
ALTER TABLE precheck add n_comentario_ing varchar(1000);


-- SE AGREGA UNA COLUMNA EN LAS TABLAS DE DETALLES (13/11/2017):
ALTER TABLE `on_air_12h`
	ADD COLUMN `d_start_temp` TIMESTAMP NULL DEFAULT NULL AFTER `d_start12h`;

ALTER TABLE `on_air24h`
	ADD COLUMN `d_start_temp` TIMESTAMP NULL DEFAULT NULL AFTER `d_start24h`;

ALTER TABLE `on_air_36h`
	ADD COLUMN `d_start_temp` TIMESTAMP NULL DEFAULT NULL AFTER `d_start36h`;


ALTER TABLE ticket_on_air add i_actualEngineer integer;

-- (Mar, 14/Nov/2017) SE AGREGA UNA COLUMNA EN LAS TABLAS DE DETALLES PARA MANIPULAR LAS HORAS QUE DURAN LAS PRORROGAS...
ALTER TABLE `on_air_12h`
	ADD COLUMN `i_hours` INT NULL DEFAULT '0' AFTER `i_state`;

ALTER TABLE `on_air24h`
	ADD COLUMN `i_hours` INT NULL DEFAULT '0' AFTER `i_state`;

ALTER TABLE `on_air_36h`
	ADD COLUMN `i_hours` INT NULL DEFAULT '0' AFTER `i_state`;
-- Se eliminan estados 14/11/2017

DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='3';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='9';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='19';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='24';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='30';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='41';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='46';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='47';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='51';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='52';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='55';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='56';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='57';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='60';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='61';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='62';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='66';
DELETE FROM `on_air`.`status_on_air` WHERE `k_id_status_onair`='67';

/*==============================================================*/
/* table: reporte_comentario                                                 */
/*==============================================================*/
CREATE TABLE IF NOT EXISTS `reporte_comentario` (
  `k_id_on_air` int(11) DEFAULT NULL,
  `n_nombre_estacion_eb` varchar(100) DEFAULT NULL,
  `n_tecnologia` varchar(100) DEFAULT NULL,
  `n_banda` varchar(100) DEFAULT NULL,
  `n_tipo_trabajo` varchar(100) DEFAULT NULL,
  `n_estado_eb_resucomen` varchar(100) DEFAULT NULL,
  `comentario_resucoment` varchar(2000) DEFAULT NULL,
  `hora_actualizacion_resucomen` timestamp NULL DEFAULT NULL,
  `usuario_resucomen` varchar(100) DEFAULT NULL,
  `ente_ejecutor` varchar(100) DEFAULT NULL,
  `tipificacion_resucomen` varchar(100) DEFAULT NULL,
  `noc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE ticket_on_air modify n_estadoonair varchar(100) DEFAULT 'NO ON AIR';

-- (15 nov 2017) se modifica el campo time_escalado
ALTER TABLE scaled_on_air modify d_time_escalado varchar(100);

ALTER TABLE preparation_stage modify n_comentarioccial varchar(1000);
ALTER TABLE ticket_on_air modify n_kpis_degraded varchar(1000);
ALTER TABLE ticket_on_air modify i_valor_kpi1 varchar(100);
ALTER TABLE ticket_on_air modify i_valor_kpi2 varchar(100);
ALTER TABLE ticket_on_air modify i_valor_kpi3 varchar(100);
ALTER TABLE ticket_on_air modify i_valor_kpi4 varchar(100);
ALTER TABLE ticket_on_air modify n_en_prorroga varchar(100) DEFAULT 'FALSE';
ALTER TABLE ticket_on_air modify b_excpetion_gri varchar(100);
ALTER TABLE preparation_stage modify b_vistamm varchar(100);


/* MODIFICACIONES 16/11/2017 */
ALTER TABLE ticket_on_air add i_priority varchar(10);

/* MODIFICACIONES 16/Nov/2017 05:54 pm */
ALTER TABLE `ticket_on_air`
	ADD COLUMN `d_created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `i_priority`;

ALTER TABLE `ticket_on_air`
	ADD COLUMN `d_precheck_init` TIMESTAMP NULL DEFAULT NULL AFTER `i_priority`;

	INSERT INTO `on_air`.`substatus` (`k_id_substatus`, `n_name_substatus`) VALUES ('31', 'Notificacion');
	INSERT INTO `on_air`.`status_on_air` (`k_id_status_onair`, `k_id_substatus`, `k_id_status`) VALUES ('91', '31', '9');



	/* MODIFICACIONES 17/11/2019 */
	ALTER TABLE ticket_on_air modify n_round integer DEFAULT '1';
