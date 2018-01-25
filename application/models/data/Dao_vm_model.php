<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_vm_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/VmModel');
    }

    public function insertVm($request) {
        try {
            $vm = new VmModel();
            $datos = $vm->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function updateVm($request) {
        try {
            $vm = new VmModel();
            $datos = $vm->where("k_id_vm", "=", $request->k_id_vm)
                    ->update($request->all());
//            echo $vm->getSQL();
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getAll() {
        try {
            $vm = new VmModel();
            $datos = $vm->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getAllVm() {
        try {
            $db = new DB();
            $datos['historico'] = $db->select("SELECT vm.*, CONCAT(us1.n_name_user, ' ', us1.n_last_name_user) ingeniero_creador_grupo, CONCAT(us2.n_name_user, ' ', us2.n_last_name_user) ingeniero_control, 
                                                    CONCAT(us3.n_name_user, ' ', us3.n_last_name_user) ingeniero_apertura, CONCAT(us4.n_name_user, ' ', us4.n_last_name_user) ingeniero_cierre, st.n_name_station, 
                                                    tg.n_name_technology, bn.n_name_band, wk.n_name_ork
                                                FROM vm
                                                INNER JOIN station st ON st.k_id_station = vm.k_id_station
                                                INNER JOIN technology tg ON tg.k_id_technology = vm.k_id_technology
                                                INNER JOIN band bn ON bn.k_id_band = vm.k_id_band
                                                INNER JOIN work wk ON wk.k_id_work = vm.k_id_work
                                                LEFT JOIN user us1 ON us1.k_id_user = vm.i_ingeniero_creador_grupo 
                                                LEFT JOIN user us2 ON us2.k_id_user = vm.i_ingeniero_punto_control
                                                LEFT JOIN user us3 ON us3.k_id_user = vm.i_ingeniero_apertura
                                                LEFT JOIN user us4 ON us4.k_id_user = vm.i_ingeniero_cierre")->get();
            
            $datos['hoy'] = $db->select("SELECT vm.*, CONCAT(us1.n_name_user, ' ', us1.n_last_name_user) ingeniero_creador_grupo, CONCAT(us2.n_name_user, ' ', us2.n_last_name_user) ingeniero_control, 
                                            CONCAT(us3.n_name_user, ' ', us3.n_last_name_user) ingeniero_apertura, CONCAT(us4.n_name_user, ' ', us4.n_last_name_user) ingeniero_cierre, st.n_name_station, 
                                            tg.n_name_technology, bn.n_name_band, wk.n_name_ork
                                        FROM vm
                                        INNER JOIN station st ON st.k_id_station = vm.k_id_station
                                        INNER JOIN technology tg ON tg.k_id_technology = vm.k_id_technology
                                        INNER JOIN band bn ON bn.k_id_band = vm.k_id_band
                                        INNER JOIN work wk ON wk.k_id_work = vm.k_id_work
                                        LEFT JOIN user us1 ON us1.k_id_user = vm.i_ingeniero_creador_grupo 
                                        LEFT JOIN user us2 ON us2.k_id_user = vm.i_ingeniero_punto_control
                                        LEFT JOIN user us3 ON us3.k_id_user = vm.i_ingeniero_apertura
                                        LEFT JOIN user us4 ON us4.k_id_user = vm.i_ingeniero_cierre
                                        WHERE vm.d_fecha_solicitud >= CURDATE()")->get();
            
            $datos['apertura'] = $db->select("SELECT vm.*, CONCAT(us1.n_name_user, ' ', us1.n_last_name_user) ingeniero_creador_grupo, CONCAT(us2.n_name_user, ' ', us2.n_last_name_user) ingeniero_control, 
                                                CONCAT(us3.n_name_user, ' ', us3.n_last_name_user) ingeniero_apertura, CONCAT(us4.n_name_user, ' ', us4.n_last_name_user) ingeniero_cierre, st.n_name_station, 
                                                tg.n_name_technology, bn.n_name_band, wk.n_name_ork
                                            FROM vm
                                            INNER JOIN station st ON st.k_id_station = vm.k_id_station
                                            INNER JOIN technology tg ON tg.k_id_technology = vm.k_id_technology
                                            INNER JOIN band bn ON bn.k_id_band = vm.k_id_band
                                            INNER JOIN work wk ON wk.k_id_work = vm.k_id_work
                                            LEFT JOIN user us1 ON us1.k_id_user = vm.i_ingeniero_creador_grupo 
                                            LEFT JOIN user us2 ON us2.k_id_user = vm.i_ingeniero_punto_control
                                            LEFT JOIN user us3 ON us3.k_id_user = vm.i_ingeniero_apertura
                                            LEFT JOIN user us4 ON us4.k_id_user = vm.i_ingeniero_cierre
                                            WHERE vm.n_fase_ventana = 'apertura vm' AND vm.n_asignado = 'N' 
                                            AND vm.d_fecha_solicitud >= CURDATE()")->get();
            $datos['control'] = $db->select("SELECT vm.*, CONCAT(us1.n_name_user, ' ', us1.n_last_name_user) ingeniero_creador_grupo, CONCAT(us2.n_name_user, ' ', us2.n_last_name_user) ingeniero_control, 
                                                CONCAT(us3.n_name_user, ' ', us3.n_last_name_user) ingeniero_apertura, CONCAT(us4.n_name_user, ' ', us4.n_last_name_user) ingeniero_cierre, st.n_name_station, 
                                                tg.n_name_technology, bn.n_name_band, wk.n_name_ork
                                            FROM vm
                                            INNER JOIN station st ON st.k_id_station = vm.k_id_station
                                            INNER JOIN technology tg ON tg.k_id_technology = vm.k_id_technology
                                            INNER JOIN band bn ON bn.k_id_band = vm.k_id_band
                                            INNER JOIN work wk ON wk.k_id_work = vm.k_id_work
                                            LEFT JOIN user us1 ON us1.k_id_user = vm.i_ingeniero_creador_grupo 
                                            LEFT JOIN user us2 ON us2.k_id_user = vm.i_ingeniero_punto_control
                                            LEFT JOIN user us3 ON us3.k_id_user = vm.i_ingeniero_apertura
                                            LEFT JOIN user us4 ON us4.k_id_user = vm.i_ingeniero_cierre
                                            WHERE vm.n_fase_ventana = 'punto control' AND vm.n_asignado = 'N' 
                                            AND vm.d_fecha_solicitud >= CURDATE()")->get();
            $datos['cierre'] = $db->select("SELECT vm.*, CONCAT(us1.n_name_user, ' ', us1.n_last_name_user) ingeniero_creador_grupo, CONCAT(us2.n_name_user, ' ', us2.n_last_name_user) ingeniero_control, 
                                                CONCAT(us3.n_name_user, ' ', us3.n_last_name_user) ingeniero_apertura, CONCAT(us4.n_name_user, ' ', us4.n_last_name_user) ingeniero_cierre, st.n_name_station, 
                                                tg.n_name_technology, bn.n_name_band, wk.n_name_ork
                                            FROM vm
                                            INNER JOIN station st ON st.k_id_station = vm.k_id_station
                                            INNER JOIN technology tg ON tg.k_id_technology = vm.k_id_technology
                                            INNER JOIN band bn ON bn.k_id_band = vm.k_id_band
                                            INNER JOIN work wk ON wk.k_id_work = vm.k_id_work
                                            LEFT JOIN user us1 ON us1.k_id_user = vm.i_ingeniero_creador_grupo 
                                            LEFT JOIN user us2 ON us2.k_id_user = vm.i_ingeniero_punto_control
                                            LEFT JOIN user us3 ON us3.k_id_user = vm.i_ingeniero_apertura
                                            LEFT JOIN user us4 ON us4.k_id_user = vm.i_ingeniero_cierre
                                            WHERE vm.n_fase_ventana = 'cierre vm' AND vm.n_asignado = 'N' 
                                            AND vm.d_fecha_solicitud >= CURDATE()")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function toAssignEngineerStage($k_id_vm, $ingeniero, $campo) {
        try {
            $vm = new VmModel();
            $datos = $vm->where("k_id_vm", "=", $k_id_vm)
                    ->update([
                $campo => $ingeniero,
                'n_asignado' => 'Y',
            ]);
//            echo $vm->getSQL();
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getVmAssigned() {
        try {
            $db = new DB();
            $usuario_session = Auth::user()->k_id_user;
            $datos = $db->select("SELECT vm.*, st.n_name_station, tg.n_name_technology, bn.n_name_band, wk.n_name_ork
                                FROM vm
                                INNER JOIN station st ON st.k_id_station = vm.k_id_station
                                INNER JOIN technology tg ON tg.k_id_technology = vm.k_id_technology
                                INNER JOIN band bn ON bn.k_id_band = vm.k_id_band
                                INNER JOIN work wk ON wk.k_id_work = vm.k_id_work
                                WHERE vm.n_asignado = 'Y' AND vm.d_fecha_solicitud >= CURDATE() 
                                AND vm.i_ingeniero_apertura = $usuario_session 
                                OR vm.i_ingeniero_punto_control = $usuario_session 
                                OR vm.i_ingeniero_cierre = $usuario_session")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

}

?>
