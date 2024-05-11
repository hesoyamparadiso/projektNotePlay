<?php
class ZanrEdt {
	private $id_z;
	private $nazev;
	private $barva;


	public function __construct($id_z, $nazev, $barva) {
	  $this->id_z = $id_z;
	  $this->nazev = $nazev;
	  $this->barva = $barva;
	}
	public function vratId() {
		return $this->id_z;
	}

	public function __toString() {
	  return "$this->id_z , $this->nazev , $this->barva";
	}
  
} 
?>