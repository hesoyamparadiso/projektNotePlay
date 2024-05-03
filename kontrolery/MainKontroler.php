<?php
class MainKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 

    $spravceMainu = new SpravceMainu();
    $spravceUzivatelu = new SpravceUzivatelu;
    $spravceKomentaru = new SpravceKomentaru;

    $this->pohled = "main";
    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    $this->data["control"] = "main";

    if (isset($parametry[1]) && $parametry[1] == "odstranit") {
      $spravceKomentaru->odstranKomentar($parametry[0]);
      $url = "main/" .  $_SESSION["currTrackID"];
      $this->presmeruj($url);

    }else if (isset($parametry[0])) {
        $this->data["currTrack"] = "/Content/hudba/" . $spravceMainu->vratZdrojSkladby($parametry[0]);
        $this->data["currTrackName"] = $spravceMainu->vratNazevSkladby($parametry[0]);
        $this->data["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[0]);
        $_SESSION["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[0]);
    }
 
    if (isset($parametry[0])) {
        $this->data["currTrack"] = "/Content/hudba/" . $spravceMainu->vratZdrojSkladby($parametry[0]);
       
    }   

    if (isset($_POST["comment"])) {
        $spravceKomentaru->pridejKomentar($_POST["comment"], $this->data["prihlasenyUzivatel"]["id_u"], $this->data["currTrackID"]);
        $url = "main/" . $this->data["currTrackID"];
        $this->presmeruj($url);
    }

   if ((isset($parametry[0]) && is_numeric($parametry[0]) == true) || !isset($parametry[0])){
      $skladbyDB = $spravceMainu->vratSkladbySJmenem();
    }
    
    $skladby = $spravceMainu->prevedUdajeSkladebNaObjekty($skladbyDB, $this->pohled);
    $this->data["skladby"] = $skladby;
    
    if(isset($this->data["currTrackID"]))
      $this->data["komentare"] = $spravceKomentaru->vratKomentare($this->data["currTrackID"]);
    
  }
}

?>