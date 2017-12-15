<?php

class CityModel extends Model {

    protected $k_id_city;
    protected $k_id_regional;
    protected $n_name_city;
    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "city";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdCity($k_id_city) {
        $this->k_id_city = $k_id_city;
    }

    public function getKIdCity() {
        return $this->k_id_city;
    }

    public function setKIdRegional($k_id_regional) {
        $this->k_id_regional = $k_id_regional;
    }

    public function getKIdRegional() {
        return $this->k_id_regional;
    }

    public function setNNameCity($n_name_city) {
        $this->n_name_city = $n_name_city;
    }

    public function getNNameCity() {
        return $this->n_name_city;
    }

}
