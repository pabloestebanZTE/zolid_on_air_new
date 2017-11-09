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

