<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ObjUtil {

    protected $request;
    protected $data;
    public $method;

    public function __construct($values = null) {
        $this->data = array();
        if (isset($values)) {
            foreach ($values as $key => $value) {
                if (is_array($value)) {
                    $this->data[$key] = new Request($value);
                } else {
                    $this->data[$key] = $value;
                }
            }
        }
    }

    public function __get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    public function all() {
        return $this->data;
    }

}
