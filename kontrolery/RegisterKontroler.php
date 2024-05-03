<?php
class RegisterKontroler extends Kontroler {
  
   public function zpracuj($parametry) {
     $spravceUzivatelu = new SpravceUzivatelu;
     
     if (!empty($_POST)) {
        if ($spravceUzivatelu->registruj($_POST)) {
            $this->pridejZpravu("Registrace byla úspìšná.");
            $this->presmeruj("login");
        }
        else
          $this->pridejZpravu("Registrace nebyla úspìšná.");
          
     }
     
     $this->pohled = "register";
   }

}
?>