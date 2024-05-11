<?php 
class SpravceEditAutori {
    public function vratAutory() {
        $sqlDotaz = "
            SELECT * FROM autori
        ";
        $autoriDB = Db::dotazVsechny($sqlDotaz);

        return $autoriDB;
    }

    public function vratAutora($id_i) {
        $sqlDotaz = "
            SELECT * FROM autori
            WHERE id_i = ?
        ";
        $autorDB = Db::dotazJeden($sqlDotaz, [$id_i]);

        return $autorDB; 
    }

    public function ulozAutora($udajeAutora) {
        if (empty($udajeAutora["id_i"])) {
          unset($udajeAutora["id_i"]);
          Db::vloz("autori", $udajeAutora);
        }          
        else
            Db::zmen("autori", $udajeAutora, 
                "WHERE id_i = ?", [$udajeAutora["id_i"]]);    
    }

    public function odstranAutora($id_i) {
        Db::odstran("autori", "id_i", $id_i);
    } 

    public function prevedUdajeAutoruNaObjekty($autoriDB) {
        $autori = [];
        foreach ($autoriDB as $autor) {
            $autori[] = new Autor($autor["id_i"], $autor["jmeno"], $autor["prijmeni"], $autor["ArtistName"], $autor["foto"]);
        }
        return $autori;
    }

    public function vratPrazdnehoAutora() {
        return [
            "id_i" => "",
            "jmeno" => "",
            "prijmeni" => "",
            "ArtistName" => "",
            "foto" => ""
        ];
    }
}