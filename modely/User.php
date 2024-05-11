<?php
class User {
	private $id_u;
	private $name;
	private $surname;
	private $usrname;
	private $mail;
	private $password;
	private $typ_uctu;

	public function __construct($id_u, $name, $surname, $usrname, $mail, $password, $typ_uctu) {
	  $this->id_u = $id_u;
	  $this->name = $name;
	  $this->surname = $surname;
	  $this->usrname = $usrname;
	  $this->mail = $mail;
	  $this->password = $password;
	  $this->typ_uctu = $typ_uctu;
	}
	public function vratId() {
		return $this->id_u;
	}

	public function __toString() {
	  return "$this->id_u , $this->name , $this->surname , $this->usrname , $this->mail , $this->typ_uctu";
	}
  
} 
?>