<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_acs_model extends CI_Model {

    public function __construct() {
        
    }

    public function insertAcs($request) {
        $response = new Response(EMessages::INSERT);
        try {
            //Verificamos, limpiamos y obtenemos la información del primer formulario (VM).
            $obj = $this->validateAndGetData($request->vm->all());
            if ($obj) {
                //Insertamos el formulario (VM)...
                $vmModel = new VmModel();
                $obj->d_fecha_solicitud = date('Y-m-d');
                $idVm = $vmModel->insert($obj->all())->data;
                $response->setData($idVm);
                if ($idVm == 0) {
                    return new Response(EMessages::ERROR_INSERT, "No se pudo crear el registro.");
                }
                //Insertamos el kpi del ACS...
                //Creación...
                $kpiAcsModel = new KpiAcsModel();
                $kpiAcsModel->insert([
                    "k_id_user" => Auth::user()->k_id_user,
                    "k_id_vm" => $idVm,
                    "d_create_at" => Hash::getDate(),
                    "n_type" => "CREATION_VM"
                ]);
                //Verificamos, limpiamos y obtenemos la información del segundo formulario (AVM).
                $avmModel = new AvmModel();
                $request->avm->k_id_vm = $idVm;
                $obj2 = $this->validateAndGetData($request->avm);
                $idAvm = DB::NULLED;
                if ($obj2) {
                    $idAvm = $avmModel->insert($obj2->all())->data;
                    if ($idAvm > 0) {
                        $kpiAcsModel = new KpiAcsModel();
                        $kpiAcsModel->insert([
                            "k_id_user" => Auth::user()->k_id_user,
                            "k_id_vm" => $idVm,
                            "d_create_at" => Hash::getDate(),
                            "n_type" => "CREATION_AVM"
                        ]);
                    }
                }
                //Verificamos, limpiamos y obteneoms la información del 4 formulario (CVM).
                $cvmModel = new CvmModel();
                $request->cvm->k_id_vm = $idVm;
                $obj3 = $this->validateAndGetData($request->cvm);
                if ($obj3) {
                    $idCvm = $cvmModel->insert($obj3->all())->data;
                    if ($idCvm > 0) {
                        $kpiAcsModel = new KpiAcsModel();
                        $kpiAcsModel->insert([
                            "k_id_user" => Auth::user()->k_id_user,
                            "k_id_vm" => $idVm,
                            "d_create_at" => Hash::getDate(),
                            "n_type" => "CREATION_CVM"
                        ]);
                    }
                }
            } else {
                return new Response(EMessages::ERROR, "Formulario incompleto.");
            }
        } catch (DeplynException $ex) {
            return $ex;
        }
        return $response;
    }

    public function updateAcs($request) {
        $response = new Response(EMessages::UPDATE);
        try {
            //Verificamos si el registro existe...
            $vmModel = new VmModel();
            if (!$vmModel->where("k_id_vm", "=", $request->id)->exist()) {
                return new Response(EMessages::ERROR, "El registro no existe.");
            }
            //Verificamos, limpiamos y obtenemos la información del primer formulario (VM).
            $obj = $this->validateAndGetData($request->vm->all());
            if ($obj) {
                //Actualizamos el formulario (VM)...
                $vmModel = new VmModel();
                $idVm = $vmModel->where("k_id_vm", "=", $request->id)->update($obj->all())->data;

                $avmModel = new AvmModel();
                $obj2 = $this->validateAndGetData($request->avm->all());
                //Si existe el AVM, lo actualizamos...
                if ($avmModel->where("k_id_vm", "=", $request->id)->exist()) {
                    $avmModel->where("k_id_vm", "=", $request->id)->update($obj2->all());
                } else { //De lo contrario, lo insertamos...
                    $request->avm->k_id_vm = $request->id;
                    $idAvm = DB::NULLED;
                    if ($obj2) {
                        $obj2->k_id_vm = $request->id;
                        $idAvm = $avmModel->insert($obj2->all())->data;
                        if ($idAvm > 0) {
                            $kpiAcsModel = new KpiAcsModel();
                            $kpiAcsModel->insert([
                                "k_id_user" => Auth::user()->k_id_user,
                                "k_id_vm" => $request->id,
                                "d_create_at" => Hash::getDate(),
                                "n_type" => "CREATION_AVM"
                            ]);
                        }
                    }
                }

                $cvmModel = new CvmModel();
                $obj3 = $this->validateAndGetData($request->cvm->all());
                //Si existe el CVM, lo actualizamos...
                if ($cvmModel->where("k_id_vm", "=", $request->id)->exist()) {
                    $cvmModel->where("k_id_vm", "=", $request->id)->update($obj3->all());
                } else { //De lo contrario, lo insertamos...
                    if ($obj3) {
                        $obj3->k_id_vm = $request->id;
                        $idCvm = $cvmModel->insert($obj3->all())->data;
                        if ($idCvm) {
                            $kpiAcsModel = new KpiAcsModel();
                            $kpiAcsModel->insert([
                                "k_id_user" => Auth::user()->k_id_user,
                                "k_id_vm" => $request->id,
                                "d_create_at" => Hash::getDate(),
                                "n_type" => "CREATION_CVM"
                            ]);
                        }
                    }
                }
            } else {
                return new Response(EMessages::ERROR, "Formulario incompleto.");
            }
        } catch (DeplynException $ex) {
            return $ex;
        }
        return $response;
    }

    public function validateAndGetData($formData) {
        $valid = new Validator();
        $val = 0;
        $obj = new ObjUtil($formData);
        foreach ($formData as $key => $value) {
            if ($valid->required(null, $value)) {
                $val++;
            } else {
                $obj->{$key} = DB::NULLED;
            }
        }
        if ($val == 0) {
            $obj = null;
        }
        return $obj;
    }

}
