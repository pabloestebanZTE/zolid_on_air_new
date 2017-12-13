<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acs extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function principal() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $this->load->view('principalvm');
    }

    public function acsview() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $this->load->view('acsView');
    }

}
