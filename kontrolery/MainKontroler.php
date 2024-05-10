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
      if($_SESSION["searchmode"] == 0)
          $url = "main/" .  $_SESSION["currTrackID"];
      else
          $url = "main/search:=" . $_SESSION["searchVyraz"] . "/" . $_SESSION["currTrackID"];
      $this->presmeruj($url);

    } else if (isset($parametry[0]) && substr($parametry[0],0,8) == "search:=") {
        $skladbyDB = $spravceMainu->vratVyhledaneSkladby(substr($parametry[0],8));
        $this->data["search"] = $parametry[0];
        if(isset($parametry[1])){
            $this->data["currTrack"] = "/Content/hudba/" . $spravceMainu->vratZdrojSkladby($parametry[1]);
            $this->data["currTrackName"] = $spravceMainu->vratNazevSkladby($parametry[1]);
            $this->data["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[1]);
            $_SESSION["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[1]);
        }   
    } else if (isset($parametry[0])) {
        $this->data["currTrack"] = "/Content/hudba/" . $spravceMainu->vratZdrojSkladby($parametry[0]);
        $this->data["currTrackName"] = $spravceMainu->vratNazevSkladby($parametry[0]);
        $this->data["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[0]);
        $_SESSION["currTrackID"] = $spravceMainu->vratIDSkladby($parametry[0]);
    }   

    if (isset($_POST["comment"]) && substr($parametry[0],0,8) == "search:=") {
        $spravceKomentaru->pridejKomentar($_POST["comment"], $this->data["prihlasenyUzivatel"]["id_u"], $this->data["currTrackID"]);
        $url = "main/" . $parametry[0] . "/" . $this->data["currTrackID"];
        $this->presmeruj($url);
    } else if (isset($_POST["comment"])) {
        $spravceKomentaru->pridejKomentar($_POST["comment"], $this->data["prihlasenyUzivatel"]["id_u"], $this->data["currTrackID"]);
        $url = "main/" . $this->data["currTrackID"];
        $this->presmeruj($url);
    }

    if (isset($_POST["like"]) && substr($parametry[0],0,8) == "search:="){
        $spravceMainu->pridejOblibeny($this->data["prihlasenyUzivatel"]["id_u"], $this->data["currTrackID"]);
        $url = "main/" . $parametry[0] . "/" . $this->data["currTrackID"];
        $this->presmeruj($url);
    } else if (isset($_POST["like"])) {
        $spravceMainu->pridejOblibeny($this->data["prihlasenyUzivatel"]["id_u"], $this->data["currTrackID"]);
        $url = "main/" . $this->data["currTrackID"];
        $this->presmeruj($url);
    }
    
    /*vrátí 1 nebo 0 -> zda je aktualní skladba v oblibenych*/
    if (isset($this->data["currTrackID"]) && isset($this->data["prihlasenyUzivatel"]["id_u"])) {
        $this->data["like"] = $spravceMainu->vratLike($this->data["currTrackID"], $this->data["prihlasenyUzivatel"]["id_u"]);
    }

    if(isset($_POST["search"])){
        $_SESSION["searchmode"] = 1;
        $_SESSION["searchVyraz"] = $_POST["search"];
        $url = "main/" . "search:=" . $_POST["search"];
        $this->presmeruj($url);
        $skladbyDB = $spravceMainu->vratVyhledaneSkladby($_POST["search"]);
    }else if ((isset($parametry[0]) && is_numeric($parametry[0]) == true) || !isset($parametry[0])){
      $skladbyDB = $spravceMainu->vratSkladbySJmenem();
    }

    if (!isset($this->data["search"])){
        $this->data["search"] = 0;
        $_SESSION["searchmode"] = 0;
        
    }
    
    $skladby = $spravceMainu->prevedUdajeSkladebNaObjekty($skladbyDB, $this->pohled, $this->data["search"]);
    $this->data["skladby"] = $skladby;
    
    if(isset($this->data["currTrackID"]))
      $this->data["komentare"] = $spravceKomentaru->vratKomentare($this->data["currTrackID"]);
    
  }
}

?>