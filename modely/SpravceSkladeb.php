<?php 
class SpravceSkladeb {
    public function vratSkladbyUmelceSJmenem($id_i) {
        $sqlDotaz = "
            SELECT skladby.id_s, skladby.nazev, skladby.obrazek, skladby.zdroj, skladby.id_z, skladby.id_i, autori.ArtistName
            FROM skladby, autori
            WHERE skladby.id_i = autori.id_i AND skladby.id_i = ?
        ";
        $skladbyDB = Db::dotazVsechny($sqlDotaz, [$id_i]);

        return $skladbyDB; 
    }

    public function vratSkladbyZanruSJmenem ($id_z) {
        $sqlDotaz = "
            SELECT skladby.id_s, skladby.nazev, skladby.obrazek, skladby.zdroj, skladby.id_z, skladby.id_i, autori.ArtistName
            FROM skladby, autori
            WHERE skladby.id_i = autori.id_i AND id_z = ?
        ";
        $skladbyDB = Db::dotazVsechny($sqlDotaz, [$id_z]);

        return $skladbyDB; 
    }

    public function vratZdrojSkladby($id_s) {
        $sqlDotaz = "
            SELECT *
            FROM skladby
            WHERE id_s = ?
        ";
        $skladbaDB = Db::dotazJeden($sqlDotaz, [$id_s]);

        return $skladbaDB["zdroj"]; 
    }

    public function prevedUdajeSkladebNaObjekty($skladbyDB, $pohled = '0') {
        $skladby = [];
        if ($pohled == 0){
            foreach ($skladbyDB as $skladba) {
                $skladby[] = new Skladba2($skladba["id_s"], $skladba["nazev"], $skladba["obrazek"], $skladba["zdroj"], $skladba["id_z"], $skladba["id_i"], $skladba["ArtistName"]);
            }
        }else{
            foreach ($skladbyDB as $skladba) {
                $skladby[] = new Skladba2($skladba["id_s"], $skladba["nazev"], $skladba["obrazek"], $skladba["zdroj"], $skladba["id_z"], $skladba["id_i"], $skladba["ArtistName"], $pohled);
            }
        }
        return $skladby;
    }
}