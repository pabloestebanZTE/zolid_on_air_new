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
                $idVm = $vmModel->insert($obj->all())->data;

                //Verificamos, limpiamos y obtenemos la información del segundo formulario (AVM).
                $avmModel = new AvmModel();
                $request->avm->k_id_vm = $idVm;
                $obj2 = $this->validateAndGetData($request->avm);
                $idAvm = DB::NULLED;
                if ($obj2) {
                    $idAvm = $avmModel->insert($obj2->all());
                }

                //Verificamos, limpiamos y obteneoms la información del 4 formulario (CVM).
                $cvmModel = new CvmModel();
                $request->cvm->k_id_vm = $idVm;
                $obj3 = $this->validateAndGetData($request->cvm);
                if ($obj3) {
                    $idCvm = $cvmModel->insert($obj3->all());
                }
            } else {
                return new Response(EMessages::ERROR, "Formulario incompleto.");
            }
        } catch (ZolidException $ex) {
            return $ex;
        }
        return $response;
    }

    public function updateAcs($request) {
        $response = new Response(EMessages::UPDATE);
        return $response;
        try {
            //Verificamos si el registro existe...
            $vmModel = new VmModel();
            if (!$vmModel->where("k_id_vm", "=", $request->id)->exist()) {
                return new Response(EMessages::ERROR, "El registro no existe.");
            }
            //Verificamos, limpiamos y obtenemos la información del primer formulario (VM).
            $obj = $this->validateAndGetData($request->vm->all());
            if ($obj) {
                //Insertamos el formulario (VM)...
                $vmModel = new VmModel();
                $idVm = $vmModel->where("k_id_vm", "=", $request->id)->update($obj->all())->data;

                $response->setData($idVm);

                //Verificamos, limpiamos y obtenemos la información del segundo formulario (AVM).
                $avmModel = new AvmModel();
                $request->avm->k_id_vm = $idVm;
                $obj2 = $this->validateAndGetData($request->avm);
                $idAvm = DB::NULLED;
                if ($obj2) {
                    $idAvm = $avmModel->insert($obj2->all());
                }

                //Verificamos, limpiamos y obteneoms la información del 4 formulario (CVM).
                $cvmModel = new CvmModel();
                $request->cvm->k_id_vm = $idVm;
                $obj3 = $this->validateAndGetData($request->cvm);
                if ($obj3) {
                    $idCvm = $cvmModel->insert($obj3->all());
                }
            } else {
                return new Response(EMessages::ERROR, "Formulario incompleto.");
            }
        } catch (ZolidException $ex) {
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
