<?php
class NahratKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceUzivatelu = new SpravceUzivatelu;
    $spravceNahrat = new SpravceNahrat;

    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    
    $this->pohled = "nahrat";

    if (isset($parametry[1]) && $parametry[1] == "odstranit") {
      $spravceNahrat->odstranSkladbu($parametry[0]);
      $this->pridejZpravu("Skladba {$parametry[0]} byla úspěšně odstraněna.");
      $this->presmeruj("nahrat");
    }

    $track = $spravceNahrat->vratPrazdnouSkladbu();
    $zanr = $spravceNahrat->vratPrazdnyZanr();
    $autor = $spravceNahrat->vratPrazdnehoAutora();

    if (isset($parametry[1]) && $parametry[1] == "editovat") {
      $track = $spravceNahrat->vratJednuSkladbu($parametry[0]);
      $zanr = $spravceNahrat->vratZanr($parametry[0]);
      $autor = $spravceNahrat->vratAutora($parametry[0]);
    }  

    if (isset($_POST["nazev"])) {
      $_POST["id_z"] = substr($_POST["id_z"],1);
      echo $_POST["id_z"];
      $_POST["id_z"] = $spravceNahrat->convertToIDZ($_POST["id_z"]);
      echo $_POST["id_z"];
      include 'modely/Upload.php';  
      if($_SESSION["ok1"] == 1)
        $_POST["obrazek"] = $_SESSION["obrazek"];

      include 'modely/UploadSkladba.php';
      if($_SESSION["ok2"] == 1)
        $_POST["zdroj"] = $_SESSION["zdroj"];

      $_POST["id_i"] = $prihlasenyUzivatel["id_um"];
      $spravceNahrat->ulozSkladbu($_POST);
      $this->presmeruj("nahrat");
      
      if($_SESSION["ok1"] == 1 && $_SESSION["ok2"] == 1)
          $this->pridejZpravu("Skladba {$_POST["nazev"]} byla úspěšně nahrána.");
      
    }

    $tracksDB = $spravceNahrat->vratSkladbu($prihlasenyUzivatel["id_um"]);

    $tracks = $spravceNahrat->prevedUdajeSkladebNaObjekty($tracksDB);

    $zanry = $spravceNahrat->vratZanry();

    $autori = $spravceNahrat->vratAutory();
    
    $this->data["autori"] = $autori;
    $this->data["autorReturn"] = $autor;
    $this->data["zanry"] = $zanry;
    $this->data["zanrReturn"] = $zanr;
    $this->data["tracks"] = $tracks;
    $this->data["track"] = $track;
  }
}

?>