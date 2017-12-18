<?php

class BandModel extends Model {

    protected $k_id_band;
    protected $n_name_band;
    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "band";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdBand($k_id_band) {
        $this->k_id_band = $k_id_band;
    }

    public function getKIdBand() {
        return $this->k_id_band;
    }

    public function setNNameBand($n_name_band) {
        $this->n_name_band = $n_name_band;
    }

    public function getNNameBand() {
        return $this->n_name_band;
    }

}
