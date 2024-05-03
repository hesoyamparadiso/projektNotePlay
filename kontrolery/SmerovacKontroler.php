<?php
class SmerovacKontroler extends Kontroler {
  protected $kontroler; 
  

  public function zpracuj($parametry) {
      $spravceUzivatelu = new SpravceUzivatelu;
      $castiCesty = $this->parsujURL($parametry[0]);
      
      if (empty($castiCesty[0]))
      {
   
        $this->presmeruj("main");
      }

      $castNazvuKontroleru = 
        $this->pomlckyDoVelbloudiNotace(array_shift($castiCesty)); //array_shift() odstraní a vrátí první prvek
      $tridaKontroleru = $castNazvuKontroleru . "Kontroler";

      if (file_exists("kontrolery/$tridaKontroleru.php"))
        $this->kontroler = new $tridaKontroleru;
      else
        $this->presmeruj("chyba"); 
        
      $this->kontroler->zpracuj($castiCesty); 
      $this->data["prihlasenyUzivatel"] 
        = $spravceUzivatelu->vratPrihlasenehoUzivatele();
      $this->data["zpravy"] = $this->vratZpravy();  
      $this->pohled = "rozlozeni";      
  }
  

  private function pomlckyDoVelbloudiNotace($text) {
      $text = str_replace("-", " ", $text);
      $text = ucwords($text);  //prvni slovo uppercase
      $text = str_replace(" ", "", $text);
      return $text;
  }
  
  private function parsujURL($url) {
      $naparsovanaURL = parse_url($url);
      $cesta = $naparsovanaURL["path"];
      
      $cesta = ltrim($cesta, "/"); 
      $cesta = trim($cesta); 
      
      $rozdelenaCesta = explode("/", $cesta);
      
      return $rozdelenaCesta;
  }
}

?>