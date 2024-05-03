<?php
class ZanryKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceZanru = new SpravceZanru();
    $spravceUzivatelu = new SpravceUzivatelu;

    $this->pohled = "zanry"; 
    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele();     
    
    $zanryDB = $spravceZanru->vratZanry();
    $zanry = $spravceZanru->prevedUdajeZanruNaObjekty($zanryDB);
    $this->data["zanry"] = $zanry;

  }
}

?>