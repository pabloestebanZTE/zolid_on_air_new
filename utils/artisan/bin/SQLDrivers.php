<?php

/**
 * Cada motor tiene sus propias sentencias, es por esto que es necesario crear este 
 * archivo que contenga todas las sentencias necesarias para cada lenguaje.
 * 
 * Nota: Este archivo solo contiene las sentencias SQL para el módulo Artisan,
 * no incrustar sentencias que se vayan a utilizar a nivel de la aplicación
 * ya que la carpeta utils o artisan debe quedar independiente de la aplicación
 * para que pueda ser eliminada y/o excluida sin ningún problema del entorno de producción.
 */
return [
    "mysql" => [
        "SHOW_TABLEs" => "SHOW TABLES FROM ",
        "LIST_COLUMNS" => "DESCRIBE ",
        "GET_REFERENCES" => "SELECT   `TABLE_NAME`,  `COLUMN_NAME`,  `REFERENCED_TABLE_NAME`,  `REFERENCED_COLUMN_NAME`FROM  `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`WHERE  `TABLE_NAME` = 'tablename'  AND `REFERENCED_TABLE_NAME` IS NOT NULL;",
        "FIELD_NAME" => "Field",
        "FIELD_TYPE" => "Type",
        "FIELD_NULLABLE" => "Null",
        "FIELD_KEY" => "Key",
        "FIELD_DEFAULT" => "Default",
        "NULLABLE_STATE" => "YES",
        "TABLE_NAME" => "TABLE_NAME",
        "COLUMN_NAME" => "COLUMN_NAME",
        "REFERENCED_TABLE_NAME" => "REFERENCED_TABLE_NAME",
        "REFERENCED_COLUMN_NAME" => "REFERENCED_COLUMN_NAME",
        "NONE" => "NONE"
    ]
];
