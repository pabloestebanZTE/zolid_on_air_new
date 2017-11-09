<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Redirect {

    private $uri;

    function __construct() {
        $this->uri = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : URL::to("");
    }

    public function saveUri() {
        
    }

    public static function redirect($uri) {
        header("Location: $uri");
    }
    
    public static function to($uri) {
        header("Location: $uri");
    }

    public static function back() {
        if (empty($this->uri)) {
            return;
        }
        self::redirect($this->uri);
    }

}
