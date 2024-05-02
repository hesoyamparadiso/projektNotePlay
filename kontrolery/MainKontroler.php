<?php
class MainKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 

    $spravceMainu = new SpravceMainu();

    $this->pohled = "main";

    if ((isset($parametry[0]) && is_numeric($parametry[0]) == true) || !isset($parametry[0])){
      $skladbyDB = $spravceMainu->vratSkladbySJmenem();
    }    

    $skladby = $spravceMainu->prevedUdajeSkladebNaObjekty($skladbyDB, $this->pohled);
    $this->data["skladby"] = $skladby;
    
  }
}

?>