<?php

class AuditOnAirModel extends Model {

    protected $k_id_audit;
    protected $k_id_user;
    protected $n_affected_table;
    protected $n_type;
    protected $n_query;
    protected $n_json_changes;
    protected $d_created_at;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "audit_on_air";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdAudit($k_id_audit) {
        $this->k_id_audit = $k_id_audit;
    }
    public function getKIdAudit() {
        return $this->k_id_audit;
    }
    public function setKIdUser($k_id_user) {
        $this->k_id_user = $k_id_user;
    }
    public function getKIdUser() {
        return $this->k_id_user;
    }
    public function setNAffectedTable($n_affected_table) {
        $this->n_affected_table = $n_affected_table;
    }
    public function getNAffectedTable() {
        return $this->n_affected_table;
    }
    public function setNType($n_type) {
        $this->n_type = $n_type;
    }
    public function getNType() {
        return $this->n_type;
    }
    public function setNQuery($n_query) {
        $this->n_query = $n_query;
    }
    public function getNQuery() {
        return $this->n_query;
    }
    public function setNJsonChanges($n_json_changes) {
        $this->n_json_changes = $n_json_changes;
    }
    public function getNJsonChanges() {
        return $this->n_json_changes;
    }
    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }
    public function getDCreatedAt() {
        return $this->d_created_at;
    }


}

