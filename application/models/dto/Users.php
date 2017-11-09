<?php

class Users extends Model {

    protected $id;
    protected $token;
    protected $username;
    protected $email;
    protected $password;
    protected $permises; //[]    

    //Los campos que desea ocultar para que no se reflejen en la vista.
    protected $table = "users";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data", "permises"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    public function setToken($token) {
        $this->token = $token;
    }
    public function getToken() {
        return $this->token;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getPassword() {
        return $this->password;
    }


}
