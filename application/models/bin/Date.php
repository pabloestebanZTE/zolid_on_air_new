<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Date {

    public $year;
    public $month;
    public $day;
    public $hour;
    public $minute;
    public $secound;

    function __construct($date = null) {
        date_default_timezone_set("America/Bogota");
        if ($date == null) {
            $date = Hash::getDate();
        }
        $date = date_create($date);
        $date = date_format($date, "Y-m-d H:i:s");
        $this->year = date("Y", strtotime($date));
        $this->month = date("m", strtotime($date));
        $this->day = date("d", strtotime($date));
        $this->hour = date("H", strtotime($date));
        $this->minute = date("i", strtotime($date));
        $this->secound = date("s", strtotime($date));
    }

    public function getDate() {
        return date("Y-m-d H:i:s", strtotime($this->year . "-" . $this->month . "-" . $this->day . " " . $this->hour . ":" . $this->minute . ":" . $this->secound));
    }

}
