<?php

class ChecklistVmModel extends Model {

    protected $k_id_checklist_vm;
    protected $k_id_vm;
    protected $k_id_checklist;
    protected $n_estado;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "checklist_vm";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdChecklistVm($k_id_checklist_vm) {
        $this->k_id_checklist_vm = $k_id_checklist_vm;
    }
    public function getKIdChecklistVm() {
        return $this->k_id_checklist_vm;
    }
    public function setKIdVm($k_id_vm) {
        $this->k_id_vm = $k_id_vm;
    }
    public function getKIdVm() {
        return $this->k_id_vm;
    }
    public function setKIdChecklist($k_id_checklist) {
        $this->k_id_checklist = $k_id_checklist;
    }
    public function getKIdChecklist() {
        return $this->k_id_checklist;
    }
    public function setNEstado($n_estado) {
        $this->n_estado = $n_estado;
    }
    public function getNEstado() {
        return $this->n_estado;
    }


}

