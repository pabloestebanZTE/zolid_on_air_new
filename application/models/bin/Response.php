<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Response {

    var $code;
    var $message;
    var $data;

    function __construct($code = null, $message = null, $data = null) {
        if (isset($code) && empty($message)) {
            $response = EMessages::getResponse($code);
            $this->code = $response->code;
            $this->message = $response->message;
            $this->data = $response->data;
            return;
        }
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function header($tag, $value) {
        header("$tag: $value");
        return $this;
    }

    public function json($obj = null) {
        $this->header("Content-Type", "application/json");
        if (is_array($obj) || is_object($obj)) {
            return json_encode($obj);
        } else {
            return json_encode($this);
        }
    }

    public function set($code) {
        return $this->json(EMessages::getResponse($code));
    }

    public function get() {
        return "HOLLA";
        return $this->json($this);
    }

    function getCode() {
        return $this->code;
    }

    function getMessage() {
        return $this->message;
    }

    function getData() {
        return $this->data;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setData($data) {
        $this->data = $data;
    }

}
