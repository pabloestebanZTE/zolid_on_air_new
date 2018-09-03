<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File {

	function __construct() {
		parent::__construct();
	}
	
	$llantas = 4;

	//
	public function conbustible($conbustible = 'gasolina'){
		return 'Su vehiculo usa $combustible';
	}

	//
	public function velocidad($distanc, $tiempo){
		return $distanc * $tiempo;
	}
  
}
