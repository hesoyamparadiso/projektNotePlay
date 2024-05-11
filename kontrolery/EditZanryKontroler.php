<?php
class EditZanryKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceUzivatelu = new SpravceUzivatelu;
    $spravceEditZanry = new SpravceEditZanry;

    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    
    $this->pohled = "editZanry";

    if (isset($parametry[1]) && $parametry[1] == "odstranit") {
      $spravceEditZanry->odstranZanr($parametry[0]);
      $this->pridejZpravu("Žánr {$parametry[0]} byl úspěšně odstraněn.");
      $this->presmeruj("editZanry");
    }

    $zanr = $spravceEditZanry->vratPrazdnyZanr();

    if (isset($parametry[1]) && $parametry[1] == "editovat") {
      $zanr = $spravceEditZanry->vratZanr($parametry[0]);
    }  

    if (isset($_POST["nazev"])) {
      try{
        $spravceEditZanry->ulozZanr($_POST);
        $this->pridejZpravu("Žánr {$_POST["nazev"]} byl úspěšně uložen.");
        $this->presmeruj("editZanry");
      }
      catch (DBVyjimka $v) {
        echo $v->getMessage();
        $this->presmeruj("editZanry");
      }
    }


    $zanryDB = $spravceEditZanry->vratZanry();

    $zanry = $spravceEditZanry->prevedUdajeZanruNaObjekty($zanryDB);

    $this->data["zanry"] = $zanry;
    $this->data["zanr"] = $zanr;
  }
}

?>