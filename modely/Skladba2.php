<?php
class Skladba2 {
	private $id_s;
	private $nazev;
	private $obrazek;
	private $zdroj;
	private $id_z;
	private $id_i;
	private $jmeno;
	private $pohled;

	public function __construct($id_s, $nazev, $obrazek, $zdroj, $id_z, $id_i, $jmeno, $pohled = 'skladby') {
	  $this->id_s = $id_s;
	  $this->nazev = $nazev;
	  $this->obrazek = "/Content/covers/" . $obrazek;
	  $this->zdroj = $zdroj;
	  $this->id_z = $id_z;
	  $this->id_i = $id_i;
	  $this->jmeno = $jmeno;
	  $this->pohled = $pohled;
	}
	
	public function __toString() {
	  if ($this->pohled == "autori"){
		return "
					<a class='trackLink' href='/skladby/$this->id_i/$this->id_s'>
					<div class='icon'>
					<img class=\"trackPic\" src= $this->obrazek >
					<p class=\"trackLabels\" style=\"font-size: 16px\"> $this->nazev </p> 
					<p class=\"trackLabels\" style=\"font-size: 14px; color: #A8A8A8\"> $this->jmeno </p>
					</div>
					</a>
					";
	  }else{
		return "
					<a class='trackLink' href='/skladby/z$this->id_z/$this->id_s'>
					<div class='icon'>
					<img class=\"trackPic\" src= $this->obrazek >
					<p class=\"trackLabels\" style=\"font-size: 16px\"> $this->nazev </p> 
					<p class=\"trackLabels\" style=\"font-size: 14px; color: #A8A8A8\"> $this->jmeno </p>
					</div>
					</a>
					";
	  }
	  
	}

} 
?>