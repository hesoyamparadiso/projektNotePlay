<?php
class Avatar {
	private $id_i;
	private $foto;
	private $ArtistName;

	public function __construct($id_i, $foto, $ArtistName) {
	  $this->id_i = $id_i;
	  $this->ArtistName = $ArtistName;
	  $this->foto = "/Content/fotos/" . $foto;
	}

	public function __toString() {
	  return "
			<a class='trackLink' href='skladby/$this->id_i'>
			<div class='icon'>
			<img class=\"trackPic\" src= $this->foto >
            <p style=\"padding-top: 12px\" class=\"trackLabels\" style=\"font-size: 16px\"> $this->ArtistName </p> 
			</div>
			</a>
			";
	}
} 
?>