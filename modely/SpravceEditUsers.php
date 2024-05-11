<?php 
class SpravceEditUsers {
    public function vratUzivatele() {
        $sqlDotaz = "
            SELECT * FROM uzivatele
        ";
        $usersDB = Db::dotazVsechny($sqlDotaz);

        return $usersDB;
    }

    public function vratJednohoUzivatele($idUser) {
        $sqlDotaz = "
            SELECT * FROM uzivatele
            WHERE id_u = ?
        ";
        $userDB = Db::dotazJeden($sqlDotaz, [$idUser]);

        return $userDB; 
    }

    public function vratJednohoUmelce($id_u) {
        $sqlDotaz = "
            SELECT id_um FROM uzivatele
            WHERE id_u = ?
        ";
        $typDB = Db::dotazJeden($sqlDotaz, [$id_u]);

        return $typDB;
    }

    public function vratTypy() {
        $sqlDotaz = "
            SELECT distinct typ_uctu 
            FROM uzivatele
        ";
        $typyDB = Db::dotazVsechny($sqlDotaz);

        return $typyDB;
    }

    public function vratUmelce() {
        $sqlDotaz = "
            SELECT distinct * 
            FROM autori
        ";
        $umelciDB = Db::dotazVsechny($sqlDotaz);

        return $umelciDB;
    }

    public function vratTypUctu($id_u) {
        $sqlDotaz = "
            SELECT typ_uctu FROM uzivatele
            WHERE id_u = ?
        ";
        $typDB = Db::dotazJeden($sqlDotaz, [$id_u]);

        return $typDB; 
    }

    public function ulozUzivatele($udajeUzivatele) {
    try{
      if (empty($udajeUzivatele["id_u"])){
          unset($udajeUzivatele["id_u"]);
          Db::vloz("uzivatele", $udajeUzivatele);
      }
        else
            Db::zmen("uzivatele", $udajeUzivatele, 
                "WHERE id_u = ?", [$udajeUzivatele["id_u"]]); 
      }
      catch (PDOException $e) {
        
      }   
    }

    public function prevedNaCislo($typString) {
        if (strcmp($typString,"admin") == 0) {
          $typ = 3;
        }else if (strcmp($typString,"interpret") == 0) {
          $typ = 2;
        }else {
          $typ = 1;
        }
        return $typ;
    }

    public function odstranUzivatele($id_u) {
        Db::odstran("uzivatele", "id_u", $id_u);
    } 

    public function prevedUdajeUzivateluNaObjekty($usersDB) {
        $users = [];
        foreach ($usersDB as $user) {
            $users[] = new User($user["id_u"], $user["name"], $user["surname"], $user["usrname"], $user["mail"], $user["password"], $user["typ_uctu"],);
        }
        return $users;
    }

    public function vratPrazdnehoUzivatele() {
        return [
            "id_u" => "",
            "name" => "",
            "surname" => "",
            "usrname" => "",
            "mail" => "",
            "password" => "",
            "typ_uctu" => ""
        ];
    }
}