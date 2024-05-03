<?php
class Zanr {
	private $id_z;
	private $nazev;
	private $barva;

	public function __construct($id_z, $nazev, $barva) {
	  $this->id_z = $id_z;
	  $this->nazev = $nazev;
	  $this->barva = $barva;
	}

	public function __toString() {
	  return "
			<a class='trackLink' href='/skladby/z$this->id_z'>
			<div  class='icon'>
			<div  class='zanrColor' style='background: linear-gradient(to bottom right, $this->barva,  #39BA50)'> 
			</div>
			<p style=\"padding-top: 12px\" class=\"trackLabels\" style=\"font-size: 16px\"> $this->nazev </p>
			</div>
			</a>
			";
	}
} 
?>