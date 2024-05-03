<?php
class AvatariKontroler extends Kontroler {
  
  public function zpracuj($parametry) {
    $spravceAvataru = new SpravceAvataru();
    $spravceUzivatelu = new SpravceUzivatelu;  

    $this->pohled = "autori";
    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
        = $spravceUzivatelu->vratPrihlasenehoUzivatele();

    $avatariDB = $spravceAvataru->vratAvatary();
    $avatari = $spravceAvataru->prevedUdajeAvataruNaObjekty($avatariDB);
    $this->data["avatari"] = $avatari;
  }
}

?>