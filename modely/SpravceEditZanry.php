<?php 
class SpravceEditZanry {
    public function vratZanry() {
        $sqlDotaz = "
            SELECT * FROM zanry
        ";
        $zanryDB = Db::dotazVsechny($sqlDotaz);

        return $zanryDB;
    }

    public function vratZanr($id_z) {
        $sqlDotaz = "
            SELECT * FROM zanry
            WHERE id_z = ?
        ";
        $zanrDB = Db::dotazJeden($sqlDotaz, [$id_z]);

        return $zanrDB; 
    }

    public function ulozZanr($udajeZanru) { 
        try{
          if (empty($udajeZanru["id_z"])) {
                unset($udajeZanru["id_z"]);
            Db::vloz("zanry", $udajeZanru);   
          }
          else
              Db::zmen("zanry", $udajeZanru, 
                  "WHERE id_z = ?", [$udajeZanru["id_z"]]); 
      }
      catch (PDOException $e) {
          throw new DBVyjimka("Žánr není možno odstranit! Error: ({$e->getMessage()})");
      }
    }

    

    public function odstranZanr($id_z) {
        Db::odstran("zanry", "id_z", $id_z);
    } 

    public function prevedUdajeZanruNaObjekty($zanryDB) {
        $zanry = [];
        foreach ($zanryDB as $zanr) {
            $zanry[] = new ZanrEdt($zanr["id_z"], $zanr["nazev"], $zanr["barva"]);
        }
        return $zanry;
    }

    public function vratPrazdnyZanr() {
        return [
            "id_z" => "",
            "nazev" => "",
            "barva" => ""
        ];
    }
}