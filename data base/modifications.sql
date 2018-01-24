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
	`k_id_primary` int not null AUTO_INCREMENT,
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
  `noc` varchar(100) DEFAULT NULL,
	primary key (k_id_primary)
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

/* Modificaciones 19/11/2017 */
ALTER TABLE ticket_on_air add n_implementacion_remota varchar(100);
INSERT INTO `on_air`.`status_on_air` (`k_id_status_onair`, `k_id_substatus`, `k_id_status`) VALUES ('98', '8', '9');

/*ALTER TABLE preparation_stage AUTO_INCREMENT = 1;
ALTER TABLE ticket_on_air AUTO_INCREMENT = 1;
ALTER TABLE scaled_on_air AUTO_INCREMENT = 1;
ALTER TABLE scaled AUTO_INCREMENT = 1;
ALTER TABLE precheck AUTO_INCREMENT = 1;
ALTER TABLE on_air_36h AUTO_INCREMENT = 1;
ALTER TABLE on_air_12h AUTO_INCREMENT = 1;
ALTER TABLE on_air24h AUTO_INCREMENT = 1;
ALTER TABLE follow_up_36h AUTO_INCREMENT = 1;
ALTER TABLE follow_up_24h AUTO_INCREMENT = 1;
ALTER TABLE follow_up_12h AUTO_INCREMENT = 1;*/


/*use on_air;
delete from on_air_12h where k_id_12h_real > 0;
delete from on_air24h where k_id_24h_real > 0;
delete from on_air_36h where k_id_36h_real > 0;

delete from follow_up_12h where k_id_follow_up_12h > 0;
delete from follow_up_24h where k_id_follow_up_24h > 0;
delete from follow_up_36h where k_id_follow_up_36h > 0;

delete from scaled where k_id_sacled > 0;
delete from scaled_on_air where k_id_scaled_on_air > 0;

delete from ticket_on_air where k_id_onair > 0;

delete from preparation_stage where k_id_preparation > 0;
delete from precheck where k_id_precheck > 0;

delete from reporte_comentario where k_id_primary > 0;
*/

-- Modificaciones Lunes, 20 de Noviembre de 2017.
ALTER TABLE `ticket_on_air`
	CHANGE COLUMN `d_created_at` `d_created_at` TIMESTAMP NULL DEFAULT NULL AFTER `d_precheck_init`;

ALTER TABLE `user`
	ADD COLUMN `n_code_user` VARCHAR(5) NULL DEFAULT NULL AFTER `k_id_user`,
	ADD UNIQUE INDEX `n_code_user` (`n_code_user`);


-- Actualizaciones Miércoles, 22 de Noviembre 2017.
ALTER TABLE `on_air_12h`
	CHANGE COLUMN `n_comentario` `n_comentario` LONGTEXT NULL DEFAULT NULL AFTER `d_fin12h`;

ALTER TABLE `on_air24h`
	CHANGE COLUMN `n_comentario` `n_comentario` LONGTEXT NULL DEFAULT NULL AFTER `d_fin24h`;

ALTER TABLE `on_air_36h`
	CHANGE COLUMN `n_comentario` `n_comentario` LONGTEXT NULL DEFAULT NULL AFTER `d_fin36h`;


-- Actualizaciones 23, de Noviembre 2017.
ALTER TABLE `ticket_on_air`
	ADD COLUMN `i_stand_by_hours` INT NOT NULL DEFAULT '0' AFTER `d_precheck_init`;

ALTER TABLE `ticket_on_air`
	CHANGE COLUMN `i_stand_by_hours` `i_prorroga_hours` INT(11) NOT NULL DEFAULT '0' AFTER `d_precheck_init`;

INSERT INTO `on_air`.`status_on_air` (`k_id_status_onair`, `k_id_substatus`, `k_id_status`) VALUES ('100', '32', '9');

ALTER TABLE `ticket_on_air`
	ADD COLUMN `data_standby` VARCHAR(500) NULL AFTER `n_implementacion_remota`;

	/* 24 de nov 2017 */
	ALTER TABLE scaled_on_air add n_comentario_esc varchar(2000);

/*======================25 11 2017=============================*/
ALTER TABLE ticket_on_air	ADD  d_t_from_notif varchar(50);
ALTER TABLE ticket_on_air	ADD  d_t_from_asign varchar(50);
ALTER TABLE ticket_on_air	ADD  n_ola varchar(100);
ALTER TABLE ticket_on_air	ADD  n_ola_excedido varchar(100);
ALTER TABLE ticket_on_air	ADD  n_ola_areas varchar(100);
ALTER TABLE ticket_on_air	ADD  n_ola_areas_excedido varchar(100);

ALTER TABLE reporte_comentario modify comentario_resucoment varchar(5000);


-- Actualizaciones Lunes, 27 de noviembre de 2017.
ALTER TABLE `work`
	ADD COLUMN `b_aplica_bloqueo` BIT NULL DEFAULT b'0' AFTER `n_name_ork`;

ALTER TABLE `ticket_on_air`
	ADD COLUMN `n_json_sectores` VARCHAR(100) NULL DEFAULT NULL AFTER `n_sectoresdesbloqueados`;

-- Actualizaciones Miércoles, 29 de Noviembre de 2017.

-- Se actualiza la tabla Work.
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 21;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 22;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 23;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 24;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 25;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 26;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 29;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 30;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 31;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 39;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 40;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 44;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 45;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 46;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 47;
UPDATE `work` SET b_aplica_bloqueo = 1 WHERE k_id_work = 50;


-- Se agrega la tabla sectores.

-- Volcando estructura para tabla on_air.sectores
CREATE TABLE IF NOT EXISTS `sectores` (
  `k_id_sector` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`k_id_sector`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla on_air.sectores: ~45 rows (aproximadamente)
DELETE FROM `sectores`;
INSERT INTO `sectores` (`k_id_sector`, `name`, `created_at`) VALUES
	(1, '1', '2017-11-27 09:35:38'),
	(2, '2', '2017-11-27 09:35:40'),
	(3, '3', '2017-11-27 09:35:42'),
	(4, '4', '2017-11-27 09:35:43'),
	(5, '5', '2017-11-27 09:35:45'),
	(6, '6', '2017-11-27 09:35:48'),
	(7, 'A', '2017-11-27 09:36:01'),
	(8, 'B', '2017-11-27 09:36:03'),
	(9, 'C', '2017-11-27 09:36:04'),
	(10, 'X', '2017-11-27 09:36:15'),
	(11, 'Y', '2017-11-27 09:36:17'),
	(12, 'Z', '2017-11-27 09:36:19'),
	(13, 'U', '2017-11-27 09:36:21'),
	(14, 'V', '2017-11-27 09:36:33'),
	(15, 'W', '2017-11-27 09:36:34'),
	(16, 'Y1', '2017-11-27 09:36:51'),
	(17, 'Y2', '2017-11-27 09:36:53'),
	(18, 'Y3', '2017-11-27 09:36:55'),
	(19, 'Y4', '2017-11-27 09:36:59'),
	(20, 'Y5', '2017-11-27 09:37:01'),
	(21, 'Y6', '2017-11-27 09:37:06'),
	(22, 'I', '2017-11-27 09:37:08'),
	(23, 'J', '2017-11-27 09:37:10'),
	(24, 'K', '2017-11-27 09:37:12'),
	(25, 'L', '2017-11-27 09:37:14'),
	(26, 'M', '2017-11-27 09:37:16'),
	(27, 'N', '2017-11-27 09:37:18'),
	(28, 'O', '2017-11-27 09:37:23'),
	(29, 'P', '2017-11-27 09:37:24'),
	(30, 'Q', '2017-11-27 09:37:26'),
	(31, 'R', '2017-11-27 09:37:27'),
	(32, 'S', '2017-11-27 09:37:29'),
	(33, 'T', '2017-11-27 09:37:30'),
	(34, 'L1', '2017-11-27 09:37:32'),
	(35, 'L2', '2017-11-27 09:37:34'),
	(36, 'L3', '2017-11-27 09:37:36'),
	(37, 'L4', '2017-11-27 09:37:37'),
	(38, 'L5', '2017-11-27 09:37:41'),
	(39, 'L6', '2017-11-27 09:37:44'),
	(40, 'M1', '2017-11-27 09:37:46'),
	(41, 'M2', '2017-11-27 09:37:48'),
	(42, 'M3', '2017-11-27 09:37:51'),
	(43, 'M4', '2017-11-27 09:37:53'),
	(44, 'M5', '2017-11-27 09:37:55'),
	(45, 'M6', '2017-11-27 09:38:04');

-- Se agrega la tabla de relaciones de los sectores

-- Volcando estructura para tabla on_air.sectores_on_air
CREATE TABLE IF NOT EXISTS `sectores_on_air` (
  `k_id_sector_on_air` int(11) NOT NULL AUTO_INCREMENT,
  `k_id_sector` int(11) NOT NULL DEFAULT '0',
  `k_id_tecnology` int(11) DEFAULT NULL,
  `k_id_band` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id_sector_on_air`),
  KEY `k_id_tecnology` (`k_id_tecnology`),
  KEY `k_id_band` (`k_id_band`),
  KEY `k_id_sector` (`k_id_sector`),
  CONSTRAINT `FK_sectores_on_air_band` FOREIGN KEY (`k_id_band`) REFERENCES `band` (`k_id_band`),
  CONSTRAINT `FK_sectores_on_air_sectores` FOREIGN KEY (`k_id_sector`) REFERENCES `sectores` (`k_id_sector`),
  CONSTRAINT `FK_sectores_on_air_technology` FOREIGN KEY (`k_id_tecnology`) REFERENCES `technology` (`k_id_technology`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla on_air.sectores_on_air: ~177 rows (aproximadamente)
DELETE FROM `sectores_on_air`;
/*!40000 ALTER TABLE `sectores_on_air` DISABLE KEYS */;
INSERT INTO `sectores_on_air` (`k_id_sector_on_air`, `k_id_sector`, `k_id_tecnology`, `k_id_band`) VALUES
	(1, 1, 1, 3),
	(2, 2, 1, 3),
	(3, 3, 1, 3),
	(4, 4, 1, 3),
	(5, 5, 1, 3),
	(6, 6, 1, 3),
	(7, 7, 1, 1),
	(8, 8, 1, 1),
	(9, 9, 1, 1),
	(10, 10, 4, 3),
	(11, 11, 4, 3),
	(12, 12, 4, 3),
	(13, 13, 4, 3),
	(14, 14, 4, 3),
	(15, 15, 4, 3),
	(16, 16, 4, 3),
	(17, 17, 4, 3),
	(18, 18, 4, 3),
	(19, 19, 4, 3),
	(20, 20, 4, 3),
	(21, 21, 4, 3),
	(22, 22, 4, 1),
	(23, 23, 4, 1),
	(24, 24, 4, 1),
	(25, 25, 4, 1),
	(26, 26, 4, 1),
	(27, 27, 4, 1),
	(28, 28, 4, 1),
	(29, 29, 4, 1),
	(30, 30, 4, 1),
	(31, 31, 4, 1),
	(32, 32, 4, 1),
	(33, 33, 4, 1),
	(34, 34, 6, 2),
	(35, 35, 6, 2),
	(36, 36, 6, 2),
	(37, 37, 6, 2),
	(38, 38, 6, 2),
	(39, 39, 6, 2),
	(40, 40, 6, 1),
	(41, 41, 6, 1),
	(42, 42, 6, 1),
	(43, 43, 6, 1),
	(44, 44, 6, 1),
	(45, 45, 6, 1),
	(46, 1, 1, 4),
	(47, 2, 1, 4),
	(48, 3, 1, 4),
	(49, 4, 1, 4),
	(50, 5, 1, 4),
	(51, 6, 1, 4),
	(52, 7, 1, 4),
	(53, 8, 1, 4),
	(54, 9, 1, 4),
	(55, 10, 4, 4),
	(56, 11, 4, 4),
	(57, 12, 4, 4),
	(58, 13, 4, 4),
	(59, 14, 4, 4),
	(60, 15, 4, 4),
	(61, 16, 4, 4),
	(62, 17, 4, 4),
	(63, 18, 4, 4),
	(64, 19, 4, 4),
	(65, 20, 4, 4),
	(66, 21, 4, 4),
	(67, 22, 4, 4),
	(68, 23, 4, 4),
	(69, 24, 4, 4),
	(70, 25, 4, 4),
	(71, 26, 4, 4),
	(72, 27, 4, 4),
	(73, 28, 4, 4),
	(74, 29, 4, 4),
	(75, 30, 4, 4),
	(76, 31, 4, 4),
	(77, 32, 4, 4),
	(78, 33, 4, 4),
	(79, 34, 6, 7),
	(80, 35, 6, 7),
	(81, 36, 6, 7),
	(82, 37, 6, 7),
	(83, 38, 6, 7),
	(84, 39, 6, 7),
	(85, 40, 6, 7),
	(86, 41, 6, 7),
	(87, 42, 6, 7),
	(88, 43, 6, 7),
	(89, 44, 6, 7),
	(90, 45, 6, 7),
	(91, 1, 2, 4),
	(92, 2, 2, 4),
	(93, 3, 2, 4),
	(94, 4, 2, 4),
	(95, 5, 2, 4),
	(96, 6, 2, 4),
	(97, 7, 2, 4),
	(98, 8, 2, 4),
	(99, 9, 2, 4),
	(100, 10, 2, 4),
	(101, 11, 2, 4),
	(102, 12, 2, 4),
	(103, 13, 2, 4),
	(104, 14, 2, 4),
	(105, 15, 2, 4),
	(106, 16, 2, 4),
	(107, 17, 2, 4),
	(108, 18, 2, 4),
	(109, 19, 2, 4),
	(110, 20, 2, 4),
	(111, 21, 2, 4),
	(112, 22, 2, 4),
	(113, 23, 2, 4),
	(114, 24, 2, 4),
	(115, 25, 4, 1),
	(116, 26, 4, 1),
	(117, 27, 4, 1),
	(118, 27, 4, 1),
	(119, 29, 4, 1),
	(120, 30, 4, 1),
	(121, 31, 4, 1),
	(122, 32, 4, 1),
	(123, 33, 4, 1),
	(124, 25, 2, 4),
	(125, 26, 2, 4),
	(126, 27, 2, 4),
	(127, 28, 2, 4),
	(128, 29, 2, 4),
	(129, 30, 2, 4),
	(130, 31, 2, 4),
	(131, 32, 2, 4),
	(132, 33, 2, 4),
	(133, 1, 3, 5),
	(134, 2, 3, 5),
	(135, 3, 3, 5),
	(136, 4, 3, 5),
	(137, 5, 3, 5),
	(138, 6, 3, 5),
	(139, 7, 3, 5),
	(140, 8, 3, 5),
	(141, 9, 3, 5),
	(142, 10, 3, 5),
	(143, 11, 3, 5),
	(144, 12, 3, 5),
	(145, 13, 3, 5),
	(146, 14, 3, 5),
	(147, 15, 3, 5),
	(148, 16, 3, 5),
	(149, 17, 3, 5),
	(150, 18, 3, 5),
	(151, 19, 3, 5),
	(152, 20, 3, 5),
	(153, 21, 3, 5),
	(154, 22, 3, 5),
	(155, 23, 3, 5),
	(156, 24, 3, 5),
	(157, 25, 3, 5),
	(158, 26, 3, 5),
	(159, 27, 3, 5),
	(160, 28, 3, 5),
	(161, 29, 3, 5),
	(162, 29, 3, 5),
	(163, 31, 3, 5),
	(164, 32, 3, 5),
	(165, 33, 3, 5),
	(166, 34, 3, 5),
	(167, 35, 3, 5),
	(168, 36, 3, 5),
	(169, 37, 3, 5),
	(170, 38, 3, 5),
	(171, 39, 3, 5),
	(172, 40, 3, 5),
	(173, 41, 3, 5),
	(174, 42, 3, 5),
	(175, 43, 3, 5),
	(176, 44, 3, 5),
	(177, 45, 3, 5);




-- Actualizaciones Lunes, 4 de Diciembre de 2017.
ALTER TABLE `ticket_on_air`
	CHANGE COLUMN `n_json_sectores` `n_json_sectores` LONGTEXT NULL DEFAULT NULL AFTER `n_sectoresdesbloqueados`;

-- Actualizaciones VIernes, 15 de Diciembre de 2017.

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

-- Actualizaciones KPIS.
CREATE TABLE `kpi_summary_onair` (
	`k_id_kpi_summary_onair` INT(11) NOT NULL AUTO_INCREMENT,
	`k_id_onair` INT(11) NULL DEFAULT NULL,
	`n_round` INT(11) NULL DEFAULT NULL,
	`k_id_summary_precheck` INT(11) NULL DEFAULT NULL,
	`k_id_summary_12h` INT(11) NULL DEFAULT NULL,
	`k_id_summary_24h` INT(11) NULL DEFAULT NULL,
	`k_id_summary_36h` INT(11) NULL DEFAULT NULL,
	`d_created_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`k_id_kpi_summary_onair`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
CREATE TABLE `kpi_summary` (
	`k_kpi_summary` INT(11) NOT NULL AUTO_INCREMENT,
	`e_type` ENUM('PRE','POS') NULL DEFAULT NULL,
	`on_time` ENUM('Y','N') NULL DEFAULT NULL,
	`d_start` TIMESTAMP NULL DEFAULT NULL,
	`d_exec` TIMESTAMP NULL DEFAULT NULL,
	`d_end` TIMESTAMP NULL DEFAULT NULL,
	`k_id_executor` INT(11) NULL DEFAULT NULL,
	`d_created_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`k_kpi_summary`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

-- actualizacion 28/12/2017
ALTER TABLE `on_air`.`avm` 
ADD COLUMN `i_ingeniero_asignado` INT(11) NULL DEFAULT NULL AFTER `n_contratista`;

ALTER TABLE `on_air`.`cvm` 
ADD COLUMN `i_ingeniero_asignado` INT(11) NULL DEFAULT NULL AFTER `n_comentarios_cierre`;

ALTER TABLE `on_air`.`vm` 
ADD COLUMN `i_ingeniero_asignado` VARCHAR(11) NULL AFTER `n_comentario_punto_control`;

ALTER TABLE `cvm`
	CHANGE COLUMN `i_telefono_lider_cambio` `i_telefono_lider_cambio` VARCHAR(20) NULL DEFAULT NULL AFTER `n_tipo_solucion`;

-- actualizacion 29/12/2017
ALTER TABLE `on_air`.`vm` 
CHANGE COLUMN `i_ingeniero_asignado` `i_ingeniero_apertura` INT(11) NULL DEFAULT NULL ,
ADD COLUMN `i_ingeniero_punto_control` INT(11) NULL DEFAULT NULL AFTER `i_ingeniero_apertura`,
ADD COLUMN `i_ingeniero_cierre` INT(11) NULL DEFAULT NULL AFTER `i_ingeniero_punto_control`;

ALTER TABLE `on_air`.`cvm` 
DROP COLUMN `i_ingeniero_asignado`;

ALTER TABLE `on_air`.`avm` 
DROP COLUMN `i_ingeniero_asignado`;

-- actualizacion 05/01/2018
CREATE TABLE `on_air`.`tiket_remedy` (
  `k_id_tiket_remedy` INT NOT NULL AUTO_INCREMENT,
  `k_id_vm` INT NULL,
  `n_numero_incidente` VARCHAR(45) NULL,
  `n_estado_ticket` VARCHAR(45) NULL,
  `i_ingeniero_apertura_ticket` INT NULL,
  `n_tipo_afectación` VARCHAR(45) NULL,
  `n_grupo_soporte` VARCHAR(45) NULL,
  `d_inicio_afectación` DATETIME NULL,
  `n_responsable_oym` VARCHAR(45) NULL,
  `n_responsable_ticket` VARCHAR(45) NULL,
  `n_summary_remedy` VARCHAR(1000) NULL,
  `n_fm_claro` VARCHAR(45) NULL,
  `n_fm_nokia` VARCHAR(45) NULL,
  `n_comentario_ticket` VARCHAR(1000) NULL,
  PRIMARY KEY (`k_id_tiket_remedy`),
  INDEX `fk_vm_idx` (`k_id_vm` ASC),
  CONSTRAINT `fk_vm`
    FOREIGN KEY (`k_id_vm`)
    REFERENCES `on_air`.`vm` (`k_id_vm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- Viernes, 5 de enero de 2018.
CREATE TABLE `ref_tech_band` (
	`k_id_tech_band` INT(11) NOT NULL AUTO_INCREMENT,
	`k_id_technology` INT(11) NULL DEFAULT NULL,
	`k_id_band` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`k_id_tech_band`),
	INDEX `k_id_technology` (`k_id_technology`),
	INDEX `k_id_band` (`k_id_band`),
	CONSTRAINT `FK__band` FOREIGN KEY (`k_id_band`) REFERENCES `band` (`k_id_band`),
	CONSTRAINT `FK__technology` FOREIGN KEY (`k_id_technology`) REFERENCES `technology` (`k_id_technology`)
);

INSERT INTO `ref_tech_band` (`k_id_tech_band`, `k_id_technology`, `k_id_band`) VALUES
	(1, 1, 3),
	(2, 1, 1),
	(3, 4, 3),
	(4, 4, 1),
	(5, 6, 1),
	(6, 6, 2),
	(7, 2, 3),
	(8, 2, 1),
	(9, 2, 4),
	(10, 3, 1),
	(11, 3, 2),
	(12, 3, 3),
	(13, 3, 4),
	(14, 3, 5),
	(15, 3, 6),
	(16, 3, 7),
	(17, 5, 1),
	(18, 5, 2),
	(19, 5, 3),
	(20, 5, 4),
	(21, 5, 5),
	(22, 5, 6),
	(23, 5, 7);

-- actualizacion 09/01/2018
ALTER TABLE `on_air`.`work` 
ADD COLUMN `n_abreviacion` VARCHAR(45) NULL AFTER `b_aplica_bloqueo`;

UPDATE `on_air`.`work` SET `n_abreviacion`='N_adecuacion_LTE_' WHERE `k_id_work`='34';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_A_OV_' WHERE `k_id_work`='35';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_A_SE_' WHERE `k_id_work`='2';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Cambio_J+B_' WHERE `k_id_work`='36';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Cambio_J/F' WHERE `k_id_work`='37';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_CE_' WHERE `k_id_work`='10';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_CE_+ Upgrade_Modulos RF_' WHERE `k_id_work`='11';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_CE_+ Upgrade_Modulos RF_' WHERE `k_id_work`='38';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_MMR_' WHERE `k_id_work`='13';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_MMR_' WHERE `k_id_work`='52';
UPDATE `on_air`.`work` SET `n_abreviacion`='S_DI_RB_' WHERE `k_id_work`='14';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_RB_' WHERE `k_id_work`='15';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_RF_Sharing_a_Dedicado_' WHERE `k_id_work`='16';
UPDATE `on_air`.`work` SET `n_abreviacion`='S_DI_SE_' WHERE `k_id_work`='43';
UPDATE `on_air`.`work` SET `n_abreviacion`='S_DI_2N_' WHERE `k_id_work`='20';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Upgrade_Modulos_ RF_' WHERE `k_id_work`='51';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_adecuacion_LTE_' WHERE `k_id_work`='33';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_adecuacion_LTE_' WHERE `k_id_work`='1';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Cambio_J+B_' WHERE `k_id_work`='53';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Cambio_J+B_' WHERE `k_id_work`='9';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Cambio_J+B_' WHERE `k_id_work`='8';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Cambio_J+B_' WHERE `k_id_work`='7';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_Cambio_J+B_' WHERE `k_id_work`='6';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_CE_' WHERE `k_id_work`='12';
UPDATE `on_air`.`work` SET `n_abreviacion`='S_DI_RB_' WHERE `k_id_work`='41';
UPDATE `on_air`.`work` SET `n_abreviacion`='N_RB_' WHERE `k_id_work`='42';

-- actualizacion 17/01/2018
ALTER TABLE `on_air`.`vm` 
ADD COLUMN `n_fase_ventana` VARCHAR(45) NULL DEFAULT NULL AFTER `i_ingeniero_cierre`,
ADD COLUMN `n_asignado` INT(11) NULL DEFAULT NULL AFTER `n_fase_ventana`;
