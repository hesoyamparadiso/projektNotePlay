<?php
class MainKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 

    $spravceMainu = new SpravceMainu();
    $spravceUzivatelu = new SpravceUzivatelu; 

    $this->pohled = "main";
    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel = $spravceUzivatelu->vratPrihlasenehoUzivatele();

    if ((isset($parametry[0]) && is_numeric($parametry[0]) == true) || !isset($parametry[0])){
      $skladbyDB = $spravceMainu->vratSkladbySJmenem();
    }
    
    if (isset($parametry[0])) {
        $this->data["currTrack"] = "/Content/hudba/" . $spravceMainu->vratZdrojSkladby($parametry[0]);
       
    }   

    $skladby = $spravceMainu->prevedUdajeSkladebNaObjekty($skladbyDB, $this->pohled);
    $this->data["skladby"] = $skladby;
    
  }
}

?>