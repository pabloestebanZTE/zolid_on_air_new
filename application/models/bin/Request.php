<?php

class Request {

    protected $request;
    protected $data;
    public $method;

    public function __construct($request = null) {
        if (!$request) {
            $request = $_REQUEST;
        }
        $this->request = $request;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->data = array();
        foreach ($request as $key => $value) {
            if (is_array($value)) {
                $this->data[$key] = new Request($value);
            } else {
                $this->data[$key] = $value;
            }
        }
    }

    public function __get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    public function getParam($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function all() {
        return $this->data;
    }

}
