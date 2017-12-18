<?php

require "./application/models/bin/DB.php";
require PATH_UTILS . "artisan/bin/EQueries.php";

class ModelProccessor {

    function __construct() {
        
    }

    /**
     * Recibe el nombre de la tabla de la BD y devuelve todas sus columnas con los detalles pertinentes.
     * @param string $table
     * @return array
     */
    function getFields($table) {
        $db = new DB();
        $query = EQueries::getQuery(EQueries::LIST_COLUMNS) . $table;
        $db->select($query);
        return $db->get();
    }

    function getTables() {
        $db = new DB();
//        $query = EQueries::getQuery(EQueries::SHOW_TABLES);
        $db->select("SELECT 
                    table_name AS tablename 
                    FROM 
                     information_schema.tables
                    WHERE 
                    table_schema = DATABASE()");
        return $db->get();
    }

}
