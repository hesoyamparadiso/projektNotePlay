<?php
class EditTracksKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceUzivatelu = new SpravceUzivatelu;
    $spravceEditTracks = new SpravceEditTracks;

    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    
    $this->pohled = "editTracks";

    if (isset($parametry[1]) && $parametry[1] == "odstranit") {
      $spravceEditTracks->odstranSkladbu($parametry[0]);
      $this->pridejZpravu("Skladba {$parametry[0]} byla úspěšně odstraněna.");
      $this->presmeruj("editTracks");
    }

    $track = $spravceEditTracks->vratPrazdnouSkladbu();
    $zanr = $spravceEditTracks->vratPrazdnyZanr();
    $autor = $spravceEditTracks->vratPrazdnehoAutora();

    if (isset($parametry[1]) && $parametry[1] == "editovat") {
      $track = $spravceEditTracks->vratJednuSkladbu($parametry[0]);
      $zanr = $spravceEditTracks->vratZanr($parametry[0]);
      $autor = $spravceEditTracks->vratAutora($parametry[0]);
    }  

    if (isset($_POST["nazev"])) {  
        $_POST["id_z"] = substr($_POST["id_z"],1);
        $_POST["id_z"] = $spravceEditTracks->convertToIDZ($_POST["id_z"]);
        $_POST["id_i"] = substr($_POST["id_i"],1);
        $_POST["id_i"] = $spravceEditTracks->convertToIDA($_POST["id_i"]);

        include 'modely/Upload.php';
        if($_SESSION["ok1"] == 1)
          $_POST["obrazek"] = $_SESSION["obrazek"];

        include 'modely/UploadSkladba.php';
        if($_SESSION["ok2"] == 1)
          $_POST["zdroj"] = $_SESSION["zdroj"];

        $spravceEditTracks->ulozSkladbu($_POST);
        $this->presmeruj("editTracks");

        if($_SESSION["ok1"] == 1 && $_SESSION["ok2"] == 1)
          $this->pridejZpravu("Skladba {$_POST["nazev"]} byla úspěšně nahrána.");  

    }



    $tracksDB = $spravceEditTracks->vratSkladbu();

    $tracks = $spravceEditTracks->prevedUdajeSkladebNaObjekty($tracksDB);

    $zanry = $spravceEditTracks->vratZanry();

    $autori = $spravceEditTracks->vratAutory();
    
    $this->data["autori"] = $autori;
    $this->data["autorReturn"] = $autor;
    $this->data["zanry"] = $zanry;
    $this->data["zanrReturn"] = $zanr;
    $this->data["tracks"] = $tracks;
    $this->data["track"] = $track;
  }
}

?>