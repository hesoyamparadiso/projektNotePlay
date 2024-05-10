<?php
class OblibeneKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceUzivatelu = new SpravceUzivatelu;
    $spravceMainu = new SpravceMainu();
    $spravceOblibene = new SpravceOblibene();
    $spravceKomentaru = new SpravceKomentaru;

    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele(); 
 
    $this->pohled = "skladby";
    $this->data["control"] = "oblibene";

    $skladbyDB = $spravceOblibene->vratOblibeneSkladby();
    $skladby = $spravceOblibene->prevedUdajeSkladebNaObjekty($skladbyDB, $this->pohled);
    $this->data["skladby"] = $skladby;

    if (isset($parametry[1]) && $parametry[1] == "odstranit") {
      $spravceKomentaru->odstranKomentar($parametry[0]);
      $url = "oblibene/" . $_SESSION["currTrackID"];
      $this->presmeruj($url);

    }else if (isset($parametry[0])) {
      $this->data["currTrack"] = "/Content/hudba/" . $spravceMainu->vratZdrojSkladby($parametry[0]);
      $this->data["currTrackName"] = $spravceMainu->vratNazevSkladby($parametry[0]);
      $this->data["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[0]);
      $_SESSION["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[0]);
    }
    
    /*vrátí 1 nebo 0 -> zda je aktualní skladba v oblibenych*/
    if (isset($this->data["currTrackID"])) {
        $this->data["like"] = $spravceMainu->vratLike($this->data["currTrackID"], $this->data["prihlasenyUzivatel"]["id_u"]);
    }

    if (isset($_POST["comment"])) {
        $spravceKomentaru->pridejKomentar($_POST["comment"], $this->data["prihlasenyUzivatel"]["id_u"], $this->data["currTrackID"]);
        $url = "oblibene/" . $this->data["currTrackID"];
        $this->presmeruj($url);
    }

    if (isset($_POST["like"])) {
        $spravceMainu->pridejOblibeny($this->data["prihlasenyUzivatel"]["id_u"], $this->data["currTrackID"]);
        $url = "oblibene/" . $this->data["currTrackID"];
        $this->presmeruj($url);
    }

    if(isset($this->data["currTrackID"]))
      $this->data["komentare"] = $spravceKomentaru->vratKomentare($this->data["currTrackID"]);
    
  }
}
?>