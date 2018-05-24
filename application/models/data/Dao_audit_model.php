<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_audit_model extends CI_Model {

    const INSERT = "INSERT";
    const UPDATE = "UPDATE";

    var $tablesAudit = ["ticket_on_air", "on_air_12h", "on_air24h", "on_air_36h", "precheck", "scaled_on_air"];

    function __construct() {
    }

    public function audit($query, $obj, $table, $wheres) {
        if (!in_array($table, $this->tablesAudit)) {
            return;
        }
        //Registramos la información...
        $audit = new AuditOnAirModel();
        $idUser = (Auth::check()) ? Auth::user()->k_id_user : 0;
        $jsonchanges = null;
        $jsonchanges = $this->getFieldsChanged($query, $obj, $table, $wheres);
        $audit->insert([
            "k_id_user" => $idUser,
            "n_affected_table" => $table,
            "n_query" => $query,
            "n_type" => $jsonchanges->type,
            "n_json_changes" => json_encode($jsonchanges->all()),
            "d_created_at" => Hash::getDate()
        ]);
    }

    public function getFieldsChanged($query, $obj, $table, $wheres) {
        //Comprobamos si es una insersión o actualización...
        $final = new ObjUtil();
        $type = (strpos(strtoupper($query), "INSERT") !== false) ? Dao_audit_model::INSERT : Dao_audit_model::UPDATE;
        $final->type = $type;
        if ($type == Dao_audit_model::INSERT) {
            $final->obj = $obj;
        } else {
            //Como es una actualización debemos obtener el registro que se está actualizando...
            $record = DB::table($table)->setWheres($wheres)->first();
            $changes = [];
            $old = [];
            if ($record) {
                foreach ($record as $key => $value) {
                    if ((isset($obj[$key])) && ($obj[$key] != $value)) {
                        $changes[$key] = $obj[$key];
                        $old[$key] = $value;
                    }
                }
                $final->old = $old;
                $final->changes = $changes;
            } else {
                $final->obj = $obj;
            }
        }
        return $final;
    }

}
