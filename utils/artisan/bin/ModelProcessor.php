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

}
