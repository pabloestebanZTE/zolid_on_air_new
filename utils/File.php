<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class File {

    private $filePath;

    function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function read($filePath = null) {
        $filePath = (isset($filePath)) ? $filePath : $this->filePath;
        $file = fopen($filePath, "r");
        $content = "";
        while (!feof($file)) {
            $content .= fgets($file);
        }
        fclose($file);
        return $content;
    }

    public function write($content, $filePath = null) {
        $filePath = (isset($filePath)) ? $filePath : $this->filePath;
        $file = fopen($filePath, "w");
        fwrite($file, $content . PHP_EOL);
        fclose($file);
    }

}
