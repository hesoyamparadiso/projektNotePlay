<?php
class SkladbyKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 

    $spravceSkladeb = new SpravceSkladeb();
    $spravceMainu = new SpravceMainu();
    $spravceUzivatelu = new SpravceUzivatelu;

    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel = $spravceUzivatelu->vratPrihlasenehoUzivatele(); 
    $this->pohled = "skladby";
    $this->data["control"] = "skladby";
    
    if(isset($parametry[0]) && !isset($parametry[1])){ 
        $_SESSION["specifikace"] = $parametry[0]; //žánr nebo autor - filtrace
    }


    if (isset($parametry[0]) && (substr($parametry[0], 0, 1) == 'z')) { //načtení skladeb dle žánru
      $skladbyDB = $spravceSkladeb->vratSkladbyZanruSJmenem(substr($parametry[0], 1));
      $skladby = $spravceSkladeb->prevedUdajeSkladebNaObjekty($skladbyDB, "zanry");
      $this->data["skladby"] = $skladby; 

    }else if (isset($parametry[0])) {  //načtení skladeb dle autora
      $skladbyDB = $spravceSkladeb->vratSkladbyUmelceSJmenem($parametry[0]);
      $skladby = $spravceSkladeb->prevedUdajeSkladebNaObjekty($skladbyDB, "autori");
      $this->data["skladby"] = $skladby;
    }  
    
    
    if (isset($parametry[1])) {
      $this->data["currTrack"] = "/Content/hudba/" . $spravceSkladeb->vratZdrojSkladby($parametry[1]);
      $this->data["currTrackName"] = $spravceMainu->vratNazevSkladby($parametry[1]);
      $this->data["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[1]);
        /*if(!isset($_SESSION["lastTrack"])==1) {

        }else if($this->data["currTrack"] != $_SESSION["lastTrack"]) {

          if (substr($parametry[0], 0, 1) == 'z') {
            $this->data["currTrack"] = "/Content/hudba/" . $spravceSkladeb->vratZdrojSkladby($parametry[1]);
            $this->data["currTrackName"] = $spravceMainu->vratNazevSkladby($parametry[1]);
            $this->data["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[1]);
          }else {
            $this->data["currTrack"] = "/Content/hudba/" . $spravceSkladeb->vratZdrojSkladby($parametry[1]);
            $this->data["currTrackName"] = $spravceMainu->vratNazevSkladby($parametry[1]);
            $this->data["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[1]);
          }
        }*/
      }  

      if (isset($parametry[1])) {
        $_SESSION["lastTrack"] = "/Content/hudba/" . $spravceSkladeb->vratZdrojSkladby($parametry[1]);
        $_SESSION["lastTrackID"] = $parametry[1];
      }
  }
}
?>