<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EQueries {

    const SHOW_TABLES = "SHOW_TABLES";
    const LIST_COLUMNS = "LIST_COLUMNS";
    const GET_REFERENCE = "GET_REFERENCE";
    const FIELD_NAME = "FIELD_NAME";
    const FIELD_TYPE = "FIELD_TYPE";
    const FIELD_NULLABLE = "FIELD_NULLABLE";
    const FIELD_KEY = "FIELD_KEY";
    const FIELD_DEFAULT = "FIELD_DEFAULT";
    const FIELD_EXTRA = "FIELD_EXTRA";
    const NULLABLE_STATE = "NULLABLE_STATE";
    const TABLE_NAME = "TABLE_NAME";
    const COLUMN_NAME = "COLUMN_NAME";

    public static function getQuery($key, $sqlLang = null) {
        if ($sqlLang == null) {
            $dbconfig = require PATH_CONFIG;
            $sqlLang = $dbconfig["connections"][$dbconfig["default"]]["driver"];
        }
        $query = require PATH_UTILS . "artisan/bin/SQLDrivers.php";
        return $query[$sqlLang][$key];
    }

}
