<?php 
class SpravceEditTracks {
    public function vratSkladbu() {
        $sqlDotaz = "
            SELECT * FROM skladby
        ";
        $tracksDB = Db::dotazVsechny($sqlDotaz);

        return $tracksDB;
    }

    public function vratJednuSkladbu($id_s) {
        $sqlDotaz = "
            SELECT * FROM skladby
            WHERE id_s = ?
        ";
        $trackDB = Db::dotazJeden($sqlDotaz, [$id_s]);

        return $trackDB; 
    }

    public function vratZanr($id_s) {
        $sqlDotaz = "
            SELECT z.nazev 
            FROM zanry z, skladby s
            WHERE z.id_z = s.id_z AND id_s = ?
        ";
        $zanrEdit = Db::dotazJeden($sqlDotaz, [$id_s]);

        return $zanrEdit; 
    }

    public function vratAutora($id_s) {
        $sqlDotaz = "
            SELECT a.ArtistName 
            FROM autori a, skladby s
            WHERE a.id_i = s.id_i AND id_s = ?
        ";
        $autorEdit = Db::dotazJeden($sqlDotaz, [$id_s]);

        return $autorEdit; 
    }

    

    public function vratZanry() {
        $sqlDotaz = "
            SELECT * FROM zanry
        ";
        $zanryDB = Db::dotazVsechny($sqlDotaz);

        return $zanryDB;
    }

    public function vratAutory() {
        $sqlDotaz = "
            SELECT * FROM autori
        ";
        $autoriDB = Db::dotazVsechny($sqlDotaz);

        return $autoriDB;
    }

    public function convertToIDZ($nazev) {
        $sqlDotaz = "
            SELECT * 
            FROM zanry 
            WHERE nazev = ?
        "; 
        $zanrID = Db::dotazJeden($sqlDotaz, [$nazev]);

        return $zanrID["id_z"];
    }

    public function convertToIDA($nazev) {
        $sqlDotaz = "
            SELECT * 
            FROM autori 
            WHERE ArtistName = ?
        "; 
        $zanrID = Db::dotazJeden($sqlDotaz, [$nazev]);

        return $zanrID["id_i"];
    }

    public function ulozSkladbu($udajeSkladby) {      
      try{
          if (empty($udajeSkladby["id_s"])){
              unset($udajeSkladby["id_s"]);
              Db::vloz("skladby", $udajeSkladby);
          }      
          else
              Db::zmen("skladby", $udajeSkladby, 
                  "WHERE id_s = ?", [$udajeSkladby["id_s"]]); 
        }
        catch (PDOException $e) {
          throw new DBVyjimka("Uživatele není možno odstranit! Error: ({$e->getMessage()})");
        }   
    }       


    public function odstranSkladbu($id_s) {
        Db::odstran("skladby", "id_s", $id_s);
    } 

    public function prevedUdajeSkladebNaObjekty($tracksDB) {
        $tracks = [];
        foreach ($tracksDB as $track) {
            $tracks[] = new Track($track["id_s"], $track["nazev"], $track["obrazek"], $track["zdroj"], $track["id_z"], $track["id_i"]);
        }
        return $tracks;
    }

    public function vratPrazdnouSkladbu() {
        return [
            "id_s" => "",
            "nazev" => "",
            "obrazek" => "",
            "zdroj" => "",
            "id_z" => "",
            "id_i" => ""
        ];
    }

    public function vratPrazdnyZanr() {
        return [
            "id_z" => "",
            "nazev" => "",
            "popis" => "",
            "barva" => ""
        ];
    }

        public function vratPrazdnehoAutora() {
        return [
            "id_i" => "",
            "jmeno" => "",
            "prijmeni" => "",
            "ArtistName" => ""
        ];
    }
}