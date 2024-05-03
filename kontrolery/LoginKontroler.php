<?php
class LoginKontroler extends Kontroler {
  
   public function zpracuj($parametry) {
      $spravceUzivatelu = new SpravceUzivatelu;
      $this->pohled = "login"; 
      
      if (!empty($_POST)) {
        if ($spravceUzivatelu->prihlas($_POST)) {
            $this->pridejZpravu("Přihlášení bylo úspěšné.");
            $this->presmeruj("main");
        }
        else
          $this->pridejZpravu("Přihlášení nebylo úspěšné.");
          
     }
   }
}
?>