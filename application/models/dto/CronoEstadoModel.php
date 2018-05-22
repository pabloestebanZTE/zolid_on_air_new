<?php

class CronoEstadoModel extends Model {

    protected $k_id_crono_estado;
    protected $n_name_estatus;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "crono_estado";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdCronoEstado($k_id_crono_estado) {
        $this->k_id_crono_estado = $k_id_crono_estado;
    }
    public function getKIdCronoEstado() {
        return $this->k_id_crono_estado;
    }
    public function setNNameEstatus($n_name_estatus) {
        $this->n_name_estatus = $n_name_estatus;
    }
    public function getNNameEstatus() {
        return $this->n_name_estatus;
    }


}

