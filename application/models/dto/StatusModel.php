<?php

class StatusModel extends Model {

    protected $k_id_status;
    protected $n_name_status;

    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "status";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

        public function setKIdStatus($k_id_status) {
        $this->k_id_status = $k_id_status;
    }
    public function getKIdStatus() {
        return $this->k_id_status;
    }
    public function setNNameStatus($n_name_status) {
        $this->n_name_status = $n_name_status;
    }
    public function getNNameStatus() {
        return $this->n_name_status;
    }


}
