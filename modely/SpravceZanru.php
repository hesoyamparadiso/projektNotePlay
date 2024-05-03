<?php 
class SpravceZanru {
    public function vratZanry() {
        $sqlDotaz = "
            SELECT * FROM zanry
        ";
        $zanryDB = Db::dotazVsechny($sqlDotaz);

        return $zanryDB;
    }

    public function prevedUdajeZanruNaObjekty($zanryDB) {
        $zanry = [];
        foreach ($zanryDB as $zanr) {
            $zanry[] = new Zanr($zanr["id_z"], $zanr["nazev"], $zanr["barva"]);
        }
        return $zanry;
    }
}