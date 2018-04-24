<?php

class CronogramaReportesModel extends Model {

    protected $k_id_cronograma;
    protected $k_id_crono_reporte;
    protected $d_crono_date;
    protected $k_id_crono_estado;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "cronograma_reportes";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdCronograma($k_id_cronograma) {
        $this->k_id_cronograma = $k_id_cronograma;
    }
    public function getKIdCronograma() {
        return $this->k_id_cronograma;
    }
    public function setKIdCronoReporte($k_id_crono_reporte) {
        $this->k_id_crono_reporte = $k_id_crono_reporte;
    }
    public function getKIdCronoReporte() {
        return $this->k_id_crono_reporte;
    }
    public function setDCronoDate($d_crono_date) {
        $this->d_crono_date = $d_crono_date;
    }
    public function getDCronoDate() {
        return $this->d_crono_date;
    }
    public function setKIdCronoEstado($k_id_crono_estado) {
        $this->k_id_crono_estado = $k_id_crono_estado;
    }
    public function getKIdCronoEstado() {
        return $this->k_id_crono_estado;
    }


}

