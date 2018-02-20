<?php

/*
 * @author = Starlly Software - https://starlly.com.
 * @licence = GNU
 * @description = Este archivo es propiedad de Deplyn Framework (https://deplyn.com) 
 * recuerda que para usarlo debes incluir en tu proyecto la licencia del framework.
 */

class DeplynAutoloader {

    public static function register() {
        if (function_exists('__autoload')) {
            spl_autoload_register('__autoload');
        }

        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
            return spl_autoload_register(array('DeplynAutoloader', 'load'), true, true);
        } else {
            return spl_autoload_register(array('DeplynAutoloader', 'load'));
        }
    }

    public static function load($className) {
        $file = $className . ".php";
        $folders = ["models/dto", "models/data", "models/bin"];
        $imported = 0;
        foreach ($folders as $folder) {
            $path = APPPATH . $folder . DIRECTORY_SEPARATOR . $file;
            if (file_exists($path)) {
                require_once $path;
                $imported++;
                break;
            }
        }
        if ($imported == 0) {
            return false;
        }
    }

}
