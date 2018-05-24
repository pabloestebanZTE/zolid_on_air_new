<?php

class StationModel extends Model {

    protected $k_id_station;
    protected $k_id_city;
    protected $n_name_station;

    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "station";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

        public function setKIdStation($k_id_station) {
        $this->k_id_station = $k_id_station;
    }
    public function getKIdStation() {
        return $this->k_id_station;
    }
    public function setKIdCity($k_id_city) {
        $this->k_id_city = $k_id_city;
    }
    public function getKIdCity() {
        return $this->k_id_city;
    }
    public function setNNameStation($n_name_station) {
        $this->n_name_station = $n_name_station;
    }
    public function getNNameStation() {
        return $this->n_name_station;
    }


}
