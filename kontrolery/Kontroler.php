<?php
abstract class Kontroler {
  protected $pohled = "";
  protected $data = array();


  
  public function vypisPohled() {
    extract($this->data);
    require("pohledy/{$this->pohled}.phtml");
  }

  public function vypisPlayer() {
    extract($this->data);
    require("pohledy/player.phtml");
  }

  public function presmeruj($url) {
    header("Location: /$url");
    exit;
  }

  public function pridejZpravu($zprava, $typ = "ok") {
    $_SESSION["zpravy"]["text"] = $zprava;
  }

  public function vratZpravy() {
    if (isset($_SESSION["zpravy"])) {
      $zpravy = $_SESSION["zpravy"];
      unset($_SESSION["zpravy"]);
      return $zpravy;
    }
    else
      return [];
  } 
  abstract function zpracuj($parametry);
}

?>