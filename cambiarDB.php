<style type="text/css">
    *{
        font-family: sans-serif;        
        font-size: 16px;
    }
</style>
<?php
if (empty($_POST["db"])) {
    echo "No se recibió el name de la configuración que desea setear por defecto";
    return;
}


file_put_contents("application/config/db.php", "<?php

return [
    /*
      |--------------------------------------------------------------------------
      | PDO Fetch Style
      |--------------------------------------------------------------------------
      |
      | By default, database results will be returned as instances of the PHP
      | stdClass object; however, you may desire to retrieve records in an
      | array format for simplicity. Here you can tweak the fetch style.
      |
     */

    'fetch' => PDO::FETCH_OBJ,
    /*
      |--------------------------------------------------------------------------
      | Default Database Connection Name
      |--------------------------------------------------------------------------
      |
      | Here you may specify which of the database connections below you wish
      | to use as your default connection for all database work. Of course
      | you may use many connections at once using the Database library.
      |
     */
    //Por favor, Seguir subiendo la configuración de sus localhost y no la del servidor
    //que el único que apunte a el servidor mysql sea quíen suba el proyecto con nuevos cambios...
    'default' => '" . $_POST["db"] . "',
    /*
      |--------------------------------------------------------------------------
      | Database Connections
      |--------------------------------------------------------------------------
      |
      | Here are each of the database connections setup for your application.
      | Of course, examples of configuring each database platform that is
      | supported by Laravel is shown below to make development simple.
      |
      |
      | All database work in Laravel is done through the PHP PDO facilities
      | so make sure you have the driver for your particular database of
      | choice installed on your machine before you begin development.
      |
     */
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => 'zte-col.cws6f2qsxddy.us-west-2.rds.amazonaws.com',
            'port' => '3306',
            'database' => 'on_air',
            'username' => 'AdminZTE',
            'password' => 'a4b3c2d1',
            'charset' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql2' => [
            'driver' => 'mysql',
            'host' => 'mysql.hostinger.co',
            'port' => '3306',
            'database' => 'u100536767_zolid',
            'username' => 'u100536767_zolid',
            'password' => 'abc123',
            'charset' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysqlLocalhost' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => '3306',
            'database' => 'on_air',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'camilo' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => '3306',
            'database' => 'on_air',
            'username' => 'root',
            'password' => 'a4b3c2d1',
            'charset' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'test' => [
            'driver' => 'mysql',
            'host' => 'zte-col.cws6f2qsxddy.us-west-2.rds.amazonaws.com',
            'port' => '3306',
            'database' => 'on_air_test',
            'username' => 'AdminZTE',
            'password' => 'a4b3c2d1',
            'charset' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'jj' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => '3306',
            'database' => 'on_air',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
    ]
];
");

echo "Se ha actualizado la configuración de base de datos correctamente.";
