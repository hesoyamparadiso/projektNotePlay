<?php
class RegisterKontroler extends Kontroler {
  
   public function zpracuj($parametry) {
     $spravceUzivatelu = new SpravceUzivatelu;
     
     if (!empty($_POST)) {
        if ($spravceUzivatelu->registruj($_POST)) {
            $this->pridejZpravu("Registrace byla �sp�n�.");
            $this->presmeruj("login");
        }
        else
          $this->pridejZpravu("Registrace nebyla �sp�n�.");
          
     }
     
     $this->pohled = "register";
   }

}
?>