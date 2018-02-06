<?php

class RelatedTicketsModel extends Model {

    protected $k_id_related_ticket;
    protected $k_id_ticket1;
    protected $k_id_ticket2;
    protected $k_id_user_creator;
    protected $d_created;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "related_tickets";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdRelatedTicket($k_id_related_ticket) {
        $this->k_id_related_ticket = $k_id_related_ticket;
    }
    public function getKIdRelatedTicket() {
        return $this->k_id_related_ticket;
    }
    public function setKIdTicket1($k_id_ticket1) {
        $this->k_id_ticket1 = $k_id_ticket1;
    }
    public function getKIdTicket1() {
        return $this->k_id_ticket1;
    }
    public function setKIdTicket2($k_id_ticket2) {
        $this->k_id_ticket2 = $k_id_ticket2;
    }
    public function getKIdTicket2() {
        return $this->k_id_ticket2;
    }
    public function setKIdUserCreator($k_id_user_creator) {
        $this->k_id_user_creator = $k_id_user_creator;
    }
    public function getKIdUserCreator() {
        return $this->k_id_user_creator;
    }
    public function setDCreated($d_created) {
        $this->d_created = $d_created;
    }
    public function getDCreated() {
        return $this->d_created;
    }


}

