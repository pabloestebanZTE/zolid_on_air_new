/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Admin
 * Created: 30/11/2017
 */

CREATE TABLE `kpi_summary` (
	`k_kpi_summary` INT(11) NOT NULL AUTO_INCREMENT,
	`k_id_onair` INT(11) NULL DEFAULT '0',
	`i_kpi_status` INT(11) NULL DEFAULT '0',
	`d_notification_start` TIMESTAMP NULL DEFAULT NULL,
	`d_notification_end` TIMESTAMP NULL DEFAULT NULL,
	`n_round` INT(11) NULL DEFAULT '0',
	`d_created_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`k_kpi_summary`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;



CREATE TABLE `audit_on_air` (
	`k_id_audit` INT(11) NOT NULL AUTO_INCREMENT,
	`k_id_user` INT(11) NOT NULL DEFAULT '0',
	`n_affected_table` VARCHAR(50) NULL DEFAULT NULL,
	`n_type` VARCHAR(10) NULL DEFAULT NULL,
	`n_query` VARCHAR(2000) NULL DEFAULT NULL,
	`n_json_changes` LONGTEXT NULL,
	`d_created_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`k_id_audit`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
