<?php
class Track {
	private $id_s;
	private $nazev;
	private $obrazek;
	private $zdroj;
	private $id_z;
	private $id_i;

	public function __construct($id_s, $nazev, $obrazek, $zdroj, $id_z, $id_i) {
	  $this->id_s = $id_s;
	  $this->nazev = $nazev;
	  $this->obrazek = $obrazek;
	  $this->zdroj = $zdroj;
	  $this->id_z = $id_z;
	  $this->id_i = $id_i;
	}
	public function vratId() {
		return $this->id_s;
	}

	public function __toString() {
	  return "$this->id_s  ,  $this->nazev  ,  $this->obrazek  ,  $this->zdroj  ,  $this->id_z  ,  $this->id_i";
	}
  
} 
?>