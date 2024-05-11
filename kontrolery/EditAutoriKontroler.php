<?php
class EditAutoriKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceUzivatelu = new SpravceUzivatelu;
    $spravceEditAutori = new SpravceEditAutori;

    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    
    $this->pohled = "editAutori";

    if (isset($parametry[1]) && $parametry[1] == "odstranit") {
      $spravceEditAutori->odstranAutora($parametry[0]);
      $this->pridejZpravu("Autor {$parametry[0]} byl úspěšně odstraněn.");
      $this->presmeruj("editAutori");
    }

    $autor = $spravceEditAutori->vratPrazdnehoAutora();

    if (isset($parametry[1]) && $parametry[1] == "editovat") {
      $autor = $spravceEditAutori->vratAutora($parametry[0]);
    }  

    if (isset($_POST["jmeno"])) {
      include 'modely/UploadAutor.php'; 
      if($_SESSION["ok1"] == 1)
        $_POST["foto"] = $_SESSION["foto"];
      $spravceEditAutori->ulozAutora($_POST);
      $this->presmeruj("editAutori");
      if($_SESSION["ok1"] == 1)
        $this->pridejZpravu("Autor {$_POST["ArtistName"]} byl úspěšně nahrán."); 
    }

    $autoriDB = $spravceEditAutori->vratAutory();

    $autori = $spravceEditAutori->prevedUdajeAutoruNaObjekty($autoriDB);

    $this->data["autori"] = $autori;
    $this->data["autor"] = $autor;
  }
}

?>