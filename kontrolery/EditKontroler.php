<?php
class EditKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceUzivatelu = new SpravceUzivatelu;
    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    
    $this->pohled = "edit";
  }
}

?>