<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_evaluador_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/UserModel');
    }

    public function getMonth($month) {
        $months = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        return $months[intval($month)];
    }

    private function getStadisticsObject($sql) {
        $db = new DB();
        $kpis = $db->select($sql)->get();
        $monts = 0;
        $montsTemp = [
            $this->getMonth(1) => 0,
            $this->getMonth(2) => 0,
            $this->getMonth(3) => 0,
            $this->getMonth(4) => 0,
            $this->getMonth(5) => 0,
            $this->getMonth(6) => 0,
            $this->getMonth(7) => 0,
            $this->getMonth(8) => 0,
            $this->getMonth(9) => 0,
            $this->getMonth(10) => 0,
            $this->getMonth(11) => 0,
            $this->getMonth(12) => 0,
        ];
        $array = [
            "onTime" => $montsTemp,
            "overTime" => $montsTemp
        ];
        foreach ($kpis as $kpi) {
            $monthInt = date("m", strtotime($kpi->d_start));
            $month = $this->getMonth($monthInt);
//            echo $monthInt . " --- " . $month . "<br/>";
            $obj = "onTime";
            if ($kpi->on_time != "Y") {
                $obj = "overTime";
            }
            if (isset($array[$obj][$month])) {
                $array[$obj][$month] = $array[$obj][$month] + 1;
            } else {
                $array["onTime"][$month] = 0;
                $array["overTime"][$month] = 0;
            }
        }
        return $array;
    }

    public function getCountedStatistics($sql) {
        $db = new DB();
        $kpis = $db->select($sql)->get();
        $array = [
            "onTime" => 0,
            "overTime" => 0
        ];
        foreach ($kpis as $kpi) {
            $obj = "onTime";
            if ($kpi->on_time != "Y") {
                $obj = "overTime";
            }
            $array[$obj] = $array[$obj] + 1;
        }
        return $array;
    }

    public function getAllStadistics() {
        $resposne = new Response(EMessages::QUERY);
        $all = $this->getStadisticsObject("SELECT kpi_r.* FROM kpi_summary_onair kpi_s
                     INNER JOIN kpi_summary kpi_r ON kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_12h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_24h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_36h = kpi_r.k_kpi_summary                      
                     WHERE kpi_r.on_time = 'Y' OR kpi_r.on_time = 'N' 
                     ORDER BY 
                     kpi_r.d_start asc");
        $precheck = $this->getStadisticsObject("SELECT kpi_r.* FROM kpi_summary_onair kpi_s
                     INNER JOIN kpi_summary kpi_r ON kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary                    
                     OR kpi_s.k_id_summary_12h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_24h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_36h = kpi_r.k_kpi_summary 
                     WHERE kpi_r.e_type = 'PRE' AND (kpi_r.on_time = 'Y' OR kpi_r.on_time = 'N') 
                     ORDER BY 
                     kpi_r.d_start asc");
        $postcheck = $this->getStadisticsObject("SELECT kpi_r.* FROM kpi_summary_onair kpi_s
                     INNER JOIN kpi_summary kpi_r ON kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_12h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_24h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_36h = kpi_r.k_kpi_summary 
                     WHERE kpi_r.e_type = 'POS' AND (kpi_r.on_time = 'Y' OR kpi_r.on_time = 'N') 
                     ORDER BY 
                     kpi_r.d_start asc");

        $data = [
            "all" => $all,
            "precheck" => $precheck,
            "postcheck" => $postcheck
        ];
        $resposne->setData($data);
        return $resposne;
    }

    public function getStadisticsByUser($user) {
        $response = new Response(EMessages::QUERY);
        if ($user) {
            $today = $this->getCountedStatistics("SELECT kpi_r.* FROM kpi_summary_onair kpi_s
                     INNER JOIN kpi_summary kpi_r ON kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_12h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_24h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_36h = kpi_r.k_kpi_summary                      
                     WHERE kpi_r.k_id_executor = $user->k_id_user AND 
                     kpi_r.d_start > DATE_SUB(NOW(), INTERVAL 1 DAY) 
                     AND (kpi_r.on_time = 'Y' OR kpi_r.on_time = 'N') 
                     ORDER BY    
                     kpi_r.d_start asc");


            $all = $this->getStadisticsObject("SELECT kpi_r.* FROM kpi_summary_onair kpi_s
                     INNER JOIN kpi_summary kpi_r ON kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_12h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_24h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_36h = kpi_r.k_kpi_summary                      
                     WHERE kpi_r.k_id_executor = $user->k_id_user 
                     AND (kpi_r.on_time = 'Y' OR kpi_r.on_time = 'N') 
                     ORDER BY 
                     kpi_r.d_start asc");

            $precheck = $this->getStadisticsObject("SELECT kpi_r.* FROM kpi_summary_onair kpi_s
                     INNER JOIN kpi_summary kpi_r ON kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary                    
                     OR kpi_s.k_id_summary_12h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_24h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_36h = kpi_r.k_kpi_summary 
                     WHERE kpi_r.e_type = 'PRE' AND 
                     kpi_r.k_id_executor = $user->k_id_user 
                     AND (kpi_r.on_time = 'Y' OR kpi_r.on_time = 'N') 
                     ORDER BY 
                     kpi_r.d_start asc");

            $postcheck = $this->getStadisticsObject("SELECT kpi_r.* FROM kpi_summary_onair kpi_s
                     INNER JOIN kpi_summary kpi_r ON kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_precheck = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_12h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_24h = kpi_r.k_kpi_summary 
                     OR kpi_s.k_id_summary_36h = kpi_r.k_kpi_summary 
                     WHERE kpi_r.e_type = 'POS' AND 
                     kpi_r.k_id_executor = $user->k_id_user 
                     AND (kpi_r.on_time = 'Y' OR kpi_r.on_time = 'N') 
                     ORDER BY 
                     kpi_r.d_start asc");


            $data = [
                "today" => $today,
                "all" => $all,
                "precheck" => $precheck,
                "postcheck" => $postcheck
            ];
            $response->setData($data);
        } else {
            $response = new Response(EMessages::NO_FOUND_REGISTERS);
        }
        return $response;
    }

}
