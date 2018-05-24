<?php

class DocumentosAcsModel extends Model {

    protected $k_id_documento;
    protected $n_nombre;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "documentos_acs";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdDocumento($k_id_documento) {
        $this->k_id_documento = $k_id_documento;
    }
    public function getKIdDocumento() {
        return $this->k_id_documento;
    }
    public function setNNombre($n_nombre) {
        $this->n_nombre = $n_nombre;
    }
    public function getNNombre() {
        return $this->n_nombre;
    }


}

