<?php

class TechnologyModel extends Model {

    protected $k_id_technology;
    protected $n_name_technology;

    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "technology";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

        public function setKIdTechnology($k_id_technology) {
        $this->k_id_technology = $k_id_technology;
    }
    public function getKIdTechnology() {
        return $this->k_id_technology;
    }
    public function setNNameTechnology($n_name_technology) {
        $this->n_name_technology = $n_name_technology;
    }
    public function getNNameTechnology() {
        return $this->n_name_technology;
    }


}
