<?php

class UserModel extends Model {

    protected $k_id_user;
    protected $n_code_user;
    protected $n_name_user;
    protected $n_last_name_user;
    protected $n_username_user;
    protected $n_mail_user;
    protected $i_phone_user;
    protected $i_cellphone_user;
    protected $n_password;
    protected $n_role_user;
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "user";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdUser($k_id_user) {
        $this->k_id_user = $k_id_user;
    }

    public function getKIdUser() {
        return $this->k_id_user;
    }

    public function setNCodeUser($n_code_user) {
        $this->n_code_user = $n_code_user;
    }

    public function getNCodeUser() {
        return $this->n_code_user;
    }

    public function setNNameUser($n_name_user) {
        $this->n_name_user = $n_name_user;
    }

    public function getNNameUser() {
        return $this->n_name_user;
    }

    public function setNLastNameUser($n_last_name_user) {
        $this->n_last_name_user = $n_last_name_user;
    }

    public function getNLastNameUser() {
        return $this->n_last_name_user;
    }

    public function setNUsernameUser($n_username_user) {
        $this->n_username_user = $n_username_user;
    }

    public function getNUsernameUser() {
        return $this->n_username_user;
    }

    public function setNMailUser($n_mail_user) {
        $this->n_mail_user = $n_mail_user;
    }

    public function getNMailUser() {
        return $this->n_mail_user;
    }

    public function setIPhoneUser($i_phone_user) {
        $this->i_phone_user = $i_phone_user;
    }

    public function getIPhoneUser() {
        return $this->i_phone_user;
    }

    public function setICellphoneUser($i_cellphone_user) {
        $this->i_cellphone_user = $i_cellphone_user;
    }

    public function getICellphoneUser() {
        return $this->i_cellphone_user;
    }

    public function setNPassword($n_password) {
        $this->n_password = $n_password;
    }

    public function getNPassword() {
        return $this->n_password;
    }

    public function setNRoleUser($n_role_user) {
        $this->n_role_user = $n_role_user;
    }

    public function getNRoleUser() {
        return $this->n_role_user;
    }

}
