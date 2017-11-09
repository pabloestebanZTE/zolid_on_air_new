<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CamelTypes {

    /**
     * Todo el string en minúscula.
     * @param type $string
     * @param type $removeSpaces
     * @return type
     */
    public static function lowerCase($string, $removeSpaces = true) {
        $string = CamelTypes::quitUnderlines(strtolower($string));
        if ($removeSpaces) {
            $string = CamelTypes::quitSpaces($string);
        }
        return $string;
    }

    /**
     * Todas las palabras inician con mayúscula.
     * @param type $string
     * @param type $removeSpaces
     */
    public static function camelCase($string, $removeSpaces = true) {
        $string = CamelTypes::quitUnderlines($string);
        $string = CamelTypes::capitalize($string);
        if ($removeSpaces) {
            $string = CamelTypes::quitSpaces($string);
        }
        return $string;
    }

    /**
     * Todas las palabras inician con mayúscula, excepto la primera.
     * @param type $string
     * @param type $removeSpaces
     * @return string
     */
    public static function lowerCamelCase($string, $removeSpaces = true) {
        $string = CamelTypes::camelCase($string, $removeSpaces);
        $string = strtolower(substr($string, 0, 1)) . substr($string, 1);
        return $string;
    }

    public static function lowerInitial($string, $removeSpaces = true) {
        $string = strtolower(substr($string, 0, 1)) . substr($string, 1);
        return $string;
    }

    public static function upperInitial($string, $removeSpaces = true) {
        $string = strtoupper(substr($string, 0, 1)) . substr($string, 1);
        return $string;
    }

    public static function capitalize($string) {
        return ucwords($string);
    }

    public static function quitUnderlines($string, $removeSpaces = true) {
        return str_replace("_", " ", $string);
    }

    public static function quitSpaces($string, $removeSpaces = true) {
        return preg_replace('/\s+/', '', $string);
    }

}
