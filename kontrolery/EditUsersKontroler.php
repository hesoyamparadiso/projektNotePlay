<?php
class EditUsersKontroler extends Kontroler {
  
  public function zpracuj($parametry) { 
    $spravceUzivatelu = new SpravceUzivatelu;
    $spravceEditUsers = new SpravceEditUsers;

    $this->data["prihlasenyUzivatel"] = $prihlasenyUzivatel 
    = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    
    $this->pohled = "editUsers";

    if (isset($parametry[1]) && $parametry[1] == "odstranit") {
      $spravceEditUsers->odstranUzivatele($parametry[0]);
      $this->pridejZpravu("Uživatel {$parametry[0]} byl úspěšně odstraněn.");
      $this->presmeruj("editUsers");
    }

    $user = $spravceEditUsers->vratPrazdnehoUzivatele();
    $typ = "";
    $umelec["id_um"] = "";

    if (isset($parametry[1]) && $parametry[1] == "editovat") {
      $user = $spravceEditUsers->vratJednohoUzivatele($parametry[0]);
      $typ = $spravceEditUsers->vratTypUctu($parametry[0]);
      $umelec = $spravceEditUsers->vratJednohoUmelce($parametry[0]);
    }  

    if (isset($_POST["usrname"])) {
    try{
      $_POST["typ_uctu"] = $spravceEditUsers->prevedNaCislo($_POST["typ_uctu"]);
      $spravceEditUsers->ulozUzivatele($_POST);
      $this->presmeruj("editUsers");
      $this->pridejZpravu("Uzivatel {$_POST["usrname"]} byl úspěšně uložen.");
      }
      catch (DBVyjimka $v) {
        $this->pridejZpravu($v->getMessage(), "chyba");
        $this->presmeruj("editUsers");
      }
      
    }

    $usersDB = $spravceEditUsers->vratUzivatele();

    $users = $spravceEditUsers->prevedUdajeUzivateluNaObjekty($usersDB);
    
    $typy = $spravceEditUsers->vratTypy();

    $umelci = $spravceEditUsers->vratUmelce();

    $this->data["umelci"] = $umelci;
    $this->data["umelecReturn"] = $umelec;
    $this->data["users"] = $users;
    $this->data["user"] = $user;
    $this->data["typReturn"] = $typ;
    $this->data["typy"] = $typy;

  }
}

?>