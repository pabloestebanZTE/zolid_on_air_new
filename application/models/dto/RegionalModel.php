<?php

class RegionalModel extends Model {

    protected $k_id_regional;
    protected $n_name_regional;

    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "regional";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

        public function setKIdRegional($k_id_regional) {
        $this->k_id_regional = $k_id_regional;
    }
    public function getKIdRegional() {
        return $this->k_id_regional;
    }
    public function setNNameRegional($n_name_regional) {
        $this->n_name_regional = $n_name_regional;
    }
    public function getNNameRegional() {
        return $this->n_name_regional;
    }


}
