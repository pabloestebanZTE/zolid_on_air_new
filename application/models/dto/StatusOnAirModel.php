<?php

class StatusOnairModel extends Model {

    protected $k_id_status_onair;
    protected $k_id_substatus;
    protected $k_id_status;

    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "status_on_air";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

        public function setKIdStatusOnair($k_id_status_onair) {
        $this->k_id_status_onair = $k_id_status_onair;
    }
    public function getKIdStatusOnair() {
        return $this->k_id_status_onair;
    }
    public function setKIdSubstatus($k_id_substatus) {
        $this->k_id_substatus = $k_id_substatus;
    }
    public function getKIdSubstatus() {
        return $this->k_id_substatus;
    }
    public function setKIdStatus($k_id_status) {
        $this->k_id_status = $k_id_status;
    }
    public function getKIdStatus() {
        return $this->k_id_status;
    }


}
