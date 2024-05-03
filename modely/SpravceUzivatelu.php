<?php
class SpravceUzivatelu {

    public function prihlas($prihlasovaciUdaje) {
        
      $sql = "
         SELECT *
         FROM uzivatele
         WHERE usrname = ?
          AND password = ?
        ";

      $uzivatel = Db::dotazJeden($sql, 
          [
            $prihlasovaciUdaje["usrName"],
            $this->vratHashHesla($prihlasovaciUdaje["password"])
          ]  
      );
          
      if ($uzivatel) {
          $_SESSION["uzivatel"] = $uzivatel;
          return 1;
      }
      return 0;    

    }

    public function registruj($udaje) {
      $udaje["password"] =  $this->vratHashHesla($udaje["password"]);

      $uzivatel = Db::vloz("uzivatele", $udaje);
      
      if ($uzivatel) {
          return 1;
      }
      
      return 0;    

    }
    
    public function odhlas() {

        if ($this->vratPrihlasenehoUzivatele()) {
          unset($_SESSION["uzivatel"]);
          return 1;
        }
        return 0;

    }
    
    public function vratPrihlasenehoUzivatele() {

        if (isset($_SESSION["uzivatel"]))
          return $_SESSION["uzivatel"];
        else
          return false;    

    }
    

    private function vratHashHesla($heslo) {
    
        return hash("sha256", $heslo);

    }

}
?>