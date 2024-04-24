<?php
class Db {

	// Databázové spojení
  private static $spojeni;

	// Výchozí nastavení ovladače
  private static $nastaveni = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_EMULATE_PREPARES => false,
	);

	// Připojí se k databázi pomocí daných údajů
  public static function pripoj($server, $uzivatel, $heslo, $databaze)
  {
	  if (!isset(self::$spojeni)) 
    {
        $dsn = "mysql:host=$server;dbname=$databaze;charset=utf8";
		self::$spojeni = new PDO(
			$dsn,
			$uzivatel,
			$heslo,
			self::$nastaveni
		);
	  }
	}
	
  public static function dotazJeden($dotaz, $parametry = array()) {
		  $navrat = self::$spojeni->prepare($dotaz);
		  $navrat->execute($parametry);
	  return $navrat->fetch();
	}


  public static function dotazVsechny($dotaz, $parametry = array()) {
		$navrat = self::$spojeni->prepare($dotaz);
		$navrat->execute($parametry);
		return $navrat->fetchAll();
	}
	
  public static function dotazSamotny($dotaz, $parametry = array()) {
		$vysledek = self::dotazJeden($dotaz, $parametry);
		return $vysledek[0];
	}
	
	public static function dotaz($dotaz, $parametry = array()) {
		$navrat = self::$spojeni->prepare($dotaz);
		$navrat->execute($parametry);
		return $navrat->rowCount();
	}
	
	
	public static function vloz($tabulka, $parametry = array()) {  
		return self::dotaz("
      INSERT INTO $tabulka 
      (". implode(', ', array_keys($parametry)). ") 
      VALUES
      (". str_repeat('?,', sizeOf($parametry)-1). "?)
    ",
			array_values($parametry));
	}
	
	public static function zmen($tabulka, $hodnoty = array(), $podminka, $parametry = array()) {
		return self::dotaz("UPDATE $tabulka SET ".
		implode(' = ?, ', array_keys($hodnoty)).
		" = ? " . $podminka,
		array_merge(array_values($hodnoty), $parametry));
	}

	public static function odstran($tabulka, $atribut = NULL, $hodnotaAtributu = NULL) {
		$sql = "
			DELETE FROM $tabulka 
		";
		if (!empty($atribut)) 
			$sql .= "
			  WHERE $atribut = ?
			";
		
		return self::dotaz($sql,
		!empty($atribut) ? [$hodnotaAtributu] : []);
	}
	
	// Vrací ID posledně vloženého záznamu
	public static function idPoslednihoVlozeneho()
	{
		return self::$spojeni->lastInsertId();
	}
}