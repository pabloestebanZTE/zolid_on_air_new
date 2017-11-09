<?php

class URL {

    /**
     * Concatena a la url dada, la url base del sistema.
     * @param type $url
     * @return String url
     */
    public static function to($url) {
        return URL::base() . "/$url";
    }

    /**
     * Devuelve la url base del sistema.
     * @return string url
     */
    public static function base() {
        return trim(URL_PROJECT, "/");
    }

    /**
     * Devuelve la url completa del contexto actual.
     * @return String url
     */
    public static function getFull() {
        return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    /**
     * Este método obtiene la ruta base del proyecto.
     * Para el mismo efecto es recomendado usar base() así no hará reprocesos
     * internos que perjudiquen el rendimiento de la aplicación.
     * @return type
     */
    public static function getBase() {
        $base_dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $baseUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$base_dir}";
        return trim($baseUrl, "/");
    }

}

define('URL_PROJECT', URL::getBase());
