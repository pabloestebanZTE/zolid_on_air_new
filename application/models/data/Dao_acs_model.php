<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_acs_model extends CI_Model {

    public function __construct() {
        
    }

    public function insertAcs($request) {
        $response = new Response(EMessages::INSERT);
        return $response;
    }

    public function updateAcs($request) {
        $response = new Response(EMessages::UPDATE);
        return $response;
    }

}
