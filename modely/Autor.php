<?php
class Autor {
	private $id_i;
	private $jmeno;
	private $prijmeni;
	private $ArtistName;
	private $foto;


	public function __construct($id_i, $jmeno, $prijmeni, $ArtistName, $foto) {
	  $this->id_i = $id_i;
	  $this->jmeno = $jmeno;
	  $this->prijmeni = $prijmeni;
	  $this->ArtistName = $ArtistName;
	  $this->foto = $foto;
	}
	public function vratId() {
		return $this->id_i;
	}

	public function __toString() {
	  return "$this->id_i , $this->jmeno , $this->prijmeni , $this->ArtistName , $this->foto";
	}
  
} 
?>