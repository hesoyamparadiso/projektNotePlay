<?php
class SkladbaOblibene {
	private $id_s;
	private $nazev;
	private $obrazek;
	private $zdroj;
	private $id_z;
	private $id_i;
	private $jmeno;
	private $pohled;

	public function __construct($id_s, $nazev, $obrazek, $zdroj, $id_z, $id_i, $jmeno, $pohled) {
	  $this->id_s = $id_s;
	  $this->nazev = $nazev;
	  $this->obrazek = "/Content/covers/" . $obrazek;
	  $this->zdroj = $zdroj;
	  $this->id_z = $id_z;
	  $this->id_i = $id_i;
	  $this->jmeno = $jmeno;
	  $this->pohled = "oblibene";
	}
	
	public function __toString() {
	  return "
			<a class='trackLink' href='/$this->pohled/$this->id_s'>
			<div class='icon'>
			<img class=\"trackPic\" src= $this->obrazek >
            <p class=\"trackLabels\" style=\"font-size: 16px\"> $this->nazev </p> 
            <p class=\"trackLabels\" style=\"font-size: 14px; color: #A8A8A8\"> $this->jmeno </p>
			</div>
			</a>
			";
	}

} 
?>