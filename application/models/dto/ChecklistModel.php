<?php

class ChecklistModel extends Model {

    protected $k_id_checklist;
    protected $k_id_documento;
    protected $k_id_technology;
    protected $k_id_work;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "checklist";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdChecklist($k_id_checklist) {
        $this->k_id_checklist = $k_id_checklist;
    }
    public function getKIdChecklist() {
        return $this->k_id_checklist;
    }
    public function setKIdDocumento($k_id_documento) {
        $this->k_id_documento = $k_id_documento;
    }
    public function getKIdDocumento() {
        return $this->k_id_documento;
    }
    public function setKIdTechnology($k_id_technology) {
        $this->k_id_technology = $k_id_technology;
    }
    public function getKIdTechnology() {
        return $this->k_id_technology;
    }
    public function setKIdWork($k_id_work) {
        $this->k_id_work = $k_id_work;
    }
    public function getKIdWork() {
        return $this->k_id_work;
    }


}

