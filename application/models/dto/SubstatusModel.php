<?php

class SubstatusModel extends Model {

    protected $k_id_substatus;
    protected $n_name_substatus;

    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "substatus";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

        public function setKIdSubstatus($k_id_substatus) {
        $this->k_id_substatus = $k_id_substatus;
    }
    public function getKIdSubstatus() {
        return $this->k_id_substatus;
    }
    public function setNNameSubstatus($n_name_substatus) {
        $this->n_name_substatus = $n_name_substatus;
    }
    public function getNNameSubstatus() {
        return $this->n_name_substatus;
    }


}
