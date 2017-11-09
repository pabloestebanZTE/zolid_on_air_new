<?php

class Model extends Crud {

    function __construct($properties = null) {
        if (empty($properties)) {
            return;
        }
        foreach ($properties as $key => $value) {
            $this->__data[$key] = $value;
            $this->{$key} = $value;
        }
    }

    public function __get($varName) {
        if (!array_key_exists($varName, $this->__data)) {
            //this attribute is not defined!
            throw new Exception('...');
        } else
            return $this->__data[$varName];
    }

    public function __set($varName, $value) {
        $this->__data[$varName] = $value;
    }

    function getAttributes() {
        $attribs = get_class_vars($this->class);
        $returns = [];
        $max = count($attribs);
        foreach ($attribs as $key => $value) {
            if (!in_array($key, $this->exclude)) {
                $returns[] = $key;
            }
        }
        return $returns;
    }

    function parse($obj) {
        try {
            $model = $this->getAttributes();
            $finalObj = [];
            foreach ($model as $key => $value) {
                if (isset($obj[$value])) {
                    $finalObj[$value] = $obj[$value];
                }
            }
            return $finalObj;
        } catch (Exception $exc) {
            return null;
        }
    }

    function fill($obj) {
        try {
            $model = $this->getAttributes();
            foreach ($model as $key => $value) {
                if (isset($obj[$value])) {
                    $this->{$value} = $obj[$value];
                }
            }
        } catch (Exception $exc) {
            throw (new DeplynException(EMessages::ERROR_FATAL))
                    ->setMessage("Error Model.fill() :: " . $exc->getMessage());
        }
    }

    public function getTable() {
        return $this->table;
    }

}
