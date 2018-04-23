<?php

class CronoReporteModel extends Model {

    protected $k_id_crono_reporte;
    protected $n_name_report;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "crono_reporte";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdCronoReporte($k_id_crono_reporte) {
        $this->k_id_crono_reporte = $k_id_crono_reporte;
    }
    public function getKIdCronoReporte() {
        return $this->k_id_crono_reporte;
    }
    public function setNNameReport($n_name_report) {
        $this->n_name_report = $n_name_report;
    }
    public function getNNameReport() {
        return $this->n_name_report;
    }


}

